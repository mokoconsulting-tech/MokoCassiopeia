<?php
/**
 * @package     Kunena
 * @subpackage  mod_kunenastats
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_kunenastats module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-kunena-stats mod-kunena-stats-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<div class="mod-kunena-stats__container">
		<?php if ($params->get('sh_latestMemberCount', 1)) : ?>
			<div class="mod-kunena-stats__stat">
				<div class="mod-kunena-stats__icon">
					<span class="icon-users" aria-hidden="true"></span>
				</div>
				<div class="mod-kunena-stats__content">
					<div class="mod-kunena-stats__value"><?php echo $kunena_stats->memberCount; ?></div>
					<div class="mod-kunena-stats__label"><?php echo Text::_('MOD_KUNENASTATS_MEMBERS'); ?></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($params->get('sh_latestMember', 1) && !empty($kunena_stats->latestMember)) : ?>
			<div class="mod-kunena-stats__stat mod-kunena-stats__stat--latest-member">
				<div class="mod-kunena-stats__icon">
					<span class="icon-user-plus" aria-hidden="true"></span>
				</div>
				<div class="mod-kunena-stats__content">
					<div class="mod-kunena-stats__label"><?php echo Text::_('MOD_KUNENASTATS_LATEST_MEMBER'); ?></div>
					<div class="mod-kunena-stats__value mod-kunena-stats__value--link">
						<a href="<?php echo $kunena_stats->latestMember->getURL(); ?>">
							<?php echo $kunena_stats->latestMember->getName(); ?>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($params->get('sh_messageCount', 1)) : ?>
			<div class="mod-kunena-stats__stat">
				<div class="mod-kunena-stats__icon">
					<span class="icon-comments" aria-hidden="true"></span>
				</div>
				<div class="mod-kunena-stats__content">
					<div class="mod-kunena-stats__value"><?php echo $kunena_stats->messageCount; ?></div>
					<div class="mod-kunena-stats__label"><?php echo Text::_('MOD_KUNENASTATS_MESSAGES'); ?></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($params->get('sh_topicCount', 1)) : ?>
			<div class="mod-kunena-stats__stat">
				<div class="mod-kunena-stats__icon">
					<span class="icon-folder-open" aria-hidden="true"></span>
				</div>
				<div class="mod-kunena-stats__content">
					<div class="mod-kunena-stats__value"><?php echo $kunena_stats->topicCount; ?></div>
					<div class="mod-kunena-stats__label"><?php echo Text::_('MOD_KUNENASTATS_TOPICS'); ?></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($params->get('sh_todayTopicCount', 0)) : ?>
			<div class="mod-kunena-stats__stat">
				<div class="mod-kunena-stats__icon">
					<span class="icon-calendar-check" aria-hidden="true"></span>
				</div>
				<div class="mod-kunena-stats__content">
					<div class="mod-kunena-stats__value"><?php echo $kunena_stats->todayTopicCount; ?></div>
					<div class="mod-kunena-stats__label"><?php echo Text::_('MOD_KUNENASTATS_TODAY_TOPICS'); ?></div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($params->get('sh_yesterdayTopicCount', 0)) : ?>
			<div class="mod-kunena-stats__stat">
				<div class="mod-kunena-stats__icon">
					<span class="icon-calendar" aria-hidden="true"></span>
				</div>
				<div class="mod-kunena-stats__content">
					<div class="mod-kunena-stats__value"><?php echo $kunena_stats->yesterdayTopicCount; ?></div>
					<div class="mod-kunena-stats__label"><?php echo Text::_('MOD_KUNENASTATS_YESTERDAY_TOPICS'); ?></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
