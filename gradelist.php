<?php 
  require_once("Grade.php");
  
  $gradeSummary = Grade::get_all_summary();
?>

<?php require_once("load_env.php"); ?>

<?php if($gradeSummary) { ?>
<div class="card height-expand">
    <div class="card-header">
        Grades:
    </div>
    <div class="card-body">
        <div class="alert alert-secondary">
            Averages<br>
            <?php foreach($gradeSummary as $grade) { ?>
              <?= "{$grade['first_name']} {$grade['last_name']} ". round(($grade["test_grade"] + $grade["homework_grade"]), 1) ?><br>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>