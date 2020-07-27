<?php
require_once './Core/Database.php';
require_once './Models/BaseModel.php';
require_once './Controllers/BaseController.php';

$controllerName = ucfirst((strtolower($_REQUEST['controller'] ?? 'Admin')) . 'Controller');
$actioneName = $_REQUEST['action'] ?? 'index';
require "./Controllers/${controllerName}.php";
$controllerObject = new $controllerName;

require 'Views/backend/partitions/header.php';
?>

<section class="wrapper">
    <?php
    $controllerObject->$actioneName();
    ?>
</section>
<?php
require 'Views/backend/partitions/footer.php';
?>
