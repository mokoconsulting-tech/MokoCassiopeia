<?php
/**
 * @package     Community Builder
 * @subpackage  com_comprofiler
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for Community Builder users list view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// Get users list
$users = $this->users ?? [];
$pagination = $this->pagination ?? null;
$search = $this->search ?? '';
$listid = $this->listid ?? 0;
?>

<div class="cb-userslist-responsive cb-component">
	<div class="cb-userslist__header">
		<h1 class="cb-userslist__title">
			<?php echo Text::_('COM_COMPROFILER_USERLIST'); ?>
		</h1>

		<?php if ($this->showSearch ?? true) : ?>
			<div class="cb-userslist__search">
				<form action="<?php echo Route::_('index.php?option=com_comprofiler&view=userslist&listid=' . $listid); ?>" 
				      method="post" 
				      class="cb-userslist__search-form"
				      role="search"
				      aria-label="<?php echo Text::_('COM_COMPROFILER_SEARCH_USERS'); ?>">
					
					<div class="cb-userslist__search-wrapper">
						<label for="cb-userslist-search" class="visually-hidden">
							<?php echo Text::_('COM_COMPROFILER_SEARCH'); ?>
						</label>
						<input type="search" 
						       id="cb-userslist-search"
						       name="search" 
						       class="cb-userslist__search-input" 
						       placeholder="<?php echo Text::_('COM_COMPROFILER_SEARCH_USERS'); ?>"
						       value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
						       aria-label="<?php echo Text::_('COM_COMPROFILER_SEARCH'); ?>">
						
						<button type="submit" 
						        class="cb-userslist__search-btn btn btn-primary"
						        aria-label="<?php echo Text::_('COM_COMPROFILER_SEARCH'); ?>">
							<span class="icon-search" aria-hidden="true"></span>
							<span class="cb-userslist__search-text"><?php echo Text::_('COM_COMPROFILER_SEARCH'); ?></span>
						</button>
					</div>
				</form>
			</div>
		<?php endif; ?>
	</div>

	<?php if (!empty($users)) : ?>
		<div class="cb-userslist__grid">
			<?php foreach ($users as $user) : ?>
				<div class="cb-userslist__user-card">
					<?php if ($user->getField('avatar', null, 'html', 'none', 'list')) : ?>
						<div class="cb-userslist__avatar">
							<a href="<?php echo $user->getField('canvas', null, 'html', 'none', 'profile'); ?>" 
							   aria-label="<?php echo Text::sprintf('COM_COMPROFILER_VIEW_PROFILE', htmlspecialchars($user->getField('formatname', null, 'html', 'none', 'list'), ENT_QUOTES, 'UTF-8')); ?>">
								<?php echo $user->getField('avatar', null, 'html', 'none', 'list'); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="cb-userslist__user-info">
						<h3 class="cb-userslist__username">
							<a href="<?php echo $user->getField('canvas', null, 'html', 'none', 'profile'); ?>">
								<?php echo htmlspecialchars($user->getField('formatname', null, 'html', 'none', 'list'), ENT_QUOTES, 'UTF-8'); ?>
							</a>
						</h3>

						<?php if ($user->getField('onlinestatus', null, 'html', 'none', 'list')) : ?>
							<div class="cb-userslist__status">
								<?php echo $user->getField('onlinestatus', null, 'html', 'none', 'list'); ?>
							</div>
						<?php endif; ?>

						<?php if (isset($user->fields) && !empty($user->fields)) : ?>
							<div class="cb-userslist__fields">
								<?php foreach ($user->fields as $field) : ?>
									<?php if ($field->value) : ?>
										<div class="cb-userslist__field">
											<span class="cb-userslist__field-label"><?php echo htmlspecialchars($field->title, ENT_QUOTES, 'UTF-8'); ?>:</span>
											<span class="cb-userslist__field-value"><?php echo $field->value; ?></span>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<div class="cb-userslist__actions">
							<a href="<?php echo $user->getField('canvas', null, 'html', 'none', 'profile'); ?>" 
							   class="cb-userslist__btn btn btn-primary btn-sm">
								<span class="icon-user" aria-hidden="true"></span>
								<?php echo Text::_('COM_COMPROFILER_VIEW_PROFILE'); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ($pagination) : ?>
			<div class="cb-userslist__pagination">
				<?php echo $pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="alert alert-info" role="alert">
			<?php echo Text::_('COM_COMPROFILER_NO_USERS_FOUND'); ?>
		</div>
	<?php endif; ?>
</div>
