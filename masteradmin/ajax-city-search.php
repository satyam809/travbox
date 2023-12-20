<?php
include "inc.php";  
  
    if(!isset($_GET['searchTerm'])){ 
        $json = [];
    }else{
        $search = $_GET['searchTerm'];
        $sql = "SELECT posts.id, posts.name FROM $conn 
                WHERE name LIKE '%".$search."%'
                LIMIT 10"; 
        $result = $conn->query($sql);
        $json = [];
        while($row = $result->fetch_assoc()){
            $json[] = ['id'=>$row['id'], 'text'=>$row['name']];
        }
    }

    echo json_encode($json);
  ?>