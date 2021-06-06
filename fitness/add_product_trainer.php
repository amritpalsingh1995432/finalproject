<?php include("header.php");
$owner = $_SESSION["id"];
?>
<?php 
if($_POST["submit"]) {
	
	$product_name = $_POST["product_name"];
	$available_quantity = $_POST["available_quantity"];
	$producttype = $_POST["producttype"];
	$price = $_POST["price"];
	$product_description = $_POST["product_description"];

	$query = "INSERT INTO `products` (`name`,`image`,`description`, `price`,`quantity`,`producttype`,`date`,`owner_id`) VALUES ('$product_name', 'mm.jpg', '$product_description','$price','$available_quantity', '$producttype',CURDATE(),'$owner')";
	mysqli_query($conn,$query);
	$last_id = $conn->insert_id;
	$queryr = "INSERT INTO `product_rating` (`productid`, `userid`, `rating`) VALUES ('$last_id', '0', '0')";
	mysqli_query($conn,$queryr);
	
	//echo "File is an image - " . $check["mime"] . ".";
	$uploadOk = 1;
	echo "<script>
			alert('Product Added Successfully!');
			window.location.href='profile_trainer.php';
		</script>";
	
}
if($_POST["submitcoupon"]) {
	
	$coupon_name = $_POST["couponname"];
	$coupon_price = $_POST["couponprice"];
	
	$query = "INSERT INTO `discounts` (`coupon_code`,`amount`,`owner_id`) VALUES ('$coupon_name','$coupon_price','$owner')";
	mysqli_query($conn,$query);
		
	echo "<script>
			alert('Coupon Added Successfully!');
			window.location.href='profile_trainer.php';
		</script>";	
}
if($_POST["submitcontent"]) {
	
	$topicname = $_POST["topicname"];
	$topicdesc = $_POST["description"];
	$topiclink = $_POST["externalurl"];
	
	$query = "INSERT INTO `gymcontent` (`topicname`,`topicdesc`,`topiclink`,`owner_id`) VALUES ('$topicname','$topicdesc','$topiclink','$owner')";
	mysqli_query($conn,$query);
		
	echo "<script>
			alert('Content Added Successfully!');
			window.location.href='profile_trainer.php';
		</script>";	
}
include("footer.php");
?>