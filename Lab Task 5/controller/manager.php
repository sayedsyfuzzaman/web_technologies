<?php
require_once ('model/model.php');
class Manager {

    public $errors = array(
        'fname' => "",
        'lname' => "",
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

    

    function fetchAllManager()
    {
        $model = new model();
        $managers = $model->showAllManager();
        return $managers;
    }

    function addManager($data)
    {
        //fname validation
        if (empty($data["fname"])) {
            $this->errors["fname"] =  "Can not be empty";
        } elseif (str_word_count($data["fname"]) < 1) {
            $this->errors["fname"] = "Cannot contain less than one word";
        } elseif (preg_match("/[A-Za-z]/", $data["fname"][0]) == 0) {
            $this->errors["fname"] = "Must start with a letter";
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $data["fname"]) !== 1) {
            $this->errors["fname"] = "Can contain a-z, A-Z, period and dash only";
        } else {
            $this->errors["fname"] = "";
        }

        //;name validation
        if (empty($data["lname"])) {
            $this->errors["lname"] =  "Can not be empty";
        } elseif (str_word_count($data["lname"]) < 1) {
            $this->errors["lname"] = "Cannot contain less than one word";
        } elseif (preg_match("/[A-Za-z]/", $data["lname"][0]) == 0) {
            $this->errors["lname"] = "Must start with a letter";
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $data["lname"]) !== 1) {
            $this->errors["lname"] = "Can contain a-z, A-Z, period and dash only";
        } else {
            $this->errors["lname"] = "";
        }


        $model = new model();
        $accountExist = $model->checkExistingAccount($data["email"]);
        
        //email validation
        if (empty($data["email"])) {
            $this->errors["email"] =  "Email can not be empty";
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] =  "Invalid email format";
        } elseif ((int)$accountExist == 0) {
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
            empty($this->errors["fname"]) &&
            empty($this->errors["lname"]) &&
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
            
            

            $manager = $model->addManager($data);
            return $manager;
        }
        return "";
    }
}
