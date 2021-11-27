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
    );
    function inputValidation($data, $action)
    {
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


        require_once '../model/model.php';
        $model = new model();
        $accountExist = $model->checkExistingEmail($data["email"]);

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



        //nationality validation
        if (empty($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot be empty";
        } elseif (is_numeric($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot contain numbers";
        } else {
            $this->errors["nationality"] = "";
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

        if (
            empty($this->errors["name"]) &&
            empty($this->errors["email"]) &&
            empty($this->errors["nationality"]) &&
            empty($this->errors["nid"])
        ) {
            return true;
        }
        return false;
    }

    function addManager($data)
    {
        if ($this->inputValidation($data, "insert") == true) {

            //Getting Unique ID and Password
            require_once('Generator.php');
            $id = getManagerID();
            $pass = getUniquePassword();
            $data["id"] = $id;
            $data["password"] = $pass;


            $model = new model();
            $AddStatus = $model->insertManager($data);
            if ($AddStatus === true){
                header("location: ../add-manager.php?status=submitted&id=".$data["id"]."&password=".$data["password"]);
            }
            else
            {
                header("location: ../add-manager.php?status=submission_error");
            }
        }
        return "";
    }
}
