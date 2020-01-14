<?php

    if(!isset($_GET['id'])){
        header('location:disbursed-records.php');
    }


  include '../includes/header.php';
  
  $object = new View;

    try {
        $statement = $object->viewRequestDisbursed($_GET["id"]);
    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "ID is always a number.";
        header('location:disbursed-records.php');
    }

    include '../includes/navigation.php';
?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	  	<i class="fas fa-tags"></i></i> Disbursed
	  </div>
	  <div class="card-body">

<?php   if ($row = $statement->fetch()) { ?>
	  	<!---insert transaction here--->
      <div class="row">
            <div class="col">
                <p><strong>Payee</strong></p>
            </div>
            <div class="col">
                <p><strong>Amount</strong></p>
            </div>
            <div class="col">
                <p><strong>Date Disbursed</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p><?php echo $row["payee"]; ?></p>
            </div>
            <div class="col">
                <p>PHP&nbsp;<?php echo number_format($row["amount"],2); ?></p>
            </div>
            <div class="col">
            <?php
                $convert = new DateTime($row["disbursed_at"]); //create datetime object with received data
                $date = $convert->format('M d, Y'); 
                $time = $convert->format('h:m A');
                echo "<small><strong>Date:</strong> ".$date." <strong>Time:</strong> ".$time."</small>";
            ?>
            </div>
        </div>
    </div>

<div class="container">
    <hr>
    <p><strong>Description:</strong></p>
    <p>&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row["description"]; ?></p><br>
    <hr>
    <center>
    <!-- <small></small>  -->
    <embed src="../Storage/Disbursement/<?php echo $row['voucher_file'] ?>" type="application/pdf" height="500px" width="80%"/>
    </center>
</div>

<?php  
    }else{
        echo "No Data Found in this id.";
    }
?>
	  </div>
	</div>
</div>

<form action="ongoing-request.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
  <div class="modal" tabindex="-1" role="dialog" id="accept">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Upload a receiving copy of the voucher.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <input type="file" name="voucher" class="form-control" style="height:43px;" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="submitVoucher" class="btn btn-success" onclick="return confirm('Are you sure?')">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
          </div>
  </div>
</form>

<?php 
    include '../includes/footer.php';
?>