<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

namespace colibri\admin\assets;

/**
 * AdminlteAsset
 *
 * @author Sylvain PHILIP <contact@sphilip.com>
 */
class AdminlteAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/adminlte/dist';

    public $css = [
        'css/AdminLTE.css',
        'css/skins/_all-skins.min.css'
    ];

    public $js = [
        'js/app.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'colibri\admin\assets\FontawesomeAsset'
    ];
}
