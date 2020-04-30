<?php

session_start();

//config.phpとfunctions.php,Mission.phpを呼び出す
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/Mission.php');

//get missions
$missionApp = new \MyApp\Mission();
$missions = $missionApp->getAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Missions</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body  bgcolor="#000000">
  <div id="container">
    <h1>Missions</h1>
    <form action="" id="new_mission_form">
      <input type="text" id="new_mission" placeholder="Your mission is...">
    </form>
    <ul id="missions">
    <?php foreach ($missions as $mission) : ?>
      <li id="mission_<?= h($mission->id); ?>" data-id="<?= h($mission->id); ?>">
        <input type="checkbox" class="update_mission" <?php if ($mission->state === '1') {
    echo 'checked';
} ?>>
        <span class="mission_title <?php if ($mission->state === '1') {
    echo 'accomplished';
} ?>"><?= h($mission->title); ?></span>
        <div class="delete_mission">x</div>
      </li>
    <?php endforeach; ?> 
      <li id="mission_template" data-id="">
          <input type="checkbox" class="update_mission">
          <span class="mission_title "></span>
          <div class="delete_mission">x</div>
      </li> 
    </ul>
  </div>
  <input type="hidden" id="token" value="<?= h($_SESSION['token']); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="mission.js"></script>
</body>
</html>