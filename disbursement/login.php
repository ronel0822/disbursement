<!DOCTYPE html>
<html>
<head>
  <title>LOGIN SECTION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Bootstrap CDN link------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Semantic UI CDN link------------>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/icon.min.css">
    <!--Google Fonts CDN link----------->
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
      <!--CSS Style sheet link------------>
    <link rel="stylesheet" type="text/css" href="login.css">
    <!--Fontawesome ICON CDN link----------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">

      <!-- JQUERY / Bootstrap CDN Scripts---------->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>

<div class="wrapper">
  <form class="form-signin" method="POST">
    <h2 class="form-signin-heading text-center">LOGIN</h2>
    <h2 class="form-signin-heading text-center">SECTION</h2>
	<?php
		include'../class/db.php';
		include'../class/controller.php';
		include'../class/view.php';
		include'../class/auth.php';

		$object = new Auth;
		if(isset($_SESSION['username'])){
			header('location:index.php');
		}
		if(isset($_POST['login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			if($object->authentication($username,$password)){
				header('location:index.php');
			}else{
				echo "	<div class='alert alert-danger'>
							Login Failed
						</div>";
			}
		}

		if(isset($_SESSION['message'])){
			echo "	<div class='alert alert-danger'>
							".$_SESSION['message']."
					</div>";
			session_destroy();
		}

	?>

	<hr>
    <label for="exampleInputEmail1">Account Name</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
      </div>
      <input type="text" name="username" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <label for="exampleInputEmail1">Password</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
      </div>
      <input type="password" name="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <hr><br>

    <input class="login btn btn-block text-white" type="submit"  name="login" value="Login">
    
  </form>
</div>
