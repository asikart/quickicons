<?php
/**
 * @version     1.0.0
 * @package     com_akquickicons
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by AKHelper - http://asikart.com
 */


// no direct access
defined('_JEXEC') or die;

$doc = JFactory::getDocument();

$doc->addStylesheet( 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css' );
JHtml::script( 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', true );
JHtml::script( 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js', true );

$doc->addStylesheet( 'components/com_akquickicons/includes/elfinder/css/elfinder.min.css' );
$doc->addStylesheet( 'components/com_akquickicons/includes/elfinder/css/theme.css' );
JHtml::script( JURI::base().'components/com_akquickicons/includes/elfinder/js/elfinder.min.js', true );

$script = <<<EL
$().ready(function() {
	var elf = $('#elfinder').elfinder({
		url : 'index.php?option=com_akquickicons&task=manager' 
	}).elfinder('instance');
});
EL;

$doc->addScriptDeclaration($script) ;

?>
<div class="width-100">
	<fieldset class="adminformlist">
		<?php echo JText::_('COM_AKQUICKICONS_IMAGE_MANAGER_DESC'); ?>
	</fieldset>
</div>
<div id="elfinder"></div>

<p align="center">
	<br />
	Powerd by <a href="http://elfinder.org/">elFinder</a>
</p>
