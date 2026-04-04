<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_users_latest.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

if (empty($names)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-users-latest<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-users-latest__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-users-latest__list">
        <?php foreach ($names as $name) : ?>
            <li class="mod-users-latest__item">
                <?php echo htmlspecialchars($name->name, ENT_COMPAT, 'UTF-8'); ?>
                <time class="mod-users-latest__date" datetime="<?php echo HTMLHelper::_('date', $name->registerDate, 'c'); ?>">
                    <?php echo HTMLHelper::_('date', $name->registerDate, 'DATE_FORMAT_LC3'); ?>
                </time>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
