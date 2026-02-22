<?php
/**
 * @package     Kunena
 * @subpackage  mod_kunenalatest
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_kunenalatest module
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-kunena-latest mod-kunena-latest-responsive ' . $moduleclass_sfx;
?>

<div class="<?php echo $wrapperClass; ?>">
	<?php if (!empty($posts)) : ?>
		<ul class="mod-kunena-latest__list">
			<?php foreach ($posts as $post) : ?>
				<li class="mod-kunena-latest__item">
					<?php if ($params->get('sh_userpic', 1) && !empty($post->getAuthor()->getAvatarImage())) : ?>
						<div class="mod-kunena-latest__avatar">
							<?php echo $post->getAuthor()->getAvatarImage('', 40, 40); ?>
						</div>
					<?php endif; ?>

					<div class="mod-kunena-latest__content">
						<?php if ($params->get('sh_topic', 1)) : ?>
							<h<?php echo $params->get('header_level', 4); ?> class="mod-kunena-latest__title">
								<a href="<?php echo $post->getUrl(); ?>">
									<?php echo htmlspecialchars($post->subject, ENT_COMPAT, 'UTF-8'); ?>
								</a>
							</h<?php echo $params->get('header_level', 4); ?>>
						<?php endif; ?>

						<div class="mod-kunena-latest__meta">
							<?php if ($params->get('sh_username', 1)) : ?>
								<span class="mod-kunena-latest__author">
									<span class="icon-user" aria-hidden="true"></span>
									<a href="<?php echo $post->getAuthor()->getLink(); ?>">
										<?php echo $post->getAuthor()->getName(); ?>
									</a>
								</span>
							<?php endif; ?>

							<?php if ($params->get('sh_time', 1)) : ?>
								<span class="mod-kunena-latest__date">
									<span class="icon-clock" aria-hidden="true"></span>
									<time datetime="<?php echo HTMLHelper::_('date', $post->time, 'c'); ?>">
										<?php echo $post->getTime(); ?>
									</time>
								</span>
							<?php endif; ?>

							<?php if ($params->get('sh_category', 1)) : ?>
								<span class="mod-kunena-latest__category">
									<span class="icon-folder" aria-hidden="true"></span>
									<a href="<?php echo $post->getCategory()->getUrl(); ?>">
										<?php echo $post->getCategory()->name; ?>
									</a>
								</span>
							<?php endif; ?>

							<?php if ($params->get('sh_hits', 0)) : ?>
								<span class="mod-kunena-latest__hits">
									<span class="icon-eye" aria-hidden="true"></span>
									<?php echo $post->getTopic()->hits; ?>
								</span>
							<?php endif; ?>

							<?php if ($params->get('sh_replies', 0)) : ?>
								<span class="mod-kunena-latest__replies">
									<span class="icon-comments" aria-hidden="true"></span>
									<?php echo $post->getTopic()->getReplies(); ?>
								</span>
							<?php endif; ?>
						</div>

						<?php if ($params->get('sh_text', 0) && !empty($post->message)) : ?>
							<div class="mod-kunena-latest__excerpt">
								<?php echo KunenaHtmlParser::parseBBCode($post->message, $params->get('txt_len', 50)); ?>
							</div>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if ($params->get('more_link', 1)) : ?>
			<div class="mod-kunena-latest__more">
				<a href="<?php echo KunenaRoute::_('index.php?option=com_kunena'); ?>" 
				   class="mod-kunena-latest__more-link btn btn-secondary">
					<?php echo Text::_('MOD_KUNENALATEST_MORE'); ?>
					<span class="icon-chevron-right" aria-hidden="true"></span>
				</a>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<div class="mod-kunena-latest__empty">
			<p><?php echo Text::_('MOD_KUNENALATEST_NO_POSTS'); ?></p>
		</div>
	<?php endif; ?>
</div>
