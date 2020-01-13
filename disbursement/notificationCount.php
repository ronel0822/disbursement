<?php

  include '../class/db.php';
  include '../class/controller.php';
  include '../class/view.php';

  $object = new View;
  $stmt = $object->viewNotification();
  $count = 0;
  while ($row = $stmt->fetch()) {
  	$count++;
  }

  if($count == 0){
    echo "";
  }else{
    echo $count;
  }

?>