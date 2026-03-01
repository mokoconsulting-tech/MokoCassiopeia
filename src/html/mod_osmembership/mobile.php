<?php
/**
 * @package     OS Membership Pro
 * @subpackage  mod_osmembership
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_osmembership module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-osmembership mod-osmembership-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($plans)) : ?>
		<div class="mod-osmembership__plans">
			<?php foreach ($plans as $plan) : ?>
				<div class="mod-osmembership__plan">
					<?php if ($params->get('show_plan_image', 1) && !empty($plan->image)) : ?>
						<div class="mod-osmembership__plan-image">
							<img src="<?php echo $plan->image; ?>" 
							     alt="<?php echo htmlspecialchars($plan->title, ENT_COMPAT, 'UTF-8'); ?>" />
						</div>
					<?php endif; ?>

					<div class="mod-osmembership__plan-content">
						<h<?php echo $params->get('header_level', 3); ?> class="mod-osmembership__plan-title">
							<?php echo htmlspecialchars($plan->title, ENT_COMPAT, 'UTF-8'); ?>
						</h<?php echo $params->get('header_level', 3); ?>>

						<?php if ($params->get('show_short_description', 1) && !empty($plan->short_description)) : ?>
							<div class="mod-osmembership__plan-description">
								<?php echo $plan->short_description; ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('show_price', 1)) : ?>
							<div class="mod-osmembership__plan-pricing">
								<?php if ($plan->price > 0) : ?>
									<div class="mod-osmembership__price">
										<span class="mod-osmembership__currency"><?php echo $config->currency_symbol; ?></span>
										<span class="mod-osmembership__amount"><?php echo number_format($plan->price, 2); ?></span>
										<?php if ($plan->subscription_length > 0) : ?>
											<span class="mod-osmembership__period">
												/ <?php echo $plan->subscription_length . ' ' . Text::_('OSM_' . strtoupper($plan->subscription_length_unit)); ?>
											</span>
										<?php endif; ?>
									</div>
								<?php else : ?>
									<div class="mod-osmembership__price mod-osmembership__price--free">
										<?php echo Text::_('OSM_FREE'); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('show_features', 1) && !empty($plan->features)) : ?>
							<div class="mod-osmembership__features">
								<ul class="mod-osmembership__features-list">
									<?php foreach (explode("\n", $plan->features) as $feature) : ?>
										<?php if (trim($feature)) : ?>
											<li class="mod-osmembership__feature">
												<span class="icon-check" aria-hidden="true"></span>
												<?php echo htmlspecialchars(trim($feature), ENT_COMPAT, 'UTF-8'); ?>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

						<div class="mod-osmembership__actions">
							<a href="<?php echo $plan->link; ?>" 
							   class="mod-osmembership__btn btn btn-primary">
								<?php echo $params->get('button_text', Text::_('OSM_SUBSCRIBE')); ?>
								<span class="icon-chevron-right" aria-hidden="true"></span>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ($params->get('show_all_plans_link', 1)) : ?>
			<div class="mod-osmembership__all-plans">
				<a href="<?php echo OSMembershipHelperRoute::getCategoriesRoute(); ?>" 
				   class="mod-osmembership__all-plans-link btn btn-secondary">
					<?php echo Text::_('OSM_VIEW_ALL_PLANS'); ?>
				</a>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="mod-osmembership__empty">
			<p><?php echo Text::_('OSM_NO_PLANS_AVAILABLE'); ?></p>
		</div>
	<?php endif; ?>
</div>
