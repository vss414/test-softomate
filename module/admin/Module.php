<?php

namespace app\module\admin;

/**
 * Admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if(!\Yii::$app->user->identity) {
            \Yii::$app->getResponse()->redirect('/site/login');
        }

        parent::init();

        // custom initialization code goes here
    }
}
