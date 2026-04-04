<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_wrapper.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
$url         = htmlspecialchars($params->get('url', ''), ENT_COMPAT, 'UTF-8');
$width       = htmlspecialchars($params->get('width', '100%'), ENT_COMPAT, 'UTF-8');
$height      = htmlspecialchars($params->get('height', '500'), ENT_COMPAT, 'UTF-8');
$scrolling   = $params->get('scrolling', 'auto');
$frameborder = $params->get('frameborder', 0) ? '1' : '0';
?>
<div class="mod-wrapper<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-wrapper__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <iframe src="<?php echo $url; ?>"
            width="<?php echo $width; ?>"
            height="<?php echo $height; ?>"
            scrolling="<?php echo $scrolling; ?>"
            frameborder="<?php echo $frameborder; ?>"
            title="<?php echo htmlspecialchars($module->title, ENT_COMPAT, 'UTF-8'); ?>"
            class="mod-wrapper__iframe"
            loading="lazy">
    </iframe>
</div>
