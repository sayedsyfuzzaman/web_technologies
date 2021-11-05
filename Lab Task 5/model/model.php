<?php
require_once 'db_connect.php';

class Model
{

    function addManager($data)
    {
        $conn = db_conn();
        $selectQuery = "INSERT into user_info (Name, Surname, Username, Password, image) 
        VALUES (:name, :surname, :username, :password, :image)";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                ':name' => $data['name'],
                ':surname' => $data['surname'],
                ':username' => $data['username'],
                ':password' => $data['password'],
                ':image' => $data['image']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        $conn = null;
        return true;
    }

    function checkExistingAccount($email)
    {
        $conn = db_conn();
        $selectQuery = 'SELECT count(' . $email . ') FROM `manager` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    
    function getTotalManagerNumber()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT count(*) FROM `manager` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
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
