<?php          
      require_once 'C:/xampp/htdocs/web_technologies/Mid Project/model/model.php';
      $model = new model();
      $results = $model->fetchAllManager();

      $filename = 'managers information.csv';       
      header("Content-type: text/csv");       
      header("Content-Disposition: attachment; filename=$filename");       
      $output = fopen("php://output", "w");       
      $header = array_keys($results[0]);       
      fputcsv($output, $header);       
      foreach($results as $row)       
      {  
           fputcsv($output, $row);  
      }       
      fclose($output);       
 ?>  