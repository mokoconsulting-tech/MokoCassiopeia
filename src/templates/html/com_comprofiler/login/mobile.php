<?php
/**
 * @package     Community Builder
 * @subpackage  com_comprofiler
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for Community Builder login view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$return = $this->return ?? '';
$showRegisterLink = $this->showRegisterLink ?? true;
$showLostPasswordLink = $this->showLostPasswordLink ?? true;
?>

<div class="cb-login-responsive cb-component">
	<div class="cb-login__container">
		<div class="cb-login__header">
			<h1 class="cb-login__title">
				<?php echo Text::_('COM_COMPROFILER_LOGIN'); ?>
			</h1>
		</div>

		<form action="<?php echo Route::_('index.php?option=com_comprofiler&view=login'); ?>" 
		      method="post" 
		      class="cb-login__form"
		      aria-label="<?php echo Text::_('COM_COMPROFILER_LOGIN_FORM'); ?>">

			<div class="cb-login__field">
				<label for="cb-username" class="cb-login__label">
					<?php echo Text::_('COM_COMPROFILER_USERNAME'); ?>
					<span class="cb-login__required" aria-label="<?php echo Text::_('COM_COMPROFILER_REQUIRED'); ?>">*</span>
				</label>
				<input type="text" 
				       id="cb-username" 
				       name="username" 
				       class="cb-login__input" 
				       required
				       aria-required="true"
				       autocomplete="username"
				       placeholder="<?php echo Text::_('COM_COMPROFILER_USERNAME'); ?>">
			</div>

			<div class="cb-login__field">
				<label for="cb-password" class="cb-login__label">
					<?php echo Text::_('COM_COMPROFILER_PASSWORD'); ?>
					<span class="cb-login__required" aria-label="<?php echo Text::_('COM_COMPROFILER_REQUIRED'); ?>">*</span>
				</label>
				<input type="password" 
				       id="cb-password" 
				       name="passwd" 
				       class="cb-login__input" 
				       required
				       aria-required="true"
				       autocomplete="current-password"
				       placeholder="<?php echo Text::_('COM_COMPROFILER_PASSWORD'); ?>">
			</div>

			<?php if ($this->showRememberMe ?? true) : ?>
				<div class="cb-login__remember">
					<div class="form-check">
						<input type="checkbox" 
						       id="cb-remember" 
						       name="remember" 
						       class="form-check-input cb-login__remember-checkbox" 
						       value="yes">
						<label for="cb-remember" class="form-check-label cb-login__remember-label">
							<?php echo Text::_('COM_COMPROFILER_REMEMBER_ME'); ?>
						</label>
					</div>
				</div>
			<?php endif; ?>

			<div class="cb-login__actions">
				<button type="submit" class="cb-login__btn cb-login__btn--submit btn btn-primary">
					<span class="icon-lock" aria-hidden="true"></span>
					<?php echo Text::_('COM_COMPROFILER_LOGIN'); ?>
				</button>
			</div>

			<input type="hidden" name="task" value="login">
			<input type="hidden" name="return" value="<?php echo htmlspecialchars($return, ENT_QUOTES, 'UTF-8'); ?>">
			<?php echo $this->token ?? ''; ?>
		</form>

		<div class="cb-login__links">
			<?php if ($showRegisterLink) : ?>
				<div class="cb-login__link">
					<a href="<?php echo Route::_('index.php?option=com_comprofiler&view=registers'); ?>" class="cb-login__link-item">
						<span class="icon-user-plus" aria-hidden="true"></span>
						<?php echo Text::_('COM_COMPROFILER_REGISTER_NEW_ACCOUNT'); ?>
					</a>
				</div>
			<?php endif; ?>

			<?php if ($showLostPasswordLink) : ?>
				<div class="cb-login__link">
					<a href="<?php echo Route::_('index.php?option=com_comprofiler&view=lostpassword'); ?>" class="cb-login__link-item">
						<span class="icon-question" aria-hidden="true"></span>
						<?php echo Text::_('COM_COMPROFILER_FORGOT_PASSWORD'); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
