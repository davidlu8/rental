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
    static function getInstance($className) {
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
    static function setInstance($className, $classInstance) {
        return \Yii::$container->set($className, $classInstance);
    }
}