<?php

    if(!isset($_GET['id'])){
        header('location:disburse-request.php');
    }

  include '../includes/header.php';
  $object = new View;

    try {
            $statement = $object->viewPayable_view($_GET["id"]);
    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "ID is always a number.";
        header('location:disburse-request.php');
    }

    include '../includes/navigation.php';

?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	  	<i class="fas fa-tags"></i></i> Disburse Request
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
            <div class="col-2">
                <p><strong>Date Requested</strong></p>
            </div>
            <div class="col">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#accept" style="float:right;">
                    Accept
                </button>
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
                    $convert = new DateTime( $row["created_at"]); //create datetime object with received data
                    $date = $convert->format('M d, Y'); 
                    $time = $convert->format('h:m A');
                    echo "<small><strong>Date:</strong> ".$date." <strong>Time:</strong> ".$time."</small>";
                ?>
            </div>
            <div class="col-2">
    
            </div>
        </div>
    </div>

<div class="container">
    <hr>
    <label><b>Description:</b></label>
    <p>&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row["description"]; ?></p><br>
    <hr>
    <center>
    <small></small>
    <!-- 
    <embed src="/storage/disbursement/{{$data->supporting_document}}" type="application/pdf" height="800px" width="80%"/>
    -->
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

<form action="disburse-request.php?id=<?php echo $_GET['id']; ?>" method="POST">
  <div class="modal" tabindex="-1" role="dialog" id="accept">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Choose Disburse Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <select name="voucherType" class="form-control">
                  <option value="Cash">Cash</option>
                  <option value="Petty Cash">Petty Cash</option>
                  <option value="Cheque">Cheque</option>
                </select>
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