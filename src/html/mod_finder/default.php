<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_finder (Smart Search).
 * Bootstrap 5 search form with showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// Load component language for search labels
$lang = $app->getLanguage();
$lang->load('com_finder', JPATH_SITE);

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');

$showLabel  = $params->get('show_label', 1);
$labelClass = (!$showLabel ? 'visually-hidden ' : '') . 'finder';

Text::script('MOD_FINDER_SEARCH_VALUE');

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('com_finder');

if ($params->get('show_autosuggest', 1)) {
    $wa->usePreset('awesomplete');
    $app->getDocument()->addScriptOptions('finder-search', ['url' => Route::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component', false)]);
    Text::script('COM_FINDER_SEARCH_FORM_LIST_LABEL');
    Text::script('JLIB_JS_AJAX_ERROR_OTHER');
    Text::script('JLIB_JS_AJAX_ERROR_PARSE');
}

$wa->useScript('com_finder.finder');
?>
<div class="mod-finder<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-finder__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <form class="mod-finder__form js-finder-searchform form-search" action="<?php echo Route::_($route); ?>" method="get" role="search">
        <label for="mod-finder-searchword<?php echo $module->id; ?>" class="<?php echo $labelClass; ?>">
            <?php echo $params->get('alt_label', Text::_('JSEARCH_FILTER_SUBMIT')); ?>
        </label>
        <div class="input-group">
            <input type="text" name="q" id="mod-finder-searchword<?php echo $module->id; ?>"
                   class="js-finder-search-query form-control"
                   value="<?php echo htmlspecialchars($app->getInput()->get('q', '', 'string'), ENT_COMPAT, 'UTF-8'); ?>"
                   placeholder="<?php echo Text::_('MOD_FINDER_SEARCH_VALUE'); ?>">
            <?php if ($params->get('show_button', 0)) : ?>
                <button class="btn btn-primary" type="submit">
                    <span class="fa-solid fa-magnifying-glass" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?></span>
                </button>
            <?php endif; ?>
        </div>

        <?php $show_advanced = $params->get('show_advanced', 0); ?>
        <?php if ($show_advanced == 2) : ?>
            <a href="<?php echo Route::_($route); ?>" class="mod-finder__advanced-link mt-2 d-inline-block">
                <?php echo Text::_('COM_FINDER_ADVANCED_SEARCH'); ?>
            </a>
        <?php elseif ($show_advanced == 1) : ?>
            <div class="mod-finder__advanced js-finder-advanced mt-2">
                <?php echo HTMLHelper::_('filter.select', $query, $params); ?>
            </div>
        <?php endif; ?>

        <?php
        $finderHelper = $app->bootModule('mod_finder', 'site')->getHelper('FinderHelper');
        echo $finderHelper->getHiddenFields($route);
        ?>
    </form>
</div>
