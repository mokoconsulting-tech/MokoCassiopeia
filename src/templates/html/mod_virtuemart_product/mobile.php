<?php
/**
 * @package     VirtueMart
 * @subpackage  mod_virtuemart_product
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_virtuemart_product module
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerText = $params->get('headerText', '');
$headerText = HTMLHelper::_('content.prepare', $headerText);
$display_style = $params->get('display_style', 'div');

// Add responsive wrapper class
$wrapperClass = 'mod-vm-product mod-vm-product-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if ($headerText) : ?>
		<div class="mod-vm-product__header">
			<?php echo $headerText; ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($products)) : ?>
		<div class="mod-vm-product__list mod-vm-product__list--<?php echo $display_style; ?>">
			<?php foreach ($products as $product) : ?>
				<div class="mod-vm-product__item">
					<?php if (!empty($product->images[0])) : ?>
						<div class="mod-vm-product__image">
							<a href="<?php echo $product->link; ?>" 
							   title="<?php echo htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>">
								<?php echo $product->images[0]->displayMediaThumb('', false); ?>
							</a>
							
							<?php if (!empty($product->product_availability)) : ?>
								<span class="mod-vm-product__availability">
									<?php echo $product->product_availability; ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="mod-vm-product__content">
						<h3 class="mod-vm-product__title">
							<a href="<?php echo $product->link; ?>">
								<?php echo htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>
							</a>
						</h3>

						<?php if (!empty($product->product_s_desc)) : ?>
							<div class="mod-vm-product__description">
								<?php echo shopFunctionsF::limitStringByWord($product->product_s_desc, 60, '...'); ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($product->prices)) : ?>
							<div class="mod-vm-product__price">
								<?php echo $product->prices; ?>
							</div>
						<?php endif; ?>

						<div class="mod-vm-product__actions">
							<a href="<?php echo $product->link; ?>" 
							   class="mod-vm-product__btn mod-vm-product__btn--view btn btn-secondary"
							   title="<?php echo Text::_('MOD_VIRTUEMART_PRODUCT_DETAILS'); ?>">
								<?php echo Text::_('MOD_VIRTUEMART_PRODUCT_DETAILS'); ?>
							</a>
							
							<?php if (!empty($product->form)) : ?>
								<div class="mod-vm-product__form">
									<?php echo $product->form; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="mod-vm-product__empty">
			<p><?php echo Text::_('MOD_VIRTUEMART_PRODUCT_NO_PRODUCTS'); ?></p>
		</div>
	<?php endif; ?>
</div>
