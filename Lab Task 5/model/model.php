<?php
require_once 'db_connect.php';

class Model
{
    function addManager($data)
    {
        $conn = db_conn();
        $Query1 = "INSERT into manager (id, firstname, lastname, email, phone, nid, dob, gender, address, image, reg_date, nationality)
        VALUES (:id, :firstname, :lastname, :email, :phone, :nid, :dob, :gender, :address, :image, NOW(), :nationality); ";
        $Query2 = "INSERT into users (id, password, usertype)
        VALUES (:id, :password, :usertype); ";


            try{
                $stmt1 = $conn->prepare($Query1);
                $stmt1->execute([
                    ':id'           => $data["id"],
                    ':firstname'     => $data["fname"],
                    ':lastname'      => $data["lname"],
                    ':email'         => $data["email"],
                    ':phone'         => $data["phone"],
                    ':nid'         => $data["nid"],
                    ':dob'          => $data["dob"],
                    ':gender'        => $data["gender"],
                    ':address'        => $data["address"],
                    ':image'  =>     $data["filepath"], 
                    ':nationality'  => $data["nationality"]
                ]);

                $stmt2 = $conn->prepare($Query2);
                $stmt2->execute([
                    ':id'           => $data["id"],
                    ':password'    =>$data["password"],
                    ':usertype'    => "Manager"
                ]);

                if($stmt1== true and $stmt2 == true){
                    return true;
                }
                else {
                    return false;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
            $conn = null;
            return false;
    }

    function checkExistingAccount($email)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager` where email = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$email]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            return true;
        }
        return false;
    }

    function checkExistingNID($nid)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager` where nid = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$nid]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            return true;
        }
        return false;
    }

    
    function getTotalManagerNumber()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `manager` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $count = 0;
        while($stmt->fetch(PDO::FETCH_OBJ)) {
            $count++;
        }
        return $count;
    }

    function showAllManager()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `manager` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}

?>