<?php

class AdminController extends BaseController {



    public function index(){
        $checkLogin = $this->AuthLogin();
        if($checkLogin){
            return $this->view('backend.home');
        }
        else{
            return header('Location: login.php');
        }

    }


    public function check_login(){
        $this->loadModel('UserModel');
        $userModel = new UserModel();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $userModel->check_login($email,$password);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role_id'];
        if($user['role_id'] == 1 && $user['status'] == 'da-kich-hoat')
            return header('Location: admin');
        if ($user['role_id'] == 2 && $user['status'] == 'da-kich-hoat')
            return header('Location: index.php');
        echo 'Đăng nhập thất bại';
        return ;
    }
    public function log_out(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        return header('Location: admin');
    }

}