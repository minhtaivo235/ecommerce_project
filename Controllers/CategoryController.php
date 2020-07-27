<?php
class CategoryController extends BaseController
{
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel();
    }

    public function index(){
        $categories = $this->categoryModel->getAll();
        return $this->view('frontend.categories.index',['categories' => $categories]);
    }

    public function show(){
        $id = $_REQUEST['id'];
        $category = $this->categoryModel->findById($id);
//        echo '<pre>';
//        print_r($category);
//        die();
        return $this->view('backend.categories.update',['category' => $category]);
    }
    public function update(){
        $id = $_GET['id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $data = [
            'name' => $_POST['name'],
            'updated_at' => $date
        ];
        $this->categoryModel->updateData($id, $data);
        return $this->get_list();
    }

    public function get_list(){
        $categories = $this->categoryModel->getAll();
        return $this->view('backend.categories.show',['categories' => $categories]);
    }

    public function create(){
        return $this->view('backend.categories.create_form');
    }
    public function store(){
        $name = $_POST['name'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $data = [
            'name' => $name,
            'created_at' => $date,
            'updated_at' => $date
        ];
        $this->categoryModel->store($data);
        return $this->get_list();
    }

}