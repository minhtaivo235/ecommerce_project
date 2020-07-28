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
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $categories = $this->categoryModel->getAll();
        return $this->view('backend.categories.show',['categories' => $categories]);
    }

    public function show(){
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_REQUEST['id'];
        $category = $this->categoryModel->findById($id);
//        echo '<pre>';
//        print_r($category);
//        die();
        return $this->view('backend.categories.update',['category' => $category]);
    }
    public function update(){
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_REQUEST['id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $data = [
            'name' => $_POST['name'],
            'updated_at' => $date
        ];
        $this->categoryModel->updateData($id, $data);
        return header('Location: admin.php?controller=category&action=get_list&page=1');
    }

    public function get_list(){
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $totalItem_page = 1; // so item hien thi tren 1 trang
        $range = 6; // so button hien thi ra man hinh
        if (isset($_GET['page'])){
            $paging = $this->categoryModel->paging($totalItem_page,$_GET['page'],$range);
        }
        else {
            $paging = $this->categoryModel->paging($totalItem_page);
        }
//        echo '<pre>';
//        print_r($paging);
//        die();
        $startPage = $paging['start'];
        $paging['limit'] = $totalItem_page;

        $categories = $this->categoryModel->getAll(['*'],['id'],$startPage,$totalItem_page);
        return $this->view('backend.categories.show',['categories' => $categories, 'pagination' => $paging]);
    }

    public function create(){
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        return $this->view('backend.categories.create_form');
    }
    public function store(){
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $name = $_POST['name'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $data = [
            'name' => $name,
            'created_at' => $date,
            'updated_at' => $date
        ];
        $this->categoryModel->store($data);
        return header('Location: admin.php?controller=category&action=get_list&page=1');
    }

    public function delete(){
        $checkLogin = $this->AuthLogin();
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_REQUEST['id'];

        $this->categoryModel->deleteOne($id);
        return header('Location: admin.php?controller=category&action=get_list&page=1');
    }

}