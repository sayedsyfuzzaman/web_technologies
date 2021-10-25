<?php 

require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
$model = new model();
$model->deleteManager($_GET['id']);
header('Location: C:/xampp/htdocs/web_technologies/Mid Project/showManagers.php');

?>