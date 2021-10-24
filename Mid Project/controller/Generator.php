<?php

class IdGenerator {
    function getManagerID($data) {

        require_once 'C:/xampp/htdocs/web_tech/Mid Project/model/model.php';
        
        $model = new model();
        $count = $model->getTotalManagerNumber();
        $count = $count + 1000;

        $unique_id = $data["yyyy"]."-".$count."-". $data["mm"];
        return $unique_id;
    }
}

$data = array(
    'yyyy' => "2000",
    'mm' => "09",
    'dd' => "23"
);

$idgenerator = new IdGenerator();
$id = $idgenerator->getManagerID($data);
echo $id;
?>