<?php
class UserModel extends BaseModel{
    const TABLE_NAME = 'users';
    public function getAll($select = ['*'], $orderBy = [], $limit = 0){
        return $this->all(self::TABLE_NAME, $select, $orderBy, $limit);
    }
    public function findById($id){
        return __METHOD__;
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
    public function check_login($mail, $password){
        $sql = "SELECT * FROM USERS WHERE email = '${mail}' && password = ${password}";
        //$data = $this->_query($sql);
        $data = mysqli_query($this->connect,$sql);
        return mysqli_fetch_assoc($data);
    }
}