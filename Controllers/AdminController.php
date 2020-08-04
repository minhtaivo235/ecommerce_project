<?php

class AdminController extends BaseController {



    public function index(){
        $checkLogin = $this->AuthLogin(['admin','manager']);
        if($checkLogin){
            return $this->view('backend.home');
        }
        else{
            return header('Location: login.php');
        }

    }


    public function check_login(){
        //khoi tao model user va role
        $this->loadModel('UserModel');
        $userModel = new UserModel();
        $this->loadModel('RoleModel');
        $roleModel = new RoleModel();
        $email = $_POST['email'];
        $password = $_POST['password'];
        // kiem tra dang nhap
        $user = $userModel->check_login($email,$password);
        // lay ra ten role thong qua role_id trong user
        $role = $roleModel->findById($user['role_id']);
        $role_name = $role['name'];

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $role_name;
        if(($role_name == 'admin' || $role_name == 'manager') && $user['status'] == 'active')
            return header('Location: admin');
        if ($user['role_id'] == 2 && $user['status'] == 'active')
            return header('Location: index.php');
        echo 'Đăng nhập thất bại';
        return ;
    }
    public function log_out(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['role']);
        return header('Location: admin');
    }

}