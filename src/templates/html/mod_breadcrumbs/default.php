<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Mobile responsive override for mod_breadcrumbs module
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

// Add responsive wrapper class
$wrapperClass = 'mod-breadcrumbs mod-breadcrumbs-responsive ' . $moduleclass_sfx;
?>

<nav class="<?php echo $wrapperClass; ?>" aria-label="<?php echo Text::_('JGLOBAL_YOU_ARE_HERE'); ?>">
	<?php if ($params->get('showHereYouAre', 1)) : ?>
		<span class="mod-breadcrumbs__prefix"><?php echo Text::_('JGLOBAL_YOU_ARE_HERE'); ?>:</span>
	<?php endif; ?>
	
	<ol class="mod-breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">
		<?php if ($params->get('showHome', 1)) : ?>
			<li class="mod-breadcrumbs__item mod-breadcrumbs__item--home" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<?php $icon = $params->get('homeIcon', 'icon-home'); ?>
				<a itemprop="item" href="<?php echo $list[0]->link; ?>" class="mod-breadcrumbs__link">
					<span class="<?php echo $icon; ?>" aria-hidden="true"></span>
					<span itemprop="name" class="visually-hidden"><?php echo htmlspecialchars($list[0]->name, ENT_COMPAT, 'UTF-8'); ?></span>
				</a>
				<meta itemprop="position" content="1" />
			</li>
			<?php $position = 2; ?>
		<?php else : ?>
			<?php $position = 1; ?>
		<?php endif; ?>

		<?php
		$start = $params->get('showHome', 1) ? 1 : 0;
		$count = count($list);
		
		for ($i = $start; $i < $count; $i++) :
			$isLast = ($i === $count - 1);
		?>
			<li class="mod-breadcrumbs__item <?php echo $isLast ? 'mod-breadcrumbs__item--active' : ''; ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<?php if (!$isLast) : ?>
					<a itemprop="item" href="<?php echo $list[$i]->link; ?>" class="mod-breadcrumbs__link">
						<span itemprop="name"><?php echo htmlspecialchars($list[$i]->name, ENT_COMPAT, 'UTF-8'); ?></span>
					</a>
				<?php else : ?>
					<span itemprop="name" class="mod-breadcrumbs__current" aria-current="page">
						<?php echo htmlspecialchars($list[$i]->name, ENT_COMPAT, 'UTF-8'); ?>
					</span>
				<?php endif; ?>
				<meta itemprop="position" content="<?php echo $position++; ?>" />
			</li>
		<?php endfor; ?>
	</ol>
</nav>
