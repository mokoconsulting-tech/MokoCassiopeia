<?php
/**
 * @package     VirtueMart
 * @subpackage  mod_virtuemart_cart
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_virtuemart_cart module
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

// Load VirtueMart assets if not already loaded
vmJsApi::js('fancybox/jquery.fancybox-1.3.4.pack');
vmJsApi::css('jquery.fancybox-1.3.4');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$show_price = $params->get('show_price', 1);
$show_product_list = $params->get('show_product_list', 1);

// Add responsive wrapper class
$wrapperClass = 'mod-vm-cart mod-vm-cart-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($data->totalProduct) && $data->totalProduct > 0) : ?>
		<div class="mod-vm-cart__header">
			<span class="mod-vm-cart__icon" aria-hidden="true">
				<span class="icon-basket"></span>
			</span>
			<div class="mod-vm-cart__summary">
				<div class="mod-vm-cart__count">
					<?php echo $data->totalProduct; ?> 
					<?php echo $data->totalProduct == 1 ? Text::_('MOD_VIRTUEMART_CART_ITEM') : Text::_('MOD_VIRTUEMART_CART_ITEMS'); ?>
				</div>
				<?php if ($show_price && !empty($data->billTotal)) : ?>
					<div class="mod-vm-cart__total">
						<?php echo $data->billTotal; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ($show_product_list && !empty($data->products)) : ?>
			<div class="mod-vm-cart__products">
				<?php foreach ($data->products as $product) : ?>
					<div class="mod-vm-cart__product">
						<?php if (!empty($product->image)) : ?>
							<div class="mod-vm-cart__product-image">
								<a href="<?php echo $product->url; ?>" 
								   title="<?php echo htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>">
									<?php echo $product->image; ?>
								</a>
							</div>
						<?php endif; ?>
						
						<div class="mod-vm-cart__product-details">
							<div class="mod-vm-cart__product-name">
								<a href="<?php echo $product->url; ?>">
									<?php echo htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>
								</a>
							</div>
							
							<div class="mod-vm-cart__product-quantity">
								<?php echo Text::_('MOD_VIRTUEMART_CART_QUANTITY'); ?>: 
								<span class="mod-vm-cart__quantity-value"><?php echo $product->quantity; ?></span>
							</div>
							
							<?php if ($show_price && !empty($product->prices)) : ?>
								<div class="mod-vm-cart__product-price">
									<?php echo $product->prices; ?>
								</div>
							<?php endif; ?>
						</div>
						
						<?php if (!empty($product->delete_link)) : ?>
							<div class="mod-vm-cart__product-remove">
								<a href="<?php echo $product->delete_link; ?>" 
								   class="mod-vm-cart__remove-btn"
								   title="<?php echo Text::_('MOD_VIRTUEMART_CART_DELETE'); ?>"
								   aria-label="<?php echo Text::_('MOD_VIRTUEMART_CART_DELETE') . ' ' . htmlspecialchars($product->product_name, ENT_COMPAT, 'UTF-8'); ?>">
									<span class="icon-remove" aria-hidden="true"></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="mod-vm-cart__actions">
			<?php if (!empty($data->cart_show)) : ?>
				<a href="<?php echo $data->cart_show; ?>" 
				   class="mod-vm-cart__btn mod-vm-cart__btn--view btn btn-secondary"
				   title="<?php echo Text::_('MOD_VIRTUEMART_CART_SHOW'); ?>">
					<?php echo Text::_('MOD_VIRTUEMART_CART_SHOW'); ?>
				</a>
			<?php endif; ?>
			
			<?php if (!empty($data->checkout_link)) : ?>
				<a href="<?php echo $data->checkout_link; ?>" 
				   class="mod-vm-cart__btn mod-vm-cart__btn--checkout btn btn-primary"
				   title="<?php echo Text::_('MOD_VIRTUEMART_CART_CHECKOUT'); ?>">
					<?php echo Text::_('MOD_VIRTUEMART_CART_CHECKOUT'); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php else : ?>
		<div class="mod-vm-cart__empty">
			<span class="mod-vm-cart__empty-icon" aria-hidden="true">
				<span class="icon-basket"></span>
			</span>
			<p class="mod-vm-cart__empty-text">
				<?php echo Text::_('MOD_VIRTUEMART_CART_EMPTY'); ?>
			</p>
		</div>
	<?php endif; ?>
</div>
