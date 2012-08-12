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

jimport('joomla.application.component.view');

/**
 * View class for a list of Akquickicons.
 */
class AkquickiconsViewImages extends JView
{

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->addToolbar();
		
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		$canDo	= AkquickiconsHelper::getActions();

		JToolBarHelper::title(JText::_('COM_AKQUICKICONS_TITLE_IMAGES'), 'mediamanager.png');
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_akquickicons');
		}

	}
}
