<?php
    $payableId = null;
    if(!isset($_GET['id'])){
        header('location:ongoing-request.php');
    }

  include '../includes/header.php';
  $object = new View;

    try {
        $statement = $object->viewOngoingView($_GET["id"]);
    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "ID is always a number.";
        header('location:ongoing-request.php');
    }

    include '../includes/navigation.php';

?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	  	<i class="fas fa-tags"></i></i> Ongoing
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
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accept" style="float:right;">
                <i class="fas fa-check"></i> Accept
                </button>

                <?php
                    $voucherType = "";
                    if($row['voucher_type'] == 'Cash'){
                        $voucherType = "cashVoucher.php";
                    }else if($row['voucher_type'] == 'Petty Cash'){
                        $voucherType = "pettyCash.php";
                    }else if($row['voucher_type'] == 'Cheque'){
                        $voucherType = "chequeVoucher.php";
                    }

                ?>

                <form action=" <?php echo $voucherType; ?>" method="POST" target="_blank">
                    <input type="hidden" name="chequeID" value="<?php echo $row[0]; ?>">
                    <input type="hidden" name="payee" value="<?php echo $row['payee']; ?>">
                    <input type="hidden" name="preparedBy" value="<?php echo $row['prepared_by']; ?>">
                    <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
                    <input type="hidden" name="description" value="<?php echo $row['description']; ?>">
                    <button type="submit" name="generateVoucher" style="float:right;margin-right:10px;" class="btn btn-primary btn-sm"><i class="fas fa-file-invoice"></i> Voucher</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p><?php echo $row["payee"]; ?></p>
            </div>
            <div class="col">
                <p>PHP&nbsp;<?php echo number_format($row["amount"],2); ?></p>
            </div>
            <div class="col-2">
                <?php
                    $convert = new DateTime( $row["created_at"]); //create datetime object with received data
                    $date = $convert->format('M d, Y'); 
                    $time = $convert->format('h:m A');
                    echo "<small><strong>Date:</strong> ".$date." <strong>Time:</strong> ".$time."</small>";
                ?>
            </div>
            <div class="col">

    
            </div>
        </div>
    </div>

<div class="container">
    <hr>
    &nbsp;<span><b>Voucher Type :</b>&emsp;<?php echo $row['voucher_type']; ?> Voucher</span>
    <hr>
    &nbsp;<span><b>Description:</b></span>
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
    $payableId = $row["payables_id"];
    }else{
        echo "No Data Found in this id.";
    }
?>
	  </div>
	</div>
</div>

<form action="ongoing-request.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
    
    <input type="hidden" name="payableId" value="<?php echo $payableId; ?>">

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