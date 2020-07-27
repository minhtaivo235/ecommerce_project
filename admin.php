<?php
require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';
session_start();
$controllerName = ucfirst((strtolower($_REQUEST['controller'] ?? 'Admin')) . 'Controller');
$actioneName = $_REQUEST['action'] ?? 'index';
require "./Controllers/${controllerName}.php";
$controllerObject = new $controllerName;
$controllerObject->$actioneName();



