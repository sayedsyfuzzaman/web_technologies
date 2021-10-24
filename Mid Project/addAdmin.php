<?php

if (file_exists("C:/xampp/htdocs/web_tech/Mid Project/resources/data/userInfo.json")) {
    $current_data = file_get_contents('C:/xampp/htdocs/web_tech/Mid Project/resources/data/userInfo.json');
    $array_data = json_decode($current_data, true);
    $new_data = array(
        'id'        => "19-41718-3",
        'password'  => "abc@1234",
        'name'      => "Admin",
        'email'     => "admin@progschool.com",
        'usertype'     => "Admin"
    );
    $array_data[] = $new_data;
    $final_data = json_encode($array_data);
    if (file_put_contents('C:/xampp/htdocs/web_tech/Mid Project/resources/data/userInfo.json', $final_data)) {
        echo "File appended successfully!";
    } else {
        echo "Error!";
    }
}
?>