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
    static function tableName()
    {
        return 'users';
    }

    static function primaryKey()
    {
        return 'id';
    }
}