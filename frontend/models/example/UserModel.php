<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 15:47
 */
namespace frontend\models\example;

use frontend\components\base\Model;

class UserModel extends Model {
    /**
     * @return string 返回该AR类关联的数据表名
     */
    public static function tableName()
    {
        return 'users';
    }
}