<?php
class UserModel extends BaseModel{
    const TABLE_NAME = 'users';
    public function getAll( $select = ['*'], $orderBy = [] , $start = '', $limit = ''){
        return $this->all(self::TABLE_NAME, $select, $orderBy, $start, $limit);
    }
    public function paging($limit, $page = 1, $range = 2){
        return $this->pagination(self::TABLE_NAME, $limit, $page, $range);
    }
    public function findById($id){
        return $this->find(self::TABLE_NAME,$id);
    }
    public function deleteOne($id){
        return $this->delete(self::TABLE_NAME,$id);
    }
    public function store($data){
        return $this->create(self::TABLE_NAME,$data);
    }
    public function updateData($id, $data){
        return $this->update(self::TABLE_NAME, $id, $data);
    }
    public function activeStatusData($id){
        return $this->activeStatus(self::TABLE_NAME,$id);
    }
    public function inActiveStatusData($id){
        return $this->inActiveStatus(self::TABLE_NAME,$id);
    }
    public function getListUserAdmin(){
        $sql = "select * from users as u JOIN roles as r on u.role_id = r.id WHERE r.name = 'admin'";
        $query = mysqli_query($this->connect,$sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)){
            array_push($data, $row);
        }
        return $data;
    }
    public function check_login($mail, $password){
        $sql = "SELECT * FROM USERS WHERE email = '${mail}' && password = ${password}";
        //$data = $this->_query($sql);
        $data = mysqli_query($this->connect,$sql);
        return mysqli_fetch_assoc($data);
    }
}