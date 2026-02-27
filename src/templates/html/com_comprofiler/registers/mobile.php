<?php
/**
 * @package     Community Builder
 * @subpackage  com_comprofiler
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for Community Builder registration view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

// Get form and fields
$form = $this->form ?? null;
$tabs = $this->tabs ?? null;
?>

<div class="cb-register-responsive cb-component">
	<div class="cb-register__header">
		<h1 class="cb-register__title">
			<?php echo Text::_('COM_COMPROFILER_REGISTER'); ?>
		</h1>
		
		<?php if ($this->introduction ?? null) : ?>
			<div class="cb-register__intro">
				<?php echo $this->introduction; ?>
			</div>
		<?php endif; ?>
	</div>

	<?php if ($form) : ?>
		<form action="<?php echo $this->action ?? ''; ?>" 
		      method="post" 
		      class="cb-register__form"
		      enctype="multipart/form-data"
		      aria-label="<?php echo Text::_('COM_COMPROFILER_REGISTRATION_FORM'); ?>">

			<?php if ($tabs) : ?>
				<?php foreach ($tabs as $tab) : ?>
					<?php if (isset($tab->fields) && !empty($tab->fields)) : ?>
						<fieldset class="cb-register__fieldset">
							<?php if ($tab->title) : ?>
								<legend class="cb-register__legend">
									<?php echo htmlspecialchars($tab->title, ENT_QUOTES, 'UTF-8'); ?>
								</legend>
							<?php endif; ?>

							<?php if ($tab->description) : ?>
								<div class="cb-register__tab-description">
									<?php echo $tab->description; ?>
								</div>
							<?php endif; ?>

							<div class="cb-register__fields">
								<?php foreach ($tab->fields as $field) : ?>
									<div class="cb-register__field<?php echo $field->required ? ' cb-register__field--required' : ''; ?>">
										<label for="<?php echo htmlspecialchars($field->name, ENT_QUOTES, 'UTF-8'); ?>" 
										       class="cb-register__label">
											<?php echo htmlspecialchars($field->title, ENT_QUOTES, 'UTF-8'); ?>
											<?php if ($field->required) : ?>
												<span class="cb-register__required" aria-label="<?php echo Text::_('COM_COMPROFILER_REQUIRED'); ?>">*</span>
											<?php endif; ?>
										</label>

										<?php if ($field->description) : ?>
											<div class="cb-register__field-description" id="<?php echo htmlspecialchars($field->name, ENT_QUOTES, 'UTF-8'); ?>-desc">
												<?php echo $field->description; ?>
											</div>
										<?php endif; ?>

										<div class="cb-register__input-wrapper">
											<?php echo $field->input; ?>
										</div>

										<?php if (isset($field->error) && $field->error) : ?>
											<div class="cb-register__error" role="alert">
												<?php echo $field->error; ?>
											</div>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</fieldset>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ($this->showCaptcha ?? false) : ?>
				<div class="cb-register__captcha">
					<?php echo $this->captcha; ?>
				</div>
			<?php endif; ?>

			<?php if ($this->showTerms ?? false) : ?>
				<div class="cb-register__terms">
					<div class="form-check">
						<input type="checkbox" 
						       id="cb-terms" 
						       name="agreedToTerms" 
						       class="form-check-input cb-register__terms-checkbox" 
						       required
						       aria-required="true"
						       aria-describedby="cb-terms-text">
						<label for="cb-terms" class="form-check-label cb-register__terms-label" id="cb-terms-text">
							<?php echo Text::_('COM_COMPROFILER_AGREE_TO_TERMS'); ?>
							<a href="<?php echo $this->termsUrl ?? ''; ?>" target="_blank" rel="noopener noreferrer">
								<?php echo Text::_('COM_COMPROFILER_TERMS_CONDITIONS'); ?>
							</a>
						</label>
					</div>
				</div>
			<?php endif; ?>

			<div class="cb-register__actions">
				<button type="submit" class="cb-register__btn cb-register__btn--submit btn btn-primary">
					<span class="icon-check" aria-hidden="true"></span>
					<?php echo Text::_('COM_COMPROFILER_REGISTER_SUBMIT'); ?>
				</button>
				
				<a href="<?php echo $this->loginUrl ?? ''; ?>" class="cb-register__btn cb-register__btn--cancel btn btn-secondary">
					<span class="icon-cancel" aria-hidden="true"></span>
					<?php echo Text::_('JCANCEL'); ?>
				</a>
			</div>

			<?php echo $this->token ?? ''; ?>
		</form>
	<?php else : ?>
		<div class="alert alert-warning" role="alert">
			<?php echo Text::_('COM_COMPROFILER_REGISTRATION_NOT_AVAILABLE'); ?>
		</div>
	<?php endif; ?>
</div>
