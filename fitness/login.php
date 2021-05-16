<?php include('header.php'); ?>
<div class="row">
	<div class="container">
		<h2 style="color:#fff;" class="page-heading">Login</h2>
		<form action="" method="post">		    
			<label>
				<input type="text" placeholder="Enter Email" name="email" required>
			</label>
			<label>
				<input type="password" placeholder="Enter Password" name="password" required>
			</label>
			<div style="margin-bottom:10px;">
				<button name="login" type="submit">Login</button>
				<button type="reset" class="reset">Reset</button>
			</div>
			<label class="register"><a href="register.php">Register</a></label>
		</form> 
	</div>
</div>
<?php
if(isset($_POST["login"])){
	$email      = $_POST["email"];
	$password   = $_POST["password"];
	
	$query  = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
	$result = mysqli_query($conn,$query);
	$row    = mysqli_fetch_array($result,MYSQLI_ASSOC);
	  
	$count = mysqli_num_rows($result);
	if($count == 1) {
		echo "Welcome ".$row["name"];
		$_SESSION['id'] = $row["id"];
		$_SESSION['name'] = $row["name"];
		$_SESSION['email'] = $row["email"];
		$_SESSION['usertype'] = $row["usertype"];
		header("location: index.php");
	}else{
		echo "<div class='error'>Either email or password is incorrect!</div>";
	}
}
?>
<?php include('footer.php'); ?>

