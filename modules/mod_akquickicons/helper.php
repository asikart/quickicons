<?php
/**
 * @package		Asikart Joomla! Extansion Example
 * @subpackage	mod_example
 * @copyright	Copyright (C) 2012 Asikart.com, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

abstract class modAkquickiconsHelper
{
	public static $buttons = array() ;
	
	public static function getList(&$params)
	{
		$list = null ;
		$date = JFactory::getDate( 'now' , JFactory::getConfig()->get('offset') ) ;
		$user = JFactory::getUser() ;
		$db = JFactory::getDbo();
		$q = $db->getQuery(true) ;
		
		$catid = $params->get('catid', array(78)) ;
		
		// v1.1.1
		$catid = is_array($catid) ? $catid : array($catid) ;
		$catid = implode(',', $catid);
		
		$now = $date->toSQL(true);
		
		$publish = "( (a.publish_up = '0000-00-00 00:00:00' OR a.publish_up < '{$now}') AND
					(a.publish_down = '0000-00-00 00:00:00' OR a.publish_down > '{$now}') )" ;
		
		$viewlevel = $user->getAuthorisedViewLevels();
		$viewlevel = implode(',', $viewlevel);
		
		$language 	= JFactory::getLanguage()->getTag() ;
		$select 	= "a.*, b.*,
		a.link 		AS link,
		a.images 	AS images,
		a.title 	AS title,
		a.access 	AS access,
		a.alias		AS alias,
		a.params	AS params,
		b.title 	AS cat_title
		";
		
		$q->select($select)
			->from("#__akquickicons_icons AS a")
			->join('LEFT', "#__categories AS b ON a.catid = b.id")
			->where("b.extension = 'com_akquickicons'")
			->where("a.published >=1")
			->where($publish)
			->where("a.catid IN ({$catid})")
			->where("a.access IN ({$viewlevel})")
			->where("(a.language = '{$language}' OR a.language = '*')")
			->order("b.lft, a.ordering")
			;
		
		$db->setQuery($q);
		$buttons = $db->loadObjectList();
		
		foreach( $buttons as $button ):
			
			$button->params = new JRegistry($button->params);
			
			$uri = JFactory::getURI($button->link) ;
			
			// Smart URL
			if( $button->params->get('smart_url') ) {
				$uri = self::smartUrlConvertor($uri, $button);
			}
			
			self::$buttons[$button->catid][] = array(
				'link' => JRoute::_($uri->toString()),
				'image' => JURI::root().$button->images,
				'text' => $button->title,
				'icon_class'=> $button->icon_class,
				'access' => true,
				'cat_title' => $button->cat_title,
				'id' => str_replace('-', '_', $button->alias),
				'params' => $button->params
			);
			
		endforeach;
		
		if($params->get('get_icon_from_plugins', 1)) {
			self::getIconFromPlugins($params);
		}
		
		return self::$buttons ;
	}
	
	/*
	 * function getIconFromPlugins
	 * @param $params
	 */
	
	public static function getIconFromPlugins($params)
	{
		// Include buttons defined by published quickicon plugins
		$keys = array_keys(self::$buttons);
		JPluginHelper::importPlugin('quickicon');
		$app = JFactory::getApplication();
		$arrays = (array) $app->triggerEvent('onGetIcons', array('mod_quickicon'));
		
		
		// Extensions plugin image map
		$img_map = array(
			'asterisk' => '../images/quickicons/bluestock/icon-48-extension.png',
			'download' => '../images/quickicons/bluestock/icon-48-download.png',
			'pictures' => '../images/quickicons/Primo-Icons/photo_48.png'
		);
		
		
		foreach ($arrays as $response) {
			foreach ($response as $icon) {
				$default = array(
					'link' => null,
					'image' => 'cog',
					'text' => null,
					'access' => true
				);
				$icon = array_merge($default, $icon);
				if (!is_null($icon['link']) && !is_null($icon['text'])) {
					
					// Fit Joomla!3.0 icons
					if( JVERSION >= 3 ) {
						$icon['icon_class'] = 'icon-'.$icon['image'];
						
						if(array_key_exists($icon['image'], $img_map)) {
							$icon['image'] = $img_map[$icon['image']] ;
						}
					}else{
						$cur_template = JFactory::getApplication()->getTemplate();
						//$icon['image'] = JURI::base(true) .'/templates/'. $cur_template .'/images/'.$icon['image'];
					}
					
					// Set params
					if( isset($icon['params']) ){
						$icon['params'] = ( $icon['params'] instanceof JRegistry ) ? $icon['params'] : new JRegistry() ;
					}else{
						$icon['params'] = new JRegistry ;
					}
					
					self::$buttons[$keys[0]][] = $icon;
				}
			}
		}
		//AK::show(self::$buttons);
		
		return self::$buttons ;
	}
	
	/*
	 * function smartUrlConvertor
	 * @param $url
	 */
	
	public static function smartUrlConvertor($uri, $button)
	{
		// fix task redirect
		if($uri->getVar('layout') == 'edit'){
			$uri->setVar('task', "{$uri->getVar('view')}.{$uri->getVar('layout')}") ;
			$uri->delVar('view');
			$uri->delVar('layout');
		}
		
		return $uri ;
	}
}
