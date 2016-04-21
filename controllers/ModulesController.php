<?php
namespace colibri\backend\controllers;

use Yii;
use yii\web\Controller;

class ModulesController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}
