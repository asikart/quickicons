<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_akquickicons
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class AkquickiconsViewIcon extends AKView
{
	protected $state;
	protected $item;
	protected $form;
	
	public	$list_name = 'icons' ;
	public	$item_name = 'icon' ;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$app = JFactory::getApplication() ;
		
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		$this->fields	= $this->get('Fields');
		$this->canDo	= AkquickiconsHelper::getActions();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		
		// if is frontend, show toolbar
		if($app->isAdmin())	{
			parent::display($tpl);
		}else{
			parent::displayWithPanel($tpl);
		}
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);

		JToolBarHelper::title( JText::_('COM_AKQUICKICONS_TITLE_ICON'), 'akquickicons.png');

		JToolBarHelper::apply('icon.apply');
		JToolBarHelper::save('icon.save');
		JToolBarHelper::custom('icon.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		JToolBarHelper::custom('icon.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		JToolBarHelper::cancel('icon.cancel');
		
		// set Title Icon
		$doc->addStyleDeclaration("
.icon-48-akquickicons {
	background: url(components/com_akquickicons/images/icon-48.png) no-repeat;
}
");
	
	}
}
