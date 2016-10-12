<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/12
 * Time: 14:48
 */
namespace common\components\facades;

/**
 * Class map
 */
class Map {
    /**
     * @param $className
     * @return object
     */
    static function instance($className) {
        if (!\Yii::$container->has($className)) {
            \Yii::$container->set($className, $className);
        }
        $classInstance = \Yii::$container->get($className);
        return $classInstance;
    }
}