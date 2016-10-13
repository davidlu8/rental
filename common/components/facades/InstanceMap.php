<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/12
 * Time: 14:48
 */
namespace common\components\facades;

/**
 * Class InstanceMap
 * @package common\components\facades
 */
class InstanceMap {
    /**
     * @param $className
     * @return object
     */
    static function get($className) {
        if (\Yii::$container->has($className)) {
            $classInstance = \Yii::$container->get($className);
        } else {
            $classInstance = new $className();
            \Yii::$container->set($className, $classInstance);
        }
        return $classInstance;
    }

    /**
     * @param $className
     * @param $classInstance
     */
    static function set($className, $classInstance) {
        return \Yii::$container->set($className, $classInstance);
    }
}