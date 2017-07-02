<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

/* @var $this \yii\web\View */

$skinNames = [
    'skin-blue'         => 'Blue',
    'skin-black'        => 'Black',
    'skin-purple'       => 'Purple',
    'skin-green'        => 'Green',
    'skin-red'          => 'Red',
    'skin-yellow'       => 'Yellow',
    'skin-blue-light'   => 'Blue Light',
    'skin-black-light'  => 'Black Light',
    'skin-purple-light' => 'Purple Light',
    'skin-green-light'  => 'Green Light',
    'skin-red-light'    => 'Red Light',
    'skin-yellow-light' => 'Yellow Light'
];

$skinColors = [
    'skin-blue'         => ['#367fa9', '#3c8dbc', '#222d32', '#f4f5f7'],
    'skin-black'        => ['#fefefe', '#fefefe', '#222d32', '#f4f5f7'],
    'skin-purple'       => ['#555299', '#605ca8', '#222d32', '#f4f5f7'],
    'skin-green'        => ['#008d4c', '#00a65a', '#222d32', '#f4f5f7'],
    'skin-red'          => ['#d33724', '#dd4b39', '#222d32', '#f4f5f7'],
    'skin-yellow'       => ['#db8b0b', '#f39c12', '#222d32', '#f4f5f7'],
    'skin-blue-light'   => ['#367fa9', '#3c8dbc', '#f9fafc', '#f4f5f7'],
    'skin-black-light'  => ['#fefefe', '#fefefe', '#f9fafc', '#f4f5f7'],
    'skin-purple-light' => ['#555299', '#605ca8', '#f9fafc', '#f4f5f7'],
    'skin-green-light'  => ['#008d4c', '#00a65a', '#f9fafc', '#f4f5f7'],
    'skin-red-light'    => ['#d33724', '#dd4b39', '#f9fafc', '#f4f5f7'],
    'skin-yellow-light' => ['#db8b0b', '#f39c12', '#f9fafc', '#f4f5f7'],
];

$skinsJs = json_encode(array_keys($skinNames));
$storageAlert = addslashes(Yii::t('admin', 'Your browser cannot save into Storage.'));

$js = <<<SCRIPT
function checkStorage()
{
  if (typeof (Storage) !== "undefined") {
    return true;
  }

  window.alert('$storageAlert');
  return false;
}

function change_skin(cls) {
  var my_skins = $skinsJs;
  $.each(my_skins, function (i) {
    $("body").removeClass(my_skins[i]);
  });

  $("body").addClass(cls);
  return false;
}

if (checkStorage()) {
  skin = localStorage.getItem('skin');
  if (skin) {
    change_skin(skin);
  }
}

$("[data-skin]").on('click', function (e) {
  e.preventDefault();
  change_skin($(this).data('skin'));

  if (checkStorage()) {
    localStorage.setItem('skin', $(this).data('skin'));
  }
});

SCRIPT;

$this->registerJs($js);

?>
<aside class="control-sidebar control-sidebar-dark">

  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-home"></i></a></li>
    <li class=""><a href="#control-sidebar-options-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-wrench"></i></a></li>
  </ul>

  <div class="tab-content">

    <div id="control-sidebar-home-tab" class="tab-pane active">
    <?php $this->trigger('colibri.admin.control-sidebar-home') ?>
    </div>

    <div id="control-sidebar-options-tab" class="tab-pane">
      <h4 class="control-sidebar-heading"><?= Yii::t('admin', 'Skin') ?></h4>
      <ul class="list-unstyled clearfix">
      <?php foreach ($skinColors as $key => $colors): ?>
        <li style="float: left; width: 33.33333%; padding: 5px;">
          <a href="javascript:void(0);" data-skin="<?= $key ?>" style="display: block; box-shadow: 0 0 3px rgba(0, 0, 0, 0.4)" class="clearfix full-opacity-hover">
            <span style="display: block">
              <span style="display: block; width: 20%; float: left; height: 7px; background: <?= $colors[0] ?>;"></span>
              <span style="display: block; width: 80%; float: left; height: 7px; background: <?= $colors[1] ?>;"></span>
            </span>
            <span style="display: block">
              <span style="display: block; width: 20%; float: left; height: 20px; background: <?= $colors[2] ?>;"></span>
              <span style="display: block; width: 80%; float: left; height: 20px; background: <?= $colors[3] ?>;"></span>
            </span>
          </a>
          <p class="text-center no-margin; font-size: 12px;"><?= $skinNames[$key] ?></p>
        </li>
      <?php endforeach ?>
      </ul>
    </div>
  </div>
</aside>
<?php
// Add the sidebar's background. This div must be placed
// immediately after the control sidebar
?>
<div class="control-sidebar-bg"></div>
