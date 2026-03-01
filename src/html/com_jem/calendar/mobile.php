<?php
/**
 * @package     JEM
 * @subpackage  com_jem
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for JEM calendar view
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

$events = $this->rows ?? [];
$date = $this->date ?? null;
$year = $this->year ?? date('Y');
$month = $this->month ?? date('m');
?>

<div class="jem-calendar-responsive jem-component">
	<div class="jem-calendar__container">
		
		<!-- Calendar Header -->
		<div class="jem-calendar__header">
			<h1 class="jem-calendar__title">
				<?php echo Text::_('COM_JEM_CALENDAR'); ?>
			</h1>
		</div>

		<!-- Calendar Navigation -->
		<div class="jem-calendar__navigation">
			<a href="<?php echo Route::_('index.php?option=com_jem&view=calendar&year=' . ($month == 1 ? $year - 1 : $year) . '&month=' . ($month == 1 ? 12 : $month - 1)); ?>" 
			   class="jem-calendar__nav-button jem-calendar__nav-prev"
			   aria-label="<?php echo Text::_('COM_JEM_PREVIOUS_MONTH'); ?>">
				<span aria-hidden="true">&#8249;</span>
			</a>
			
			<h2 class="jem-calendar__current-month">
				<?php echo HTMLHelper::_('date', $year . '-' . $month . '-01', 'F Y'); ?>
			</h2>
			
			<a href="<?php echo Route::_('index.php?option=com_jem&view=calendar&year=' . ($month == 12 ? $year + 1 : $year) . '&month=' . ($month == 12 ? 1 : $month + 1)); ?>" 
			   class="jem-calendar__nav-button jem-calendar__nav-next"
			   aria-label="<?php echo Text::_('COM_JEM_NEXT_MONTH'); ?>">
				<span aria-hidden="true">&#8250;</span>
			</a>
		</div>

		<!-- Calendar Grid -->
		<div class="jem-calendar__grid">
			<!-- Weekday Headers -->
			<div class="jem-calendar__weekdays">
				<?php
				$weekDays = [
					Text::_('SUN'),
					Text::_('MON'),
					Text::_('TUE'),
					Text::_('WED'),
					Text::_('THU'),
					Text::_('FRI'),
					Text::_('SAT')
				];
				foreach ($weekDays as $day) : ?>
					<div class="jem-calendar__weekday">
						<?php echo $day; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Calendar Days -->
			<div class="jem-calendar__days">
				<?php
				// Generate calendar days
				$firstDay = mktime(0, 0, 0, $month, 1, $year);
				$daysInMonth = date('t', $firstDay);
				$dayOfWeek = date('w', $firstDay);
				
				// Empty cells before first day
				for ($i = 0; $i < $dayOfWeek; $i++) : ?>
					<div class="jem-calendar__day jem-calendar__day--empty"></div>
				<?php endfor;
				
				// Days with events
				for ($day = 1; $day <= $daysInMonth; $day++) :
					$currentDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
					$hasEvents = false;
					$dayEvents = [];
					
					// Check for events on this day
					if (!empty($events)) {
						foreach ($events as $event) {
							if (!empty($event->dates) && date('Y-m-d', strtotime($event->dates)) == $currentDate) {
								$hasEvents = true;
								$dayEvents[] = $event;
							}
						}
					}
					
					$isToday = ($currentDate == date('Y-m-d'));
					$classes = 'jem-calendar__day';
					if ($hasEvents) {
						$classes .= ' jem-calendar__day--has-events';
					}
					if ($isToday) {
						$classes .= ' jem-calendar__day--today';
					}
					?>
					<div class="<?php echo $classes; ?>" data-date="<?php echo $currentDate; ?>">
						<div class="jem-calendar__day-number">
							<?php echo $day; ?>
						</div>
						<?php if ($hasEvents) : ?>
							<div class="jem-calendar__day-events">
								<span class="jem-calendar__event-indicator" 
								      aria-label="<?php echo Text::sprintf('COM_JEM_EVENTS_COUNT', count($dayEvents)); ?>">
									<?php echo count($dayEvents); ?>
								</span>
							</div>
						<?php endif; ?>
					</div>
				<?php endfor; ?>
			</div>
		</div>

		<!-- Events List for Selected/Current Day -->
		<?php if (!empty($events)) : ?>
			<div class="jem-calendar__events-list">
				<h3 class="jem-calendar__events-title">
					<?php echo Text::_('COM_JEM_UPCOMING_EVENTS'); ?>
				</h3>
				<div class="jem-calendar__events">
					<?php foreach ($events as $event) : ?>
						<div class="jem-calendar__event-item">
							<div class="jem-calendar__event-date">
								<?php if (!empty($event->dates)) : ?>
									<time datetime="<?php echo $this->escape($event->dates); ?>">
										<?php echo HTMLHelper::_('date', $event->dates, Text::_('DATE_FORMAT_LC4')); ?>
									</time>
								<?php endif; ?>
							</div>
							<h4 class="jem-calendar__event-title">
								<?php if (!empty($event->slug)) : ?>
									<a href="<?php echo Route::_('index.php?option=com_jem&view=event&id=' . $event->slug); ?>" 
									   class="jem-calendar__event-link">
										<?php echo $this->escape($event->title); ?>
									</a>
								<?php else : ?>
									<?php echo $this->escape($event->title); ?>
								<?php endif; ?>
							</h4>
							<?php if (!empty($event->venue)) : ?>
								<div class="jem-calendar__event-venue">
									📍 <?php echo $this->escape($event->venue); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>
