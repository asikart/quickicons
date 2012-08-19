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
		$db = JFactory::getDbo();
		
		$p_installer = $parent->getParent() ;
		$path = $p_installer->getPath('source');
		
		jimport('joomla.filesystem.folder');
		$origin = $path.DS.'images'.DS.'quickicons' ;
		$target = JPATH_ROOT.DS.'images'.DS.'quickicons' ;
		
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
		
		$table_path = $path.DS.'tables'.DS.'icon.php' ;
		include_once $table_path ;
		$icon = JTable::getInstance('icon', 'AkquickiconsTable') ;
		//echo $table_path ;
		//AK::show($icon); 
		
		foreach( $icon_ids as $k => $icon_id ):
			$icon->load($icon_id);
			$icon->catid = $catids[0] ;
			$icon->store();
		endforeach;
		
		$this->catid = $catids[0] ;
		
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
		
		$q->delete('#__categories')
			->where("extension='com_akquickicons'")
			;
		$db->setQuery($q);
		$db->query();
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
		
		if($type == 'install'):
			$p_installer = $parent->getParent() ;
			$path = $p_installer->getPath('source');
			
			// install module
			$installer = new JInstaller();
			$mod_path = $path.DS.'..'.DS.'module' ;
			
			$result = $installer->install($mod_path);
			
			// set Module active
			$q = $db->getQuery(true) ;
			
			$q->select('*')
				->from('#__modules')
				->where("module='mod_akquickicons'")
				;
			$db->setQuery($q);
			$module = $db->loadObject();
			$module->published = 1 ;
			$module->position = 'icon' ;
			$params = new stdClass ;
			$params->catid = $this->catid ;
			$module->params = json_encode($params);
			
			$db->updateObject( '#__modules',$module, 'id');
			
			$in = new stdClass ;
			$in->moduleid = $module->id ;
			$in->menuid = 0 ;
			$db->insertObject( '#__modules_menu',$in);
		endif;
	}
	
}