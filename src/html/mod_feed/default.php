<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_feed.
 * Adds showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

if (!$feed) {
    return;
}

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
$rssurl      = $params->get('rssurl', '');
$rsstitle    = $params->get('rsstitle', 1);
$rssdesc     = $params->get('rssrtl', 0) ? ' feed-rtl' : '';
$rssimage    = $params->get('rssimage', 1);
$rssitems    = $params->get('rssitems', 5);
$rssitemdesc = $params->get('rssitemdesc', 1);
$word_count  = $params->get('word_count', 0);
?>
<div class="mod-feed<?php echo $suffix ? ' ' . $suffix : ''; ?><?php echo $rssdesc; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-feed__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>

    <?php if ($feed->title && $rsstitle) : ?>
        <h4 class="mod-feed__feed-title">
            <?php if (!empty($rssurl)) : ?>
                <a href="<?php echo htmlspecialchars($rssurl, ENT_COMPAT, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo $feed->title; ?>
                </a>
            <?php else : ?>
                <?php echo $feed->title; ?>
            <?php endif; ?>
        </h4>
    <?php endif; ?>

    <?php if ($feed->description && $rssdesc) : ?>
        <p class="mod-feed__description"><?php echo $feed->description; ?></p>
    <?php endif; ?>

    <?php if ($rssimage && $feed->image) : ?>
        <img src="<?php echo $feed->image->uri; ?>" alt="<?php echo $feed->image->title ?? ''; ?>" class="mod-feed__image" />
    <?php endif; ?>

    <?php if (!empty($feed->items)) : ?>
        <ul class="mod-feed__list">
            <?php for ($i = 0, $max = min(count($feed->items), $rssitems); $i < $max; $i++) :
                $item = $feed->items[$i];
            ?>
                <li class="mod-feed__item">
                    <?php if (!empty($item->uri)) : ?>
                        <a href="<?php echo htmlspecialchars($item->uri, ENT_COMPAT, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo $item->title; ?>
                        </a>
                    <?php else : ?>
                        <?php echo $item->title; ?>
                    <?php endif; ?>

                    <?php if ($rssitemdesc && !empty($item->content)) :
                        $desc = $item->content;
                        if ($word_count) {
                            $words = explode(' ', strip_tags($desc));
                            if (count($words) > $word_count) {
                                $desc = implode(' ', array_slice($words, 0, $word_count)) . '&hellip;';
                            }
                        }
                    ?>
                        <p class="mod-feed__item-description"><?php echo $desc; ?></p>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
        </ul>
    <?php endif; ?>
</div>
