<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	mod_quickicon
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
JHtml::_('behavior.modal');

if( JVERSION >= 3 ): 

$doc->addStyleSheet('modules/mod_akquickicons/css/akquickicons.css');

endif; 

$tabs = count($buttons) > 1 ? true : false ;

$plugin = JPATH_ADMINISTRATOR.'/components/com_akquickicons/includes/plugins/pro/pro.php' ;
if( !JFile::exists($plugin) ) {
	$tabs = false ;
}

$keys = array_keys($buttons);

?>

<style type="text/css">
	.pane-sliders .panel .tabs h3 {
		background-color: transparent ;
	}
</style>
<?php if (!empty($buttons)): ?>

	<?php if( JVERSION >= 3 && $tabs && !empty($buttons) ): ?>
	<!-- Tab Buttons -->
	<ul class="nav nav-tabs akquickicons-tabs">
		<?php foreach( $buttons as $key => $group): ?>
		<li class="<?php echo $key == $keys[0] ? 'active' : ''; ?>">
			<a href="#<?php echo 'tab-'.$key; ?>" data-toggle="tab"><?php echo $group[0]['cat_title']; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>


	<!-- Icons -->	
	<?php echo $tabs ? AkquickiconsHelper::_('panel.startTabs', 'iconTab', array( 'active' => 'tab-'.$keys[0] ) ) : null ; ?>
	
	<?php foreach( $buttons as $key => $group ): ?>
		
		<?php echo $tabs ? AkquickiconsHelper::_('panel.addPanel' , 'iconTab', $group[0]['cat_title'] , 'tab-'.$key ) : null ;?>
		<div class="cpanel">
			<?php foreach( $group as $button ): ?>
			<div class="<?php echo (JVERSION >= 3) ? '' : 'icon-wrapper'; ?>">
				<div class="icon" id="<?php echo JArrayHelper::getValue($button, 'id'); ?>">
					<a href="<?php echo $button['link']; ?>"
						class="<?php echo $button['params']->get('target') == 'modal' ? 'modal' : ''; ?>"
						target="<?php echo $button['params']->get('target') == 'blank' ? '_blank' : '_self'; ?>"
					>
						<img src="<?php echo $button['image']; ?>" alt="">
						<div>
							<span><?php echo $button['text']; ?></span>
						</div>
					</a>
				</div>
			</div>
			<?php endforeach; ?>
			<div class="clearfix"></div>
		</div>
		<div class="clr"></div>
		<?php echo $tabs ? AkquickiconsHelper::_('panel.endPanel' , 'iconTab' , 'tab-'.$key ) : null ; ?>
		
	<?php endforeach; ?>
	
	<?php echo $tabs ? AkquickiconsHelper::_('panel.endTabs' ) : null ; ?>
	
<?php endif;?>
<div class="clearfix clr"></div>