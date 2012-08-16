<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Script file of HelloWorld component
 */
class com_AkquickiconsInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		$db = JFactory::getDbo();
		$q = $db->getQuery(true) ;
		
		$q->select('extension_id')
			->from('#__extensions')
			->where("element='mod_akquickicons'")
			;
		
		$db->setQuery($q);
		$result = $db->loadResult();
		
		$installer = new JInstaller();
		$installer->uninstall( 'module', $result );
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		//echo 'AKQuickicons module Install Successfully.' ;
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		$db = JFactory::getDbo();
		
		$p_installer = $parent->getParent() ;
		$path = $p_installer->getPath('source');
		
		if($type == 'install') {
			jimport('joomla.filesystem.folder');
			$origin = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_akquickicons'.DS.'images' ;
			$target = JPATH_ROOT.DS ;
			
			JFolder::move($origin,$target);
			
			// set Category
			$q = $db->getQuery(true) ;
			
			$q->select('id')
				->from('#__categories')
				->where("extension = 'com_akquickicons'")
				;
			
			$db->setQuery($q);
			$catids = $db->loadResultArray();
			
			$cat = JTable::getInstance('Category') ;
			
			foreach( $catids as $catid ):
				$cat->load($catid);
				$cat->store();
			endforeach;
			
			// set icons
			$q = $db->getQuery(true) ;
			
			$q->select('id')
				->from('#__akquickicons_icons')
				;
			
			$db->setQuery($q);
			$icon_ids = $db->loadResultArray();
			
			$table_path = $path.DS.'admin'.DS.'tables' ;
			JTable::addIncludePath($table_path);
			$icon = JTable::getInstance('icon', 'AkquickiconsTable') ;
			
			foreach( $icon_ids as $icon_id ):
				$icon-load($icon_id);
				$icon->catid = $cat_ids[0] ;
				$icon->store();
			endforeach;
		}
		
		// install module
		$installer = new JInstaller();
		$mod_path = $path.DS.'..'.DS.'module' ;
		
		$result = $installer->install($mod_path);
		
		if(!$result) {
			return false ;
		}
	}
	
}