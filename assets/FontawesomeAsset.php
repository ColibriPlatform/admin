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
 * FontawesomeAsset
 *
 * @author Sylvain PHILIP <contact@sphilip.com>
 */
class FontawesomeAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@bower/fontawesome';

    public $css = [
        'css/font-awesome.min.css'
    ];
}
