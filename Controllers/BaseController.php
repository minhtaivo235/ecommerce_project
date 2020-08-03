<?php

class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'Models';
    protected function view($viewPath, array $data = []){
        foreach ($data as $key => $value){
            $$key = $value;
        }

        return require (self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
    }

    protected function loadModel($modelPath){
        return require (self::MODEL_FOLDER_NAME . '/' . $modelPath .  '.php');
    }
    protected function AuthLogin($permission = []){
        if($_SESSION['user_id']){
            foreach ($permission as $key => $value){
                if($_SESSION['role'] == $value){
                    return true;
                }
            }
            return false;
        }

    }
}