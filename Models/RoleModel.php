<?php

class RoleModel extends BaseModel
{
    const TABLE_NAME = 'roles';
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

}