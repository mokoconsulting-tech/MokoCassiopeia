<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_breadcrumbs.
 * Bootstrap 5 breadcrumb with schema.org BreadcrumbList markup.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

Factory::getApplication()->getLanguage()->load('mod_breadcrumbs', JPATH_SITE);

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<nav class="mod-breadcrumbs<?php echo $suffix ? ' ' . $suffix : ''; ?>" aria-label="<?php echo Text::_('MOD_BREADCRUMBS_HERE'); ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-breadcrumbs__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($list as $key => $item) : ?>
            <?php
            $isLast = ($key === array_key_last($list));
            ?>
            <li class="breadcrumb-item<?php echo $isLast ? ' active' : ''; ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"
                <?php echo $isLast ? ' aria-current="page"' : ''; ?>>
                <?php if (!$isLast && $item->link) : ?>
                    <a href="<?php echo $item->link; ?>" itemprop="item">
                        <span itemprop="name"><?php echo $item->name; ?></span>
                    </a>
                <?php else : ?>
                    <span itemprop="name"><?php echo $item->name; ?></span>
                <?php endif; ?>
                <meta itemprop="position" content="<?php echo $key + 1; ?>" />
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
