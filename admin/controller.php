<?php
/**
 * @version     1.0.0
 * @package     com_akquickicons
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by AKHelper - http://asikart.com
 */


// No direct access
defined('_JEXEC') or die;

class AkquickiconsController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable	If true, the view output will be cached
	 * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		// Load the submenu.
		AkquickiconsHelper::addSubmenu(JRequest::getCmd('view', 'icons'));

		$view		= JRequest::getCmd('view', 'icons');
        JRequest::setVar('view', $view);

		parent::display();

		return $this;
	}
	
	/*
	 * function manager
	 * @param 
	 */
	
	public function manager()
	{
		include_once AKQUICKICONS_ADMIN.DS.'includes'.DS.'elfinder'.DS.'php'.DS.'connector.php' ;
		jexit();
	}
}
