<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Template override for mod_custom adding banner-overlay wrapper pattern.
 * Based on Cassiopeia's banner layout approach.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId          = 'mod-custom' . $module->id;
$moduleclass    = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

if ($params->get('backgroundimage')) {
    /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
    $wa = $app->getDocument()->getWebAssetManager();
    $wa->addInlineStyle(
        '#' . $modId . '{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}',
        ['name' => $modId]
    );
}
?>

<div class="mod-custom custom banner-overlay custom-hero<?php echo $moduleclass ? ' ' . $moduleclass : ''; ?>" id="<?php echo $modId; ?>">
    <div class="overlay">
        <?php echo $module->content; ?>
    </div>
</div>
