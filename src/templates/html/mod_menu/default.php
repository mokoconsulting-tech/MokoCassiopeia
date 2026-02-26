<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_menu module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$id = '';

if ($tagId = $params->get('tag_id', '')) {
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use mod-menu instead
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-menu mod-menu-responsive ' . $moduleclass_sfx;

if ($params->get('layout', 'default') === 'default') {
	$wrapperClass .= ' mod-menu--default';
}
?>
<nav class="<?php echo $wrapperClass; ?>"<?php echo $id; ?> aria-label="<?php echo htmlspecialchars($module->title, ENT_COMPAT, 'UTF-8'); ?>">
	<?php if ($params->get('showHeading', 0)) : ?>
		<h<?php echo $params->get('heading', 3); ?> class="mod-menu__heading">
			<?php echo $module->title; ?>
		</h<?php echo $params->get('heading', 3); ?>>
	<?php endif; ?>
	
	<?php require ModuleHelper::getLayoutPath('mod_menu', $params->get('layout', 'default') . '_' . $params->get('menutype')); ?>
</nav>
