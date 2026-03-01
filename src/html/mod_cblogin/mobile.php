<?php
/**
 * @package     Community Builder
 * @subpackage  mod_cblogin
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_cblogin module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

// Ensure module language file is loaded
$lang = Factory::getLanguage();
$lang->load('mod_cblogin', JPATH_SITE);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-cblogin mod-cblogin-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if ($type === 'logout') : ?>
		<div class="mod-cblogin__logout">
			<?php if ($params->get('greeting', 1)) : ?>
				<div class="mod-cblogin__greeting">
					<?php if ($cbUser) : ?>
						<div class="mod-cblogin__avatar">
							<?php echo $cbUser->getField('avatar', null, 'html', 'none', 'list'); ?>
						</div>
						<div class="mod-cblogin__user-info">
							<span class="mod-cblogin__username">
								<?php echo htmlspecialchars($cbUser->getField('formatname', null, 'html', 'none', 'list'), ENT_COMPAT, 'UTF-8'); ?>
							</span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<form action="<?php echo $action; ?>" method="post" class="mod-cblogin__form">
				<div class="mod-cblogin__actions">
					<?php if ($params->get('profileLink', 1) && $cbUser) : ?>
						<a href="<?php echo $cbUser->getField('canvas', null, 'html', 'none', 'profile'); ?>" class="mod-cblogin__btn mod-cblogin__btn--profile btn btn-secondary">
							<span class="icon-user" aria-hidden="true"></span>
							<?php echo Text::_('MOD_CBLOGIN_PROFILE'); ?>
						</a>
					<?php endif; ?>
					
					<button type="submit" name="Submit" class="mod-cblogin__btn mod-cblogin__btn--logout btn btn-primary">
						<span class="icon-sign-out" aria-hidden="true"></span>
						<?php echo Text::_('MOD_CBLOGIN_LOGOUT'); ?>
					</button>
				</div>
				<input type="hidden" name="op2" value="logout" />
				<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo $securityToken; ?>
			</form>
		</div>
	<?php else : ?>
		<form action="<?php echo $action; ?>" method="post" name="login<?php echo $moduleId; ?>" id="login<?php echo $moduleId; ?>" class="mod-cblogin__form mod-cblogin__form--login">
			<?php if ($params->get('pretext')) : ?>
				<div class="mod-cblogin__pretext">
					<?php echo $params->get('pretext'); ?>
				</div>
			<?php endif; ?>

			<div class="mod-cblogin__fields">
				<div class="mod-cblogin__field">
					<label for="modloginusername<?php echo $moduleId; ?>" class="mod-cblogin__label">
						<?php echo Text::_('MOD_CBLOGIN_USERNAME'); ?>
					</label>
					<input 
						id="modloginusername<?php echo $moduleId; ?>" 
						type="text" 
						name="username" 
						class="mod-cblogin__input form-control" 
						placeholder="<?php echo Text::_('MOD_CBLOGIN_USERNAME'); ?>"
						autocomplete="username"
						required
					/>
				</div>

				<div class="mod-cblogin__field">
					<label for="modloginpass<?php echo $moduleId; ?>" class="mod-cblogin__label">
						<?php echo Text::_('MOD_CBLOGIN_PASSWORD'); ?>
					</label>
					<input 
						id="modloginpass<?php echo $moduleId; ?>" 
						type="password" 
						name="passwd" 
						class="mod-cblogin__input form-control" 
						placeholder="<?php echo Text::_('MOD_CBLOGIN_PASSWORD'); ?>"
						autocomplete="current-password"
						required
					/>
				</div>

				<?php if ($params->get('remember_me', 1)) : ?>
					<div class="mod-cblogin__remember">
						<input 
							id="modloginrememberme<?php echo $moduleId; ?>" 
							type="checkbox" 
							name="remember" 
							class="mod-cblogin__checkbox" 
							value="yes"
						/>
						<label for="modloginrememberme<?php echo $moduleId; ?>" class="mod-cblogin__remember-label">
							<?php echo Text::_('MOD_CBLOGIN_REMEMBER_ME'); ?>
						</label>
					</div>
				<?php endif; ?>
			</div>

			<div class="mod-cblogin__actions">
				<button type="submit" name="Submit" class="mod-cblogin__btn mod-cblogin__btn--submit btn btn-primary">
					<span class="icon-sign-in" aria-hidden="true"></span>
					<?php echo Text::_('MOD_CBLOGIN_LOGIN'); ?>
				</button>
			</div>

			<div class="mod-cblogin__links">
				<?php if ($params->get('lostpassword_link', 1)) : ?>
					<a href="<?php echo $lostPasswordLink; ?>" class="mod-cblogin__link">
						<?php echo Text::_('MOD_CBLOGIN_FORGOT_PASSWORD'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
				<?php endif; ?>
				
				<?php if ($params->get('lostusername_link', 1)) : ?>
					<a href="<?php echo $lostUsernameLink; ?>" class="mod-cblogin__link">
						<?php echo Text::_('MOD_CBLOGIN_FORGOT_USERNAME'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
				<?php endif; ?>
				
				<?php if ($params->get('registration_link', 1)) : ?>
					<a href="<?php echo $registrationLink; ?>" class="mod-cblogin__link">
						<?php echo Text::_('MOD_CBLOGIN_REGISTER'); ?>
						<span class="icon-chevron-right" aria-hidden="true"></span>
					</a>
				<?php endif; ?>
			</div>

			<?php if ($params->get('posttext')) : ?>
				<div class="mod-cblogin__posttext">
					<?php echo $params->get('posttext'); ?>
				</div>
			<?php endif; ?>

			<input type="hidden" name="op2" value="login" />
			<input type="hidden" name="lang" value="<?php echo $lang; ?>" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<input type="hidden" name="message" value="0" />
			<input type="hidden" name="loginfrom" value="loginmodule" />
			<?php echo $securityToken; ?>
		</form>
	<?php endif; ?>
</div>
