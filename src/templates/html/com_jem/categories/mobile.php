<?php
/**
 * @package     JEM
 * @subpackage  com_jem
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for JEM categories view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$categories = $this->categories ?? [];
?>

<div class="jem-categories-responsive jem-component">
	<div class="jem-categories__container">
		
		<!-- Categories Header -->
		<div class="jem-categories__header">
			<h1 class="jem-categories__title">
				<?php echo Text::_('COM_JEM_CATEGORIES'); ?>
			</h1>
		</div>

		<?php if (!empty($categories)) : ?>
			<div class="jem-categories__list">
				<?php foreach ($categories as $category) : ?>
					<div class="jem-categories__item">
						<div class="jem-categories__item-inner">
							
							<!-- Category Image -->
							<?php if (!empty($category->image)) : ?>
								<div class="jem-categories__image-wrapper">
									<img src="<?php echo $this->escape($category->image); ?>" 
									     alt="<?php echo $this->escape($category->catname); ?>" 
									     class="jem-categories__image"
									     loading="lazy">
								</div>
							<?php endif; ?>

							<!-- Category Content -->
							<div class="jem-categories__content">
								
								<!-- Category Title -->
								<h2 class="jem-categories__category-title">
									<?php if (!empty($category->slug)) : ?>
										<a href="<?php echo Route::_('index.php?option=com_jem&view=category&id=' . $category->slug); ?>" 
										   class="jem-categories__link">
											<?php echo $this->escape($category->catname); ?>
										</a>
									<?php else : ?>
										<?php echo $this->escape($category->catname); ?>
									<?php endif; ?>
								</h2>

								<!-- Category Description -->
								<?php if (!empty($category->catdescription)) : ?>
									<div class="jem-categories__description">
										<?php echo $category->catdescription; ?>
									</div>
								<?php endif; ?>

								<!-- Event Count -->
								<?php if (isset($category->eventcount)) : ?>
									<div class="jem-categories__meta">
										<span class="jem-categories__event-count">
											<?php echo Text::sprintf('COM_JEM_EVENTS_COUNT_FULL', (int) $category->eventcount); ?>
										</span>
									</div>
								<?php endif; ?>

								<!-- View Category Button -->
								<?php if (!empty($category->slug)) : ?>
									<div class="jem-categories__actions">
										<a href="<?php echo Route::_('index.php?option=com_jem&view=category&id=' . $category->slug); ?>" 
										   class="jem-categories__button btn btn-primary"
										   aria-label="<?php echo Text::sprintf('COM_JEM_VIEW_CATEGORY', $this->escape($category->catname)); ?>">
											<?php echo Text::_('COM_JEM_VIEW_CATEGORY'); ?>
										</a>
									</div>
								<?php endif; ?>

							</div>

						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Pagination -->
			<?php if (!empty($this->pagination)) : ?>
				<div class="jem-categories__pagination">
					<?php echo $this->pagination->getPagesLinks(); ?>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<div class="jem-categories__empty">
				<p class="jem-categories__empty-message">
					<?php echo Text::_('COM_JEM_NO_CATEGORIES'); ?>
				</p>
			</div>
		<?php endif; ?>

	</div>
</div>
