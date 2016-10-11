<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 11:50
 */
namespace frontend\services\example;

use frontend\components\base\Service;
use frontend\components\base\ModelService;

/**
 * Class TestService
 * @package frontend\services\example
 */
class TestService extends Service {
    use ModelService;
    protected $modelName = 'frontend\models\example\UserModel';
    protected $model;
    function __construct()
    {
        $this->init();
    }

    function getItems() {
        return $this->model->find()->all();
    }
}