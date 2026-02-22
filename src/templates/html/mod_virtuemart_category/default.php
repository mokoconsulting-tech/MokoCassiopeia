<?php
/**
 * @package     VirtueMart
 * @subpackage  mod_virtuemart_category
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_virtuemart_category module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$show_images = $params->get('show_images', 1);
$show_description = $params->get('show_description', 0);
$show_product_count = $params->get('show_product_count', 0);

// Add responsive wrapper class
$wrapperClass = 'mod-vm-category mod-vm-category-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($categories)) : ?>
		<nav class="mod-vm-category__nav" aria-label="<?php echo Text::_('MOD_VIRTUEMART_CATEGORY_NAVIGATION'); ?>">
			<ul class="mod-vm-category__list">
				<?php foreach ($categories as $category) : ?>
					<li class="mod-vm-category__item <?php echo ($category->current) ? 'mod-vm-category__item--active' : ''; ?>">
						<a href="<?php echo $category->link; ?>" 
						   class="mod-vm-category__link <?php echo ($category->current) ? 'mod-vm-category__link--active' : ''; ?>"
						   <?php echo ($category->current) ? 'aria-current="page"' : ''; ?>>
							
							<?php if ($show_images && !empty($category->images[0])) : ?>
								<span class="mod-vm-category__image">
									<?php echo $category->images[0]->displayMediaThumb('', false); ?>
								</span>
							<?php endif; ?>
							
							<span class="mod-vm-category__name">
								<?php echo htmlspecialchars($category->category_name, ENT_COMPAT, 'UTF-8'); ?>
							</span>
							
							<?php if ($show_product_count && isset($category->product_count)) : ?>
								<span class="mod-vm-category__count">
									(<?php echo $category->product_count; ?>)
								</span>
							<?php endif; ?>
						</a>

						<?php if ($show_description && !empty($category->category_description)) : ?>
							<div class="mod-vm-category__description">
								<?php echo shopFunctionsF::limitStringByWord($category->category_description, 50, '...'); ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($category->children)) : ?>
							<ul class="mod-vm-category__sublist">
								<?php foreach ($category->children as $child) : ?>
									<li class="mod-vm-category__subitem <?php echo ($child->current) ? 'mod-vm-category__subitem--active' : ''; ?>">
										<a href="<?php echo $child->link; ?>" 
										   class="mod-vm-category__sublink <?php echo ($child->current) ? 'mod-vm-category__sublink--active' : ''; ?>"
										   <?php echo ($child->current) ? 'aria-current="page"' : ''; ?>>
											<?php echo htmlspecialchars($child->category_name, ENT_COMPAT, 'UTF-8'); ?>
											<?php if ($show_product_count && isset($child->product_count)) : ?>
												<span class="mod-vm-category__count">
													(<?php echo $child->product_count; ?>)
												</span>
											<?php endif; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	<?php else : ?>
		<div class="mod-vm-category__empty">
			<p><?php echo Text::_('MOD_VIRTUEMART_CATEGORY_NO_CATEGORIES'); ?></p>
		</div>
	<?php endif; ?>
</div>
