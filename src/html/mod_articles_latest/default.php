<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_articles_latest.
 * Adds showtitle support and respects module settings.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-articles-latest<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-articles-latest__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-articles-latest__list">
        <?php foreach ($list as $item) : ?>
            <li class="mod-articles-latest__item" itemscope itemtype="https://schema.org/Article">
                <a href="<?php echo $item->link; ?>" itemprop="url">
                    <span itemprop="name"><?php echo $item->title; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
