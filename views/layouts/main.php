<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

use yii\helpers\Html;
use colibri\admin\assets\AdminlteAsset;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AdminlteAsset::register($this);
//$this->params['adminAssetBundle'] = AdminAsset::register($this);

$breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php $this->beginBody() ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?= $this->render('header'); ?>
            <?= $this->render('sidebar'); ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                    <?= $this->title ?>
                    <?php if (isset($this->params['subtitle'])): ?>
                      <small><?= $this->params['subtitle'] ?></small>
                    <?php endif ?>
                    </h1>
                    <?=
                    Breadcrumbs::widget([
                        'tag' => 'ol',
                        'encodeLabels' => false,
                        'homeLink' => ['label' => '<i class="fa fa-dashboard"></i> ' . Yii::t('admin', 'Home/Dashboard'), 'url' => ['/admin']],
                        'links' => $breadcrumbs,
                    ])
                    ?>
                </section>
                <section class="content">
                    <?= $content ?>
                </section>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    Version 1.0
                </div>
                <strong><a href="https://github.com/ColibriPlatform">Colibri</a></strong>
            </footer>
            <?= $this->render('control-sidebar'); ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
