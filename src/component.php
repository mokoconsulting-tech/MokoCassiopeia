<?php
/* Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later
 */


defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Component\ComponentHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app   = Factory::getApplication();
$input = $app->getInput();
$document = $app->getDocument();
$wa    = $document->getWebAssetManager();

// Template params - Component uses minimal configuration
$params_googletagmanager   = $this->params->get('googletagmanager', false);
$params_googletagmanagerid = $this->params->get('googletagmanagerid', null);
$params_googleanalytics    = $this->params->get('googleanalytics', false);
$params_googleanalyticsid  = $this->params->get('googleanalyticsid', null);
$params_googlesitekey      = $this->params->get('googlesitekey', null);

if (!empty($params_googlesitekey)) {
	$this->setMetaData('google-site-verification', htmlspecialchars($params_googlesitekey, ENT_QUOTES, 'UTF-8'));
}

// Detecting Active Variables
$option    = $input->getCmd('option', '');
$view      = $input->getCmd('view', '');
$layout    = $input->getCmd('layout', '');
$task      = $input->getCmd('task', '');
$itemid    = $input->getCmd('Itemid', '');
$sitenameR = $app->get('sitename'); // raw for title composition
$sitename  = htmlspecialchars($sitenameR, ENT_QUOTES, 'UTF-8');
$menu      = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Template/Media path
$templatePath = 'media/templates/site/mokocassiopeia';

// Core template CSS
$wa->useStyle('template.base');   // css/template.css

// Component always uses light theme only (no theme switching)
$wa->useStyle('template.light.standard');      // css/theme/light.standard.css

// Load Osaka font for site title
$wa->useStyle('template.font.osaka');

// Brand: logo from params OR siteTitle
// -------------------------------------
$brandHtml = '';
$logoFile  = (string) $this->params->get('logoFile');

if ($logoFile !== '') {
	$brandHtml = HTMLHelper::_(
		'image',
		Uri::root(false) . htmlspecialchars($logoFile, ENT_QUOTES, 'UTF-8'),
		$sitename,
		['class' => 'logo d-inline-block', 'loading' => 'eager', 'decoding' => 'async'],
		false,
		0
	);
} else {
	// If no logo file, show the title (defaults to "MokoCassiopeia" if not set)
	$siteTitle = $this->params->get('siteTitle', 'MokoCassiopeia');
	$brandHtml = '<span class="site-title" title="' . $sitename . '">'
			   . htmlspecialchars($siteTitle, ENT_COMPAT, 'UTF-8')
			   . '</span>';
}

?>
<!DOCTYPE html>
<html class="component" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" data-bs-theme="light">
<head>
	<jdoc:include type="metas" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="<?php echo $this->direction === 'rtl' ? 'rtl' : ''; ?>">
<?php if (!empty($params_googletagmanager) && !empty($params_googletagmanagerid)) :
	$gtmID = htmlspecialchars($params_googletagmanagerid, ENT_QUOTES, 'UTF-8'); ?>
	<!-- Google Tag Manager -->
	<script>
		(function(w,d,s,l,i){
			w[l]=w[l]||[];
			w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
			var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),
				dl=l!='dataLayer'?'&l='+l:'';
			j.async=true;
			j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
			f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','<?php echo $gtmID; ?>');
	</script>
	<!-- End Google Tag Manager -->

	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtmID; ?>"
				height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php endif; ?>

<?php if (!empty($params_googleanalytics) && !empty($params_googleanalyticsid)) :
	$gaId = htmlspecialchars($params_googleanalyticsid, ENT_QUOTES, 'UTF-8'); ?>
	<!-- Google Analytics (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gaId; ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('consent', 'default', {
			'ad_storage': 'denied',
			'analytics_storage': 'granted',
			'ad_user_data': 'denied',
			'ad_personalization': 'denied'
		});
		(function(id){
			if (/^G-/.test(id)) {
				gtag('config', id, { 'anonymize_ip': true });
			} else if (/^UA-/.test(id)) {
				gtag('config', id, { 'anonymize_ip': true });
				console.warn('Using a UA- ID. Universal Analytics is sunset; consider migrating to GA4.');
			} else {
				console.warn('Unrecognized Google Analytics ID format:', id);
			}
		})('<?php echo $gaId; ?>');
	</script>
	<!-- End Google Analytics -->
<?php endif; ?>

	<?php if ($this->params->get('brand', 1)) : ?>
		<div class="navbar-brand">
			<a class="brand-logo" href="<?php echo $this->baseurl; ?>/">
				<?php echo $brandHtml; ?>
			</a>
		</div>
	<?php endif; ?>

	<jdoc:include type="message" />
	<jdoc:include type="component" />

	<footer class="container-footer footer full-width">
		<?php if ($this->countModules('footer-menu', true)) : ?>
			<div class="grid-child footer-menu">
				<jdoc:include type="modules" name="footer-menu" />
			</div>
		<?php endif; ?>
		<?php if ($this->countModules('footer', true)) : ?>
			<div class="grid-child">
				<jdoc:include type="modules" name="footer" style="none" />
			</div>
		<?php endif; ?>
	</footer>

	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
