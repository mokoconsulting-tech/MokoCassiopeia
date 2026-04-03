<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Default layout override for mod_login.
 * Bootstrap 5 login form with showtitle support.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

Factory::getApplication()->getLanguage()->load('mod_login', JPATH_SITE);

$suffix      = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_COMPAT, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_COMPAT, 'UTF-8');
?>
<div class="mod-login<?php echo $suffix ? ' ' . $suffix : ''; ?>">
    <?php if ($module->showtitle) : ?>
        <<?php echo $headerTag; ?> class="mod-login__title<?php echo $headerClass ? ' ' . $headerClass : ''; ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
    <?php endif; ?>

    <?php if ($type === 'logout') : ?>
        <form action="<?php echo Route::_('index.php', true); ?>" method="post" class="mod-login__form mod-login__form--logout">
            <?php if ($params->get('greeting', 1)) : ?>
                <div class="mod-login__greeting">
                    <?php if (!empty($user->name)) : ?>
                        <span class="mod-login__name"><?php echo Text::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->name, ENT_COMPAT, 'UTF-8')); ?></span>
                    <?php else : ?>
                        <span class="mod-login__name"><?php echo Text::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->username, ENT_COMPAT, 'UTF-8')); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="mod-login__submit">
                <button type="submit" name="Submit" class="btn btn-primary w-100"><?php echo Text::_('JLOGOUT'); ?></button>
            </div>
            <input type="hidden" name="option" value="com_users">
            <input type="hidden" name="task" value="user.logout">
            <input type="hidden" name="return" value="<?php echo $return; ?>">
            <?php echo HTMLHelper::_('form.token'); ?>
        </form>
    <?php else : ?>
        <form action="<?php echo Route::_('index.php', true); ?>" method="post" class="mod-login__form mod-login__form--login">
            <?php if ($params->get('pretext')) : ?>
                <div class="mod-login__pretext"><?php echo $params->get('pretext'); ?></div>
            <?php endif; ?>

            <div class="mod-login__field mb-3">
                <label for="modlgn-username-<?php echo $module->id; ?>" class="form-label visually-hidden"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user" aria-hidden="true"></i></span>
                    <input id="modlgn-username-<?php echo $module->id; ?>" type="text" name="username" class="form-control" autocomplete="username" placeholder="<?php echo Text::_('JGLOBAL_USERNAME'); ?>">
                </div>
            </div>

            <div class="mod-login__field mb-3">
                <label for="modlgn-passwd-<?php echo $module->id; ?>" class="form-label visually-hidden"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock" aria-hidden="true"></i></span>
                    <input id="modlgn-passwd-<?php echo $module->id; ?>" type="password" name="password" class="form-control" autocomplete="current-password" placeholder="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>">
                </div>
            </div>

            <?php if (count($twofactormethods) > 1) : ?>
                <div class="mod-login__field mb-3">
                    <label for="modlgn-secretkey-<?php echo $module->id; ?>" class="form-label visually-hidden"><?php echo Text::_('JGLOBAL_SECRETKEY'); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></span>
                        <input id="modlgn-secretkey-<?php echo $module->id; ?>" type="text" name="secretkey" class="form-control" autocomplete="one-time-code" placeholder="<?php echo Text::_('JGLOBAL_SECRETKEY'); ?>">
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($params->get('remember', 1)) : ?>
                <div class="mod-login__remember form-check mb-3">
                    <input id="modlgn-remember-<?php echo $module->id; ?>" type="checkbox" name="remember" class="form-check-input" value="yes">
                    <label for="modlgn-remember-<?php echo $module->id; ?>" class="form-check-label"><?php echo Text::_('JGLOBAL_REMEMBER_ME'); ?></label>
                </div>
            <?php endif; ?>

            <div class="mod-login__submit mb-3">
                <button type="submit" name="Submit" class="btn btn-primary w-100"><?php echo Text::_('JLOGIN'); ?></button>
            </div>

            <?php $usersConfig = \Joomla\CMS\Component\ComponentHelper::getParams('com_users'); ?>
            <ul class="mod-login__options list-unstyled small">
                <?php if ($usersConfig->get('allowUserRegistration')) : ?>
                    <li>
                        <a href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>">
                            <?php echo Text::_('MOD_LOGIN_REGISTER'); ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>">
                        <?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
                        <?php echo Text::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>
                    </a>
                </li>
            </ul>

            <input type="hidden" name="option" value="com_users">
            <input type="hidden" name="task" value="user.login">
            <input type="hidden" name="return" value="<?php echo $return; ?>">
            <?php echo HTMLHelper::_('form.token'); ?>

            <?php if ($params->get('posttext')) : ?>
                <div class="mod-login__posttext"><?php echo $params->get('posttext'); ?></div>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</div>
