<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_related_items.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
$showDate    = $params->get('showDate', 0);
?>
<div class="mod-related-items<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-related-items__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-related-items__list">
        <?php foreach ($list as $item) : ?>
            <li class="mod-related-items__item">
                <a href="<?php echo $item->route; ?>"><?php echo $item->title; ?></a>
                <?php if ($showDate) : ?>
                    <time class="mod-related-items__date" datetime="<?php echo HTMLHelper::_('date', $item->created, 'c'); ?>">
                        <?php echo HTMLHelper::_('date', $item->created, 'DATE_FORMAT_LC3'); ?>
                    </time>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
