<?php
class UserController extends BaseController
{
    private $userModel;
    private $roleModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel();
        $this->loadModel('RoleModel');
        $this->roleModel = new RoleModel();
    }

    public function index(){
        $checkLogin = $this->AuthLogin(['admin','manager']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $users = $this->userModel->getAll();
        return $this->view('backend.users.show',['users' => $users]);
    }

    public function show(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_GET['id'];
        $user = $this->userModel->findById($id);
//        echo '<pre>';
//        print_r($category);
//        die();
        return $this->view('backend.users.update',['user' => $user]);
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
            'email' => $_POST['email'],
            'updated_at' => $date
        ];
        $this->userModel->updateData($id, $data);
        return header('Location: admin.php?controller=user&action=get_list&page=1');
    }

    public function get_list(){
        // kiem tra quyen admin
        $checkLogin = $this->AuthLogin(['admin','manager']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $totalItem_page = 5; // so item hien thi tren 1 trang
        $range = 6; // so button hien thi ra man hinh
        if (isset($_GET['page'])){
            $paging = $this->userModel->paging($totalItem_page,$_GET['page'],$range);
        }
        else {
            $paging = $this->userModel->paging($totalItem_page);
        }
//        echo '<pre>';
//        print_r($paging);
//        die();
        $startPage = $paging['start'];
        $paging['limit'] = $totalItem_page;

        $users = $this->userModel->getAll(['*'],['id','desc'],$startPage,$totalItem_page);
        return $this->view('backend.users.show',['users' => $users, 'pagination' => $paging]);
    }

    public function create(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $roles = $this->roleModel->getAll();
        return $this->view('backend.users.create_form',['roles' => $roles]);
    }
    public function store(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role_id' => $role_id,
            'status' => 'da-kich-hoat',
            'created_at' => $date,
            'updated_at' => $date
        ];
        $this->userModel->store($data);
        return header('Location: admin.php?controller=user&action=get_list&page=1');
    }

    public function delete(){
        $checkLogin = $this->AuthLogin(['admin']);
        if(!$checkLogin){
            return header('Location: login.php');
        }

        $id = $_GET['id'];

        $this->categoryModel->deleteOne($id);
        return header('Location: admin.php?controller=category&action=get_list&page=1');
    }

}