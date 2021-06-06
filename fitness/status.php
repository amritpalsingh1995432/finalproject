<?php 
include("header.php");
$accept = $_GET["accept"];
$decline = $_GET["decline"];
$quantity = $_GET["q"];
$product = $_GET["p"];

if($accept > 0) {	
	$queryaccept = "UPDATE `orders` SET `status` = '1' WHERE `id` = '$accept'";
	mysqli_query($conn,$queryaccept);		
	echo "<script>
			alert('Order Accepted!');
			window.location.href='profile.php';
		</script>";	
}

if($decline > 0) {	
	$queryquantity = "UPDATE `products` SET `quantity` = `quantity`+$quantity WHERE `pid` = '$product'";
	echo $queryquantity;
	mysqli_query($conn,$queryquantity);
	$querydecline = "UPDATE `orders` SET `status` = '2' WHERE `id` = '$decline'";
	mysqli_query($conn,$querydecline);		
	echo "<script>
			alert('Order Declined!');
			window.location.href='profile.php';
		</script>";	
}


include("footer.php");
?>