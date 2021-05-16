<?php include("header.php"); ?>
<div class="container">
	<div class="row">
		<?php			
			unset($_SESSION["id"]);  
			unset($_SESSION['name']);
			header("Location: login.php");
		?>
	</div>
</div>
<?php include("footer.php"); ?>