<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_languages.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

if (empty($list)) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-languages<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-languages__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>
    <ul class="mod-languages__list">
        <?php foreach ($list as $language) : ?>
            <?php $isActive = $language->active ? ' active' : ''; ?>
            <li class="mod-languages__item<?php echo $isActive; ?>" dir="<?php echo $language->rtl ? 'rtl' : 'ltr'; ?>">
                <?php if ($language->active) : ?>
                    <span class="mod-languages__link mod-languages__link--active" lang="<?php echo $language->sef; ?>">
                <?php else : ?>
                    <a class="mod-languages__link" href="<?php echo htmlspecialchars($language->link, ENT_COMPAT, 'UTF-8'); ?>" lang="<?php echo $language->sef; ?>">
                <?php endif; ?>

                <?php if ($params->get('image', 1)) : ?>
                    <?php if ($language->image) : ?>
                        <?php echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', '', null, true); ?>
                    <?php else : ?>
                        <span class="mod-languages__badge badge bg-secondary"><?php echo strtoupper($language->sef); ?></span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($params->get('show_name', 1)) : ?>
                    <?php echo $language->title_native; ?>
                <?php endif; ?>

                <?php if ($language->active) : ?>
                    </span>
                <?php else : ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
