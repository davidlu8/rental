<?php
/**
 * Created by PhpStorm.
 * User: luw
 * Date: 2016/10/11
 * Time: 14:52
 */

namespace frontend\components\base;

use yii\db\Query;

class Model
{
    protected $query;
    protected $db;
    protected $tableName;
    protected $primaryKey;
    /**
     * @var \yii\db\Transaction
     */
    protected $transaction; // 事务

    public function __construct($db = null)
    {
        $this->query = (new Query());
        if (is_null($db)) {
            $this->db = \Yii::$app->db;
        }
    }

    public function insert($data)
    {
        return $this->db->createCommand()->insert($this->tableName, $data)->execute();
    }

    public function update($data, $condition)
    {
        return $this->db->createCommand()->update($this->tableName, $data, $condition)->execute();
    }

    public function delete($condition)
    {
        return $this->db->createCommand()->delete($this->tableName, $condition)->execute();
    }

    public function getOne($fields, $orderBy)
    {
        return $this->query->select($fields)
            ->from($this->tableName)
            ->orderBy($orderBy)
            ->one();
    }

    public function getOneByCondition($condition, $fields)
    {
        return $this->query->select($fields)
            ->from($this->tableName)
            ->where($condition)
            ->one();
    }

    public function getScalar($condition, $field, $orderBy)
    {
        return $this->query->select($field)
            ->from($this->tableName)
            ->where($condition)
            ->orderBy($orderBy)
            ->one();
    }


    public function getList($fields, $orderBy)
    {
        return $this->query->select($fields)
            ->from($this->tableName)
            ->orderBy($orderBy)
            ->all();
    }


    public function getAll($condition, $fields, $orderBy)
    {
        return $this->query->select($fields)
            ->from($this->tableName)
            ->where($condition)
            ->orderBy($orderBy)
            ->all();
    }

    public function getLastSql()
    {
        return $this->query->createCommand()->sql;
    }

    public function getPages($pageIndex, $pageSize, $fields, $orderBy)
    {
        $queryObject = $this->query->from($this->tableName);
        $countQuery = clone $queryObject;
        $total = $countQuery->count();
        $items = [];
        if ($total > 0) {
            $items = $this->query->offset(($pageIndex - 1) * $pageSize)
                ->limit($pageSize)
                ->select($fields)
                ->orderBy($orderBy)
                ->all();
        }
        return [$total, $items];
    }

    public function getPageByCondition($condition, $pageIndex, $pageSize, $fields, $orderBy)
    {
        $queryObject = $this->query->from($this->tableName);
        if ($condition) {
            $queryObject->where($condition);
        }
        $countQuery = clone $queryObject;
        $total = $countQuery->count();
        $items = [];
        if ($total > 0) {
            $items = $queryObject->offset(($pageIndex - 1) * $pageSize)
                ->limit($pageSize)
                ->select($fields)
                ->orderBy($orderBy)
                ->all();
        }
        return [$total, $items];
    }


    public function getPagesFromTwoTable($tableA, $tableB, $on, $condition, $pageIndex, $pageSize, $fields, $orderBy)
    {
        if (!empty($condition['between'])) {
            $between = $condition['between'];
            unset($condition['between']);
            $queryObject = $this->query->from($tableA)->leftJoin($tableB, $on)->where($condition)->andWhere($between);
        } else {
            $queryObject = $this->query->from($tableA)->leftJoin($tableB, $on)->where($condition);
        }
        $countQuery = clone $queryObject;
        $total = $countQuery->count();
        $items = [];
        if ($total > 0) {
            $items = $queryObject->offset(($pageIndex - 1) * $pageSize)
                ->limit($pageSize)
                ->select($fields)
                ->orderBy($orderBy)
                ->all();
        }
        return [$total, $items];
    }

    public function getPagesFromTables($tableA, $tableB, $on, $condition, $pageIndex, $pageSize, $fields, $orderBy, $operatorWhere)
    {
        $queryObject = $this->query->from($tableA)->leftJoin($tableB, $on)->where($condition);
        if (!empty($operatorWhere)) {
            foreach ($operatorWhere as $item) {
                $queryObject->andWhere($item);
            }
        }
        $countQuery = clone $queryObject;
        $total = $countQuery->count();
        $items = [];
        if ($total > 0) {
            $items = $queryObject->offset(($pageIndex - 1) * $pageSize)
                ->limit($pageSize)
                ->select($fields)
                ->orderBy($orderBy)
                ->all();
        }
        return [$total, $items];
    }


    public function beginTrans()
    {
        $this->transaction = $this->db->beginTransaction();
    }

    public function commit()
    {
        $this->transaction->commit();
    }

    public function rollback()
    {
        $this->transaction->rollBack();
    }
}