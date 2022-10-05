<?php
  require_once("db.php");
  require_once("Grade.php");

  class Student {
    public static function get_student_by_name($firstName, $lastName){
      $sql = "SELECT * FROM students WHERE first_name = '$firstName' AND last_name = '$lastName' ORDER BY id DESC";
      $result = DB::query($sql); 
      if($result && $result[0]){
        return new Student($result[0]);
      }
    }

    public static function insert_student($firstName, $lastName){
      $sql = "INSERT INTO students (first_name, last_name) VALUES ('$firstName', '$lastName')";
      DB::execute($sql);

      $student = Student::get_student_by_name($firstName, $lastName);
      return $student;
    }

    /***
     * Instance Members
     */
    public function __construct($value)
    {
      foreach($value as $index => $val){
        $this->{$index} = $val;
      }
    }


    public function get_active_quarter_grades($quarter, $year){
      return Grade::get_active_quarter_grades($this->id, $quarter, $year);
    }

    public function deactivate_active_quarter_grades($quarter, $year){
      Grade::deactivate_active_quarter_grades($this->id, $quarter, $year);
    }
  }