<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_syndicate.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-syndicate<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-syndicate__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <a href="<?php echo $link; ?>" class="mod-syndicate__link">
        <span class="fa-solid fa-rss" aria-hidden="true"></span>
        <?php echo htmlspecialchars($text, ENT_COMPAT, 'UTF-8'); ?>
    </a>
</div>
