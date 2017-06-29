<?php

namespace colibri\admin;
use Yii;

// use yii\web\GroupUrlRule;


class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

    public $controllerNamespace = 'colibri\admin\controllers';

    /**
     * @var array child modules of this module
     */
    protected static $_registeredModules = [];

    /**
     * Constructor.
     * @param string $id the ID of this module.
     * @param Module $parent the parent module (if any).
     * @param array $config name-value pairs that will be used to initialize the object properties.
     */
    public function __construct($id, $parent = null, $config = [])
    {

        if (!isset($config['modules']['settings'])) {

            $config['modules']['settings'] = [
                'class' => 'pheme\settings\Module',
                'sourceLanguage' => 'en'
            ];
        }

        parent::__construct($id, $parent = null, $config);
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'beforeRequest' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'resend', 'request', 'register', 'confirm'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\web\Application $app the application currently running
     */
    public function bootstrap($app)
    {

        $app->urlManager->addRules([
            $this->id . '/login' => '/user/security/login',
            $this->id . '/logout' => '/user/security/logout',
            $this->id . '/users/<action:\w+>' => '/user/admin/<action>',
            $this->id . '/rbac/<controller:\w+>/<action:\w+>' => '/rbac/<controller>/<action>',
        ]);

        $app->getModule('user')->controllerMap['admin'] = [
            'class'  => 'dektrium\user\controllers\AdminController',
            'layout' => '@vendor/colibri-platform/admin/views/layouts/main.php'
        ];

        $app->getModule('rbac')->layout = '@vendor/colibri-platform/admin/views/layouts/main.php';
    }

    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['admin'])) {

            Yii::$app->i18n->translations['admin'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages'
            ];
        }

        $this->layout = 'main';

        // $user = Yii::$app->getUser();
        // $user->loginUrl =  [$this->id . '/user/security/login'];
        // $user->returnUrl =  [$this->id];


/*
        $view = Yii::$app->getView();
        if (empty($view->theme)) {
            $view->theme = Yii::createObject('yii\base\Theme');
        }
        $view->theme->pathMap['@dektrium/user/views'] = __DIR__ . '/views/user';
*/
    }




}
