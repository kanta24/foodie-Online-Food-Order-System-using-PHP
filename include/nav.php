<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>FOODIE</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,700" rel="stylesheet">
</head>
<body>
	<header>
		<div class="wrapper">
			<nav>
				<a href="../"><img src="../css/images/logo3.png"></a>
				<ul>
					<li><a href="../">Home</a></li>
					<?php
						session_start();
						
					 	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie'])) {
					 		//only for restaurant owners
							echo "<li><a href='../restaurant'>My Restaurant</a></li>";
							echo "<li><a href='../restaurant/addfood.php'>Add Item</a></li>";
							echo "<li><a href='../restaurant/orders.php'>Orders</a></li>";
							echo "<li><a href='logout.php'>Logout</a></li>";
						}elseif (isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
							echo "<li><a href='#'>My Info</a></li>";
							echo "<li><a href='logout.php'>Logout</a></li>";
						}elseif (!isset($_SESSION['userid']) && !isset($_COOKIE['usercookie'])){
							echo "<li><a href='../user/login.php'>Login</a></li>";
							echo "<li><a href='../user/signup.php'>Sign up</a></li>";
						}
					?>
				</ul>
			</nav>
		</div>
	</header>
