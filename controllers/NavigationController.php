<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

namespace colibri\admin\controllers;

use yii\web\Controller;

/**
 * Navigation controller.
 *
 * @author Sylvain PHILIP <contact@sphilip.com>
 */
class NavigationController extends Controller
{

    /**
     * Display the navigation manager
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
