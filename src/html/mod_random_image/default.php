<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_random_image.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

if (empty($image)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-random-image<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-random-image__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <?php if ($link) : ?>
        <a href="<?php echo htmlspecialchars($link, ENT_COMPAT, 'UTF-8'); ?>">
    <?php endif; ?>
    <img src="<?php echo htmlspecialchars($image->folder . '/' . $image->name, ENT_COMPAT, 'UTF-8'); ?>"
         alt="<?php echo htmlspecialchars($image->name, ENT_COMPAT, 'UTF-8'); ?>"
         <?php if ($image->width) : ?>width="<?php echo $image->width; ?>"<?php endif; ?>
         <?php if ($image->height) : ?>height="<?php echo $image->height; ?>"<?php endif; ?>
         class="mod-random-image__img"
         loading="lazy" />
    <?php if ($link) : ?>
        </a>
    <?php endif; ?>
</div>
