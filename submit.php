<?php

require_once("Student.php");
require_once("ParseGrade.php");

try{
  $input = isset($_POST["input"]) ? $_POST["input"] : null;

  if(isset($_POST["file_upload"])){
    if ($_FILES['uploadedfile']['error'] == UPLOAD_ERR_OK
        && is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) {
      
      $extension = pathinfo($_FILES["uploadedfile"]["name"], PATHINFO_EXTENSION);
      if($extension != "txt"){
        throw new Exception("Only .txt file are allowed.");
      }

      $input = file_get_contents($_FILES['uploadedfile']['tmp_name']); 
    }
    else{
      throw new Exception("Error occured while uploading the file. Please try again.");
    }
  }

  if($input){
    $values = ParseGrade::parseInput($input);
    
    foreach($values as $val){
      $student = Student::get_student_by_name($val["first_name"], $val["last_name"]);

      if(!$student){
        // Insert new
        $student = Student::insert_student($val["first_name"], $val["last_name"]);
      }

      $grades = $student->get_active_quarter_grades($val["quarter"], $val["year"]);
      $allgrades = [];
      if($grades){
        $student->deactivate_active_quarter_grades($val["quarter"], $val["year"]);
      }

      if($val["tests"]){
        foreach($val["tests"] as $testGrade){
          $allgrades[] = Grade::insert_grade($student->id, $val["quarter"], $val["year"], "Test", $testGrade, 1);
        }
      }

      if($val["homeworks"]){
        if(count($val["homeworks"]) > 1){
          $minVal = min($val["homeworks"]);
          $position = array_search($minVal, $val["homeworks"]);
          unset($val["homeworks"][$position]);
        }

        foreach($val["homeworks"] as $testGrade){
          $allgrades[] = Grade::insert_grade($student->id, $val["quarter"], $val["year"], "Homework", $testGrade, 1);
        }
      }
    }

    echo "<script>alert('Grades Submitted!');</script>";
  }
  else{
    throw new Exception("Empty input.");
  }
}catch(Exception $e){
  $message = $e->getMessage();
  echo "<script>alert('$message');</script>";
}

  echo "<script>window.location.href = 'index.php';</script>";
?>