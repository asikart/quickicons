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

jimport('joomla.application.component.controllerform');

/**
 * Icon controller class.
 */
class AkquickiconsControllerIcon extends JControllerForm
{

    function __construct() {
        $this->view_list = 'icons';
        parent::__construct();
    }
	
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Icon', $prefix = 'AkquickiconsModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model = $this->getModel();

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_akquickicons&view=icons' . $this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}
		
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
		return parent::getRedirectToItemAppend($recordId , $urlVar );
	}
}