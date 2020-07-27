<?php

class BaseModel extends Database
{
    protected $connect;
    public function __construct()
    {
        $this->connect = $this->connect();
    }
    public function all($table, $select = ['*'], $orderBy = [] , $limit = '', $offset = ''){
        $column = implode(',', $select);
        $columnOrder = implode(' ', $orderBy);
        if($columnOrder !== '' && $limit !== ''  && $offset !== ''){
            $sql = "Select ${column} from {$table} order by ${columnOrder} LIMIT ${limit},${offset} ";

        }else if ($columnOrder !== '' && $limit == ''  && $offset == ''){
            $sql = "Select ${column} from {$table} order by ${columnOrder}";

        } else if ($columnOrder == '' && $limit !== ''  && $offset !== ''){
            $sql = "Select ${column} from {$table} LIMIT ${limit},${offset} ";

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
    public function pagination($table, $limit, $offset){
        $page = 1;
        $sql = 'select id from ${table}';
        $data = $this->_query($sql);
        $total_record = mysqli_num_rows($data);
        $total_page=ceil($total_record/$limit);
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
            return;
        }
        else{
            return;
        }
        //return $this->_query($sql);
    }
    public function _query($sql){
        return mysqli_query($this->connect,$sql);
    }
}