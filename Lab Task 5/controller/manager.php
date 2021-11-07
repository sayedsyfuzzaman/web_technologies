<?php
require_once('model/model.php');

class Manager
{

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
    public $target_file = "";
    public $target_dir = "images/";

    function fetchManager($id)
    {
        $model = new model();
        $manager = $model->showManager($id);

        $managerInfo = array();
        foreach ($manager as $rows) {
            $managerInfo = array(
                'id' => $rows["id"],
                'fname' => $rows["firstname"],
                'lname' => $rows["lastname"],
                'email' => $rows["email"],
                'phone' => $rows["phone"],
                'nationality' => $rows["nationality"],
                'nid' => $rows["nid"],
                'dob' => $rows["dob"],
                'gender' => $rows["gender"],
                'address' => $rows["address"],
                'image' => $rows["image"]
            );
            break;
        }

        return $managerInfo;
    }

    function fetchAllManager()
    {
        $model = new model();
        $managers = $model->showAllManager();
        return $managers;
    }

    function inputValidation($data, $action)
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

        //name validation
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
        } elseif ($accountExist == true and $action == "insert") {
            $this->errors["email"] =  "Email already exist, try another.";
        } else {
            $this->errors["email"] = "";
        }

        //phone number validation
        if (empty($data["phone"])) {
            $this->errors["phone"] = "Phone number cannot be empty";
        } elseif (!filter_var($data["phone"], FILTER_SANITIZE_NUMBER_INT)) {
            $this->errors["phone"] = "Invalid phone number";
        } elseif (strlen($data["phone"]) != 11) {
            $this->errors["phone"] = "Phone number cannot be greater or less than 11";
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

        $nidExist = $model->checkExistingNID($data["nid"]);

        if (empty($data["nid"])) {
            $this->errors["nid"] = "Nid cannot be empty";
        } elseif ($nidExist == true and $action == "insert") {
            $this->errors["nid"] =  "Sorry! This NID already exist.";
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

        if (empty($data["file"]) && $action != "update") {
            $this->errors["pictureErr"] = "picture is required";
        } else {
            if($data["imageSelected"] != "none"){
                $this->target_file =  $this->target_dir . $data["file"];
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));
                $this->filepath = $this->target_file;
            }
            
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
            return true;
        }
        return false;
    }

    function addManager($data)
    {
        if ($this->inputValidation($data, "insert") == true) {

            $data["filepath"] = $this->filepath;

            //Getting Unique ID and Password
            require_once('Generator.php');
            $id = getManagerID();
            $pass = getUniquePassword();
            $data["id"] = $id;
            $data["password"] = $pass;


            $model = new model();
            $AddStatus = $model->addManager($data);
            if ($AddStatus == true) {
                $credentials = array(
                    'id' => $data["id"],
                    'password' => $data["password"]
                );


                if (move_uploaded_file($data["temp_name"],  $this->target_file)) {
                    $this->filepath = $this->target_dir . htmlspecialchars(basename($data["file"]));
                }
                return $credentials;
            }
        }
        return "";
    }


    function updateManager($data)
    {
        if ($this->inputValidation($data, "update") == true) {

            if($data["imageSelected"] != "none"){
                $data["filepath"] = $this->filepath;
            }
            
            $model = new model();
            $UpdateStatus = $model->updateManager($data);
            if ($UpdateStatus == true) {
                if (move_uploaded_file($data["temp_name"], $this->target_file)) {

                    $this->filepath = $this->target_dir . htmlspecialchars(basename($data["file"]));

                    //need to unlink old image file
                }

                
                return "updated";
            }

        }
        return "failed";
    }

    function deleteManager($id)
    {
        $model = new model();
        $Status = $model->deleteManager($id);
        if ($Status == true) {
            return true;
        }
        return false;
    }
    
}
