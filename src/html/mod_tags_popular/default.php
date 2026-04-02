<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_tags_popular.
 * Adds showtitle support with Bootstrap badge-style tags.
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
<div class="mod-tags-popular<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-tags-popular__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <div class="mod-tags-popular__list d-flex flex-wrap gap-2">
        <?php foreach ($list as $item) : ?>
            <a class="badge bg-secondary text-decoration-none mod-tags-popular__tag" href="<?php echo $item->link; ?>">
                <?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
                <?php if ($params->get('show_tag_count', 0)) : ?>
                    <span class="mod-tags-popular__count">(<?php echo $item->count; ?>)</span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
