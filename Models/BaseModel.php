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
    public function pagination($table, $limit, $page = 1, $range = 2){
        // khoi tao gia tri min, max


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


        // middle la so nam giua khoang tong so trang hien thi ra man hinh
        $middle = ceil($range / 2); //1
        // neu tong so trang ma be hon so button hien thi ra man hinh
        if($total_page < $range){
            $min = 1;
            $max = $total_page;
        }
        else { // neu tong so trang lon hon so button hien thi ra man hinh
            $min = $page - $middle ; // so trang nho nhat
            $max = $page + $middle  ; // so trang lon nhat

            // neu min < 1 thi gan min = 1 va max = range
            if($min < 1){
                $min = 1;
                $max = $range;
            }
            // neu min > tong so trang
            // gan max = tong so trang va min = (tong so trang - range) + 1
            else if($max > $total_page){
                $max = $total_page;
                $min = $total_page - $range + 1;
            }
        }

        $data = [];
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['start'] = $start;
        $data['min'] = $min;
        $data['max'] = $max;
        $data['total_record'] = $total_record;

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

    public function activeStatus($table, $id){
        $sql = "Update ${table} set status = 'active' where id = ${id}";
        return $this->_query($sql);
    }
    public function inActiveStatus($table, $id){
        $sql = "Update ${table} set status = 'inactive' where id = ${id}";
        return $this->_query($sql);
    }

    private function _query($sql){
        return mysqli_query($this->connect,$sql);
    }
}