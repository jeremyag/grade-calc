<?php
class DB {
  public static function query($sql){

    require("dbconfig.php");
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      $return_value = [];
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $return_value[] = $row;
      }
      return $return_value;
    } else {
      return null;
    }
  }
  public static function execute($sql){
    require("dbconfig.php");
    $conn->query($sql);
  }
}