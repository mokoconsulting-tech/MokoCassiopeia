<?php
/**
 * @package     Kunena
 * @subpackage  mod_kunenalogin
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_kunenalogin module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-kunena-login mod-kunena-login-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if ($kunena_my->exists()) : ?>
		<!-- Logged in state -->
		<div class="mod-kunena-login__profile">
			<?php if ($params->get('showAvatar', 1)) : ?>
				<div class="mod-kunena-login__avatar">
					<?php echo $kunena_my->getAvatarImage('', 60, 60); ?>
				</div>
			<?php endif; ?>
			
			<div class="mod-kunena-login__user-info">
				<div class="mod-kunena-login__username">
					<a href="<?php echo $kunena_my->getURL(); ?>">
						<?php echo $kunena_my->getName(); ?>
					</a>
				</div>
				
				<?php if ($params->get('showRank', 1) && !empty($kunena_my->getRank())) : ?>
					<div class="mod-kunena-login__rank">
						<?php echo $kunena_my->getRank(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ($params->get('showStats', 1)) : ?>
			<div class="mod-kunena-login__stats">
				<div class="mod-kunena-login__stat">
					<span class="mod-kunena-login__stat-label"><?php echo Text::_('MOD_KUNENALOGIN_POSTS'); ?>:</span>
					<span class="mod-kunena-login__stat-value"><?php echo $kunena_my->posts; ?></span>
				</div>
				
				<?php if ($params->get('showKarma', 0) && isset($kunena_my->karma)) : ?>
					<div class="mod-kunena-login__stat">
						<span class="mod-kunena-login__stat-label"><?php echo Text::_('MOD_KUNENALOGIN_KARMA'); ?>:</span>
						<span class="mod-kunena-login__stat-value"><?php echo $kunena_my->karma; ?></span>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="mod-kunena-login__actions">
			<?php if ($params->get('showProfile', 1)) : ?>
				<a href="<?php echo $kunena_my->getURL(); ?>" class="mod-kunena-login__btn btn btn-secondary">
					<span class="icon-user" aria-hidden="true"></span>
					<?php echo Text::_('MOD_KUNENALOGIN_PROFILE'); ?>
				</a>
			<?php endif; ?>
			
			<?php if ($params->get('showMessages', 1)) : ?>
				<a href="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=user&layout=messages'); ?>" 
				   class="mod-kunena-login__btn btn btn-secondary">
					<span class="icon-envelope" aria-hidden="true"></span>
					<?php echo Text::_('MOD_KUNENALOGIN_PRIVATE_MESSAGES'); ?>
					<?php if (!empty($private_messages)) : ?>
						<span class="mod-kunena-login__badge"><?php echo $private_messages; ?></span>
					<?php endif; ?>
				</a>
			<?php endif; ?>
			
			<form action="<?php echo Route::_('index.php', true); ?>" method="post" class="mod-kunena-login__logout-form">
				<button type="submit" class="mod-kunena-login__btn mod-kunena-login__btn--logout btn btn-primary">
					<span class="icon-sign-out" aria-hidden="true"></span>
					<?php echo Text::_('MOD_KUNENALOGIN_LOGOUT'); ?>
				</button>
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.logout" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</form>
		</div>
	<?php else : ?>
		<!-- Login form -->
		<form action="<?php echo Route::_('index.php', true); ?>" method="post" class="mod-kunena-login__form">
			<?php if ($params->get('pretext')) : ?>
				<div class="mod-kunena-login__pretext">
					<?php echo $params->get('pretext'); ?>
				</div>
			<?php endif; ?>

			<div class="mod-kunena-login__fields">
				<div class="mod-kunena-login__field">
					<label for="kunena-login-username-<?php echo $module->id; ?>" class="mod-kunena-login__label">
						<?php echo Text::_('MOD_KUNENALOGIN_USERNAME'); ?>
					</label>
					<input 
						id="kunena-login-username-<?php echo $module->id; ?>"
						type="text" 
						name="username" 
						class="mod-kunena-login__input form-control" 
						placeholder="<?php echo Text::_('MOD_KUNENALOGIN_USERNAME'); ?>"
						autocomplete="username"
						required
					/>
				</div>

				<div class="mod-kunena-login__field">
					<label for="kunena-login-password-<?php echo $module->id; ?>" class="mod-kunena-login__label">
						<?php echo Text::_('MOD_KUNENALOGIN_PASSWORD'); ?>
					</label>
					<input 
						id="kunena-login-password-<?php echo $module->id; ?>"
						type="password" 
						name="password" 
						class="mod-kunena-login__input form-control" 
						placeholder="<?php echo Text::_('MOD_KUNENALOGIN_PASSWORD'); ?>"
						autocomplete="current-password"
						required
					/>
				</div>

				<?php if ($params->get('showRememberMe', 1)) : ?>
					<div class="mod-kunena-login__remember">
						<input 
							id="kunena-login-remember-<?php echo $module->id; ?>"
							type="checkbox" 
							name="remember" 
							class="mod-kunena-login__checkbox" 
							value="yes"
						/>
						<label for="kunena-login-remember-<?php echo $module->id; ?>" class="mod-kunena-login__remember-label">
							<?php echo Text::_('MOD_KUNENALOGIN_REMEMBER_ME'); ?>
						</label>
					</div>
				<?php endif; ?>
			</div>

			<div class="mod-kunena-login__actions">
				<button type="submit" class="mod-kunena-login__btn mod-kunena-login__btn--submit btn btn-primary">
					<span class="icon-sign-in" aria-hidden="true"></span>
					<?php echo Text::_('MOD_KUNENALOGIN_LOGIN'); ?>
				</button>
			</div>

			<div class="mod-kunena-login__links">
				<?php if ($params->get('showRegister', 1) && $usersConfig->get('allowUserRegistration')) : ?>
					<a href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>" 
					   class="mod-kunena-login__link">
						<?php echo Text::_('MOD_KUNENALOGIN_REGISTER'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
				<?php endif; ?>
				
				<?php if ($params->get('showForgot', 1)) : ?>
					<a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>" 
					   class="mod-kunena-login__link">
						<?php echo Text::_('MOD_KUNENALOGIN_FORGOT_PASSWORD'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
				<?php endif; ?>
			</div>

			<?php if ($params->get('posttext')) : ?>
				<div class="mod-kunena-login__posttext">
					<?php echo $params->get('posttext'); ?>
				</div>
			<?php endif; ?>

			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.login" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
