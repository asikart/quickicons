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

$user	= JFactory::getUser();
$userId	= $user->get('id');

$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_akquickicons');
$saveOrder	= $listOrder == 'a.ordering';

jimport('libraries.joomla.html.jgrid');
akquickiconsLoader('admin://class/grid');



// Set Table
// =================================================================================
$table 	= array() ;
$th 	= array() ;
$tr 	= array() ;



// Set Rows and Cells
// =================================================================================
foreach( $this->items as $k => $item ):
	$item = new JObject($item);
		
	$ordering	= ($listOrder == 'a.ordering');
	$canCreate	= $user->authorise('core.create',		'com_akquickicons');
	$canEdit	= $user->authorise('core.edit',			'com_akquickicons');
	$canCheckin	= $user->authorise('core.manage',		'com_akquickicons');
	$canChange	= $user->authorise('core.edit.state',	'com_akquickicons');
	$canEditOwn = $user->authorise('core.edit.own',		'com_akquickicons');
	
	
	
	// Example Column START
	// =================================================================================
		$column = 'example' ;
		
		
		// Example TH
		// -----------------------------------------
		if($k == 0){
			$th[$column]['option']['class'] 	= null ;
			$th[$column]['option']['width'] 	= '5%' ;
			$th[$column]['content'] 			= JHtml::_('grid.sort',  'JPUBLISHED', 'a.published', $listDirn, $listOrder);
		}
		
		
		// Example TD Option
		// -----------------------------------------
		$option['class'] = 'nowrap center' ;
		
		
		// Example TD Content
		// -----------------------------------------
		
		$content = 'EXAMPLE' ;
		
		
		// Put in $td
		// -----------------------------------------
		$td[$column]['option'] 	= $option ;
		$td[$column]['content'] = $content ;
	

	
	
	
	// Checkbox Column START
	// =================================================================================
		$column = 'checkbox' ;
		
		
		// Checkbox TH
		// -----------------------------------------
		if($k == 0){
			$th[$column]['option']['class'] 	= null ;
			$th[$column]['option']['width'] 	= '1%' ;
			$th[$column]['content'] 			= '<input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />';
		}
		
		
		// Checkbox TD Option
		// -----------------------------------------
		$option['class'] = 'nowrap center' ;
		
		
		// Checkbox TD Content
		// -----------------------------------------
		
		$content = JHtml::_('grid.id', $i, $item->a_id); ;
		
		
		// Put in $td
		// -----------------------------------------
		$td[$column]['option'] 	= $option ;
		$td[$column]['content'] = $content ;
	

	
	
	
	// Sort Column
	// =================================================================================
		$column = 'sort' ;
		
		
		// Sort TH
		// -----------------------------------------
		if($k == 0){
			$th[$column]['option']['class'] 	= 'nowrap center hidden-phone' ;
			$th[$column]['option']['width'] 	= '1%' ;
			$th[$column]['content'] 			= JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING');
		}
		
		
		// Sort TD Option
		// -----------------------------------------
		$option['class'] = 'order nowrap center hidden-phone' ;
		
		
		// Sort TD Content
		// -----------------------------------------
		if ($canChange) :
		$disableClassName = '';
		$disabledLabel	  = '';
	
		if (!$saveOrder) :
			$disabledLabel    = JText::_('JORDERINGDISABLED');
			$disableClassName = 'inactive tip-top';
		endif;
		endif;
		
		$content = '<span class="sortable-handler hasTooltip '.$disableClassName.'" title="'.$disabledLabel.'">
						<i class="icon-menu"></i>
					</span>' ;
		
		$content .= '<input type="text" style="display:none" name="order[]" size="5" value="'.$item->a_ordering.'" class="width-20 text-area-order " />' ;
		
		
		// Put in $td
		// -----------------------------------------
		$td[$column]['option'] 	= $option ;
		$td[$column]['content'] = $content ;
	
	
	
	// Title
	// =================================================================================
		$column = 'a_title' ;
		
		// Title TH
		if($k == 0){
			$th[$column]['option']['class'] = null ;
			$th[$column]['option']['width'] = null ;
			$th[$column]['content'] 		= JHtml::_('grid.sort',  'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder);
		}
		
		// Title TD
		$option['class'] = 'nowrap has-context' ;
		
		$content = '<div class="pull-left">' ;
		
		if ($item->get('a_checked_out'))
			$content .= JHtml::_('jgrid.checkedout', $i, $item->get('a_checked_out'), $item->get('a_checked_out_time'), 'icons.', $canCheckin);
		
		if ($canEdit || $canEditOwn) 
			$content .= JHtml::link(JRoute::_('index.php?option=com_akquickicons&task=icon.edit&id='.$item->a_id), $item->get('a_title')) ;
		
		
		$content .= '<div class="small">'.JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape( $item->get('a_alias') )).'</div></div>' ;
		
		JHtml::_('dropdown.edit', $item->id, 'icons.');
		JHtml::_('dropdown.divider');
		if ($item->a_published) :
			JHtml::_('dropdown.unpublish', 'cb' . $i, 'icons.');
		else :
			JHtml::_('dropdown.publish', 'cb' . $i, 'icons.');
		endif;
		
		JHtml::_('dropdown.divider');
		
		if ($item->a_checked_out) :
			JHtml::_('dropdown.checkin', 'cb' . $i, 'icons.');
		endif;
		
		
		if ($trashed) :
			JHtml::_('dropdown.untrash', 'cb' . $i, 'icons.');
		else :
			JHtml::_('dropdown.trash', 'cb' . $i, 'icons.');
		endif;
		
		$content .= '<div class="pull-left">'.JHtml::_('dropdown.render').'</div>' ;
		
		$td[$column]['option'] 	= $option ;
		$td[$column]['content'] = $content ;
	
	
	
	
	// Published Column START
	// =================================================================================
		$column = 'a_published' ;
		
		
		// Published TH
		// -----------------------------------------
		if($k == 0){
			$th[$column]['option']['class'] 	= 'nowrap' ;
			$th[$column]['option']['width'] 	= '5%' ;
			$th[$column]['content'] 			= JHtml::_('grid.sort',  'JPUBLISHED', 'a.published', $listDirn, $listOrder);
		}
		
		
		// Published TD Option
		// -----------------------------------------
		$option['class'] = 'nowrap center' ;
		
		
		// Published TD Content
		// -----------------------------------------
		
		$content = JHtml::_('jgrid.published', $item->a_published, $i, 'icons.', $canChange, 'cb', $item->a_publish_up, $item->a_publish_down);
		
		
		// Put in $td
		// -----------------------------------------
		$td[$column]['option'] 	= $option ;
		$td[$column]['content'] = $content ;
	
	
	
	
	
	
	
	
	// Set TR
	// =================================================================================
	$tr[$k]['option']['class'] 				= "row".($k%2) ;
	$tr[$k]['option']['sortable-group-id'] 	= $item->a_catid;
	$tr[$k]['td'] = $td ;
endforeach;


// Set th in Table
$table['thead']['tr'][0]['th'] 	= $th ;
$table['tbody']['tr'] 			= $tr ;

$table_option = array( 'class' => 'table table-striped adminlist', 'id' => 'articleList' ) ;


// Render Grid
echo $this->renderGrid($table, $table_option) ;
?>

