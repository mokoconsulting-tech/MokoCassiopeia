<?php
/**
 * @package     VirtueMart
 * @subpackage  mod_virtuemart_currencies
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_virtuemart_currencies module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$text_before = $params->get('text_before', '');
$text_after = $params->get('text_after', '');

// Add responsive wrapper class
$wrapperClass = 'mod-vm-currencies mod-vm-currencies-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if ($text_before) : ?>
		<div class="mod-vm-currencies__text-before">
			<?php echo $text_before; ?>
		</div>
	<?php endif; ?>

	<form action="<?php echo $action; ?>" method="post" id="currency_form_<?php echo $module->id; ?>" class="mod-vm-currencies__form">
		<label for="virtuemart_currency_id_<?php echo $module->id; ?>" class="mod-vm-currencies__label">
			<?php echo Text::_('MOD_VIRTUEMART_CURRENCIES_SELECT'); ?>
		</label>
		
		<div class="mod-vm-currencies__select-wrapper">
			<select 
				name="virtuemart_currency_id" 
				id="virtuemart_currency_id_<?php echo $module->id; ?>" 
				class="mod-vm-currencies__select form-select"
				onchange="document.getElementById('currency_form_<?php echo $module->id; ?>').submit();"
				aria-label="<?php echo Text::_('MOD_VIRTUEMART_CURRENCIES_SELECT'); ?>">
				<?php foreach ($currencies as $currency) : ?>
					<option 
						value="<?php echo $currency->virtuemart_currency_id; ?>"
						<?php echo ($currency->virtuemart_currency_id == $virtuemart_currency_id) ? 'selected="selected"' : ''; ?>>
						<?php echo $currency->currency_name; ?> (<?php echo $currency->currency_code_3; ?>)
					</option>
				<?php endforeach; ?>
			</select>
			<span class="mod-vm-currencies__icon" aria-hidden="true">
				<span class="icon-chevron-down"></span>
			</span>
		</div>

		<noscript>
			<button type="submit" class="mod-vm-currencies__submit btn btn-primary">
				<?php echo Text::_('MOD_VIRTUEMART_CURRENCIES_CHANGE'); ?>
			</button>
		</noscript>

		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="user" />
		<input type="hidden" name="task" value="setcurrency" />
	</form>

	<?php if ($text_after) : ?>
		<div class="mod-vm-currencies__text-after">
			<?php echo $text_after; ?>
		</div>
	<?php endif; ?>
</div>
