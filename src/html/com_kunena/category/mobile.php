<?php
/**
 * @package     Kunena
 * @subpackage  com_kunena
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for Kunena category list
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$this->document->addStyleDeclaration('
.kunena-category-list-responsive {
	width: 100%;
}

.kunena-category-responsive {
	background: var(--body-bg);
	border: 1px solid var(--border-color);
	border-radius: var(--border-radius);
	padding: 1rem;
	margin-bottom: 1rem;
	transition: all 0.2s;
}

.kunena-category-responsive:hover {
	background: var(--secondary-bg);
	border-color: var(--color-primary);
}

@media (max-width: 575.98px) {
	.kunena-category-responsive {
		padding: 0.75rem;
	}
}
');
?>

<div class="kunena-category-list-responsive">
	<?php if (!empty($this->categories)) : ?>
		<?php foreach ($this->categories as $category) : ?>
			<div class="kunena-category-responsive">
				<h3 class="kunena-category__title">
					<a href="<?php echo $category->getUrl(); ?>">
						<?php echo $this->escape($category->name); ?>
					</a>
				</h3>
				
				<?php if ($category->description) : ?>
					<div class="kunena-category__description">
						<?php echo $category->displayField('description'); ?>
					</div>
				<?php endif; ?>
				
				<div class="kunena-category__meta">
					<span><?php echo Text::_('COM_KUNENA_TOPICS'); ?>: <?php echo $category->numTopics; ?></span>
					<span><?php echo Text::_('COM_KUNENA_POSTS'); ?>: <?php echo $category->numPosts; ?></span>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else : ?>
		<div class="alert alert-info">
			<?php echo Text::_('COM_KUNENA_NO_CATEGORIES'); ?>
		</div>
	<?php endif; ?>
</div>
