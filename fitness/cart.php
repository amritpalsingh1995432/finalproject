<?php include("header.php"); 
$id = $_GET["id"];
$qty = $_GET["q"];
$renew = $_GET["renew"];
$user_id  = $_SESSION['id'];
$usertype = $_SESSION['usertype'];
if($id){
	$queryq = "SELECT `quantity` FROM `products`  WHERE `pid` = '$id'";
	$resultq = mysqli_query($conn,$queryq);
	$rowq = mysqli_fetch_array( $resultq );
	if($rowq['quantity'] < $qty){
		if($rowq['quantity'] == 0){
			echo "<script>
					alert('Sorry! We are all stocked out for this product.');
					window.location.href='index.php';
				</script>";
		}else{
			echo "<script>
					alert('Please reduce order quantity! Only ".$rowq['quantity']." units available.');
					window.location.href='index.php';
				</script>";
		}
	}else{
		$_SESSION['cart'][$id] = $qty;
	}
}
//$_SESSION['cart'] = array_unique($_SESSION['cart']);
//echo"<pre>";print_r($_SESSION['cart']);echo"</pre>";
if($renew == 1){
	foreach($_SESSION['cart'] as $productid => $value){
		$queryup = "UPDATE `orders` SET `date` = CURDATE() WHERE `product_id` = '$productid' AND `user_id` = '$user_id'";
		mysqli_query($conn,$queryup);
		$queryup = "UPDATE `products` SET `quantity` = `quantity`-1 WHERE `pid` = '$productid'";
		mysqli_query($conn,$queryup);
		unset($_SESSION['cart'][$productid]);
	}
	echo "<script>
				alert('Successfully Renewed.');
			window.location.href='profile.php';
			</script>";
}

$remove_product = $_GET["rid"];
if($remove_product > 0){
	unset($_SESSION['cart'][$remove_product]);
}
$totals = 0;
$couponid = 1;
?>
<?php
if(!empty($user_id) && ($usertype == "buyer")){
?>
<div class="container">
	<div class="row">	
	<?php if(!empty($_SESSION['cart'])){ ?>
		<div class="col-md-6 col-offset-3 product">
			<?php
			foreach($_SESSION['cart'] as $productid => $value){
				$queryp = "SELECT * FROM products WHERE pid = '$productid'";
				$resultp = mysqli_query($conn,$queryp);
			
				while($row = mysqli_fetch_array( $resultp ))
				{ ?>
					
					<div class="col-md-6 product">
						<img src="images/<?php echo $row['image']; ?> " width='200px' height='200px'/>
						<p class="name"><?php echo $row['name']; ?></p>
						<p class="price">$<?php echo $row['price']; ?> <span style="margin-left:25px;" >Quantity to Order: <?php echo $value; ?></span></p>
						<p><a href="cart.php?rid=<?php echo $productid; ?>">Remove</a></p>
					</div>
				<?php }
			}
			?>
		</div>
		<div class="col-md-6 col-offset-3">
			<h2>Cart Totals</h2>
			<?php
			foreach($_SESSION['cart'] as $productid => $value){
				$queryp = "SELECT * FROM products WHERE pid = '$productid'";
				$resultp = mysqli_query($conn,$queryp);
			
				while($row = mysqli_fetch_array( $resultp ))
				{ ?>
					<p class="name"><?php echo $row['name']; ?></p>
					<?php $carttotals = ($row['price'] * $value); ?>
					<?php $totals += $carttotals; ?>
					<p class="price">$<?php echo $row['price']; ?> <span style="margin-left:5px;" > X </span><span style="margin-left:5px;" > <?php echo $value; ?> = <?php echo "$".$carttotals; ?></span> </p>				
				<?php }
			}
			?>
			<p style="font-size: 16px; margin-bottom: 15px;"><strong>Totals: $<span id="total"><?php echo $totals; ?></span></strong></p>
			<p style="margin-bottom: 15px;">Have a coupon?</p>			
			<form class="couponform" name="couponform" method="post" action="">
				<input type="text" name="coupon" placeholder="Enter COUPON" required/>
				<input type="submit" name="applycoupon"  value="Apply Coupon"/>
			</form>
			<?php
			if(isset($_POST["applycoupon"])){
				$coupon = $_POST["coupon"];
				$queryc = "SELECT * FROM discounts WHERE coupon_code = '$coupon'";
				$resultc = mysqli_query($conn,$queryc);
				$rowc    = mysqli_fetch_array($resultc,MYSQLI_ASSOC);	  
				$countc = mysqli_num_rows($resultc);
				if($countc == 1) {
					$coupon_value =  $rowc["amount"];
					$couponid =  $rowc["id"];
					$totals = $totals - $coupon_value;
					echo '<p>Coupon Applied!</p>';
					echo '<p>Coupon Value is $'.$coupon_value.'</p>';
					echo '<p style="font-size: 18px; margin: 15px 0;"><strong>New Totals: $<span id="total">'. $totals .'</span></strong></p>';
				}else{
					echo "<p>Invalid coupon</p>";
				}
			}
			?>
			<h2>Checkout</h2>
			<form name="checkoutform" method="post" action="">
				<div class="form-group">
					<input type="text" name="name_card"  class="form-control" tabindex="1" placeholder="NAME ON CARD" required/>
				</div>
				<div class="form-group">
					<input type="text" name="card_number"  class="form-control" placeholder="ENTER CARD NUMBER" required/>
				</div>
				<div class="form-group">
					<input type="date" name="expiry_date" class="form-control" placeholder="EXPIRY DATE" required/>
				</div>
				<div class="form-group">
					<input type="text" name="cvv" class="form-control" tabindex="1" placeholder="CVV" required/>
				</div>
				<div class="form-group">
					<input type="submit" name="submitcart"  value="Submit"/>
				</div>
			</form>
		</div>
	<?php }else{ ?>
		Cart Empty! Add some <a href="index.php">products.</a>
	<?php } ?>
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
	if(isset($_POST["submitcart"])){
		$card_number = $_POST["card_number"];
		foreach($_SESSION['cart'] as $productid => $value){
			$query = "INSERT INTO `orders` (`product_id`,`quantity_ordered`,`user_id`,`card_number`,`coupon_id`,`date`,`status`) VALUES ('$productid','$value','$user_id','$card_number','$couponid',CURDATE(),'0')";
			mysqli_query($conn,$query);
			//echo("Error description: " . $conn -> error);
			$query2 = "UPDATE `products` SET `quantity` = `quantity`-$value WHERE `pid` = '$productid'";
			mysqli_query($conn,$query2);
			
		}
		$_SESSION['cart'] = array();
		echo "<script>
				alert('Order Placed.');
			window.location.href='profile.php';
			</script>";
	}
?>