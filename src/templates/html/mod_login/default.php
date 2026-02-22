<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_login module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('bootstrap.tooltip', '.hasTooltip');

$usersConfig = ComponentHelper::getParams('com_users');
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-login mod-login-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if ($type === 'logout') : ?>
		<form action="<?php echo Route::_('index.php', true); ?>" method="post" id="login-form-<?php echo $module->id; ?>" class="mod-login__form mod-login__form--logout">
			<?php if ($params->get('greeting', 1)) : ?>
				<div class="mod-login__greeting">
					<?php if ($params->get('name', 0) == 0) : ?>
						<?php echo Text::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'), ENT_COMPAT, 'UTF-8')); ?>
					<?php else : ?>
						<?php echo Text::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'), ENT_COMPAT, 'UTF-8')); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="mod-login__actions">
				<button type="submit" name="Submit" class="mod-login__btn mod-login__btn--logout btn btn-secondary">
					<span class="icon-sign-out" aria-hidden="true"></span>
					<?php echo Text::_('JLOGOUT'); ?>
				</button>
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.logout" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</form>
	<?php else : ?>
		<form action="<?php echo Route::_('index.php', true); ?>" method="post" id="login-form-<?php echo $module->id; ?>" class="mod-login__form mod-login__form--login">
			<?php if ($params->get('pretext')) : ?>
				<div class="mod-login__pretext">
					<?php echo $params->get('pretext'); ?>
				</div>
			<?php endif; ?>

			<div class="mod-login__fields">
				<div class="mod-login__field">
					<label for="modloginusername-<?php echo $module->id; ?>" class="mod-login__label">
						<?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?>
					</label>
					<input 
						id="modloginusername-<?php echo $module->id; ?>" 
						type="text" 
						name="username" 
						class="mod-login__input form-control" 
						placeholder="<?php echo Text::_('MOD_LOGIN_VALUE_USERNAME'); ?>"
						autocomplete="username"
						required
					/>
				</div>

				<div class="mod-login__field">
					<label for="modloginpass-<?php echo $module->id; ?>" class="mod-login__label">
						<?php echo Text::_('JGLOBAL_PASSWORD'); ?>
					</label>
					<input 
						id="modloginpass-<?php echo $module->id; ?>" 
						type="password" 
						name="password" 
						class="mod-login__input form-control" 
						placeholder="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>"
						autocomplete="current-password"
						required
					/>
				</div>

				<?php if (count($twofactormethods) > 1) : ?>
					<div class="mod-login__field">
						<label for="modloginsecretkey-<?php echo $module->id; ?>" class="mod-login__label">
							<?php echo Text::_('JGLOBAL_SECRETKEY'); ?>
						</label>
						<input 
							id="modloginsecretkey-<?php echo $module->id; ?>" 
							type="text" 
							name="secretkey" 
							class="mod-login__input form-control" 
							placeholder="<?php echo Text::_('JGLOBAL_SECRETKEY'); ?>"
							autocomplete="one-time-code"
						/>
					</div>
				<?php endif; ?>

				<?php if ($params->get('useLocale', 0)) : ?>
					<div class="mod-login__field">
						<label for="lang-<?php echo $module->id; ?>" class="mod-login__label">
							<?php echo Text::_('MOD_LOGIN_LANGUAGE'); ?>
						</label>
						<?php echo $languages; ?>
					</div>
				<?php endif; ?>

				<?php if ($params->get('showRememberMe', 1)) : ?>
					<div class="mod-login__remember">
						<input 
							id="modloginrememberme-<?php echo $module->id; ?>" 
							type="checkbox" 
							name="remember" 
							class="mod-login__checkbox" 
							value="yes"
						/>
						<label for="modloginrememberme-<?php echo $module->id; ?>" class="mod-login__remember-label">
							<?php echo Text::_('MOD_LOGIN_REMEMBER_ME'); ?>
						</label>
					</div>
				<?php endif; ?>
			</div>

			<div class="mod-login__actions">
				<button type="submit" name="Submit" class="mod-login__btn mod-login__btn--submit btn btn-primary">
					<span class="icon-sign-in" aria-hidden="true"></span>
					<?php echo Text::_('JLOGIN'); ?>
				</button>
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.login" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>

			<?php if ($usersConfig->get('allowUserRegistration')) : ?>
				<div class="mod-login__links">
					<a href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>" class="mod-login__link">
						<?php echo Text::_('MOD_LOGIN_REGISTER'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
					<a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>" class="mod-login__link">
						<?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
					<a href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>" class="mod-login__link">
						<?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
				</div>
			<?php endif; ?>

			<?php if ($params->get('posttext')) : ?>
				<div class="mod-login__posttext">
					<?php echo $params->get('posttext'); ?>
				</div>
			<?php endif; ?>
		</form>
	<?php endif; ?>
</div>
