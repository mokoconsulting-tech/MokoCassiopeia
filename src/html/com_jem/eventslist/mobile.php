<?php
/**
 * @package     JEM
 * @subpackage  com_jem
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for JEM events list view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

// Load JEM helper if available
if (file_exists(JPATH_SITE . '/components/com_jem/helpers/helper.php')) {
	require_once JPATH_SITE . '/components/com_jem/helpers/helper.php';
}

$items = $this->items ?? [];
$params = $this->params ?? null;
?>

<div class="jem-eventslist-responsive jem-component">
	<div class="jem-eventslist__container">
		
		<?php if (!empty($this->pageheading)) : ?>
			<div class="jem-eventslist__header">
				<h1 class="jem-eventslist__title">
					<?php echo $this->escape($this->pageheading); ?>
				</h1>
			</div>
		<?php endif; ?>

		<?php if (!empty($items)) : ?>
			<div class="jem-eventslist__list">
				<?php foreach ($items as $item) : ?>
					<div class="jem-eventslist__item">
						<div class="jem-eventslist__item-inner">
							
							<!-- Event Date -->
							<div class="jem-eventslist__date">
								<?php if (!empty($item->dates)) : ?>
									<time datetime="<?php echo $this->escape($item->dates); ?>" 
									      class="jem-eventslist__datetime">
										<?php echo HTMLHelper::_('date', $item->dates, Text::_('DATE_FORMAT_LC4')); ?>
									</time>
								<?php endif; ?>
								
								<?php if (!empty($item->enddates) && $item->enddates != $item->dates) : ?>
									<span class="jem-eventslist__date-separator"> - </span>
									<time datetime="<?php echo $this->escape($item->enddates); ?>" 
									      class="jem-eventslist__datetime">
										<?php echo HTMLHelper::_('date', $item->enddates, Text::_('DATE_FORMAT_LC4')); ?>
									</time>
								<?php endif; ?>
							</div>

							<!-- Event Title -->
							<h2 class="jem-eventslist__event-title">
								<?php if (!empty($item->slug)) : ?>
									<a href="<?php echo Route::_('index.php?option=com_jem&view=event&id=' . $item->slug); ?>" 
									   class="jem-eventslist__link">
										<?php echo $this->escape($item->title); ?>
									</a>
								<?php else : ?>
									<?php echo $this->escape($item->title); ?>
								<?php endif; ?>
							</h2>

							<!-- Event Venue -->
							<?php if (!empty($item->venue)) : ?>
								<div class="jem-eventslist__venue">
									<span class="jem-eventslist__venue-icon" aria-hidden="true">📍</span>
									<?php if (!empty($item->venueslug)) : ?>
										<a href="<?php echo Route::_('index.php?option=com_jem&view=venue&id=' . $item->venueslug); ?>" 
										   class="jem-eventslist__venue-link">
											<?php echo $this->escape($item->venue); ?>
										</a>
									<?php else : ?>
										<span class="jem-eventslist__venue-name">
											<?php echo $this->escape($item->venue); ?>
										</span>
									<?php endif; ?>
									
									<?php if (!empty($item->city)) : ?>
										<span class="jem-eventslist__city">
											, <?php echo $this->escape($item->city); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<!-- Event Description -->
							<?php if (!empty($item->introtext)) : ?>
								<div class="jem-eventslist__description">
									<?php echo $item->introtext; ?>
								</div>
							<?php endif; ?>

							<!-- Event Categories -->
							<?php if (!empty($item->categories)) : ?>
								<div class="jem-eventslist__categories">
									<?php foreach ($item->categories as $category) : ?>
										<span class="jem-eventslist__category-badge">
											<?php echo $this->escape($category->catname); ?>
										</span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<!-- Read More Button -->
							<?php if (!empty($item->slug)) : ?>
								<div class="jem-eventslist__actions">
									<a href="<?php echo Route::_('index.php?option=com_jem&view=event&id=' . $item->slug); ?>" 
									   class="jem-eventslist__button btn btn-primary"
									   aria-label="<?php echo Text::sprintf('COM_JEM_READ_MORE_ABOUT', $this->escape($item->title)); ?>">
										<?php echo Text::_('COM_JEM_READ_MORE'); ?>
									</a>
								</div>
							<?php endif; ?>

						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Pagination -->
			<?php if (!empty($this->pagination)) : ?>
				<div class="jem-eventslist__pagination">
					<?php echo $this->pagination->getPagesLinks(); ?>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<div class="jem-eventslist__empty">
				<p class="jem-eventslist__empty-message">
					<?php echo Text::_('COM_JEM_NO_EVENTS'); ?>
				</p>
			</div>
		<?php endif; ?>

	</div>
</div>
