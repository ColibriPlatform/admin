<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

use kartik\form\ActiveForm;
use colibri\admin\models\Navigation;
use yii\web\View;

/**
 * @var View         $this
 * @var Navigation   $node
 * @var ActiveForm   $form
 */
?>

<div class="row">
    <div class="col-sm-4">
        <?= $form->field($node, 'slug')->textInput() ?>
        <?= $form->field($node, 'route')->textInput() ?>
        <?= $form->field($node, 'route_params')->textArea() ?>
        <?= $form->field($node, 'access_roles')->textArea() ?>
    </div>
    <div class="col-sm-8">
         <?= $form->field($node, 'page_title')->textInput() ?>
         <?= $form->field($node, 'meta_description')->textArea() ?>
         <?= $form->field($node, 'meta_keywords')->textArea() ?>
         <?= $form->field($node, 'link_options')->textArea() ?>
    </div>
</div>
