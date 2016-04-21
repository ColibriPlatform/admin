<?php

namespace colibri\backend;
use Yii;


class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{
    public $controllerNamespace = 'colibri\backend\controllers';

    public function init()
    {
        if (!isset(Yii::$app->i18n->translations['backend'])) {
            Yii::$app->i18n->translations['backend'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages'
            ];
        }
        
        $this->layout = 'main';

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        /* @var $app yii\web\Application */

        if ($app->getUser()->isGuest) {
            $app->layout = 'login';
        }

    }

}
