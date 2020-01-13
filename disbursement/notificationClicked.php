<?php

  include '../class/db.php';
  include '../class/controller.php';
  include '../class/view.php';

  $object = new View;
  if($object->updateNotification()){
  	echo "";
  }

?>