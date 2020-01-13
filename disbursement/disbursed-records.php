<?php
  include '../includes/header.php';
  include '../includes/navigation.php';
  $object = new View;
  $stmt = $object->viewDisbursed();
  $count = 1;
?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	  	<h5 style="float:left;padding-top:5px;"><i class="fas fa-tags"></i></i> Disburse Request</h5>
	  </div>
	  <div class="card-body">
		<?php 

				if(isset($_SESSION['errorMessage'])){
					echo "
					<div class='alert alert-danger'>
					<strong>Error!</strong> ".$_SESSION['errorMessage']."
					</div>";
					unset($_SESSION['errorMessage']);
				}
		?>
	  	<!---insert transaction here--->
		  <?php if($stmt->rowCount() != 0){ ?>
		<table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
			<thead align="center">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Disbursed ID</th>
					<th scope="col">Payee</th>
					<th scope="col">Description</th>
					<th scope="col">Amount</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			while($row = $stmt->fetch()) {
				?>
				<tr align="center">
					<th scope="row"><?php echo $count; ?></th>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row["payee"]; ?></td>
					<td><?php echo $row["description"]; ?></td>
					<td>PHP&nbsp;<?php echo number_format($row["amount"],2); ?></td>
					<td><a href="disbursed-record-view.php?id=<?php echo $row[0]; ?>" style="text-decoration:none;" title="View"><i class="far fa-eye"></i></a></td>
				</tr>
			<?php $count++; } 
				}else{
					echo "<h5>Request is empty.<h5>";
				}
			?>
			</tbody>
		</table>

	  </div>
	</div>
</div>

<?php 
    include '../includes/footer.php';
?>