<?php
	
	include "../include/connection.php";
	session_start();
	
	if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie'])) {
        header("location: login.php");
    }
    if (isset($_COOKIE['restaurantcookie'])) {
    	$restaurantid=$_COOKIE['restaurantcookie'];
    }elseif (isset($_SESSION['restaurantid'])) {
    	$restaurantid=$_SESSION['restaurantid'];
    }
    $query="SELECT * from orders as o,customers as c where o.restaurantid=$restaurantid and c.id=o.userid;";

    if ($conn->query($query)) {
    	$result=$conn->query($query);

    	while ($row=$result->fetch_assoc()) {
    		$name=$row['name'];
    		$address=$row['address'];
    		$phone=$row['phone'];
    		$desc=$row['orderdesc'];
    		echo "$desc<br><br>$name<br>$phone<br>$address<br><hr>";
    	}
    }

?>