<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 16:32
 */
namespace frontend\components\base;

use app\framework\utils\StringHelper;
use app\framework\utils\DateTimeHelper;
use frontend\models\example\UserModel;
use common\components\facades\Map;

/**
 * Class ModelService
 * @package frontend\components\base
 */
class ModelService extends Service
{
    public $modelName = null;
    protected $model;



    /**
     * ModelService constructor.
     */
    public function __construct()
    {
        if ($this->modelName) {
            $this->model = Map::instance($this->modelName);
        }
    }

    public function insert($data)
    {

        return $this->model->insert($data);
    }

    public function update($data , $condition)
    {
        $field['modified_on'] = DateTimeHelper::now();
        foreach($data as $key => $value) {
            $this->model->$key = $value;
        }
        return $this->model->update($field, $condition);
    }

    public function delete($condition)
    {
        return $this->model->delete($condition);
    }

    public function getOne($fields = '*', $orderBy = 'created_on DESC')
    {
        return $this->model->getOne($fields, $orderBy);
    }

    public function getOneByCondition($condition, $fields = '*')
    {
        return $this->model->getOneByCondition($condition, $fields);
    }

    public function getById($id, $field = '*')
    {
        $condition = ['id' => $id];
        return $this->model->getOneByCondition($condition, $field);
    }

    public function getScalar($condition, $field, $order = 'created_on DESC')
    {
        $result = $this->model->getScalar($condition, $field, $order);
        return !empty($result[$field]) ? $result[$field] : '';
    }

    public function getAll()
    {
        return $this->model->find()->all();
    }

    public function getList($fields = '*', $orderBy = 'created_on DESC')
    {
        return $this->model->getList($fields, $orderBy);
    }

    public function getPageByCondition(
        $condition,
        $pageIndex = 1,
        $pageSize = '15',
        $fields = '*',
        $orderBy = 'created_on DESC'
    )
    {
        list($total, $items) = $this->model->getPageByCondition($condition, $pageIndex, $pageSize, $fields, $orderBy);
        return [$total, $items];
    }

    /**
     * 开始事务
     */
    public function beginTrans()
    {
        $this->model->beginTrans();
    }

    /**
     * 提交事务
     */
    public function commit()
    {
        $this->model->commit();
    }

    /**
     * 回滚事务
     */
    public function rollback()
    {
        $this->model->rollBack();
    }

    /**
     * 解析查询时间
     * @param $time
     * @return array
     */
    public function parseSearchTime($time)
    {
        if (in_array($time, [7, 15, 30])) {
            $min = date('Y-m-d', strtotime("-{$time} day"));
            $max = date('Y-m-d', strtotime("+1 day"));
        } else {
            $dates = explode(',', $time);
            if (count($dates) != 2) {
                return [];
            }
            $min = date('Y-m-d', strtotime($dates[0]));
            $max = date('Y-m-d', strtotime($dates[1]) + 60 * 60 * 24);
        }
        return [$min, $max];
    }

}