<!----Navigation---->

<nav class="navigation navbar navbar-expand-lg navbar-dark shadow-sm">
  <a class="navbar-brand" href="index.php"><h4 class="mt-2"><img src="../images/logo.png"> Skyline Hotel and Restaurant</h4></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </ul>
    <span class="account mr-3 mt-2">
		<div class="dropdown">
		  <button class=" btn border-0 text-white rounded-pill" type="button" data-toggle="dropdown" data-hover="dropdown">
		    <h6 class="mt-2 mr-2"><img class="rounded-circle mr-1" src="../images/sampleimg.jpeg" width="30" height="30"> Welcome, <?php echo ucfirst($_SESSION['firstname'])." ".ucfirst($_SESSION['lastname']); ?>! <h6>
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		    <a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Account Profile</a>
		    <a class="dropdown-item" href="?logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a>
		  </div>
		</div>	
	</span>
	<span class="hr mr-3">		
	</span>
    <span class="mt-2 mr-3">
    	<div class="btn-group">
			  <button id="notificationBtn" class="notif btn border-0 text-white rounded-pill" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Notification">
          <i class="far fa-bell"></i>
          <span id="notificationBadge" class="badge" style="
            background-color: rgba(255,0,0,0.9);  
            position: absolute;
            right: -3px;
            border-radius: 50%;
            background-color: red;
            color: white;
            font-size: 60%;

          "></span>
        </button>
			  <div class="dropdown-menu dropdown-menu-right shadow-sm">
			  	<span class="dropdown-item-text"><b><i class="far fa-bell"></i>&nbsp;Notification</b></span>

          <div id="notificationDrop"></div>

			  </div>
		  </div> 
    </span>

    <span class="mt-2 mr-2 text-white">
    	<a class="text-white text-decoration-none" href=""><i class="notif far fa-question-circle"></i> Help</a>	
    </span>

  </div>
</nav>


<!---Side Navigation Menu-->
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-sm-3">
      <div class="nav mt-3 shadow-sm">
      	<div class="multi-level">
      		<input type="checkbox" id="menu"/>
      		<label class="menu" for="Menu"><i class="fas fa-bars"></i> Menu Navigation</label>
      		<div class="item">
      			<input type="checkbox" id="A"/>
      			<label for="A"><i class="fas fa-chart-line"></i><a href="index.php" style="text-decoration:none; color:black;"> Dashboard</a></label>
      		</div>

      		<div class="item">
      			<input type="checkbox" id="C"/>
      			<i class=""></i><label for="C"> <i class="fas fa-tags"></i><a href="disburse-request.php" style="text-decoration:none; color:black;"></i> Request</a></label>
      		</div>


      		<div class="item">
      			<input type="checkbox" id="D"/>
      			<label for="D"><i class="fas fa-tasks"></i><a href="ongoing-request.php" style="text-decoration:none; color:black;"></i> Ongoing</a></label>
      		</div>

      		<div class="item">
      			<input type="checkbox" id="E"/>
      			<label for="E"><i class="fas fa-database"></i><a href="disbursed-records.php" style="text-decoration:none;color:black;"> Records</a></label>
      		</div>

      	</div>
      </div>

      <div class="nav mt-3 shadow-sm">
        <div class="multi-level">
          <input type="checkbox" id="menu"/>
          <label class="menu" for="Menu"><i class="fas fa-cog"></i> Settings</label>
          <div class="item">
            <input type="checkbox" id="F"/>
            <i class="arrow fas fa-chevron-down"></i><label for="F"><i class="fas fa-user-cog"></i> Account Settings</label>

            <ul>
              <li><a href=""><i class="far fa-user"></i> Update Profile</a></li>
              <li><a href=""><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
          </div>
         
        </div>
      </div>

  </div>