<?php
require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';

//require_once "./Controllers/HomeController.php";
//$controllerObject = new HomeController();
//$controllerObject->index();
//$controllerName = isset($_REQUEST['controller']) ? ucfirst((strtolower($_REQUEST['controller'])) . 'Controller') : 'HomeController';
$controllerName = ucfirst((strtolower($_REQUEST['controller'] ?? 'Home')) . 'Controller');
$actioneName = $_REQUEST['action'] ?? 'index';
require "./Controllers/${controllerName}.php";
$controllerObject = new $controllerName;
$controllerObject->$actioneName();
