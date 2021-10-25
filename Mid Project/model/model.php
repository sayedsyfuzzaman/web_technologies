<?php

class model
{
    function getUserInfo($data)
    {
        $file_data = file_get_contents("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json");
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

    function getTotalManagerNumber()
    {
        $count = 0;
        $file_data = file_get_contents("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json");
        $file_data = json_decode($file_data, true);

        if (!empty($file_data)) {
            foreach ($file_data as $row) {
                if ($row["usertype"] == "Manager") {
                    $count = $count + 1;
                }
            }
        }
        return $count;
    }

    function checkExistingAccount($data)
    {
        $file_data = file_get_contents("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json");
        $file_data = json_decode($file_data, true);

        if (!empty($file_data)) {
            foreach ($file_data as $row) {
                if ($row["email"] == $data["email"]) {
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    function insertManager($data)
    {

        $filepath = "";

        $managerData = array(
            'id' => "",
            'password' => ""
        );
        $file_location = "C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json";
        if (file_exists($file_location)) {

            require_once "C:/xampp/htdocs/web_technologies/Mid Project/controller/Generator.php";
            $generator = new IdGenerator();

            $target_dir = "resources/images/";
            $target_file =  $target_dir . $data["file"];

            if (move_uploaded_file($data["temp_name"], $target_file)) {

                $mypic = $target_file;
                $UploadConfirmation = "Picture has been uploaded Successfully";
                $filepath = $target_dir . htmlspecialchars(basename($data["file"]));


                if ($data["old_file"] != $filepath && $data["old_file"] != "") {
                    unlink($data["old_file"]);
                }

                $current_data = file_get_contents($file_location);
                $array_data = json_decode($current_data, true);
                $new_data = array(
                    'id'        => $generator->getManagerID($data),
                    'password'  => $generator->getUniquePassword(),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'nationality' => $data['nationality'],
                    'nid' => $data['nid'],
                    'dob' => $data['dob'],
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                    'usertype'   => "Manager",
                    'picture'   => $filepath
                );

                $array_data[] = $new_data;
                $final_data = json_encode($array_data);
                if (file_put_contents($file_location, $final_data)) {

                    $managerData = array(
                        'id' => $new_data["id"],
                        'password' => $new_data["password"]
                    );
                    return $managerData;
                } else {
                    echo "";
                }
            }
        }
        return $managerData;
    }

    function updateManager($manager)
    {
        $file_location = "C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json";
        $data = file_get_contents($file_location);
        $data = json_decode($data, true);
        foreach ($data as $row) {
            if ($row["id"] == $manager["id"]) {
                $data = file_get_contents($file_location);
                $data = json_decode($data, true);
                if (!empty($data)) {
                    foreach ($data as $key => $row) {
                        if ($row["id"] == $manager["id"]) {
                            $data[$key]['name'] = $manager["name"];
                            $data[$key]['email'] = $manager["email"];
                            $data[$key]['phone'] = $manager["phone"];
                            $data[$key]['nationality'] = $manager["nationality"];
                            $data[$key]['nid'] = $manager["nid"];
                            $data[$key]['dob'] = $manager["dob"];
                            $data[$key]['gender'] = $manager["gender"];
                            $data[$key]['address'] = $manager["address"];

                            echo "Information changed!";
                            break;
                        }
                    }

                    file_put_contents($file_location, json_encode($data));
                }
                break;
            }
        }
        return "";
    }



    function deleteManager($id)
    {
        $file_location = "C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json";
        $data = file_get_contents( $file_location);
        $json_arr = json_decode($data, true);

        // get array index to delete
        $arr_index = array();
        foreach ($json_arr as $key => $value) {
            if ($value['id'] == $id) {
                $arr_index[] = $key;
            }
        }

        // delete data
        foreach ($arr_index as $i) {
            unset($json_arr[$i]);
        }

        // rebase array
        $json_arr = array_values($json_arr);

        // encode array to json and save to file
        file_put_contents('results_new.json', json_encode($json_arr));
    }

    function fetchManager($id)
    {
        if (file_exists("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json")) {
            $file_data = file_get_contents("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json");
            $file_data = json_decode($file_data, true);

            if (!empty($file_data)) {
                foreach ($file_data as $row) {
                    if ($row["id"] == $id && $row["usertype"] == "Manager") {
                        return $row;
                    }
                }
            }
        }

        return "";
    }

    function fetchAllManager()
    {

        $data = array();


        if (file_exists("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json")) {
            $file_data = file_get_contents("C:/xampp/htdocs/web_technologies/Mid Project/resources/data/userInfo.json");
            $file_data = json_decode($file_data, true);

            if (!empty($file_data)) {
                foreach ($file_data as $row) {
                    if ($row["usertype"] == "Manager") {
                        array_push($data, $row);
                    }
                }
                return $data;
            }
        }

        return "";
    }
}
