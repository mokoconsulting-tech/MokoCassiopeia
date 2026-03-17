<?php
/**
 * @package     Community Builder
 * @subpackage  com_comprofiler
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for Community Builder user profile view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

// Get user object
$user = $this->user ?? null;
$tabs = $this->tabs ?? null;
?>

<div class="cb-profile-responsive cb-component">
	<?php if ($user) : ?>
		<div class="cb-profile__header">
			<?php if ($user->getField('avatar', null, 'html', 'none', 'profile')) : ?>
				<div class="cb-profile__avatar">
					<?php echo $user->getField('avatar', null, 'html', 'none', 'profile'); ?>
				</div>
			<?php endif; ?>
			
			<div class="cb-profile__header-info">
				<h1 class="cb-profile__name">
					<?php echo htmlspecialchars($user->getField('formatname', null, 'html', 'none', 'profile'), ENT_QUOTES, 'UTF-8'); ?>
				</h1>
				
				<?php if ($user->getField('onlinestatus', null, 'html', 'none', 'profile')) : ?>
					<div class="cb-profile__status">
						<?php echo $user->getField('onlinestatus', null, 'html', 'none', 'profile'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ($tabs) : ?>
			<div class="cb-profile__tabs">
				<ul class="cb-profile__tabs-nav" role="tablist" aria-label="<?php echo Text::_('COM_COMPROFILER_PROFILE_TABS'); ?>">
					<?php foreach ($tabs as $tab) : ?>
						<?php if (isset($tab->fields) && !empty($tab->fields)) : ?>
							<li class="cb-profile__tab-item" role="presentation">
								<a href="#<?php echo htmlspecialchars($tab->id, ENT_QUOTES, 'UTF-8'); ?>" 
								   class="cb-profile__tab-link"
								   role="tab"
								   aria-controls="<?php echo htmlspecialchars($tab->id, ENT_QUOTES, 'UTF-8'); ?>"
								   aria-selected="false">
									<?php echo htmlspecialchars($tab->title, ENT_QUOTES, 'UTF-8'); ?>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>

				<div class="cb-profile__tabs-content">
					<?php foreach ($tabs as $tab) : ?>
						<?php if (isset($tab->fields) && !empty($tab->fields)) : ?>
							<div id="<?php echo htmlspecialchars($tab->id, ENT_QUOTES, 'UTF-8'); ?>" 
							     class="cb-profile__tab-pane"
							     role="tabpanel"
							     aria-labelledby="<?php echo htmlspecialchars($tab->id, ENT_QUOTES, 'UTF-8'); ?>-tab">
								
								<?php if ($tab->description) : ?>
									<div class="cb-profile__tab-description">
										<?php echo $tab->description; ?>
									</div>
								<?php endif; ?>

								<div class="cb-profile__fields">
									<?php foreach ($tab->fields as $field) : ?>
										<?php if ($field->value) : ?>
											<div class="cb-profile__field">
												<div class="cb-profile__field-label">
													<?php echo htmlspecialchars($field->title, ENT_QUOTES, 'UTF-8'); ?>
												</div>
												<div class="cb-profile__field-value">
													<?php echo $field->value; ?>
												</div>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="alert alert-warning" role="alert">
			<?php echo Text::_('COM_COMPROFILER_USER_NOT_FOUND'); ?>
		</div>
	<?php endif; ?>
</div>
