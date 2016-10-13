<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 14:52
 */

namespace frontend\components\base;

use yii\db\ActiveRecord;
use yii\db\Query;
use Exception;

class Model extends ActiveRecord
{
    /**
     * 插入记录
     * @param array $attributes 字段数据
     * @return integer 插入记录数
     */
    public static function add($attributes)
    {
        $command = static::getDb()->createCommand();
        $command->insert(static::tableName(), $attributes);

        return $command->execute();
    }

    /**
     * 更新记录
     * @param array $attributes 字段数据
     * @param string|array $condition where条件
     * @param array $params where参数
     * @return integer 更新记录数
     */
    public static function edit($attributes, $condition = '', $params = [])
    {
        $command = static::getDb()->createCommand();
        $command->update(static::tableName(), $attributes, $condition, $params);

        return $command->execute();
    }

    /**
     * 删除记录
     * @param string|array $condition where条件
     * @param array $params where参数
     * @return integer 删除记录数
     */
    public static function remove($condition = '', $params = [])
    {
        $command = static::getDb()->createCommand();
        $command->delete(static::tableName(), $condition, $params);

        return $command->execute();
    }

    /**
     * 记录是否存在
     * @param string|array $condition where条件
     * @param array $params where参数
     * @return bool 是否存在
     */
    public static function exist($condition = '', $params = [])
    {
        return (new Query())->where($condition, $params)->count() ? true : false;
    }

    /**
     * 查询记录数
     * @param string|array $condition where条件
     * @param array $params where参数
     * @return integer 记录数
     */
    public static function count($condition = '', $params = [])
    {
        return (new Query())->where($condition, $params)->count();
    }

    /**
     * @param string|array $value 主键值
     * @return static
     */
    public static function findByPK($value) {
        $primaryKey =  static::primaryKey();
        $condition = [];
        if (is_array($primaryKey)) {
            if (!is_array($value) && !is_string($value)) {
                throw new Exception("根据主键查询类型不正确");
            }
            if (is_string($value)) {
                $value = explode(',', $value);
            }
            if (count($value) != count($primaryKey)) {
                throw new Exception("根据主键查询参数和主键值不匹配");
            }
            foreach($primaryKey as $key => $name) {
                $condition[$name] = $value[$key];
            }
        } else {
            $condition[$primaryKey] = $value;
        }
        return static::findOne($condition);
    }
}