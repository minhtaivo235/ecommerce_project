<?php

class BaseModel extends Database
{
    protected $connect;
    public function __construct()
    {
        $this->connect = $this->connect();
    }
    public function all($table, $select = ['*'], $orderBy , $limit){
        $column = implode(',', $select);
        $columnOrder = implode(' ', $orderBy);
        if($columnOrder && $limit){
            $sql = "Select ${column} from {$table} order by ${columnOrder} LIMIT ${limit} ";
        }else if ($columnOrder){
            $sql = "Select ${column} from {$table} order by ${columnOrder}";
        } else if ($limit){
            $sql = "Select ${column} from {$table} LIMIT ${limit} ";
        } else {
            $sql = "Select ${column} from {$table}";
        }
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)){
            array_push($data, $row);
        }
        return $data;
    }
    public function find($table, $id){
        $sql = "SELECT * FROM ${table} WHERE id = '${id}' LIMIT 1";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }
    public function create($table, $data = []){
        $keys = array_keys($data);
        $key = implode(',', $keys);
        $values = array_map(function ($value){
            return "'" . $value . "'";
        },array_values($data));
        $value = implode(',', $values);
        $sql = "INSERT INTO ${table}(${key}) values (${value})";
        return $this->_query($sql);
    }
    public function update($table, $id, $data){
        $dataSet = [];
        foreach ($data as $key => $value){
            array_push($dataSet, "${key} = '" . $value . "'");
        }
        $column = implode(',', $dataSet);
//        echo '<pre>';
//        print_r($column);
        $sql = "UPDATE ${table} SET ${column} where id = ${id}";
        return $this->_query($sql);
    }

    public function delete($table, $id){
        $sql = "delete from ${table} where id = ${id}";
        if($this->_query($sql)){
            echo 'Xóa thành công';
            return;
        }
        else{
            echo 'Xóa thất bại';
            return;
        }
        //return $this->_query($sql);
    }
    private function _query($sql){
        return mysqli_query($this->connect,$sql);
    }
}