<?php include("header.php"); 
$id = $_GET["id"];
$user_id  = $_SESSION['id'];
$usertype = $_SESSION['usertype'];

$_SESSION['cart'];
array_push($_SESSION['cart'], $id);
$_SESSION['cart'] = array_unique($_SESSION['cart']);
//print_r($_SESSION['cart']);


$remove_product = $_GET["rid"];
if($remove_product > 0){
	if (($key = array_search($remove_product, $_SESSION['cart'])) !== false) {
		unset($_SESSION['cart'][$key]);
	}
}

?>
<?php
if(!empty($user_id) && ($usertype == "buyer")){
?>
<div class="container">
	<div class="row">	
		<div class="col-md-6 col-offset-3 product">
		<?php
		foreach($_SESSION['cart'] as $productid){
			$queryp = "SELECT * FROM products WHERE pid = '$productid'";
			$resultp = mysqli_query($conn,$queryp);
		
			while($row = mysqli_fetch_array( $resultp ))
			{ ?>
				<div class="col-md-12 product">
					<img src="images/<?php echo $row['image']; ?> " width='200px' height='200px'/>
					<p class="name"><?php echo $row['name']; ?></p>
					<p class="price">$<?php echo $row['price']; ?> <span style="margin-left:25px;" >Quantity <input style="margin-left:5px;width:65px;" type="number" value="1" /></span></p>
					<p><a href="cart.php?rid=<?php echo $productid; ?>">Remove</a></p>
				</div>
			<?php }
		}
		?>
		<input type="submit" name="updatecart" value="UPDATE CART"/>
		</div>
		<div class="col-md-6 col-offset-3">
			<h2>Checkout</h2>
			<form method="post" action="">
				<div class="form-group">
					<input type="text" name="name_card"  class="form-control" tabindex="1" placeholder="NAME ON CARD"/>
				</div>
				<div class="form-group">
					<input type="text" name="card_number"  class="form-control" placeholder="ENTER CARD NUMBER"/>
				</div>
				<div class="form-group">
					<input type="date" name="expiry_date" class="form-control" placeholder="EXPIRY DATE"/>
				</div>
				<div class="form-group">
					<input type="text" name="cvv" class="form-control" tabindex="1" placeholder="CVV"/>
				</div>
				<div class="form-group">
					<input type="submit" name="submit"  value="Submit"/>
				</div>
			</form>
		</div>
	</div>
</div>
<?php }else{ ?>
	<div class="container">
		<div class="row">
			<div class='notification'>Please login with a valid buyer account in order to access this area.</div>
		</div>
	</div>
<?php
	}
?>
<?php include("footer.php"); ?>

<?php 
	if(isset($_POST["submit"])){
		$card_number = $_POST["card_number"];
		$query = "INSERT INTO `order` (`product_id`,`user_id`,`card_number`,`date`) VALUES ('$id','$user_id','$card_number',CURDATE())";
		mysqli_query($conn,$query);
		$query2 = "UPDATE `products` SET `quantity` = `quantity`-1 WHERE `pid` = '$id'";
		mysqli_query($conn,$query2);
		echo "<script>
				alert('Order Placed.');
				window.location.href='profile.php';
			</script>";
	}
?>