<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

use colibri\admin\widgets\SideNav;
use yii\base\Event;

/* @var $this \yii\web\View */

$items = [];

$evt = new Event();
$evt->data = &$items;

/*
 * Trigger the admin side nav event that allow third party code to update the item list.
 *
 * Exemple of use :
 *
 * ```php
 * Yii::$app->view->on('colibri.admin.initSideNav', function($event) {
 *    $items = &$event->data;
 *    $items[] = ['label' => 'Site', 'icon' => 'gear', 'url' => ['/admin/site']];
 * });
 * ```
 */

$this->trigger('colibri.admin.initSideNav', $evt);

array_unshift($items, ['label' => strtoupper(Yii::t('admin', 'Main navigation')), 'options' => ['class' => 'header']]);

$items[] = ['label' => Yii::t('admin', 'System'), 'icon' => 'gear', 'url' => ['#'], 'items' => [
    ['label' => Yii::t('admin', 'Users'), 'url' => ['/user/admin/index'], 'icon' => 'group'],
    ['label' => Yii::t('admin', 'Roles'), 'url' => ['/rbac/role/index'], 'icon' => 'group'],
    ['label' => Yii::t('admin', 'Permissions'), 'url' => ['/rbac/permission/index'], 'icon' => 'group'],
    ['label' => Yii::t('admin', 'Global configuration'), 'url' => ['/admin/settings/default/index'], 'icon' => 'wrench'],
]];

?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php $this->trigger('colibri.admin.sidebar-top') ?>

        <?php
        echo SideNav::widget([
            'options' => [
                'class' => 'sidebar-menu',
             ],
            'items' => $items,
            'activateParents' => true
        ]);
        ?>

        <?php $this->trigger('colibri.admin.sidebar-bottom') ?>
    </section>
</aside>
