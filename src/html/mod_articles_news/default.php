<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_articles_news (newsflash).
 * Adds showtitle support with card-based layout.
 */

defined('_JEXEC') or die;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-articles-news newsflash<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-articles-news__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <?php foreach ($list as $item) : ?>
        <div class="mod-articles-news__item" itemscope itemtype="https://schema.org/Article">
            <?php if ($params->get('item_title')) : ?>
                <h4 class="mod-articles-news__item-title" itemprop="name">
                    <?php if ($item->link !== '' && $params->get('link_titles')) : ?>
                        <a href="<?php echo $item->link; ?>" itemprop="url"><?php echo $item->title; ?></a>
                    <?php else : ?>
                        <?php echo $item->title; ?>
                    <?php endif; ?>
                </h4>
            <?php endif; ?>

            <?php if (!empty($item->afterDisplayTitle)) : ?>
                <?php echo $item->afterDisplayTitle; ?>
            <?php endif; ?>

            <?php if ($params->get('show_introtext', 1)) : ?>
                <div class="mod-articles-news__intro" itemprop="description">
                    <?php echo $item->introtext; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($item->readmore) && $item->readmore) : ?>
                <a class="mod-articles-news__readmore" href="<?php echo $item->link; ?>" itemprop="url">
                    <?php echo $item->linkText; ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
