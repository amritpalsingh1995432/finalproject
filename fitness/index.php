<?php include('header.php'); ?>
<?php 
	$usertype = $_SESSION['usertype']; 
?>
<div class="row">
	<div class="container">
		<h2 class="page-heading">Products</h2>
		<div class="col-sm-10 col-sm-offset-1">
			<table id="inventory" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Image</th>
						<th>Product</th>
						<th class='desc'>Description</th>
						<th>In Stock</th>
						<th>Price</th>
						<?php if(($usertype != "seller") && ($usertype != "trainer")){ ?>
						<th>Quantity</th>
						<th class="action">Action</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "SELECT `products`.`pid`, `products`.`image`, `products`.`name`, `products`.`description`, `products`.`quantity`, `products`.`price`, `products`.`owner_id`  FROM `products` WHERE `producttype` = 'simple'";
					$result = mysqli_query($conn,$query);
					
					while($row = mysqli_fetch_array( $result ))
					{
						$queryrating = "SELECT AVG(rating) as avgrating FROM `product_rating` WHERE `productid` = ".$row['pid']."";
						$resultrating = mysqli_query($conn,$queryrating);
						$rowrating = mysqli_fetch_array($resultrating);
						$avgrating = $rowrating['avgrating'];
						$rating = "";
						for($i = 1; $i <= $avgrating; $i++){
							$rating .= '<i class="fa fa-star checked" style="font-size:20px;"></i>';
						}
						
						echo "<tr class='products-row'>";
						echo '<td><image src=images/' . $row['image'] . ' width = "100px" /></td>';
						echo '<td>' . $row['name'] . '<br>'.$rating.'</td>';
						echo '<td class="desc">' . $row['description'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>$' . $row['price'] . '</td>';
						if(($usertype != "seller") && ($usertype != "trainer")){
							if (array_key_exists($row['pid'],$_SESSION['cart'])){
								echo '<td><input style="margin-left:5px;width:65px;" class="amount" type="number" value="'.$_SESSION['cart'][$row['pid']].'" max="'.$row['quantity'] .'" disabled /> </td>';
								echo '<td class="action"><a class="addtocart" href="cart.php">View Cart</a><br><br>'.(($_SESSION['usertype']=='buyer')?'<a href="contact.php?id='.$row['owner_id'].'">Contact Seller</a>':"").'</td>';						
							}else{
								echo '<td><input style="margin-left:5px;width:65px;" class="amount" type="number" value="1" max="'.$row['quantity'] .'" /> </td>';
								echo '<td class="action"><a class="addtocart" href="cart.php?id='.$row['pid'].'&q=1">Add to Cart</a><br><br>'.(($_SESSION['usertype']=='buyer')?'<a href="contact.php?id='.$row['owner_id'].'">Contact Seller</a>':"").'</td>';						
							}
						}
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

