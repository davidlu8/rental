<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 11:43
 */

namespace frontend\modules\example;

/**
 * test module definition class
 * @name 测试模块
 * @enable true
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\example\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}