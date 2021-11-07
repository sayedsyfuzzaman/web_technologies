<?php 

require_once 'model/model.php';
$model =  new Model();
if ($model->deleteManager($_GET['id'])) {
    header('Location: all_managers.php?status=deleted');
}

?>