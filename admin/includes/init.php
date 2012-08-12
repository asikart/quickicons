<?php
/**
 * php document by Asika
 */ 

defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$app = JFactory::getApplication();
$lang = JFactory::getLanguage();

// define
define('AKQUICKICONS_SITE' , JPATH_COMPONENT_SITE ) ;
define('AKQUICKICONS_ADMIN', JPATH_COMPONENT_ADMINISTRATOR);

//include AKHelper
if( !class_exists('AKHelper') ){
	include_once JPath::clean(AKQUICKICONS_ADMIN.'/includes/akhelper/akhelper.php') ;
}

//include joomla api
jimport('joomla.application.component.controller');
jimport('joomla.application.component.controllerform');
jimport('joomla.application.component.controlleradmin');

jimport('joomla.application.component.view');

jimport('joomla.application.component.modeladmin');
jimport('joomla.application.component.modellist');
jimport('joomla.application.component.modelitem');

jimport('joomla.html.toolbar');

// include Component Custom class
include_once JPath::clean( AKQUICKICONS_ADMIN."/class/viewpanel.class.php" ) ;
include_once JPath::clean( AKQUICKICONS_ADMIN."/helpers/aktext.php" ) ;
include_once JPath::clean( AKQUICKICONS_ADMIN."/helpers/toolbar.php" ) ;
include_once JPath::clean( JPATH_ADMINISTRATOR."/includes/toolbar.php" ) ;

if( $app->isSite() ){
	include_once JPath::clean( AKQUICKICONS_ADMIN."/helpers/akquickicons.php" ) ;
	$lang->load('', JPATH_ADMINISTRATOR);
	$lang->load('com_akquickicons', AKQUICKICONS_ADMIN );
}else{
	include_once JPath::clean( AKQUICKICONS_ADMIN."/helpers/akquickicons.php" ) ;
}

// set Base to fix toolbar anchor bug
$doc->setBase( JFactory::getURI()->toString() );

// include css
$doc->addStyleSheet('administrator/templates/bluestork/css/template.css');