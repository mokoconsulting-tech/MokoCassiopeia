<?php
/**
 * @package     HikaShop
 * @subpackage  mod_hikashop_cart
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_hikashop_cart module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-hikashop-cart mod-hikashop-cart-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>" id="hikashop_cart_module<?php echo $params->get('id'); ?>">
	<?php if (!empty($cart->products)) : ?>
		<div class="mod-hikashop-cart__header">
			<span class="mod-hikashop-cart__icon" aria-hidden="true">
				<span class="icon-basket"></span>
			</span>
			<div class="mod-hikashop-cart__summary">
				<div class="mod-hikashop-cart__count">
					<?php echo count($cart->products); ?> 
					<?php echo count($cart->products) == 1 ? Text::_('ITEM') : Text::_('ITEMS'); ?>
				</div>
				<?php if (!empty($cart->total)) : ?>
					<div class="mod-hikashop-cart__total">
						<?php echo $cart->total->price_value_with_tax_formated; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ($params->get('show_products', 1)) : ?>
			<div class="mod-hikashop-cart__products">
				<?php foreach ($cart->products as $product) : ?>
					<div class="mod-hikashop-cart__product">
						<?php if (!empty($product->images[0]) && $params->get('show_image', 1)) : ?>
							<div class="mod-hikashop-cart__product-image">
								<img src="<?php echo $product->images[0]->file_path; ?>" 
								     alt="<?php echo htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>" />
							</div>
						<?php endif; ?>
						
						<div class="mod-hikashop-cart__product-details">
							<div class="mod-hikashop-cart__product-name">
								<?php echo htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>
							</div>
							
							<div class="mod-hikashop-cart__product-quantity">
								<?php echo Text::_('QUANTITY'); ?>: 
								<span class="mod-hikashop-cart__quantity-value"><?php echo $product->cart_product_quantity; ?></span>
							</div>
							
							<?php if (!empty($product->prices[0])) : ?>
								<div class="mod-hikashop-cart__product-price">
									<?php echo $product->prices[0]->price_value_with_tax_formated; ?>
								</div>
							<?php endif; ?>
						</div>
						
						<?php if ($params->get('show_delete', 1)) : ?>
							<div class="mod-hikashop-cart__product-remove">
								<a href="#" 
								   class="mod-hikashop-cart__remove-btn hikashop_cart_product_delete" 
								   data-product-id="<?php echo $product->product_id; ?>"
								   title="<?php echo Text::_('HIKA_DELETE'); ?>"
								   aria-label="<?php echo Text::_('HIKA_DELETE') . ' ' . htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>">
									<span class="icon-remove" aria-hidden="true"></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="mod-hikashop-cart__actions">
			<?php if ($params->get('show_cart_button', 1)) : ?>
				<a href="<?php echo hikashop_completeLink('cart'); ?>" 
				   class="mod-hikashop-cart__btn mod-hikashop-cart__btn--view btn btn-secondary">
					<?php echo Text::_('HIKASHOP_CART_VIEW'); ?>
				</a>
			<?php endif; ?>
			
			<?php if ($params->get('show_checkout_button', 1)) : ?>
				<a href="<?php echo hikashop_completeLink('checkout'); ?>" 
				   class="mod-hikashop-cart__btn mod-hikashop-cart__btn--checkout btn btn-primary">
					<?php echo Text::_('HIKASHOP_CHECKOUT'); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php else : ?>
		<div class="mod-hikashop-cart__empty">
			<span class="mod-hikashop-cart__empty-icon" aria-hidden="true">
				<span class="icon-basket"></span>
			</span>
			<p class="mod-hikashop-cart__empty-text">
				<?php echo Text::_('HIKASHOP_CART_EMPTY'); ?>
			</p>
		</div>
	<?php endif; ?>
</div>
