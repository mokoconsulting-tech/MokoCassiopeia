<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_articles_categories.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
$showDescription = $params->get('show_description', 0);
$numitems    = $params->get('numitems', 0);
?>
<div class="mod-articles-categories<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-articles-categories__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-articles-categories__list">
        <?php foreach ($list as $item) : ?>
            <li class="mod-articles-categories__item">
                <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
                <?php if ($numitems) : ?>
                    <span class="mod-articles-categories__count">(<?php echo $item->numitems; ?>)</span>
                <?php endif; ?>
                <?php if ($showDescription && !empty($item->description)) : ?>
                    <p class="mod-articles-categories__description"><?php echo $item->description; ?></p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
