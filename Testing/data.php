<?php

  include '../class/db.php';
  include '../class/controller.php';
  include '../class/view.php';

  $object = new View;
  $stmt = $object->viewNotification();
  $count = 0;
  while($row = $stmt->fetch()){
    $count++;
  }

  echo $count;

?>