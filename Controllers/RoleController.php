<?php
class RoleController extends BaseController
{
    private $roleModel;
    public function __construct()
    {
        $this->loadModel('RoleModel');
        $this->roleModel = new RoleModel();
    }

    public function index(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $roles = $this->roleModel->getAll();
        return $this->view('backend.roles.show',['roles' => $roles]);
    }

    public function show(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_REQUEST['id'];
        $role = $this->roleModel->findById($id);
//        echo '<pre>';
//        print_r($category);
//        die();
        return $this->view('backend.roles.update',['role' => $role]);
    }
    public function update(){
        $checkLogin = $this->AuthLogin(['admin']);
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
        $this->roleModel->updateData($id, $data);
        return header('Location: admin.php?controller=role&action=get_list&page=1');
    }

    public function get_list(){
        // kiem tra quyen admin
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $totalItem_page = 5; // so item hien thi tren 1 trang
        $range = 6; // so button hien thi ra man hinh
        if (isset($_GET['page'])){
            $paging = $this->roleModel->paging($totalItem_page,$_GET['page'],$range);
        }
        else {
            $paging = $this->roleModel->paging($totalItem_page);
        }
//        echo '<pre>';
//        print_r($paging);
//        die();
        $startPage = $paging['start'];
        $paging['limit'] = $totalItem_page;

        $roles = $this->roleModel->getAll(['*'],['id'],$startPage,$totalItem_page);
        return $this->view('backend.roles.show',['roles' => $roles, 'pagination' => $paging]);
    }

    public function create(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        return $this->view('backend.roles.create_form');
    }
    public function store(){
        $checkLogin = $this->AuthLogin(['admin']);
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
        $this->roleModel->store($data);
        return header('Location: admin.php?controller=role&action=get_list&page=1');
    }

    public function delete(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_GET['id'];

        $this->roleModel->deleteOne($id);
        return header('Location: admin.php?controller=role&action=get_list&page=1');
    }

}