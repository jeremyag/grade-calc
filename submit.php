<?php

require_once("Student.php");
require_once("ParseGrade.php");

if(isset($_POST["input"])){
  $input = $_POST["input"];
  try{
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

      foreach($val["tests"] as $testGrade){
        $allgrades[] = Grade::insert_grade($student->id, $val["quarter"], $val["year"], "Test", $testGrade, 1);
      }

      $minVal = min($val["homeworks"]);
      $position = array_search($minVal, $val["homeworks"]);
      unset($val["homeworks"][$position]);
      foreach($val["homeworks"] as $testGrade){
        $allgrades[] = Grade::insert_grade($student->id, $val["quarter"], $val["year"], "Homework", $testGrade, 1);
      }
    }

    echo "<script>alert('Grades Submitted!');</script>";
  }catch(Exception $e){
    echo "<script>alert('{$e->getMessage()}');</script>";
  }

  echo "<script>window.location.href = 'http://localhost/grades-calc';</script>";
}
?>