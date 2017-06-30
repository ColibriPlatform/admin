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
 * Default admin controller.
 *
 * @author Sylvain PHILIP <contact@sphilip.com>
 */
class DefaultController extends Controller
{

    /**
     * Display the admin home page
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
