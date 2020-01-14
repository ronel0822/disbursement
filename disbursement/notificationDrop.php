<?php

  include '../class/db.php';
  include '../class/controller.php';
  include '../class/view.php';


  $object = new View;
  $stmt = $object->viewAllNotification();
    while($row = $stmt->fetch()){ ?>
	  <div class="dropdown-divider"></div>
	  <a class="dropdown-item text-dark" href='disburse-request-view.php?id=<?php echo $row['payable_id']; ?>' style='max-width: 650px;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                <?php if($row['viewed_at'] == null){echo "background-color: rgba(0,0,0,0.1);";} ?>'><?php echo $row['payee'].": ".$row['description']; ?></a>    
  <?php
    }
?>