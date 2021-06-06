<?php
include('header.php');
$usertype = $_SESSION['usertype'];

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	$result = mysqli_query($conn,"DELETE FROM products WHERE pid='$id'");
	if($usertype == 'seller'){
		header("Location: profile.php");
	}else{
		header("Location: profile_trainer.php");
	}
}
elseif(isset($_GET['cid']) && is_numeric($_GET['cid'])){
	$cid = $_GET['cid'];
	$resultc = mysqli_query($conn,"DELETE FROM discounts WHERE id='$cid'");
	if($usertype == 'seller'){
		header("Location: profile.php");
	}else{
		header("Location: profile_trainer.php");
	}
}else{
	echo "Cannot delete record!";
}

include('footer.php');
?>