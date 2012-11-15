<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	mod_quickicon
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

?>

<?php if( JVERSION >= 3 ): ?>
<style type="text/css">
	.cpanel .icon {
		float: left;
		padding: 5px 0 5px 10px;
		margin: 0;
		text-align: center;
	}
	
	.cpanel .icon a {
		background-color: #F9F9F9;
		background-position: -30px;
		display: block;
		float: left;
		height: 97px;
		width: 108px;
		padding: 7px;
		c/olor: #565656;
		vertical-align: middle;
		text-decoration: none;
		border: 1px solid #CCC;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-transition-property: background-position, -webkit-border-bottom-left-radius, -webkit-box-shadow;
		-moz-transition-property: background-position, -moz-border-radius-bottomleft, -moz-box-shadow;
		-webkit-transition-duration: 0.8s;
		-moz-transition-duration: 0.8s;	
	}
	
	#cpanel div.icon a:hover, #cpanel div.icon a:focus, #cpanel div.icon a:active, .cpanel div.icon a:hover, .cpanel div.icon a:focus, .cpanel div.icon a:active {
		background-color: whiteSmoke ;
		background-position: 0;
		-webkit-border-bottom-left-radius: 50% 20px;
		-moz-border-radius-bottomleft: 50% 20px;
		border-bottom-left-radius: 50% 20px;
		-webkit-box-shadow: -5px 10px 15px rgba(0, 0, 0, 0.25);
		-moz-box-shadow: -5px 10px 15px rgba(0, 0, 0, 0.25);
		box-shadow: -5px 10px 15px rgba(0, 0, 0, 0.25);
		position: relative;
		z-index: 10;
	}
	
	#cpanel span, .cpanel span {
		display: block;
		text-align: center;
	}
	
	#cpanel img, .cpanel img {
		padding: 10px 0;
		margin: 0 auto;
	}
</style>
<?php endif; ?>

<?php if (!empty($buttons)): ?>
	<div class="cpanel">
		<?php foreach( $buttons as $button ): ?>
		<div class="">
			<div class="icon">
				<a href="<?php echo $button['link']; ?>">
					<img src="<?php echo $button['image']; ?>" alt="">
					<span><?php echo $button['text']; ?></span>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
<?php endif;?>
<div class="clearfix"></div>