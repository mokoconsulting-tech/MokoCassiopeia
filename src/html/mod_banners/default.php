<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_banners.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-banners<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-banners__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <?php foreach ($list as $item) : ?>
        <div class="mod-banners__item">
            <?php $link = $item->params->get('url') ?: ''; ?>
            <?php if ($item->type == 1) : ?>
                <?php // Image banner ?>
                <?php $imageUrl = $item->params->get('imageurl', ''); ?>
                <?php $alt = htmlspecialchars($item->name, ENT_COMPAT, 'UTF-8'); ?>
                <?php if ($link) : ?>
                    <a href="<?php echo htmlspecialchars($link, ENT_COMPAT, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo htmlspecialchars($imageUrl, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo $alt; ?>" class="mod-banners__image" loading="lazy" />
                    </a>
                <?php else : ?>
                    <img src="<?php echo htmlspecialchars($imageUrl, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo $alt; ?>" class="mod-banners__image" loading="lazy" />
                <?php endif; ?>
            <?php else : ?>
                <?php // Custom HTML banner ?>
                <?php echo $item->custombannercode; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
