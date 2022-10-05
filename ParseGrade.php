<?php
class ParseGrade {
  public const QUARTERS = ["Quarter 1", "Quarter 2", "Quarter 3", "Quarter 4"];
  public static function parseInput($input){
    try{

      // Check if empty
      if(!$input){
        throw new Exception("No Input. Please check your input values.");
      }

      $values = explode("\n", $input);
      
      // Get Quarter and Year
      $firstRow = explode(",", $values[0]);
      $quarter = trim($firstRow[0]);
      $year = trim($firstRow[1]);

      if(!in_array($quarter, ParseGrade::QUARTERS) || intval($year) <= 0){
        throw new Exception("Invalid Quarter or Year.");
      }

      if(count($values) <= 1){
        throw new Exception("Must contain at least 1 student.");
      }
  
      $extraction = [];
    
      // Iterate from row 2 forward (Student data)
      for($i = 1; $i < count($values); $i++){
        $current_row = explode(" ", trim($values[$i]));
        $rowNum = $i+1;
    
        // Get Names
        $firstname = $current_row[0];
        $lastname = $current_row[1];
    
    
        $homeworks = [];
        $tests = [];
        
        $current_type = "";
        for($x = 2; $x < count($current_row); $x++){
          $positionNum = $x+1;
          $current_word = trim($current_row[$x]);
    
          if(ctype_alpha($current_word)){
            switch($current_word){
              case "T":
                $current_type = "Test";
                break;
              case "H":
                $current_type = "Homework";
                break;
              default:
                $current_type = "";
                throw new Exception("Invalid grade type. Can only be 'H' or 'T'. Found '$current_word' instead on row {$rowNum} position {$positionNum}.");
            }
            continue;
          }
          elseif(is_numeric($current_word)){
            if($current_type === "Test"){
              $tests[] = floatval($current_word);
            }
            elseif($current_type === "Homework"){
              $homeworks[] = floatval($current_word);
            }
            else{
              throw new Exception("");
            }
          }else{
            throw new Exception("Invalid value on row $rowNum position $positionNum. Can only be an alpha or numeric value. Found '$current_word' instead.");
          }
        }
    
        $extraction[] = [
          "first_name" => $firstname,
          "last_name" => $lastname,
          "quarter" => $quarter,
          "year" => $year,
          "tests" => $tests,
          "homeworks" => $homeworks
        ];
      }
    
      return $extraction;
    }catch(Exception $e){
      throw $e;
    }
  }
}