<?php
/**
 * @package     VirtueMart
 * @subpackage  mod_virtuemart_manufacturer
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_virtuemart_manufacturer module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$show_images = $params->get('show_images', 1);
$display_style = $params->get('display_style', 'list');

// Add responsive wrapper class
$wrapperClass = 'mod-vm-manufacturer mod-vm-manufacturer-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($manufacturers)) : ?>
		<div class="mod-vm-manufacturer__container mod-vm-manufacturer__container--<?php echo $display_style; ?>">
			<?php foreach ($manufacturers as $manufacturer) : ?>
				<div class="mod-vm-manufacturer__item">
					<a href="<?php echo $manufacturer->link; ?>" 
					   class="mod-vm-manufacturer__link"
					   title="<?php echo htmlspecialchars($manufacturer->mf_name, ENT_COMPAT, 'UTF-8'); ?>">
						
						<?php if ($show_images && !empty($manufacturer->images[0])) : ?>
							<div class="mod-vm-manufacturer__image">
								<?php echo $manufacturer->images[0]->displayMediaThumb('', false); ?>
							</div>
						<?php endif; ?>
						
						<div class="mod-vm-manufacturer__content">
							<span class="mod-vm-manufacturer__name">
								<?php echo htmlspecialchars($manufacturer->mf_name, ENT_COMPAT, 'UTF-8'); ?>
							</span>
							
							<?php if (!empty($manufacturer->mf_desc)) : ?>
								<div class="mod-vm-manufacturer__description">
									<?php echo shopFunctionsF::limitStringByWord($manufacturer->mf_desc, 30, '...'); ?>
								</div>
							<?php endif; ?>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="mod-vm-manufacturer__empty">
			<p><?php echo Text::_('MOD_VIRTUEMART_MANUFACTURER_NO_MANUFACTURERS'); ?></p>
		</div>
	<?php endif; ?>
</div>
