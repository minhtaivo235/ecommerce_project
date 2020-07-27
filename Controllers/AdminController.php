<?php

class AdminController extends BaseController {
    public function index(){
        return $this->view('backend.home');
    }
    public function show_login(){
        return $this->view('login');
    }

    public function check_login(){
        $this->loadModel('UserModel');
        $user = new UserModel();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $users = $user->getAll();
        foreach ($users as $key => $value){
            if($email == $value['email'] && $password == $value['password']){
                if($value['role_id'] == 1 && $value['status'] == 'da-kich-hoat')
                    return header('Location: admin');
                if ($value['role_id'] == 2 && $value['status'] == 'da-kich-hoat')
                    return header('Location: index.php');
            }
        }
        echo 'Đăng nhập thất bại';
        return ;
    }
}