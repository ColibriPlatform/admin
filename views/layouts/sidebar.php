<?php

use colibri\admin\widgets\SideNav;

/* @var $this View */

// Yii::$app->

$items = isset($this->params['sideMenu'])? $this->params['sideMenu'] : [];

array_unshift($items, ['label' => Yii::t('admin', 'Navigation'), 'options' => ['class' => 'header']]);

$items[] = ['label' => 'System', 'icon' => 'gear', 'url' => ['#'], 'items' => [
    ['label' => Yii::t('admin', 'Users'), 'url' => ['/user/admin/index'], 'icon' => 'group'],
    ['label' => Yii::t('admin', 'Roles'), 'url' => ['/rbac/role/index'], 'icon' => 'group'],
    ['label' => Yii::t('admin', 'Permissions'), 'url' => ['/rbac/permission/index'], 'icon' => 'group'],
    ['label' => Yii::t('admin', 'Configuration'), 'url' => ['/admin/settings/default/index'], 'icon' => 'wrench'],
]];

?>
<aside class="main-sidebar">
    <section class="sidebar">

        <form class="sidebar-form" method="get" action="#">
            <div class="input-group">
              <input type="text" placeholder="Search..." class="form-control" name="q">
              <span class="input-group-btn">
                <button class="btn btn-flat" id="search-btn" name="search" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
        <?php
        echo SideNav::widget([
            'options' => [
                'class' => 'sidebar-menu',
             ],
            'items' => $items,
            'activateParents' => true
        ]);
        ?>
    </section>
</aside>
