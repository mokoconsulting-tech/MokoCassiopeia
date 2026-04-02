<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_tags_similar.
 * Adds showtitle support.
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
<div class="mod-tags-similar<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-tags-similar__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-tags-similar__list">
        <?php foreach ($list as $item) : ?>
            <li class="mod-tags-similar__item">
                <a href="<?php echo $item->link; ?>"><?php echo htmlspecialchars($item->core_title, ENT_COMPAT, 'UTF-8'); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
