<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $identity dektrium\user\models\User */

$identity = Yii::$app->getUser()->getIdentity();
?>
<header class="main-header">
    <a href="<?= Yii::$app->homeUrl; ?>" class="logo">
        <span class="logo-mini"><?= ArrayHelper::getValue(Yii::$app->params, 'app.name.small', 'App')?></span>
        <span class="logo-lg"><?= Yii::$app->name ?></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?= Yii::t('admin', 'Toggle navigation') ?></span>
        </a>
        <?php $this->trigger('colibri.admin.top-navbar') ?>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php $this->trigger('colibri.admin.navbar-custom-menu-before') ?>
              <!-- User Account -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <img src="<?= $identity->profile->getAvatarUrl(160) ?>" class="user-image" alt="User Image" />

                  <span class="hidden-xs"><?= empty($identity->profile->name)?  $identity->username : $identity->profile->name?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">

                    <img src="<?= $identity->profile->getAvatarUrl(160) ?>" class="img-circle" alt="User Image">

                    <p><?= empty($identity->profile->name)?  $identity->username : $identity->profile->name?></p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?= Html::a('Profile', ['/user/settings/profile'], ['class' => 'btn btn-default btn-flat'])?>
                    </div>
                    <div class="pull-right">
                      <?= Html::a('Logout', ['/user/security/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post'])?>
                    </div>
                  </li>
                </ul>
              </li>
              <?php $this->trigger('colibri.admin.navbar-custom-menu-after') ?>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
        </div>
    </nav>
</header>