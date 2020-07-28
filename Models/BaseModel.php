<?php

class BaseModel extends Database
{
    protected $connect;
    public function __construct()
    {
        $this->connect = $this->connect();
    }
    public function all($table, $select = ['*'], $orderBy = [] , $start = '', $limit = ''){
        $column = implode(',', $select);
        $columnOrder = implode(' ', $orderBy);
        if($columnOrder !== '' && ($start !== '' || $start == 0) && $limit !== ''){
            $sql = "Select ${column} from ${table} order by ${columnOrder} LIMIT ${start},${limit} ";

        }else if ($columnOrder !== '' && $start == '' && $limit == ''){
            $sql = "Select ${column} from ${table} order by ${columnOrder}";

        } else if ($columnOrder == '' && ($start !== '' || $start == 0) && $limit !== ''){
            $sql = "Select ${column} from ${table} LIMIT ${start},${limit}";

        } else {
            $sql = "Select ${column} from ${table}";

        }

        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)){
            array_push($data, $row);
        }
        return $data;
    }
    public function pagination($table, $limit, $page = 1){
        $page = 1; // khoi tao trang bat dau
        $sql = "select id from ${table}";

        $record = $this->_query($sql);

        $total_record = mysqli_num_rows($record); // tong so bang co trong table

        $total_page=ceil($total_record/$limit); // tong so trang se chia
        // kiem tra xem trang co vuot gioi han khong
        if(isset($_GET['page'])){ // kiem tra co ton tai bien page k
            $page = $_GET['page']; // neu ton tai thi page hien tai la $_GET['page']
        }
        if($page < 1){ // neu bien page nho hon 1 thi gan page bang 1
            $page = 1;
        }
        if($page > $total_page) {
            $page = $total_page; // neu page lon hon tong so trang thi gan bang trang cuoi cung
        }
        // tinh vi tri se bat dau lay
        $start = ($page - 1) * $limit;
        $data = [];
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['start'] = $start;
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