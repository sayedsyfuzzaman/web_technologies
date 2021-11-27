<?php
$nid = $_REQUEST['nid'];

require_once "../model/model.php";
$obj = new Model();

$nid_exist=$obj->checkExistingNID($nid);

if ($nid_exist == true) {
    echo "exist";
} else {
    echo "not_exist";
}
