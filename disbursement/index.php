<?php
  include '../includes/header.php';
  include '../includes/navigation.php';

	$object = new View;
	$weekly = $object->viewWeeklyTransaction();
	$daily = $object->viewDailyTransaction();
	$monthly = $object->viewMonthlyTransaction();
	$otherInformation = $object->viewOtherInformation();
	$graphYear = null;

	if(isset($_GET['year'])){
		if(is_numeric($_GET['year'])){
		  if(intval($_GET['year']) < 2999 && intval($_GET['year']) > 1000){
		    $graphYear = $_GET['year']; 
		  }else{
		    echo "<script>alert('Do not customize url to access this website.');</script>";
		    $graphYear = date("Y"); 
		  }
		}else{
		  $graphYear = date("Y"); 
		}
	}else{
		$graphYear = date("Y"); 
	}
	$montlyYear = [];
	for ($i=1; $i <= 12 ; $i++) { 
		$monthlyYear[$i] = "WHERE disbursed_at >= '".$graphYear."-".$i."-01' AND disbursed_at <= '".$object->getLastDayOfMonth($graphYear."-".$i."-01")."' GROUP BY id";
	}

	$dataMonth = $object->viewBarGraph($monthlyYear);

?>


<div class="col-12 col-sm-9">
   <div class="container-fluid mt-3">
        <div class="card shadow-sm">
          <div class="navigation text-white card-header shadow-sm">
            <i class="fas fa-chart-line"></i> Dashboard
          </div>
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-6 col-md-3 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"></i> Today Transaction
                </div>
                <?php 
                	$transactionCount = null;
                	if($row = $daily->fetch()){ 
                		$transactionCount+=$row['voucher_count'];
            	?>
					<div class="card-body">
						<p><?php echo ucfirst($row['voucher_type']); ?> Voucher : <strong><?php echo $row['voucher_count']; ?></strong></p>
						<?php while ($row2 = $daily->fetch()) {
							$transactionCount+=$row2['voucher_count'];
							?>
								<p><?php echo ucfirst($row2['voucher_type']); ?> Voucher : <?php echo $row2['voucher_count']; ?></p>
							<?php
						} ?>
					</div>
					<div class="card-footer">
						<h5 class="card-title text-center">Total : <strong><?php echo $transactionCount; ?></strong></h5>
					</div>
				<?php } ?>
              </div>
             </div>

			<div class="col-6 col-md-3 mb-2">
				<div class="card">
					<div class="card-header bg-primary text-white">
						<i class="fas fa-users"></i> Week Transaction
					</div>
	                <?php 
                	$transactionCount = null;
                	if($row = $weekly->fetch()){ 
                		$transactionCount+=$row['voucher_count'];
	            	?>
						<div class="card-body">
							<p><?php echo ucfirst($row['voucher_type']); ?> Voucher : <strong><?php echo $row['voucher_count']; ?></strong></p>
							<?php while ($row2 = $weekly->fetch()) {
								$transactionCount+=$row2['voucher_count'];
								?>
									<p><?php echo ucfirst($row2['voucher_type']); ?> Voucher : <?php echo $row2['voucher_count']; ?></p>
								<?php
							} ?>
						</div>
						<div class="card-footer">
							<h5 class="card-title text-center">Total : <strong><?php echo $transactionCount; ?></strong></h5>
						</div>
					<?php } ?>
				</div>
			</div>
             <div class="col-6 col-md-3 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"></i> Month Transac..
                </div>	
                <?php 
                	$transactionCount = null;
                	if($row = $monthly->fetch()){ 
                		$transactionCount+=$row['voucher_count'];
            	?>
					<div class="card-body">
						<p><?php echo ucfirst($row['voucher_type']); ?> Voucher : <strong><?php echo $row['voucher_count']; ?></strong></p>
						<?php while ($row2 = $monthly->fetch()) {
							$transactionCount+=$row2['voucher_count'];
							?>
								<p><?php echo ucfirst($row2['voucher_type']); ?> Voucher :<strong><?php echo $row2['voucher_count']; ?></strong></p>
							<?php
						} ?>
					</div>
					<div class="card-footer">
						<h5 class="card-title text-center">Total : <strong><?php echo $transactionCount; ?></strong></h5>
					</div>
				<?php } ?>
              </div>
             </div>

             <div class="col-6 col-md-3 mb-2">
                  <div class="card">
                <div class="card-header bg-primary text-white">
                  <i class="fas fa-users"></i> Other Information
                </div>
                <div class="card-body">
             		<h4 class="card-title text-center" style="font-size: 16px;">Request : 
                  <strong><?php echo $otherInformation['request']; ?></strong></h4>
             		<h4 class="card-title text-center" style="font-size: 16px;">Ongoing : 
                  <strong><?php echo $otherInformation['ongoing']; ?></strong></h4>
             		<h4 class="card-title text-center" style="font-size: 16px;">Disbursed : 
                  <strong><?php echo $otherInformation['disbursed']; ?></strong></h4>
                </div>
              </div>
             </div>


              </div>
            </div>


          </div>
        </div>
      </div>
        <div class="container-fluid mt-3">
               <div class="card shadow-sm">
                  <div class="card-body">
                    <form action="index.php" method="GET">
                      <div class="form-group" style="float: right;">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="SUBMIT" style="height: 40px;padding: 5px;margin-left: 10px;">
                      </div>
                      <div class="form-group" style="width: 30%;float: right;">
                        <select name="year" class="form-control">
                          <option></option>
                          <?php for($x = 2000;$x<=date('Y');$x++){ ?>
                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group" style="float: right;margin-right: 10px;">
                        <h3>Select Year :</h3>
                      </div>
                    </form>
                    
                     <canvas id="myChart" width="500" height="150"></canvas>
                     <script>
                      var months = ['January','February','March','April','May','June','July','August','September','October','November','December',];
                     var ctx = document.getElementById('myChart').getContext('2d');
                     var myChart = new Chart(ctx, {
                         type: 'bar',
                         data: {
                             labels: months,
                             datasets: [{
                                 label: 'NUMBER OF DISBURSED ON YEAR <?php echo $graphYear; ?>',
                                 data: [
                                 <?php echo $dataMonth[0] ?>, 
                                 <?php echo $dataMonth[1] ?>, 
                                 <?php echo $dataMonth[2] ?>, 
                                 <?php echo $dataMonth[3] ?>, 
                                 <?php echo $dataMonth[4] ?>, 
                                 <?php echo $dataMonth[5] ?>, 
                                 <?php echo $dataMonth[6] ?>, 
                                 <?php echo $dataMonth[7] ?>, 
                                 <?php echo $dataMonth[8] ?>, 
                                 <?php echo $dataMonth[9] ?>, 
                                 <?php echo $dataMonth[10] ?>, 
                                 <?php echo $dataMonth[11] ?> 
                                 ],
                                 backgroundColor: [
                                     'rgba(255, 0, 0, 0.5)',
                                     'rgba(255,100, 0, 0.5)',
                                     'rgba(255, 0, 100, 0.5)',
                                     'rgba(255, 100, 100, 0.5)',
                                     'rgba(0, 255, 0, 0.5)',
                                     'rgba(100, 255, 0, 0.5)',
                                     'rgba(0, 255, 100, 0.5)',
                                     'rgba(100, 255, 100, 0.5)',
                                     'rgba(0, 0, 255, 0.5)',
                                     'rgba(100, 0, 255, 0.5)',
                                     'rgba(0, 100, 255, 0.5)',
                                     'rgba(100, 100, 255, 0.5)',
                                 ],
                                 borderColor: [
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)',
                                     'rgba(0, 0, 0, 0.5)'
                                 ],
                                 borderWidth: 1
                             }]
                         },
                         options: {
                             scales: {
                                 yAxes: [{
                                     ticks: {
                                         beginAtZero: true
                                     }
                                 }]
                             }
                         }
                     });
                     </script>
          </div>
          
  
      </div>
</div>
  </div>


<?php 
    include '../includes/footer.php';
?>