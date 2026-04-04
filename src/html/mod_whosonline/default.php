<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_whosonline.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
$showmode    = $params->get('showmode', 0);
?>
<div class="mod-whosonline<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-whosonline__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>

    <?php if ($showmode == 0 || $showmode == 2) : ?>
        <p class="mod-whosonline__count">
            <?php echo Text::plural('MOD_WHOSONLINE_GUESTS', $count['guest']); ?><br />
            <?php echo Text::plural('MOD_WHOSONLINE_MEMBERS', $count['user']); ?>
        </p>
    <?php endif; ?>

    <?php if (($showmode == 1 || $showmode == 2) && !empty($names)) : ?>
        <ul class="mod-whosonline__list">
            <?php foreach ($names as $name) : ?>
                <li class="mod-whosonline__item"><?php echo $name->username; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
