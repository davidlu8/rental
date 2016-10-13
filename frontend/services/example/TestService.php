<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 11:50
 */
namespace frontend\services\example;

use common\components\facades\InstanceMap;
use frontend\components\base\ModelService;
use frontend\models\example\UserModel;

/**
 * Class TestService
 * @package frontend\services\example
 */
class TestService extends ModelService
{
    public $modelName = UserModel::class;
    public $model;

    function __construct()
    {
        $this->model = InstanceMap::get(UserModel::class);
    }

    function getItems()
    {
        return $this->model->getAll([], '*', 'created_on');
    }

    function getTest()
    {
        UserModel::findOne(['aaa' => 1]);
    }
}