<?php
	session_start();
	include '../class/db.php';
	include '../class/controller.php';
	include '../class/view.php';
	if(!isset($_SESSION['username'])){
		$_SESSION['message'] = "Required to login";
		header('location:test.php');
	}

	if(isset($_GET['logout'])){
		session_destroy();
		header("location:test.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Skyline Hotel and Restaurant</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- Material Design Bootstrap -->
	<link rel="stylesheet" href="../css/mdb.min.css">
	<!-- Your custom styles (optional) -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- MDBootstrap Datatables  -->
	<link href="../css/addons/datatables.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="../fontawesome/css/all.css">
	<link rel="stylesheet" href="../css/design.css">
	<script src="../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
	<script src="../bootstrap-4.3.1-dist/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body class="bg-light">