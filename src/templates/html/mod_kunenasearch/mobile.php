<?php
/**
 * @package     Kunena
 * @subpackage  mod_kunenasearch
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_kunenasearch module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-kunena-search mod-kunena-search-responsive ' . $moduleclass_sfx;

$button_pos = $params->get('button_pos', 'right');
$button_text = $params->get('button_text', '');
?>

<div class="<?php echo $wrapperClass; ?>">
	<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=search'); ?>" 
	      method="post" 
	      class="mod-kunena-search__form mod-kunena-search__form--button-<?php echo $button_pos; ?>">
		
		<?php if ($button_pos === 'top' || $button_pos === 'left') : ?>
			<div class="mod-kunena-search__button-wrapper mod-kunena-search__button-wrapper--<?php echo $button_pos; ?>">
				<button type="submit" class="mod-kunena-search__button btn btn-primary">
					<?php if ($button_text) : ?>
						<?php echo htmlspecialchars($button_text, ENT_COMPAT, 'UTF-8'); ?>
					<?php else : ?>
						<span class="icon-search" aria-hidden="true"></span>
						<span class="visually-hidden"><?php echo Text::_('MOD_KUNENASEARCH_SEARCH'); ?></span>
					<?php endif; ?>
				</button>
			</div>
		<?php endif; ?>

		<div class="mod-kunena-search__input-wrapper">
			<label for="mod-kunena-search-<?php echo $module->id; ?>" class="visually-hidden">
				<?php echo Text::_('MOD_KUNENASEARCH_SEARCH_FORUM'); ?>
			</label>
			<input 
				type="search" 
				name="q" 
				id="mod-kunena-search-<?php echo $module->id; ?>"
				class="mod-kunena-search__input form-control" 
				placeholder="<?php echo Text::_('MOD_KUNENASEARCH_SEARCH_FORUM'); ?>"
				aria-label="<?php echo Text::_('MOD_KUNENASEARCH_SEARCH_FORUM'); ?>"
				value="<?php echo htmlspecialchars($params->get('default_value', ''), ENT_COMPAT, 'UTF-8'); ?>"
			/>
		</div>

		<?php if ($button_pos === 'bottom' || $button_pos === 'right') : ?>
			<div class="mod-kunena-search__button-wrapper mod-kunena-search__button-wrapper--<?php echo $button_pos; ?>">
				<button type="submit" class="mod-kunena-search__button btn btn-primary">
					<?php if ($button_text) : ?>
						<?php echo htmlspecialchars($button_text, ENT_COMPAT, 'UTF-8'); ?>
					<?php else : ?>
						<span class="icon-search" aria-hidden="true"></span>
						<span class="visually-hidden"><?php echo Text::_('MOD_KUNENASEARCH_SEARCH'); ?></span>
					<?php endif; ?>
				</button>
			</div>
		<?php endif; ?>

		<input type="hidden" name="task" value="results" />
		<input type="hidden" name="option" value="com_kunena" />
	</form>
</div>
