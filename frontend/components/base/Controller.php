<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 11:51
 */

namespace frontend\components\base;

use yii\web\Response;

class Controller extends \yii\web\Controller
{
    /**
     * @param object $data
     */
    function success($data = null)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->data = [
            'result' => true,
            'msg' => '',
            'data' => $data,
        ];
        return;
    }

    /**
     * @param $code
     * @param $msg
     */
    public function error($msg)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->data = [
            'result' => false,
            'msg' => $msg,
            'data' => null
        ];
        return null;
    }
}