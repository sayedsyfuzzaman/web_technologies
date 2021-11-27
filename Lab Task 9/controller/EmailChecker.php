<?php
$email = $_REQUEST['email'];

require_once "../model/model.php";
$obj = new Model();

$email_exist=$obj->checkExistingEmail($email);

if ($email_exist == true) {
    echo "exist";
} else {
    echo "not_exist";
}
?>