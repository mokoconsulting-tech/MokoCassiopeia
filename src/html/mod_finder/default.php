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

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-finder<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-finder__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <form action="<?php echo Route::_($route); ?>" method="get" class="mod-finder__form" role="search">
        <div class="input-group">
            <label for="mod-finder-searchword-<?php echo $module->id; ?>" class="visually-hidden">
                <?php echo Text::_('COM_FINDER_SEARCH_LABEL'); ?>
            </label>
            <input type="search" name="q" id="mod-finder-searchword-<?php echo $module->id; ?>"
                   class="form-control" value="<?php echo htmlspecialchars($app->getInput()->get('q', '', 'string'), ENT_COMPAT, 'UTF-8'); ?>"
                   placeholder="<?php echo Text::_('COM_FINDER_SEARCH_LABEL'); ?>">
            <button type="submit" class="btn btn-primary">
                <span class="fa-solid fa-magnifying-glass" aria-hidden="true"></span>
                <span class="visually-hidden"><?php echo Text::_('COM_FINDER_SEARCH_LABEL'); ?></span>
            </button>
        </div>
        <?php if ($params->get('show_autosuggest', 1)) : ?>
            <?php $app->getDocument()->getWebAssetManager()->useScript('awesomplete'); ?>
        <?php endif; ?>
        <input type="hidden" name="option" value="com_finder">
        <input type="hidden" name="Itemid" value="<?php echo $route; ?>">
    </form>
</div>
