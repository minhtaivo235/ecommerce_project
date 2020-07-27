<?php
class HomeController extends BaseController
{
    private $productModel;
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel();
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel();
    }
    public function index(){
        $categories = $this->categoryModel->getAll();
        return $this->view('frontend.home',['categories' => $categories]);
    }
}