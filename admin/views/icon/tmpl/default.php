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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
AkquickiconsHelper::_('include.core');


$app = JFactory::getApplication() ;
if( JVERSION >= 3){
	JHtml::_('formbehavior.chosen', 'select');
	if($app->isSite()){
		//AkquickiconsHelper::_('include.fixBootstrapToJoomla');
	}
}else{
	AkquickiconsHelper::_('include.bluestork');
	// AkquickiconsHelper::_('include.fixBootstrapToJoomla');
}



// Init some API objects
// ================================================================================
$date 	= JFactory::getDate( 'now' , JFactory::getConfig()->get('offset') ) ;
$doc 	= JFactory::getDocument() ;
$uri 	= JFactory::getURI() ;
$user	= JFactory::getUser() ;



// For Site
// ================================================================================
if($app->isSite()) {
	AkquickiconsHelper::_('include.isis');
}



// Edit setting
// ================================================================================
$tabs = count( $this->fields ) > 1 ? true : false;

if($app->isAdmin()) {
	$span_left 	= 8 ;
	$span_right = 4 ;
	
	$width_left = 60 ;
	$width_right= 40 ;
}else{
	$span_left 	= 12 ;
	$span_right = 12 ;
	
	$width_left = 100 ;
	$width_right= 100 ;
}

?>
<script type="text/javascript">
	<?php if( $app->isSite() ): ?>
	Akquickicons.fixToolbar(40, 300) ;
	<?php endif; ?>
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'icon.cancel' || document.formvalidator.isValid(document.id('icon-form'))) {
			Joomla.submitform(task, document.getElementById('icon-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<div id="<?php echo (JVERSION >= 3) ? 'joomla30' : 'joomla25' ?>">

<form action="<?php echo JRoute::_( JFactory::getURI()->toString() ); ?>" method="post" name="adminForm" id="icon-form" class="form-validate">
	
	
	<?php if( JVERSION >= 3 ): ?>
	<!-- Tab Buttons -->
	<ul class="nav nav-tabs">
		<?php foreach( $this->fields as $key => $group): ?>
		<li class="<?php echo $key == 0 ? 'active' : ''; ?>">
			<a href="#<?php echo $group; ?>" data-toggle="tab"><?php echo JText::_('COM_AKQUICKICONS_EDIT_FIELDS_'.$group); ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	
	
	<!-- Tab Bodys -->
	<?php echo $tabs ? AkquickiconsHelper::_('panel.startTabs', 'iconTab', array( 'active' => $this->fields[0] ) ) : null ; ?>
		<?php foreach( $this->fields as $key => $group ): 
				$fieldsets = $this->form->getFieldsets($group) ;
				
				echo $tabs ? AkquickiconsHelper::_('panel.addPanel' , 'iconTab', JText::_('COM_AKQUICKICONS_EDIT_FIELDS_'.$group) , $group ) : null ;
		?>
			<div class="row-fluid">
			
				
				<!-- Left Bar -->
				<div class="span<?php echo $span_left; ?><?php echo JVERSION < 3 ? ' width-'.$width_left : '' ;?> fltlft">
					
					<?php foreach( $fieldsets as  $k => $fieldset ): ?>
						
						<?php if( empty($fieldset->align) ) $fieldset->align = 'left' ; ?>
						<?php if( $fieldset->align == 'right' ) continue; ?>
						
						<!-- Fieldset -->
						<?php $this->current_fieldset = $fieldset; ?>
						<?php echo $this->loadTemplate('fieldset'); ?>
						
					<?php endforeach; ?>
					
				</div>
				
				
				<!-- Right Bar -->
				<div class="span<?php echo $span_right; ?><?php echo JVERSION < 3 ? ' width-'.$width_right : '' ;?> fltlft">
					
					<?php foreach( $fieldsets as  $k => $fieldset ): ?>
						
						<?php if( empty($fieldset->align) ) $fieldset->align = 'left' ; ?>
						<?php if( $fieldset->align == 'left' ) continue; ?>
						
						<!-- Fieldset -->
						<?php $this->current_fieldset = $fieldset; ?>
						<?php echo $this->loadTemplate('fieldset'); ?>
						
					<?php endforeach; ?>
					
				</div>
			
			</div>
			
			<div class="clr"></div>
			
			<?php echo $tabs ? AkquickiconsHelper::_('panel.endPanel' , 'iconTab' , $group ) : null ; ?>
			
		<?php endforeach; ?>
		
		<?php echo $tabs ? AkquickiconsHelper::_('panel.endTabs' ) : null ; ?>
	
	
	<!-- Hidden Inputs -->
	<div id="hidden-inputs">
		<input type="hidden" name="option" value="com_akquickicons" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>

</div>