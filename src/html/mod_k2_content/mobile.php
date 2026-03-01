<?php
/**
 * @package     K2
 * @subpackage  mod_k2_content
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_k2_content module
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-k2-content mod-k2-content-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (count($items)) : ?>
		<ul class="mod-k2-content__list">
			<?php foreach ($items as $key => $item) : ?>
				<li class="mod-k2-content__item">
					<?php if ($params->get('itemImage') && !empty($item->imageXSmall)) : ?>
						<div class="mod-k2-content__image">
							<a href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>">
								<img src="<?php echo $item->imageXSmall; ?>" alt="<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>" />
							</a>
						</div>
					<?php endif; ?>

					<div class="mod-k2-content__content">
						<?php if ($params->get('itemTitle')) : ?>
							<h<?php echo $params->get('item_heading', 4); ?> class="mod-k2-content__title">
								<a href="<?php echo $item->link; ?>">
									<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
								</a>
							</h<?php echo $params->get('item_heading', 4); ?>>
						<?php endif; ?>

						<?php if ($params->get('itemAuthor') || $params->get('itemDateCreated') || $params->get('itemCategory') || $params->get('itemHits')) : ?>
							<div class="mod-k2-content__meta">
								<?php if ($params->get('itemAuthor')) : ?>
									<span class="mod-k2-content__author">
										<span class="icon-user" aria-hidden="true"></span>
										<?php echo $item->author; ?>
									</span>
								<?php endif; ?>

								<?php if ($params->get('itemDateCreated')) : ?>
									<span class="mod-k2-content__date">
										<span class="icon-calendar" aria-hidden="true"></span>
										<time datetime="<?php echo HTMLHelper::_('date', $item->created, 'c'); ?>">
											<?php echo HTMLHelper::_('date', $item->created, Text::_('DATE_FORMAT_LC3')); ?>
										</time>
									</span>
								<?php endif; ?>

								<?php if ($params->get('itemCategory')) : ?>
									<span class="mod-k2-content__category">
										<span class="icon-folder" aria-hidden="true"></span>
										<a href="<?php echo $item->categoryLink; ?>">
											<?php echo $item->categoryname; ?>
										</a>
									</span>
								<?php endif; ?>

								<?php if ($params->get('itemHits')) : ?>
									<span class="mod-k2-content__hits">
										<span class="icon-eye" aria-hidden="true"></span>
										<?php echo $item->hits; ?> <?php echo Text::_('MOD_K2_CONTENT_HITS'); ?>
									</span>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('itemIntroText') && !empty($item->introtext)) : ?>
							<div class="mod-k2-content__intro">
								<?php echo $item->introtext; ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('itemReadMore')) : ?>
							<div class="mod-k2-content__readmore">
								<a href="<?php echo $item->link; ?>" class="mod-k2-content__readmore-link btn btn-secondary">
									<?php echo Text::_('MOD_K2_CONTENT_READ_MORE'); ?>
									<span class="icon-chevron-right" aria-hidden="true"></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if ($params->get('itemCustomLink')) : ?>
			<div class="mod-k2-content__custom-link">
				<a href="<?php echo $params->get('itemCustomLinkURL'); ?>" class="btn btn-primary">
					<?php echo $params->get('itemCustomLinkTitle'); ?>
				</a>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="mod-k2-content__empty">
			<p><?php echo Text::_('MOD_K2_CONTENT_NO_ITEMS'); ?></p>
		</div>
	<?php endif; ?>
</div>
