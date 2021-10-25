<?php

class Manager
{

    public $errors = array(
        'name' => "",
        'email' => "",
        'phone' => "",
        'nationality' => "",
        'nid' => "",
        'dob' => "",
        'gender' => "",
        'address' => "",
        'pictureErr' => ""
    );

    public $filepath = "";

    function addManager($data)
    {

        require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
        $model = new model();

        $Manager = $model->insertManager($data);
        return $Manager;
    }

    function validation($data)
    {


        //name validation
        if (empty($data["name"])) {
            $this->errors["name"] =  "Name can not be empty";
        } elseif (str_word_count($data["name"]) < 2) {
            $this->errors["name"] = "Cannot contain less than two words";
        } elseif (preg_match("/[A-Za-z]/", $data["name"][0]) == 0) {
            $this->errors["name"] = "Must start with a letter";
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $data["name"]) !== 1) {
            $this->errors["name"] = "Can contain a-z, A-Z, period and dash only";
        } else {
            $this->errors["name"] = "";
        }


        require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
        $model = new model();
        $accountExist = $model->checkExistingAccount($data);
        //email validation
        if (empty($data["email"])) {
            $this->errors["email"] =  "Email can not be empty";
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] =  "Invalid email format";
        } elseif ($accountExist == true) {
            $this->errors["email"] =  "Email already exist, try another.";
        } else {
            $this->errors["email"] = "";
        }

        //phone number validation
        if (empty($data["phone"])) {
            $this->errors["phone"] = "Phone number cannot be empty";
        } elseif (!filter_var($data["phone"], FILTER_SANITIZE_NUMBER_INT)) {
            $this->errors["phone"] = "Invalid phone number";
        } elseif (!strlen($data["phone"]) >= 11) {
            $this->errors["phone"] = "Phone number cannot be greate or less than 11";
        } else {
            $this->errors["phone"] = "";
        }

        //nationality validation
        if (empty($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot be empty";
        } elseif (is_numeric($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot contain numbers";
        } else {
            $this->errors["nationality"] = "";
        }



        //dob validation
        if (empty($data["dob"])) {
            $this->errors["dob"] = "Date of birth cannot be empty";
        } else {
            $this->errors["dob"] = "";
        }


        //gender valiadion
        if (empty($data["gender"])) {
            $this->errors["gender"] = "Please select your gender";
        } else {
            $this->errors["gender"] = "";
        }

        //nid validation
        if (empty($data["nid"])) {
            $this->errors["nid"] = "Nid cannot be empty";
        } elseif (!filter_var($data["nid"], FILTER_SANITIZE_NUMBER_INT)) {
            $this->errors["nid"] = "Invalid nid number";
        } else {
            $this->errors["nid"] = "";
        }

        //Adress validation
        if (empty($data["address"])) {
            $this->errors["address"] = "Address cannot be empty";
        } else {
            $this->errors["address"] = "";
        }


        //image validation
        $target_dir = "resources/images/";
        if (empty($data["file"])) {
            $this->errors["pictureErr"] = "picture is required";
        } else {
            $target_file =  $target_dir . $data["file"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $filepath = "";
            if ($data["file"] != "") {
                $check = getimagesize($data["temp_name"]);
                if ($check !== false) {
                    $uploaded = 1;
                } else {
                    $this->errors["pictureErr"] = "File is not an image.";
                    $uploaded = 0;
                }

                if ($data["size"] > 40000000000) {
                    $this->errors["pictureErr"] = "Sorry, your file is too large.";
                    $uploaded = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $this->errors["pictureErr"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploaded = 0;
                }

                if ($uploaded == 0) {
                    $this->errors["pictureErr"] = "Sorry, your file was not uploaded.";
                }
            } else {
                $this->errors["pictureErr"] = "No Image was selected";
            }
        }


        if (
            empty($this->errors["name"]) &&
            empty($this->errors["email"]) &&
            empty($this->errors["phone"]) &&
            empty($this->errors["nationality"]) &&
            empty($this->errors["nid"]) &&
            empty($this->errors["dob"]) &&
            empty($this->errors["gender"]) &&
            empty($this->errors["address"]) &&
            empty($this->errors["pictureErr"])
        ) {

            $data["filepath"] = $this->filepath;
            $manager = $this->addManager($data);
            return $manager;
        }
        return "";
    }

    function updateManager($data)
    {
        //name validation
        if (empty($data["name"])) {
            $this->errors["name"] =  "Name can not be empty";
        } elseif (str_word_count($data["name"]) < 2) {
            $this->errors["name"] = "Cannot contain less than two words";
        } elseif (preg_match("/[A-Za-z]/", $data["name"][0]) == 0) {
            $this->errors["name"] = "Must start with a letter";
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $data["name"]) !== 1) {
            $this->errors["name"] = "Can contain a-z, A-Z, period and dash only";
        } else {
            $this->errors["name"] = "";
        }

        //email validation
        if (empty($data["email"])) {
            $this->errors["email"] =  "Email can not be empty";
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] =  "Invalid email format";
        } else {
            $this->errors["email"] = "";
        }

        //phone number validation
        if (empty($data["phone"])) {
            $this->errors["phone"] = "Phone number cannot be empty";
        } elseif (!filter_var($data["phone"], FILTER_SANITIZE_NUMBER_INT)) {
            $this->errors["phone"] = "Invalid phone number";
        } elseif (!strlen($data["phone"]) >= 11) {
            $this->errors["phone"] = "Phone number cannot be greate or less than 11";
        } else {
            $this->errors["phone"] = "";
        }

        //nationality validation
        if (empty($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot be empty";
        } elseif (is_numeric($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot contain numbers";
        } else {
            $this->errors["nationality"] = "";
        }



        //dob validation
        if (empty($data["dob"])) {
            $this->errors["dob"] = "Date of birth cannot be empty";
        } else {
            $this->errors["dob"] = "";
        }


        //gender valiadion
        if (empty($data["gender"])) {
            $this->errors["gender"] = "Please select your gender";
        } else {
            $this->errors["gender"] = "";
        }

        //nid validation
        if (empty($data["nid"])) {
            $this->errors["nid"] = "Nid cannot be empty";
        } elseif (!filter_var($data["nid"], FILTER_SANITIZE_NUMBER_INT)) {
            $this->errors["nid"] = "Invalid nid number";
        } else {
            $this->errors["nid"] = "";
        }

        //Adress validation
        if (empty($data["address"])) {
            $this->errors["address"] = "Address cannot be empty";
        } else {
            $this->errors["address"] = "";
        }

        if (
            empty($this->errors["name"]) &&
            empty($this->errors["email"]) &&
            empty($this->errors["phone"]) &&
            empty($this->errors["nationality"]) &&
            empty($this->errors["nid"]) &&
            empty($this->errors["dob"]) &&
            empty($this->errors["gender"]) &&
            empty($this->errors["address"])
        ) {

            $data["filepath"] = $this->filepath;            
            require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
            $model = new model();

            $Manager = $model->updateManager($data);
            header('Location: C:/xampp/htdocs/web_technologies/Mid Project/editManagers.php');
            return $Manager;

        }
        return "";
    }


    function showManager($id)
    {
        require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
        $model = new model();

        $Manager = $model->fetchManager($id);
        return $Manager;
    }

    function showAllManager()
    {
        require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
        $model = new model();

        $Manager = $model->fetchAllManager();
        return $Manager;
    }
}
