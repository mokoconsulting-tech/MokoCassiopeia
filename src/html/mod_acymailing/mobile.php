<?php
/**
 * @package     AcyMailing
 * @subpackage  mod_acymailing
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_acymailing module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-acymailing mod-acymailing-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($formDisplay)) : ?>
		<div class="mod-acymailing__form-container">
			<?php if ($params->get('intro_text')) : ?>
				<div class="mod-acymailing__intro">
					<?php echo $params->get('intro_text'); ?>
				</div>
			<?php endif; ?>

			<?php echo $formDisplay; ?>

			<?php if ($params->get('outro_text')) : ?>
				<div class="mod-acymailing__outro">
					<?php echo $params->get('outro_text'); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php else : ?>
		<div class="mod-acymailing__empty">
			<p><?php echo Text::_('MOD_ACYMAILING_NO_FORM'); ?></p>
		</div>
	<?php endif; ?>
</div>

<style>
/* Override AcyMailing inline styles for mobile responsiveness */
.mod-acymailing-responsive .acymailing_module input[type="email"],
.mod-acymailing-responsive .acymailing_module input[type="text"] {
	min-height: 44px !important;
	font-size: 1rem !important;
	padding: 0.5rem 0.75rem !important;
	border-radius: var(--border-radius, 0.375rem) !important;
	border: 1px solid var(--input-border-color, #dee2e6) !important;
	width: 100% !important;
	box-sizing: border-box !important;
}

.mod-acymailing-responsive .acymailing_module button[type="submit"],
.mod-acymailing-responsive .acymailing_module input[type="submit"] {
	min-height: 44px !important;
	padding: 0.625rem 1rem !important;
	font-size: 1rem !important;
	border-radius: var(--border-radius, 0.375rem) !important;
	cursor: pointer !important;
}

@media (max-width: 575.98px) {
	.mod-acymailing-responsive .acymailing_module input[type="email"],
	.mod-acymailing-responsive .acymailing_module input[type="text"] {
		font-size: 16px !important;
		min-height: 48px !important;
		padding: 0.75rem 1rem !important;
	}
	
	.mod-acymailing-responsive .acymailing_module button[type="submit"],
	.mod-acymailing-responsive .acymailing_module input[type="submit"] {
		min-height: 48px !important;
		width: 100% !important;
	}
}
</style>
