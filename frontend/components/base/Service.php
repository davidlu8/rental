<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 12:00
 */
namespace frontend\components\base;

/**
 * Class Service
 */
class Service
{
    /**
     * 如果容器有实例,则从容器获取实例
     * @return null
     * @throws \yii\base\InvalidConfigException
     */
    public static function instance()
    {
        $className = get_called_class();
        return Map::instance($className);
    }
}
