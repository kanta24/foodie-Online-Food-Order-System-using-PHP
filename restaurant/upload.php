<?php
	include_once "../include/nav.php";
?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<button type="submit" name="upload">Upload</button>
	</form>
</body>
</html>

<?php

	include "../include/connection.php";

	if (!isset($_SESSION['restaurantid']) && !isset($_COOKIE['restaurantcookie']) && !isset($_GET['restaurantid'])){
        header("location: login.php");
    }

    if (isset($_COOKIE['restaurantcookie'])) {
    	$restaurantid=$_COOKIE['restaurantcookie'];
    }elseif (isset($_SESSION['restaurantid'])) {
    	$restaurantid=$_SESSION['restaurantid'];
    }

    if (isset($_POST['upload'])) {
    	$img=$_FILES['file']['name'];
        $uniqname=uniqid();
        $source=$_FILES['file']['tmp_name'];
        $fileext=explode('.', $img);
        $fileactualext=strtolower(end($fileext));
        $allowed=array('jpg','jpeg','png');

        if (in_array($fileactualext,$allowed)) {
            $newname=$uniqname.".".$fileactualext;
            $uploadedDirectory="img/$newname";
            move_uploaded_file($source, $uploadedDirectory);

            //uploading the name in the database
            $query="UPDATE restaurants set pic='$newname' where id=$restaurantid;";
            if ($conn->query($query)) {
            	header("location: index.php");
            }
        }else{
            echo "The picture format is not acceptable";
            exit();
        }
    }