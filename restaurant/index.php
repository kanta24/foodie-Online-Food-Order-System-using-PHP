<?php

	include "../include/connection.php";
	include_once "../include/nav.php";

	if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie']) && !isset($_GET['restaurantid'])){
        header("location: login.php");
    }


    //setting the value of restaurantid
    if (isset($_GET['restaurantid'])) {
    	$restaurantid=$_GET['restaurantid'];
    }elseif (isset($_COOKIE['restaurantcookie'])) {
    	$restaurantid=$_COOKIE['restaurantcookie'];
    }elseif (isset($_SESSION['restaurantid'])) {
    	$restaurantid=$_SESSION['restaurantid'];
    }
    $query="SELECT * from restaurants where id=$restaurantid;";
    if ($conn->query($query)) {
    	$result=$conn->query($query);
    	$row=$result->fetch_assoc();
    	$pic=$row['pic'];
    	$restaurantname=$row['name'];
    }
    $query="SELECT * from food where restaurantId=$restaurantid;";

?>


		<div class="restaurantpic">
			<img src="img/<?php echo $pic ?>">
			<?php
				if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie'])) {
					echo "<a href='upload.php'>Change Restaurant Picture</a>";
				}
			?>
			
		</div>
	
	<div class="wrapper">
		<?php echo "<h2 class='restaurants'>$restaurantname</h1>
		<a href='../user/mycart.php?restaurantid=$restaurantid' class='cart'>My Cart</a>"; ?>		
		<div class="item">
			<?php
				
				if ($conn->query($query)) {
					$result=$conn->query($query);
					while ($row=$result->fetch_assoc()) {
						$foodid=$row['id'];
						$name=$row['name'];
						$price=$row['price'];
						$ingredients=$row['ingredients'];
						$foodno=$row['foodno'];?>
					<div class="singleitem">
						<?php echo 
						"<div class='name-price'>
							<p class='foodname'>$foodno. $name</p>
							<p class='price'>$price Tk</p>
						</div>";
						echo 
						"<div class='ingredients'>
							<p>$ingredients</p>";
						if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie'])) {
								echo 
							"<form action='../user/cart.php?foodid=$foodid&restaurantid=$restaurantid' method='post'>
								Quantity
								<input type='text' name='quantity' value='1'><br>
								<button type='submit' name='add'>Add</button>
							</form>
						";
						}
						echo "</div>"?>
					</div>		
			<?php	echo "<hr>";	
					}
				}
			?>
			
		</div>
	</div>
</body>
</html>