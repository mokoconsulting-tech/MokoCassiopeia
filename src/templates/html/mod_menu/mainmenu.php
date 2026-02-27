<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Main Menu - Mobile responsive collapsible dropdown menu override
 * Bootstrap 5 responsive navbar with hamburger menu
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$id = '';

if ($tagId = $params->get('tag_id', '')) {
    $id = ' id="' . $tagId . '"';
}

// Get module class suffix
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// The menu class is deprecated. Use mod-menu instead
?>
<nav class="mod-menu mod-menu-main navbar navbar-expand-lg<?php echo $moduleclass_sfx; ?>"<?php echo $id; ?>>
    <div class="container-fluid">
        <!-- Hamburger toggle button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenuCollapse" aria-controls="mainMenuCollapse" aria-expanded="false" aria-label="Toggle Main Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible menu content -->
        <div class="collapse navbar-collapse" id="mainMenuCollapse">
            <ul class="navbar-nav mod-menu-main__list">
<?php foreach ($list as $i => &$item) :
    $itemParams = $item->getParams();
    $class = 'nav-item mod-menu-main__item item-' . $item->id;

    if ($item->id == $default_id) {
        $class .= ' default';
    }

    if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id)) {
        $class .= ' current';
    }

    if (in_array($item->id, $path)) {
        $class .= ' active';
    } elseif ($item->type === 'alias') {
        $aliasToId = $itemParams->get('aliasoptions');

        if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
            $class .= ' active';
        } elseif (in_array($aliasToId, $path)) {
            $class .= ' alias-parent-active';
        }
    }

    if ($item->type === 'separator') {
        $class .= ' divider';
    }

    if ($item->deeper) {
        $class .= ' deeper dropdown';
    }

    if ($item->parent) {
        $class .= ' parent';
    }

    echo '<li class="' . $class . '">';

    switch ($item->type) :
        case 'separator':
        case 'component':
        case 'heading':
        case 'url':
            require ModuleHelper::getLayoutPath('mod_menu', 'mainmenu_' . $item->type);
            break;

        default:
            require ModuleHelper::getLayoutPath('mod_menu', 'mainmenu_url');
            break;
    endswitch;

    // The next item is deeper.
    if ($item->deeper) {
        echo '<ul class="dropdown-menu mod-menu-main__dropdown">';
    } elseif ($item->shallower) {
        // The next item is shallower.
        echo '</li>';
        echo str_repeat('</ul></li>', $item->level_diff);
    } else {
        // The next item is on the same level.
        echo '</li>';
    }
endforeach;
?></ul>
        </div>
    </div>
</nav>
