<?php

class CategoryModel extends BaseModel
{
    const TABLE_NAME = 'categories';
    public function getAll($select = ['*'], $orderBy = [], $limit = 0){
        return $this->all(self::TABLE_NAME, $select, $orderBy, $limit);
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