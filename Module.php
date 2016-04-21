<?php

namespace colibri\backend;
use Yii;


class Module extends \yii\base\Module
{

    public $controllerNamespace = 'colibri\backend\controllers';

    /**
     * @var array child modules of this module
     */
    protected static $_registeredModules = [];

    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['backend'])) {
            Yii::$app->i18n->translations['backend'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages'
            ];
        }

        $this->layout = 'main';

        foreach (static::$_registeredModules as $id => $module) {
            $this->setModule($id, $module);
        }
    }

    /**
     * Registers statically a sub-modules in this module.
     * This intends : 
     * - To avoid to instantiate this module when it's not needed. 
     * - To be independent from the id of this module
     *
     *  Example of use :
     *  \colibri\backend\Module::registerModule('pages', 'colibri\pages\backend\Module');
     *
     * @param string $id
     * @param array|string|\yii\base\Module $module the sub-module to be added to this module
     */
    public static function registerModule($id, $module)
    {
        static::$_registeredModules[$id] = $module;
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->getUser()->isGuest){
            // throw new UnauthorizedHttpException(Yii::t('app', 'Unauthorized access message'));
            // Redirect to the backend  login page
        }

        switch ($action->id) {
            case 'index' :
                if ($action->controller->id == 'default') {
                    break;
                }
            case 'view' :
            case 'create' :
            case 'update' :
                $view = Yii::$app->getView();
                $view->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administration'), 'url' => ['/admin/default/index']];
                break;
        }

        return true;
    }


}
