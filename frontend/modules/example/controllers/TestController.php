<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 11:44
 */
namespace frontend\modules\example\controllers;

use yii\base\Module;
use frontend\components\base\Controller;
use frontend\services\example\TestService;
use frontend\models\example\UserModel;

/**
 * Class TestController
 * @package frontend\modules\test\controllers
 * @name 测试
 * @enable true
 */
class TestController extends Controller
{
    /**
     * @return mixed
     */
    public function actionOne()
    {
        $testService = new TestService();
        $items = $testService->getItems();
        return $this->success($items);
    }

    public function actionInsert()
    {
        $testService = new TestService();
        return $this->success($testService->insert([
            'id' => '123',
            'name' => '鲁伟',
            'account' => 'luw01',
            'mobile' => '123',
        ]));
    }

    public function actionTest() {
        echo '<pre>';
        print_r(UserModel::findByPK('123'));
    }
}