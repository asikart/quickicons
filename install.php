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
		
		jimport('joomla.filesystem.file') ;
		jimport('joomla.filesystem.folder') ;
		
		// install module
		$p_installer = $parent->getParent() ;
		$path = $p_installer->getPath('source');
		
		$installer = new JInstaller();
		$mod_path = $path.DS.'..'.DS.'module' ;
		
		$result = $installer->install($mod_path);
		
		if(!$result) {
			return false ;
		}
		
		//echo 'AKQuickicons module Install Successfully.' ;
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		
	}
	
}

