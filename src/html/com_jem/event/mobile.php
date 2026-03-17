<?php
/**
 * @package     JEM
 * @subpackage  com_jem
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for JEM event details view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

$item = $this->item ?? null;
$params = $this->params ?? null;

if (!$item) {
	return;
}
?>

<div class="jem-event-responsive jem-component">
	<div class="jem-event__container">
		
		<!-- Event Header -->
		<div class="jem-event__header">
			<h1 class="jem-event__title">
				<?php echo $this->escape($item->title); ?>
			</h1>
		</div>

		<!-- Event Image -->
		<?php if (!empty($item->datimage)) : ?>
			<div class="jem-event__image-wrapper">
				<img src="<?php echo $this->escape($item->datimage); ?>" 
				     alt="<?php echo $this->escape($item->title); ?>" 
				     class="jem-event__image"
				     loading="lazy">
			</div>
		<?php endif; ?>

		<!-- Event Meta Information -->
		<div class="jem-event__meta">
			
			<!-- Date and Time -->
			<div class="jem-event__meta-item jem-event__date">
				<span class="jem-event__meta-icon" aria-hidden="true">📅</span>
				<div class="jem-event__meta-content">
					<strong class="jem-event__meta-label">
						<?php echo Text::_('COM_JEM_DATE'); ?>:
					</strong>
					<?php if (!empty($item->dates)) : ?>
						<time datetime="<?php echo $this->escape($item->dates); ?>" 
						      class="jem-event__datetime">
							<?php echo HTMLHelper::_('date', $item->dates, Text::_('DATE_FORMAT_LC3')); ?>
						</time>
					<?php endif; ?>
					
					<?php if (!empty($item->enddates) && $item->enddates != $item->dates) : ?>
						<span class="jem-event__date-separator"> - </span>
						<time datetime="<?php echo $this->escape($item->enddates); ?>" 
						      class="jem-event__datetime">
							<?php echo HTMLHelper::_('date', $item->enddates, Text::_('DATE_FORMAT_LC3')); ?>
						</time>
					<?php endif; ?>
				</div>
			</div>

			<!-- Time -->
			<?php if (!empty($item->times)) : ?>
				<div class="jem-event__meta-item jem-event__time">
					<span class="jem-event__meta-icon" aria-hidden="true">🕐</span>
					<div class="jem-event__meta-content">
						<strong class="jem-event__meta-label">
							<?php echo Text::_('COM_JEM_TIME'); ?>:
						</strong>
						<span class="jem-event__time-value">
							<?php echo $this->escape($item->times); ?>
							<?php if (!empty($item->endtimes)) : ?>
								- <?php echo $this->escape($item->endtimes); ?>
							<?php endif; ?>
						</span>
					</div>
				</div>
			<?php endif; ?>

			<!-- Venue -->
			<?php if (!empty($item->venue)) : ?>
				<div class="jem-event__meta-item jem-event__venue">
					<span class="jem-event__meta-icon" aria-hidden="true">📍</span>
					<div class="jem-event__meta-content">
						<strong class="jem-event__meta-label">
							<?php echo Text::_('COM_JEM_VENUE'); ?>:
						</strong>
						<?php if (!empty($item->venueslug)) : ?>
							<a href="<?php echo Route::_('index.php?option=com_jem&view=venue&id=' . $item->venueslug); ?>" 
							   class="jem-event__venue-link">
								<?php echo $this->escape($item->venue); ?>
							</a>
						<?php else : ?>
							<span class="jem-event__venue-name">
								<?php echo $this->escape($item->venue); ?>
							</span>
						<?php endif; ?>
						
						<?php if (!empty($item->street) || !empty($item->city)) : ?>
							<div class="jem-event__address">
								<?php if (!empty($item->street)) : ?>
									<span class="jem-event__street">
										<?php echo $this->escape($item->street); ?>
									</span>
								<?php endif; ?>
								<?php if (!empty($item->city)) : ?>
									<span class="jem-event__city">
										<?php echo $this->escape($item->city); ?>
									</span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Categories -->
			<?php if (!empty($item->categories)) : ?>
				<div class="jem-event__meta-item jem-event__categories">
					<span class="jem-event__meta-icon" aria-hidden="true">🏷️</span>
					<div class="jem-event__meta-content">
						<strong class="jem-event__meta-label">
							<?php echo Text::_('COM_JEM_CATEGORIES'); ?>:
						</strong>
						<div class="jem-event__category-list">
							<?php foreach ($item->categories as $category) : ?>
								<span class="jem-event__category-badge">
									<?php echo $this->escape($category->catname); ?>
								</span>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

		</div>

		<!-- Event Description -->
		<?php if (!empty($item->fulltext)) : ?>
			<div class="jem-event__description">
				<h2 class="jem-event__description-title">
					<?php echo Text::_('COM_JEM_DESCRIPTION'); ?>
				</h2>
				<div class="jem-event__description-content">
					<?php echo $item->fulltext; ?>
				</div>
			</div>
		<?php endif; ?>

		<!-- Event Registration -->
		<?php if (!empty($item->registra) && $item->registra == 1) : ?>
			<div class="jem-event__registration">
				<h2 class="jem-event__registration-title">
					<?php echo Text::_('COM_JEM_REGISTRATION'); ?>
				</h2>
				<?php if (!empty($item->maxplaces)) : ?>
					<p class="jem-event__capacity">
						<strong><?php echo Text::_('COM_JEM_MAX_PLACES'); ?>:</strong>
						<?php echo (int) $item->maxplaces; ?>
					</p>
				<?php endif; ?>
				<?php if (!empty($item->waitinglist)) : ?>
					<p class="jem-event__waitinglist">
						<?php echo Text::_('COM_JEM_WAITING_LIST_ENABLED'); ?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<!-- Event Contact -->
		<?php if (!empty($item->contactname)) : ?>
			<div class="jem-event__contact">
				<h2 class="jem-event__contact-title">
					<?php echo Text::_('COM_JEM_CONTACT'); ?>
				</h2>
				<p class="jem-event__contact-info">
					<strong><?php echo Text::_('COM_JEM_NAME'); ?>:</strong>
					<?php echo $this->escape($item->contactname); ?>
				</p>
				<?php if (!empty($item->contactemail)) : ?>
					<p class="jem-event__contact-info">
						<strong><?php echo Text::_('COM_JEM_EMAIL'); ?>:</strong>
						<a href="mailto:<?php echo $this->escape($item->contactemail); ?>" 
						   class="jem-event__contact-link">
							<?php echo $this->escape($item->contactemail); ?>
						</a>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<!-- Back Button -->
		<div class="jem-event__actions">
			<a href="<?php echo Route::_('index.php?option=com_jem&view=eventslist'); ?>" 
			   class="jem-event__button btn btn-secondary">
				<?php echo Text::_('COM_JEM_BACK_TO_EVENTS'); ?>
			</a>
		</div>

	</div>
</div>
