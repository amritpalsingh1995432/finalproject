<?php include('header.php'); ?>
<div class="row">
	<div class="container">
		<h2 class="page-heading">Register</h2>
		<form action="" method="post">		    
			<label>
				<input type="text" placeholder="Enter Name" name="name" required>
			</label>
			<label>
				<input type="email" placeholder="Enter Email" name="email" required>
			</label>
			<label>
				<input type="text" placeholder="Enter Password" name="password" required>
			</label>
			<label>
				<input type="text" placeholder="Re-type Password" name="repassword" required>
			</label>
			<label><p>GENDER </p>
				<input class="gender" type="radio" name="gender" value="male"> Male
				<input class="gender" type="radio" name="gender" value="female"> Female
				<input class="gender" type="radio" name="gender" value="notspecified"> Not Specified
			</label>
			<label><p>USER TYPE</p>
				<select name="usertype">
					<option value="buyer">Buyer</option>
					<option value="seller">Seller</option>
					<option value="trainer">Trainer</option>
				</select>
			</label>
			<div style="margin-bottom:10px;">
				<button name="register" type="submit">Register</button>
				<button type="reset" class="reset">Reset</button>
			</div>
			<label class="register"><a href="index.html">Login</a></label>
		</form> 
	</div>
</div>
<?php
if(isset($_POST["register"])){
	$name       = $_POST["name"];
	$email      = $_POST["email"];
	$gender     = $_POST["gender"];
	$usertype   = $_POST["usertype"];
	$password   = $_POST["password"];
	$repassword = $_POST["repassword"];
	
	if($password == $repassword){
		if($name != "" && $email != "" && $gender != "" && $usertype != ""){
			$existing_email_Check = "SELECT * FROM users WHERE email = '".$email."'";
			$result = mysqli_query($conn, $existing_email_Check);
			if (mysqli_num_rows($result) > 0) {	
				echo "<div class='error'>User already exists!</div>";
			}else{
				$query = "INSERT INTO `users` (`name`, `email`, `password`, `gender`, `usertype`) VALUES ('".$name."', '".$email."', '".$password."', '".$gender."', '".$usertype."')";
				if ($conn->query($query) === TRUE) {
				  $_SESSION['message'] = $name."! Registeration Done.<br>Login to continue.";
				} else {
				  echo "Error: " . $query . "<br>" . $conn->error;
				}
				$conn->close();
			}
		}else{
			echo "<div class='error'>All fields are required!</div>";
		}
	}else{
		echo "<div class='error'>Passwords must match!</div>";
	}
}
?>
<?php include('footer.php'); ?>

