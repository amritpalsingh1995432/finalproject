<?php
include('header.php');

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	$result = mysqli_query($conn,"DELETE FROM products WHERE pid='$id'");
	header("Location: profile.php");
}
else{
	echo "Cannot delete record!";
}

include('footer.php');
?>