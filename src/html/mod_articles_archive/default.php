<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_articles_archive.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-articles-archive<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-articles-archive__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-articles-archive__list">
        <?php foreach ($list as $item) : ?>
            <li class="mod-articles-archive__item">
                <a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
