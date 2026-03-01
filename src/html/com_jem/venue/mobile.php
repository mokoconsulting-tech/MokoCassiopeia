<?php
/**
 * @package     JEM
 * @subpackage  com_jem
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for JEM venue view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

$venue = $this->venue ?? null;
$events = $this->rows ?? [];

if (!$venue) {
	return;
}
?>

<div class="jem-venue-responsive jem-component">
	<div class="jem-venue__container">
		
		<!-- Venue Header -->
		<div class="jem-venue__header">
			<h1 class="jem-venue__title">
				<?php echo $this->escape($venue->venue); ?>
			</h1>
		</div>

		<!-- Venue Image -->
		<?php if (!empty($venue->locimage)) : ?>
			<div class="jem-venue__image-wrapper">
				<img src="<?php echo $this->escape($venue->locimage); ?>" 
				     alt="<?php echo $this->escape($venue->venue); ?>" 
				     class="jem-venue__image"
				     loading="lazy">
			</div>
		<?php endif; ?>

		<!-- Venue Information -->
		<div class="jem-venue__info">
			
			<!-- Address -->
			<?php if (!empty($venue->street) || !empty($venue->city) || !empty($venue->postalCode)) : ?>
				<div class="jem-venue__info-item jem-venue__address">
					<span class="jem-venue__info-icon" aria-hidden="true">📍</span>
					<div class="jem-venue__info-content">
						<strong class="jem-venue__info-label">
							<?php echo Text::_('COM_JEM_ADDRESS'); ?>:
						</strong>
						<address class="jem-venue__address-content">
							<?php if (!empty($venue->street)) : ?>
								<div class="jem-venue__street">
									<?php echo $this->escape($venue->street); ?>
								</div>
							<?php endif; ?>
							<?php if (!empty($venue->postalCode) || !empty($venue->city)) : ?>
								<div class="jem-venue__city-line">
									<?php if (!empty($venue->postalCode)) : ?>
										<span class="jem-venue__postal">
											<?php echo $this->escape($venue->postalCode); ?>
										</span>
									<?php endif; ?>
									<?php if (!empty($venue->city)) : ?>
										<span class="jem-venue__city">
											<?php echo $this->escape($venue->city); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if (!empty($venue->state)) : ?>
								<div class="jem-venue__state">
									<?php echo $this->escape($venue->state); ?>
								</div>
							<?php endif; ?>
							<?php if (!empty($venue->country)) : ?>
								<div class="jem-venue__country">
									<?php echo $this->escape($venue->country); ?>
								</div>
							<?php endif; ?>
						</address>
					</div>
				</div>
			<?php endif; ?>

			<!-- Website -->
			<?php if (!empty($venue->url)) : ?>
				<div class="jem-venue__info-item jem-venue__website">
					<span class="jem-venue__info-icon" aria-hidden="true">🌐</span>
					<div class="jem-venue__info-content">
						<strong class="jem-venue__info-label">
							<?php echo Text::_('COM_JEM_WEBSITE'); ?>:
						</strong>
						<a href="<?php echo $this->escape($venue->url); ?>" 
						   target="_blank" 
						   rel="noopener noreferrer" 
						   class="jem-venue__link">
							<?php echo $this->escape($venue->url); ?>
						</a>
					</div>
				</div>
			<?php endif; ?>

			<!-- Description -->
			<?php if (!empty($venue->locdescription)) : ?>
				<div class="jem-venue__description">
					<h2 class="jem-venue__description-title">
						<?php echo Text::_('COM_JEM_DESCRIPTION'); ?>
					</h2>
					<div class="jem-venue__description-content">
						<?php echo $venue->locdescription; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>

		<!-- Map -->
		<?php if (!empty($venue->latitude) && !empty($venue->longitude)) : ?>
			<div class="jem-venue__map">
				<h2 class="jem-venue__map-title">
					<?php echo Text::_('COM_JEM_LOCATION'); ?>
				</h2>
				<div class="jem-venue__map-container">
					<!-- Map would be rendered here by JEM's map functionality -->
					<div class="jem-venue__map-placeholder">
						<p><?php echo Text::_('COM_JEM_MAP_VIEW'); ?></p>
						<p>
							<a href="https://www.google.com/maps?q=<?php echo $venue->latitude; ?>,<?php echo $venue->longitude; ?>" 
							   target="_blank" 
							   rel="noopener noreferrer" 
							   class="jem-venue__map-link btn btn-primary">
								<?php echo Text::_('COM_JEM_VIEW_ON_MAP'); ?>
							</a>
						</p>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Events at this Venue -->
		<?php if (!empty($events)) : ?>
			<div class="jem-venue__events">
				<h2 class="jem-venue__events-title">
					<?php echo Text::_('COM_JEM_EVENTS_AT_VENUE'); ?>
				</h2>
				<div class="jem-venue__events-list">
					<?php foreach ($events as $event) : ?>
						<div class="jem-venue__event-item">
							<div class="jem-venue__event-date">
								<?php if (!empty($event->dates)) : ?>
									<time datetime="<?php echo $this->escape($event->dates); ?>">
										<?php echo HTMLHelper::_('date', $event->dates, Text::_('DATE_FORMAT_LC4')); ?>
									</time>
								<?php endif; ?>
							</div>
							<h3 class="jem-venue__event-title">
								<?php if (!empty($event->slug)) : ?>
									<a href="<?php echo Route::_('index.php?option=com_jem&view=event&id=' . $event->slug); ?>" 
									   class="jem-venue__event-link">
										<?php echo $this->escape($event->title); ?>
									</a>
								<?php else : ?>
									<?php echo $this->escape($event->title); ?>
								<?php endif; ?>
							</h3>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<!-- Back Button -->
		<div class="jem-venue__actions">
			<a href="<?php echo Route::_('index.php?option=com_jem&view=eventslist'); ?>" 
			   class="jem-venue__button btn btn-secondary">
				<?php echo Text::_('COM_JEM_BACK_TO_EVENTS'); ?>
			</a>
		</div>

	</div>
</div>
