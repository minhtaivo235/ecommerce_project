<?php
class ProductController extends BaseController
{
    private $productModel;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel();
    }

    public function index(){
        $select = ['id', 'name','price'];
        $orderBy = ['id' , 'desc'];
        $limit = 3;
        $data = $this->productModel->getAll();

        return $this->view('frontend.products.index',['data' => $data]);
    }
    public function  show(){
        echo $this->productModel->findById(1);
        return $this->view('frontend.products.show');
    }

    public function store(){
        $data = [
            'name' => 'Iphone X',
            'price' => 8000000,
            'image' => null,
            'category_id' => 2
        ];
        return $this->productModel->store($data);
    }
    public function update(){
        $id = $_GET['id'];
        $data = [
            'name' => 'Iphone X',
            'price' => 9000000,
            'image' => null,
            'category_id' => 1
        ];
        return $this->productModel->updateData($id, $data);
    }
    public function delete(){
        $id = $_GET['id'];
        return $this->productModel->deleteOne($id);
    }
}