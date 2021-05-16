<?php 
include('header.php'); 
$sellerid        = $_GET["id"];
$current_user_id = $_SESSION['id'];
$name            = $_SESSION['name'];
$usertype        = $_SESSION['usertype'];
$useremail        = $_SESSION['email'];

$query      = "SELECT name FROM users WHERE id = '$sellerid'";
$result     = mysqli_query($conn,$query);
$row        = mysqli_fetch_array($result,MYSQLI_ASSOC);
$sellername = $row["name"];
?>
<div class="row contact-page">
	<div class="container">
		<h2 class="page-heading">Contact <?php echo $sellername; ?></h2>
		<div class="col-sm-10 col-sm-offset-1">
			<form action="" method="post" name="contactpage">
				<input type="text" name="username" placeholder="Your Name" value="<?php echo $name; ?>" required/>
				<input type="text" name="useremail" placeholder="Your Email" value="<?php echo $useremail; ?>" required/>
				<input type="text" name="usermobile" placeholder="Your Contact Number"/>
				<input type="text" name="usertopic" placeholder="Your Topic"/>
				<textarea type="text" name="usermessage" placeholder="Your Message"></textarea>
				<input type="hidden" name="userfrom" value="<?php echo $current_user_id; ?>"/>
				<input type="hidden" name="userto" value="<?php echo $sellerid; ?>"/>
				<input type="submit" name="contactsubmit" value="Send Message"/>
			</form>
		</div>
	</div>
</div>
<?php
if(isset($_POST["contactsubmit"])){
	$username       = $_POST["username"];
	$useremail      = $_POST["useremail"];
	$usermobile     = $_POST["usermobile"];
	$usertopic      = $_POST["usertopic"];
	$usermessage    = $_POST["usermessage"];
	$userfrom       = $_POST["userfrom"];
	$userto         = $_POST["userto"];
		
	$query = "INSERT INTO `chat` (`user_from`, `user_to`, `contactname`, `contactemail`, `contactphone`, `contacttopic`, `message`) VALUES ('".$userfrom."', '".$userto."','".$username."', '".$useremail."', '".$usermobile."', '".$usertopic."', '".$usermessage."')";
	if ($conn->query($query) === TRUE) {
	  echo '<p style="color:#fff; text-align:center; ">Message sent successfully! </p>';
	} else {
	  echo "Error: " . $query . "<br>" . $conn->error;
	}
			
}
?>
<?php include('footer.php'); ?>

