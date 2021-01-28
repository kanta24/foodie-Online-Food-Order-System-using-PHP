<?php

	include "../include/connection.php";

	session_start();
	if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie'])){
        header("location: login.php");
    }

    //adding food in food table
    if (isset($_POST['addfood'])) {
    	$name=$_POST['name'];
    	$price=$_POST['price'];
    	$ingredients=$_POST['ingredients'];

    	//setting the value of restaurant id for session and cookie
    	if (isset($_SESSION['restaurantid'])) {
    		$restaurantid=$_SESSION['restaurantid'];
    	}elseif (isset($_COOKIE['restaurantcookie'])) {
    		$restaurantid=$_COOKIE['restaurantcookie'];
    	}

    	$query="INSERT into food (name,price,ingredients,restaurantId) values ('$name',$price,'$ingredients',$restaurantid);";
    	if ($conn->query($query)) {
    		header("location: index.php");
    	}
    }



?>

<!DOCTYPE html>
<html class="food">
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

	<div class="foodform">
		<h1>Add new item in your menu</h1>
		<form action="" method="POST">
			<input type="text" name="name" placeholder="Item name"><br>
			<input type="text" name="price" placeholder="Price"><br>
			<input type="text" name="ingredients" placeholder="Ingredients"><br>
			<button type="submit" name="addfood">Add food</button>
		</form>
	</div>

</body>
</html>