<?php include("header.php"); ?>
<div class="container">
	<div class="row">
		<?php			
			unset($_SESSION["id"]);  
			unset($_SESSION['name']);
			unset($_SESSION['email']);
			unset($_SESSION['usertype']);
			unset($_SESSION['cart']);
			header("Location: login.php");
		?>
	</div>
</div>
<?php include("footer.php"); ?>