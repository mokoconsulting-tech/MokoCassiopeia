<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_articles_latest module
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-articles-latest mod-articles-latest-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($list)) : ?>
		<ul class="mod-articles-latest__list">
			<?php foreach ($list as $item) : ?>
				<li class="mod-articles-latest__item" itemscope itemtype="https://schema.org/Article">
					<?php if ($params->get('show_introtext', 0) && !empty($item->introtext)) : ?>
						<div class="mod-articles-latest__article">
							<h<?php echo $params->get('item_heading', 4); ?> class="mod-articles-latest__title" itemprop="headline">
								<?php if ($params->get('link_titles', 1)) : ?>
									<a href="<?php echo $item->link; ?>" itemprop="url" class="mod-articles-latest__link">
										<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
									</a>
								<?php else : ?>
									<?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?>
								<?php endif; ?>
							</h<?php echo $params->get('item_heading', 4); ?>>

							<?php if ($params->get('show_author', 0) || $params->get('show_date', 0) || $params->get('show_category', 0) || $params->get('show_hits', 0)) : ?>
								<div class="mod-articles-latest__meta">
									<?php if ($params->get('show_author', 0)) : ?>
										<span class="mod-articles-latest__author" itemprop="author" itemscope itemtype="https://schema.org/Person">
											<span class="icon-user" aria-hidden="true"></span>
											<span itemprop="name"><?php echo $item->author; ?></span>
										</span>
									<?php endif; ?>

									<?php if ($params->get('show_date', 0)) : ?>
										<span class="mod-articles-latest__date">
											<span class="icon-calendar" aria-hidden="true"></span>
											<time datetime="<?php echo HTMLHelper::_('date', $item->publish_up, 'c'); ?>" itemprop="datePublished">
												<?php echo HTMLHelper::_('date', $item->publish_up, Text::_('DATE_FORMAT_LC3')); ?>
											</time>
										</span>
									<?php endif; ?>

									<?php if ($params->get('show_category', 0)) : ?>
										<span class="mod-articles-latest__category">
											<span class="icon-folder" aria-hidden="true"></span>
											<?php echo $item->displayCategoryTitle; ?>
										</span>
									<?php endif; ?>

									<?php if ($params->get('show_hits', 0)) : ?>
										<span class="mod-articles-latest__hits">
											<span class="icon-eye" aria-hidden="true"></span>
											<?php echo $item->displayHits; ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<div class="mod-articles-latest__intro" itemprop="description">
								<?php echo $item->introtext; ?>
							</div>

							<?php if ($params->get('readmore', 0)) : ?>
								<div class="mod-articles-latest__readmore">
									<a href="<?php echo $item->link; ?>" class="mod-articles-latest__readmore-link btn btn-secondary">
										<?php echo Text::_('MOD_ARTICLES_LATEST_READMORE'); ?>
										<span class="icon-chevron-right" aria-hidden="true"></span>
									</a>
								</div>
							<?php endif; ?>
						</div>
					<?php else : ?>
						<a href="<?php echo $item->link; ?>" class="mod-articles-latest__link" itemprop="url">
							<span itemprop="headline"><?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></span>
						</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<div class="mod-articles-latest__empty">
			<p><?php echo Text::_('MOD_ARTICLES_LATEST_NO_ARTICLES'); ?></p>
		</div>
	<?php endif; ?>
</div>
