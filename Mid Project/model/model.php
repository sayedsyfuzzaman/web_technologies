<?php

class model {
    function getUserInfo($data) {
        $file_data = file_get_contents("C:/xampp/htdocs/web_tech/Mid Project/resources/data/userInfo.json");
        $file_data = json_decode($file_data, true);
   
        if (!empty($file_data)) {
            foreach ($file_data as $row) {
                if ($row["id"] == $data["id"]) {
                    if ($row["password"] == $data["password"]) {
                        return $row;
                        break;
                    }
                }
                
            }
        }
        return "";
    }

    function getTotalManagerNumber(){
        $count = 0;
        $file_data = file_get_contents("C:/xampp/htdocs/web_tech/Mid Project/resources/data/userInfo.json");
        $file_data = json_decode($file_data, true);
   
        if (!empty($file_data)) {
            foreach ($file_data as $row) {
                if ($row["usertype"] =="Manager") {
                    $count = $count + 1;
                }
                
            }
        }
        return $count;
    }
}
 

?>