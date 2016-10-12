<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 11:50
 */
namespace frontend\services\example;

use frontend\components\base\ModelService;
use frontend\models\example\UserModel;

/**
 * Class TestService
 * @package frontend\services\example
 */
class TestService extends ModelService {
    public $modelName = UserModel::class;
    public $model;

    function __construct()
    {
        $this->model = new UserModel();
    }

    function getItems() {
        return $this->model->find()->all();
    }
}