<?php
/**
 * @package     OS Membership Pro
 * @subpackage  com_osmembership
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for OS Membership plans list
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$this->document->addStyleDeclaration('
.osmembership-plans-responsive {
	display: grid;
	gap: 2rem;
	grid-template-columns: 1fr;
}

.osmembership-plan-card {
	background: var(--body-bg);
	border: 2px solid var(--border-color);
	border-radius: var(--border-radius);
	padding: 2rem;
	transition: all 0.3s;
	display: flex;
	flex-direction: column;
}

.osmembership-plan-card:hover {
	transform: translateY(-4px);
	box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
	border-color: var(--color-primary);
}

.osmembership-plan-card--featured {
	border-color: var(--color-primary);
	position: relative;
}

.osmembership-plan-card--featured::before {
	content: "' . Text::_('OSM_POPULAR') . '";
	position: absolute;
	top: -12px;
	right: 20px;
	background: var(--color-primary);
	color: white;
	padding: 0.25rem 1rem;
	border-radius: 1rem;
	font-size: 0.875rem;
	font-weight: 600;
}

@media (min-width: 768px) {
	.osmembership-plans-responsive {
		grid-template-columns: repeat(2, 1fr);
	}
}

@media (min-width: 992px) {
	.osmembership-plans-responsive {
		grid-template-columns: repeat(3, 1fr);
	}
}

@media (min-width: 1200px) {
	.osmembership-plans-responsive.osmembership-plans--many {
		grid-template-columns: repeat(4, 1fr);
	}
}
');
?>

<div class="osmembership-plans-responsive <?php echo count($this->items) > 3 ? 'osmembership-plans--many' : ''; ?>">
	<?php foreach ($this->items as $item) : ?>
		<div class="osmembership-plan-card <?php echo $item->featured ? 'osmembership-plan-card--featured' : ''; ?>">
			<?php if (!empty($item->image)) : ?>
				<div class="osmembership-plan__image" style="margin-bottom: 1.5rem;">
					<img src="<?php echo $item->image; ?>" 
					     alt="<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>"
					     style="width: 100%; height: auto; border-radius: var(--border-radius);" />
				</div>
			<?php endif; ?>

			<h2 class="osmembership-plan__title" style="margin: 0 0 1rem 0; font-size: 1.75rem; font-weight: 700;">
				<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
			</h2>

			<div class="osmembership-plan__pricing" style="margin-bottom: 1.5rem;">
				<?php if ($item->price > 0) : ?>
					<div style="font-size: 2.5rem; font-weight: 700; color: var(--color-primary); line-height: 1;">
						<span style="font-size: 1.5rem; vertical-align: super;"><?php echo $this->config->currency_symbol; ?></span>
						<?php echo number_format($item->price, 0); ?>
					</div>
					<?php if ($item->subscription_length > 0) : ?>
						<div style="color: var(--gray-600); margin-top: 0.5rem;">
							<?php echo Text::_('OSM_PER') . ' ' . $item->subscription_length . ' ' . Text::_('OSM_' . strtoupper($item->subscription_length_unit)); ?>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<div style="font-size: 2.5rem; font-weight: 700; color: var(--success);">
						<?php echo Text::_('OSM_FREE'); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($item->short_description)) : ?>
				<div class="osmembership-plan__description" style="margin-bottom: 1.5rem; color: var(--gray-600); line-height: 1.6;">
					<?php echo $item->short_description; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($item->features)) : ?>
				<div class="osmembership-plan__features" style="flex: 1; margin-bottom: 1.5rem;">
					<ul style="list-style: none; padding: 0; margin: 0;">
						<?php foreach (explode("\n", $item->features) as $feature) : ?>
							<?php if (trim($feature)) : ?>
								<li style="padding: 0.5rem 0; display: flex; align-items: flex-start; gap: 0.5rem;">
									<span class="icon-check" style="color: var(--success); flex-shrink: 0; margin-top: 0.25rem;"></span>
									<span><?php echo htmlspecialchars(trim($feature), ENT_COMPAT, 'UTF-8'); ?></span>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="osmembership-plan__actions">
				<a href="<?php echo OSMembershipHelperRoute::getRegistrationRoute($item->id); ?>" 
				   class="btn btn-primary" 
				   style="width: 100%; min-height: 48px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
					<?php echo Text::_('OSM_SUBSCRIBE_NOW'); ?>
					<span class="icon-chevron-right" style="margin-left: 0.5rem;"></span>
				</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>
