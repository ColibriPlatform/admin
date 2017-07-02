<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

/* @var $this \yii\web\View */
use yii\base\Event;
use yii\jui\Sortable;

$this->title = Yii::t('admin', 'Dashboard');
$this->params['subtitle'] = Yii::t('admin', 'Control panel');

$this->registerCss('.ui-sortable .box-header {cursor: move}');
?>

<!-- Top positions -->

<div class="row">
  <div class="col-lg-3 col-xs-6">
  <?php $this->trigger('colibri.admin.dashboard.top-1') ?>
  </div>

  <div class="col-lg-3 col-xs-6">
  <?php $this->trigger('colibri.admin.dashboard.top-2') ?>
  </div>

  <div class="col-lg-3 col-xs-6">
  <?php $this->trigger('colibri.admin.dashboard.top-3') ?>
  </div>

  <div class="col-lg-3 col-xs-6">
  <?php $this->trigger('colibri.admin.dashboard.top-4') ?>
  </div>
</div>

<!-- Main positions -->

<div class="row">
  <section class="col-lg-7">
  <?php
      $items = [];
      $evt = new Event();
      $evt->data = &$items;
      $this->trigger('colibri.admin.dashboard.main-1', $evt);

      if (!empty($items)) {
        echo Sortable::widget(['items' => $items,
          'clientOptions' => [
              'placeholder' => 'sort-highlight',
              'handle' => '.box-header, .nav-tabs',
              'forcePlaceholderSize' => true,
              'zIndex' => '999999',
          ],
          'options' => ['tag' => 'div'],
          'itemOptions' => ['tag' => 'div'],
        ]);
    }
  ?>
  </section>

  <section class="col-lg-5">
  <?php
      $items = [];
      $evt = new Event();
      $evt->data = &$items;
      $this->trigger('colibri.admin.dashboard.main-2', $evt);

      if (!empty($items)) {
        echo Sortable::widget(['items' => $items,
          'clientOptions' => [
              'placeholder' => 'sort-highlight',
              'handle' => '.box-header, .nav-tabs',
              'forcePlaceholderSize' => true,
              'zIndex' => '999999',
          ],
          'options' => ['tag' => 'div'],
          'itemOptions' => ['tag' => 'div'],
        ]);
    }
  ?>
  </section>
</div>
