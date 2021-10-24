<?php

class authentication{
    function authenticateUser($data) {
    
        require_once "C:/xampp/htdocs/web_tech/Mid Project/model/model.php"; 

        $model = new model();
        $user = $model->getUserInfo($data);
        if(!empty($user)) {
            if($user['usertype'] == "Admin") {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['usertype'] = $user['usertype'];
                header("location: dashboard.php");
            }
            
        }
        return false;
    }
}
?>
