<?php
require_once 'db_connect.php';

class model
{
    function insertManager($data)
    {
        $conn = db_conn();
        $Query1 = "INSERT into manager_info (id, password, name, email, phone, nationality, nid, dob, gender, address, created_at)
                                     VALUES (:id, :password, :name, :email, :phone,:nationality, :nid, :dob, :gender, :address, NOW()); ";
        $Query2 = "INSERT into users (id, usertype)
        VALUES (:id, :usertype); ";

        try {
            $stmt1 = $conn->prepare($Query1);
            $stmt1->execute([
                ':id'           => $data["id"],
                ':password'     => $data["password"],
                ':name'      => $data["name"],
                ':email'         => $data["email"],
                ':phone'         => $data["phone"],
                ':nationality'  => $data["nationality"],
                ':nid'         => $data["nid"],
                ':dob'          => $data["dob"],
                ':gender'        => $data["gender"],
                ':address'        => $data["address"]
            ]);

            $stmt2 = $conn->prepare($Query2);
            $stmt2->execute([
                ':id'           => $data["id"],
                ':usertype'    => "Manager"
            ]);

            if ($stmt1 == true and $stmt2 == true) {
                return true;
            } else {
                $conn = null;
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        $conn = null;
        return false;
    }

    function checkExistingEmail($email)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager_info` where email = ?";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$email]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if (!empty($row)) {
            return true;
        }
    }

    function checkExistingNID($nid)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager_info` where nid = ?";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$nid]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if (!empty($row)) {
            return true;
        }
        return false;
    }

    function getUserInfo($data){
        $conn = db_conn();
        $selectQuery = "select u.usertype , a.* from users u , admin_info a where u.id = a.id and u.id = ? and a.password = ? ";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["id"],
                $data["password"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows;
    }

    function getTotalManagerNumber()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT id FROM `manager_info` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $count = 0;
        while($stmt->fetch(PDO::FETCH_OBJ)) {
            $count++;
        }
        $conn = null;
        return $count;
    }

    function showAllManager()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `manager-info` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows;
    }
}
