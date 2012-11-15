<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_quickicon
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addStylesheet( 'components/com_akquickicons/includes/akicons/css/akicons.css') ;
?>
<?php if (!empty($buttons)): ?>
	<div class="row-striped">
		<?php foreach( $buttons as $button ): ?>
		<div class="row-fluid">
			<div class="span6">
				<a href="<?php echo $button['link']; ?>">
					<i class="icon <?php echo $button['icon_class']; ?>"></i>
					<span>
						<?php echo $button['text']; ?>
					</span>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
<?php endif;?>