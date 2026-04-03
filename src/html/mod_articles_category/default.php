<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_articles_category.
 * Adds showtitle support and respects module settings.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

Factory::getApplication()->getLanguage()->load('mod_articles_category', JPATH_SITE);

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-articles-category<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-articles-category__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-articles-category__list">
        <?php foreach ($list as $item) : ?>
            <li class="mod-articles-category__item" itemscope itemtype="https://schema.org/Article">
                <?php if ($params->get('link_titles') == 1) : ?>
                    <a class="mod-articles-category__link" href="<?php echo $item->link; ?>" itemprop="url">
                        <span itemprop="name"><?php echo $item->title; ?></span>
                    </a>
                <?php else : ?>
                    <span itemprop="name"><?php echo $item->title; ?></span>
                <?php endif; ?>

                <?php if ($item->displayHits) : ?>
                    <span class="mod-articles-category__hits">
                        (<?php echo $item->displayHits; ?>)
                    </span>
                <?php endif; ?>

                <?php if ($params->get('show_author', 0)) : ?>
                    <span class="mod-articles-category__author">
                        <?php echo $item->displayAuthorName; ?>
                    </span>
                <?php endif; ?>

                <?php if ($item->displayDate) : ?>
                    <time class="mod-articles-category__date" datetime="<?php echo HTMLHelper::_('date', $item->displayDate, 'c'); ?>" itemprop="datePublished">
                        <?php echo $item->displayDate; ?>
                    </time>
                <?php endif; ?>

                <?php if ($params->get('show_introtext', 0)) : ?>
                    <div class="mod-articles-category__intro" itemprop="description">
                        <?php echo $item->displayIntrotext; ?>
                    </div>
                <?php endif; ?>

                <?php if ($params->get('show_readmore', 0)) : ?>
                    <a class="mod-articles-category__readmore" href="<?php echo $item->link; ?>" itemprop="url">
                        <?php echo Text::_('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
