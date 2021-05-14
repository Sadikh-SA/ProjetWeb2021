<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
    $ident=$_GET["ident"];
    include '../../Controller/Service.php';
    $test = new Service();
    $form = $test->find("Chapitre", $ident);
    $form = $form->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../CSS/styleaccueil.css" />
  <title>QCM</title>
</head>

<body>

  <form class="box" method="POST" action="">
    <?php
    $total_questions = 5;
    $total_easy = 5;
    $total_medium = 5;
    $total_hard = 5;

    if (isset($_POST['finish'])) {
      //Finished
      $data = simplexml_load_file("../../Media/".$form['questionnaire']."");
      $answer = $_POST['answer'];
      $difficulty = $_POST['difficulty'];
      $old_easy = $_POST['old-easy'];
      $old_medium = $_POST['old-medium'];
      $old_hard = $_POST['old-hard'];
      $old = [];
      if ($difficulty == "easy"){
          $old = explode(",", $old_easy);
      }
      elseif ($difficulty == "medium") {
        $old = explode(",", $old_medium);
      }
      elseif ($difficulty == "hard") {$old = explode(",", $old_hard);}
      $real_answer = $data->$difficulty->question[intval($old[intval(count($old) - 2)])]->answer;
      $correct = 0;
      if (intval($answer) == intval($real_answer)) { $correct = 1;}

      $answer = $_POST["old-answer"] . $correct . ",";
      $difficulty = $_POST["old-difficulty"];

      $answer = explode(",", $answer);
      $difficulty = explode(",", $difficulty);

      $ret = "";
      $ret .= "<div class='page-title'>Results</div>";
      $ret .= "<div class='results'>";
      $ret .= "<div class='results-top-row'>";
      $ret .= "<div class='results-top-row-index'>Index</div>";
      $ret .= "<div class='results-top-row-answer'>Answer</div>";
      $ret .= "<div class='results-top-row-difficulty'>Difficulty</div>";
      $ret .= "<div class='results-top-row-points'>Points</div>";
      $ret .= "</div>";
      $total_points = 0;
      for ($i = 0; $i < count($answer) - 1; $i++) {
        if ($i % 2 == 0) $ret .= "<div class='results-row'>";
        else $ret .= "<div class='results-row' style='background-color: #3b3b3b;'>";
        $ret .= "<div class='results-index'>Question " . ($i + 1) . "</div>";
        if (intval($answer[$i]) == 0) $ret .= "<div class='results-answer results-incorrect'>Incorrect</div>";
        else $ret .= "<div class='results-answer results-correct'>Correct</div>";
        $ret .= "<div class='results-difficulty'>" . $difficulty[$i] . "</div>";
        $points = 0;
        if (intval($answer[$i]) == 1) {
          if ($difficulty[$i] == "easy") $points = 100;
          else if ($difficulty[$i] == "medium") $points = 200;
          else if ($difficulty[$i] == "hard") $points = 300;
        }
        $total_points += $points;
        $ret .= "<div class='results-points'>" . $points . "</div>";
        $ret .= "</div>";
      }
      $ret .= "</div>";
      $ret .= "<div class='total-points'>Total score: " . $total_points . "</div>";
      $results = 1;
      echo ($ret);
    } else if (isset($_POST['start'])) {
      //First question
      $data = simplexml_load_file("../../Media/".$form['questionnaire']."");

      $index = $_POST['index'];

      $random = rand(0, $total_medium - 1);

      $ret = "";
      $ret .= "<div class='page-title'>Question 1 / {$total_questions}</div>";
      $ret .= "<div class='title'>" . $data->medium->question[$random]->title . "</div>";
      $ret .= "<div class='option-wrapper'>";
      for ($i = 0; $i < count($data->medium->question[$random]->option); $i++) {
        $ret .= "<input type='radio' name='answer' required value='" . ($i + 1) . "' id='radio{$i}' class='option'><label for='radio{$i}'>" . $data->medium->question[$random]->option[$i] . "</label><br>";
      }
      $ret .= "</div>";
      $ret .= "<input name='old-difficulty' style='display:none;' value='medium,'></input>";
      $ret .= "<input name='old-answer' style='display:none;' value=''></input>";
      $ret .= "<input name='old-easy' style='display:none;' value=''></input>";
      $ret .= "<input name='old-medium' style='display:none;' value='" . $random . ",'></input>";
      $ret .= "<input name='old-hard' style='display:none;' value=''></input>";
      $ret .= "<input name='index' style='display:none;' value='" . ($index + 1) . "'></input>";
      $ret .= "<input name='difficulty' style='display:none;' value='medium'></input>";
      $ret .= "<button class='button button-finish' formnovalidate name='finish'>Finish</button>";
      $ret .= "<button class='button button-next' name='next'>Next</button>";
      echo ($ret);
    } else if (isset($_POST['next'])) {
      //Next question
      $data = simplexml_load_file("../../Media/".$form['questionnaire']."");
      $index = $_POST['index'];
      $answer = $_POST['answer'];
      $difficulty = $_POST['difficulty'];
      $old_easy = $_POST['old-easy'];
      $old_medium = $_POST['old-medium'];
      $old_hard = $_POST['old-hard'];
      $old = [];
      if ($difficulty == "easy") $old = explode(",", $old_easy);
      else if ($difficulty == "medium") $old = explode(",", $old_medium);
      else if ($difficulty == "hard") $old = explode(",", $old_hard);
      $real_answer = $data->$difficulty->question[intval($old[intval(count($old) - 2)])]->answer;
      $correct = 0;
      if (intval($answer) == intval($real_answer)) {
        $correct = 1;
        if ($difficulty == "easy") $difficulty = "medium";
        else $difficulty = "hard";
      } else {
        if ($difficulty == "hard") $difficulty = "medium";
        else $difficulty = "easy";
      }

      if ($difficulty == "easy") $old = explode(",", $old_easy);
      else if ($difficulty == "medium") $old = explode(",", $old_medium);
      else if ($difficulty == "hard") $old = explode(",", $old_hard);

      $max_range = 0;
      if ($difficulty == "easy") $max_range = $total_easy - 1;
      if ($difficulty == "medium") $max_range = $total_medium - 1;
      if ($difficulty == "hard") $max_range = $total_hard - 1;
      $random = rand(0, $max_range);

      while (in_array($random, $old)) $random = rand(0, $max_range);

      if ($difficulty == "easy") $old_easy .= $random . ",";
      if ($difficulty == "medium") $old_medium .= $random . ",";
      if ($difficulty == "hard") $old_hard .= $random . ",";

      $ret = "";
      $ret .= "<div class='page-title'>Question " . ($index + 1) . " / {$total_questions}</div>";
      $ret .= "<div class='title'>" . $data->$difficulty->question[$random]->title . "</div>";
      $ret .= "<div class='option-wrapper'>";
      for ($i = 0; $i < count($data->$difficulty->question[$random]->option); $i++) {
        $ret .= "<input type='radio' name='answer' required value='" . ($i + 1) . "' id='radio{$i}' class='option'><label for='radio{$i}'>" . $data->$difficulty->question[$random]->option[$i] . "</label><br>";
      }
      $ret .= "</div>";
      $ret .= "<input name='old-difficulty' style='display:none;' value='" . $_POST["old-difficulty"] . $difficulty . ",'></input>";
      $ret .= "<input name='old-answer' style='display:none;' value='" . $_POST["old-answer"] . $correct . ",'></input>";
      $ret .= "<input name='old-easy' style='display:none;' value='" . $old_easy . "'></input>";
      $ret .= "<input name='old-medium' style='display:none;' value='" . $old_medium . "'></input>";
      $ret .= "<input name='old-hard' style='display:none;' value='" . $old_hard . "'></input>";
      $ret .= "<input name='index' style='display:none;' value='" . ($index + 1) . "'></input>";
      $ret .= "<input name='difficulty' style='display:none;' value='" . $difficulty . "'></input>";
      if (($index + 1) == $total_questions) {
        $ret .= "<button class='button button-finish-last' formnovalidate name='finish'>Finish</button>";
      } else {
        $ret .= "<button class='button button-finish' formnovalidate name='finish'>Finish</button>";
        $ret .= "<button class='button button-next' name='next'>Next</button>";
      }
      echo ($ret);
    } else {
      //Init
      $ret = "";
      $ret .= "<div class='page-title'>HTML CSS</div>";
      $ret .= "<input name='index' style='display:none;' value='0'></input>";
      $ret .= "<button class='button button-start' name='start'>Start</button>";
      echo ($ret);
    }
    ?>
  </form>

</body>

</html>

<script>
  if (localStorage.getItem("couleur")) {
        document.body.style.backgroundColor=localStorage.getItem("couleur");
    }
</script>