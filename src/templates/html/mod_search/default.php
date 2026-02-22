<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_search module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

// Get module parameters
$width = (int) $params->get('width', 20);
$maxlength = (int) $params->get('maxlength', 200);
$button_text = $params->get('button_text', '');
$button_pos = $params->get('button_pos', 'right');
$imagebutton = $params->get('imagebutton', 0);
$set_itemid = (int) $params->get('set_itemid', 0);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-search mod-search-responsive ' . $moduleclass_sfx;
$inputClass = 'mod-search__input form-control';
$buttonClass = 'mod-search__button btn btn-primary';

// Build the search button
if ($imagebutton) {
	$buttonHtml = '<button class="' . $buttonClass . ' mod-search__button--icon" type="submit" aria-label="' . Text::_('JSEARCH_FILTER_SUBMIT') . '">'
		. '<span class="icon-search" aria-hidden="true"></span>'
		. '</button>';
} else {
	$button_text = $button_text ?: Text::_('JSEARCH_FILTER_SUBMIT');
	$buttonHtml = '<button class="' . $buttonClass . '" type="submit">'
		. htmlspecialchars($button_text, ENT_COMPAT, 'UTF-8')
		. '</button>';
}

$output = '';

// Menuitem option
$mitemid = $set_itemid > 0 ? $set_itemid : $app->input->getInt('Itemid');
?>

<div class="<?php echo $wrapperClass; ?>">
	<form action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post" class="mod-search__form">
		<?php if ($button_pos === 'top') : ?>
			<div class="mod-search__button-wrapper mod-search__button-wrapper--top">
				<?php echo $buttonHtml; ?>
			</div>
		<?php endif; ?>

		<div class="mod-search__input-wrapper <?php echo $button_pos !== 'top' && $button_pos !== 'bottom' ? 'mod-search__input-wrapper--inline' : ''; ?>">
			<?php if ($button_pos === 'left') : ?>
				<div class="mod-search__button-wrapper mod-search__button-wrapper--left">
					<?php echo $buttonHtml; ?>
				</div>
			<?php endif; ?>

			<label for="mod-search-searchword<?php echo $module->id; ?>" class="visually-hidden">
				<?php echo Text::_('COM_SEARCH_SEARCH'); ?>
			</label>
			<input
				id="mod-search-searchword<?php echo $module->id; ?>"
				name="searchword"
				class="<?php echo $inputClass; ?>"
				type="search"
				maxlength="<?php echo $maxlength; ?>"
				placeholder="<?php echo Text::_('COM_SEARCH_SEARCH'); ?>"
				aria-label="<?php echo Text::_('COM_SEARCH_SEARCH'); ?>"
			/>

			<?php if ($button_pos === 'right') : ?>
				<div class="mod-search__button-wrapper mod-search__button-wrapper--right">
					<?php echo $buttonHtml; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($button_pos === 'bottom') : ?>
			<div class="mod-search__button-wrapper mod-search__button-wrapper--bottom">
				<?php echo $buttonHtml; ?>
			</div>
		<?php endif; ?>

		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>
