<?php
/**
 * @package     Community Builder
 * @subpackage  mod_comprofilerOnline
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_comprofilerOnline module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

// Ensure module language file is loaded
$lang = Factory::getLanguage();
$lang->load('mod_comprofilerOnline', JPATH_SITE);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-cb-online mod-cb-online-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($onlineUsers)) : ?>
		<div class="mod-cb-online__stats">
			<div class="mod-cb-online__count">
				<span class="mod-cb-online__count-number"><?php echo $totalOnline; ?></span>
				<span class="mod-cb-online__count-label">
					<?php echo $totalOnline == 1 ? Text::_('MOD_CB_ONLINE_USER') : Text::_('MOD_CB_ONLINE_USERS'); ?>
				</span>
			</div>
			
			<?php if ($params->get('show_guest_count', 1)) : ?>
				<div class="mod-cb-online__breakdown">
					<span class="mod-cb-online__breakdown-item">
						<span class="icon-users" aria-hidden="true"></span>
						<?php echo $membersOnline; ?> <?php echo Text::_('MOD_CB_ONLINE_MEMBERS'); ?>
					</span>
					<span class="mod-cb-online__breakdown-item">
						<span class="icon-eye" aria-hidden="true"></span>
						<?php echo $guestsOnline; ?> <?php echo Text::_('MOD_CB_ONLINE_GUESTS'); ?>
					</span>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($params->get('show_user_list', 1) && !empty($onlineUsers)) : ?>
			<div class="mod-cb-online__users">
				<h<?php echo $params->get('header_level', 3); ?> class="mod-cb-online__heading">
					<?php echo Text::_('MOD_CB_ONLINE_WHO_IS_ONLINE'); ?>
				</h<?php echo $params->get('header_level', 3); ?>>
				
				<ul class="mod-cb-online__list">
					<?php foreach ($onlineUsers as $user) : ?>
						<li class="mod-cb-online__user">
							<?php if ($params->get('show_avatar', 1) && !empty($user->avatar)) : ?>
								<div class="mod-cb-online__avatar">
									<?php echo $user->avatar; ?>
								</div>
							<?php endif; ?>
							
							<div class="mod-cb-online__info">
								<?php if ($params->get('link_names', 1) && !empty($user->link)) : ?>
									<a href="<?php echo $user->link; ?>" class="mod-cb-online__name">
										<?php echo htmlspecialchars($user->name, ENT_COMPAT, 'UTF-8'); ?>
									</a>
								<?php else : ?>
									<span class="mod-cb-online__name">
										<?php echo htmlspecialchars($user->name, ENT_COMPAT, 'UTF-8'); ?>
									</span>
								<?php endif; ?>
								
								<?php if ($params->get('show_status', 1) && !empty($user->status)) : ?>
									<span class="mod-cb-online__status">
										<?php echo htmlspecialchars($user->status, ENT_COMPAT, 'UTF-8'); ?>
									</span>
								<?php endif; ?>
							</div>
							
							<?php if ($params->get('show_online_icon', 1)) : ?>
								<span class="mod-cb-online__indicator" title="<?php echo Text::_('MOD_CB_ONLINE_NOW'); ?>">
									<span class="icon-checkmark" aria-hidden="true"></span>
								</span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="mod-cb-online__empty">
			<p><?php echo Text::_('MOD_CB_ONLINE_NO_USERS'); ?></p>
		</div>
	<?php endif; ?>
</div>
