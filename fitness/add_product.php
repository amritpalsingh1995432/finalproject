<?php include("header.php");
$owner = $_SESSION["id"];
?>
<?php 
if($_POST["submit"]) {
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["filebutton"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	$product_name = $_POST["product_name"];
	$available_quantity = $_POST["available_quantity"];
	$price = $_POST["price"];
	$product_category = $_POST["product_category"];
	$product_description = $_POST["product_description"];
	$image = $_FILES["filebutton"]["name"];
	
	$check = getimagesize($_FILES["filebutton"]["tmp_name"]);
	if($check !== false) {
		$query = "INSERT INTO `products` (`name`,`description`,`image`,`price`,`category`,`quantity`,`date`,`owner_id`) VALUES ('$product_name','$product_description','$image','$price','$product_category','$available_quantity',CURDATE(),'$owner')";
		mysqli_query($conn,$query);
		//echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
		echo "<script>
				alert('Product Added Successfully!');
				window.location.href='profile.php';
			</script>";
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	if ($_FILES["filebutton"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";

	} else {
		if (move_uploaded_file($_FILES["filebutton"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["filebutton"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
include("footer.php");
?>