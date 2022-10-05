<?php

require_once("db.php");

class Grade {
  public static function get_active_quarter_grades($student_id, $quarter, $year){
    $sql = "SELECT * FROM grades WHERE `student_id` = $student_id AND `quarter` = '$quarter' AND `year` = $year AND `active` = 1";
    $result = DB::query($sql);

    if($result){
      $grades = [];
      foreach($result as $res){
        $grades[] = new Grade($res);
      }
      return $grades;
    }

    return null;
  }

  public static function deactivate_active_quarter_grades($student_id, $quarter, $year){
    $sql = "UPDATE grades SET `active` = 0 WHERE `student_id` = $student_id AND `quarter` = '$quarter' AND `year` = $year AND `active` = 1";
    DB::execute($sql);
  }

  public static function insert_grade($student_id, $quarter, $year, $type, $grade, $active){
    $sql = "INSERT INTO grades (`student_id`, `quarter`, `year`, `type`, `grade`, `active`)
              VALUES ($student_id, '$quarter', $year, '$type', $grade, $active)";
    DB::execute($sql);

    $sql = "SELECT * FROM grades WHERE `student_id` = $student_id AND `quarter` = '$quarter' AND `year` = $year AND `grade` = $grade AND `active` = $active ORDER BY id DESC LIMIT 1";

    $res = DB::query($sql);
    if($res && $res[0]){
      return new Grade($res[0]);
    }

    return null;
  }

  public static function get_all_summary(){
    $gradePercentage = 0.6;
    $homeworkPercentage = 0.4;

    $sql = "SELECT
              id,
              first_name,
              last_name,
              `quarter`, 
              `year`,
              SUM(IF(type = 'Test', (average * $gradePercentage), 0)) as 'test_grade',
              SUM(IF(type = 'Homework', (average * $homeworkPercentage), 0)) as 'homework_grade'
            FROM 
            (
              SELECT
                s.id,
                s.first_name,
                s.last_name,
                AVG(g.grade) as average,
                g.`type`, 
                g.quarter,
                g.`year` 
              FROM 
                grades g 
              INNER JOIN students s on s.id = g.student_id 
              WHERE 
                g.active = 1
              GROUP BY 
                g.student_id,
                g.`type` 
            ) t
              GROUP BY t.id
              ORDER BY t.first_name, t.last_name";
    
    return DB::query($sql);
  }

  /***
   * Instance Memebers
   */
  public function __construct($value)
  {
    foreach($value as $index => $val){
      $this->{$index} = $val;
    }
  }
}