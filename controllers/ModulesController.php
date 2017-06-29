<?php
namespace colibri\admin\controllers;

use yii\web\Controller;

class ModulesController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}
