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
		
		$catid = $params->get('catid', 78) ;
		
		$now = $date->toSQL(true);
		
		$publish = "( (publish_up = '0000-00-00 00:00:00' OR publish_up < '{$now}') AND
					(publish_down = '0000-00-00 00:00:00' OR publish_down > '{$now}') )" ;
		
		$viewlevel = $user->getAuthorisedViewLevels();
		$viewlevel = implode(',', $viewlevel);
		
		$language = JFactory::getLanguage()->getTag() ;
		
		$q->select("*")
			->from("#__akquickicons_icons")
			->where("published >=1")
			->where($publish)
			->where("catid = {$catid}")
			->where("access IN ({$viewlevel})")
			->where("(language = '{$language}' OR language = '*')")
			->order("ordering")
			;
		
		$db->setQuery($q);
		$buttons = $db->loadObjectList();
		self::$buttons[$catid] = array() ;
		
		foreach( $buttons as $button ):
			
			// fix task redirect
			$uri = JFactory::getURI($button->link) ;
			
			if($uri->getVar('layout') == 'edit'){
				$uri->setVar('task', "{$uri->getVar('view')}.{$uri->getVar('layout')}") ;
				$uri->delVar('view');
				$uri->delVar('layout');
			}
			
			self::$buttons[$catid][] = array(
				'link' => JRoute::_($uri->toString()),
				'image' => JURI::root().$button->images,
				'text' => $button->title,
				'icon_class'=> $button->icon_class,
				'access' => true
			);
			
		endforeach;
		
		
		
		return self::$buttons[$catid] ;
	}
}
