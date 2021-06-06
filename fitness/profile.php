<?php include("header.php");
$owner    = $_SESSION["id"];
$usertype = $_SESSION['usertype'];

if($usertype == "trainer"){
	header("Location: profile_trainer.php");
}
?>
<div class="container">
	<div class="row">
		<nav>
			<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				<?php if($usertype != "buyer"){ ?>
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add New Product</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Your Products</a>
				<a class="nav-item nav-link" id="nav-coupon-tab" data-toggle="tab" href="#nav-coupon" role="tab" aria-controls="nav-msg" aria-selected="false">Manage Coupons</a>
				<?php } ?>
				<a class="nav-item nav-link" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" <?php if($usertype != "buyer"){ ?> aria-selected="false" >Your Sales<?php }else{ ?> aria-selected="true">Your Orders <?php }?></a>
				<a class="nav-item nav-link" id="nav-msg-tab" data-toggle="tab" href="#nav-msg" role="tab" aria-controls="nav-msg" aria-selected="false">Messages</a>
			</div>
		</nav>
		<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
			<?php if($usertype != "buyer"){ ?>
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form class="form-horizontal" method="POST" action="add_product.php" enctype="multipart/form-data">
					<fieldset>
					<div class="form-group">
					  <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
					  <div class="col-md-4">
					  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text">
						
					  </div>
					</div>

					<div class="form-group">
					  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>  
					  <div class="col-md-4">
					  <input id="available_quantity" name="available_quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">
						
					  </div>
					</div>
					
					<div class="form-group">
					  <label class="col-md-4 control-label" for="price">PRODUCT PRICE</label>  
					  <div class="col-md-4">
					  <input id="price" name="price" placeholder="PRODUCT PRICE" class="form-control input-md" required="" type="text">
						
					  </div>
					</div>

					<div class="form-group">
					  <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
					  <div class="col-md-4">                     
						<textarea class="form-control" id="product_description" name="product_description"></textarea>
					  </div>
					</div>
					
					<div class="form-group">
					  <label class="col-md-4 control-label" for="product_category">PRODUCT CATEGORY</label>
					  <div class="col-md-4">                     
						<select id="product_category" name="product_category">
							<option value="gym-equipment">Gym Equipment</option>
							<option value="free-weight">Free Weight</option>
							<option value="bars">Bars</option>
							<option value="cardio">Cardio</option>
							<option value="machines">Machines</option>
						</select>
					  </div>
					</div>
			
					<div class="form-group">
					  <label class="col-md-4 control-label" for="filebutton">PRODUCT IMAGE</label>
					  <div class="col-md-4">
						<input id="filebutton" name="filebutton" class="input-file" type="file">
					  </div>
					</div>
					
					<div class="form-group">
					  <label class="col-md-4 control-label" for="singlebutton"></label>
					  <div class="col-md-4">
						<input name="submit" type="submit" value="Submit" />
					  </div>
					  </div>

					</fieldset>
				</form>
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<?php
					$query = "SELECT * FROM products WHERE `owner_id` = '$owner' ";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Product Image</th>
					<th>Product Name</th>
					<th class='desc'>Description</th>
					<th>Price</font></th>
					<th>Quantity</th>
					<th>Date</th>
					<th>Edit</th>
					<th>Delete</th>
					</tr>";

					while($row = mysqli_fetch_array( $result ))
					{
						echo "<tr>";
						echo '<td><image src=images/' . $row['image'] . ' width = "100px" /></td>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td class="desc">' . $row['description'] . '</td>';
						echo '<td>$' . $row['price'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>' . $row['date'] . '</td>';
						echo '<td><a href="edit.php?id=' . $row['pid'] . '">Edit</a></td>';
						echo '<td><a href="delete.php?id=' . $row['pid'] . '">Delete</a></td>';
						echo "</tr>";
					}

					echo "</table>";
				?>
			</div>
			<div class="tab-pane fade" id="nav-coupon" role="tabpanel" aria-labelledby="nav-coupon-tab">
				<div class="col-md-6">
					<form style="width:100%; " class="form-horizontal" method="POST" action="add_product.php" enctype="multipart/form-data">
						<fieldset>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="product_name">COUPON NAME</label>  
						  <div class="col-md-4">
						  <input id="coupon_name" name="couponname" placeholder="COUPON NAME" class="form-control input-md" required="" type="text">
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-md-4 control-label" for="price">COUPON VALUE</label>  
						  <div class="col-md-4">
						  <input id="couponprice" name="couponprice" placeholder="COUPON VALUE" class="form-control input-md" required="" type="text">
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-md-4 control-label" for="singlebutton"></label>
						  <div class="col-md-4">
							<input name="submitcoupon" type="submit" value="Submit" />
						  </div>
						  </div>

						</fieldset>
					</form>
				</div>
				<div class="col-md-6">
				<?php
					$query = "SELECT * FROM discounts WHERE `owner_id` = '$owner' ";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Coupon Code</th>
					<th>Value</th>
					<th>Delete</th>
					</tr>";

					while($row = mysqli_fetch_array( $result ))
					{
						echo "<tr>";
						echo '<td>' . $row['coupon_code'] . '</td>';
						echo '<td class="desc">' . $row['amount'] . '</td>';
						echo '<td><a href="delete.php?cid=' . $row['id'] . '">Delete</a></td>';
						echo "</tr>";
					}

					echo "</table>";
				?>
				</div>
			</div>
			<?php } ?>
			
			<div class="tab-pane fade <?php if($usertype == "buyer"){ echo "show active"; } ?> " id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
				<?php
				if($usertype == "buyer"){
					$query = "SELECT `products`.`pid`,`products`.`image`,`products`.`name`,`products`.`category`, `products`.`price`, `orders`.`date`, `orders`.`status` FROM `products` INNER JOIN `orders` ON `products`.`pid` = `orders`.`product_id` WHERE `orders`.`user_id` = '$owner' ORDER BY `orders`.`id` ASC";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Product Image</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Price</font></th>
					<th>Date</th>
					<th>Status</th>
					<th style='min-width: 250px; text-align:center;'>Rate Product</th>
					</tr>";

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
						
						if($row['status'] == 0){
							$action = "Order Placed";
						}elseif($row['status'] == 1){
							$action = "Processed";
						}elseif($row['status'] == 2){
							$action = "Declined";
						}else{
							$action = "";
						}
						
						echo "<tr>";
						echo '<td><image src=images/' . $row['image'] . ' width = "100px" /></td>';
						echo '<td>' . $row['name'] . '<br>'.$rating.'</td>';
						echo '<td>' . $row['category'] . '</td>';
						echo '<td>$' . $row['price'] . '</td>';
						echo '<td>' . $row['date'] . '</td>';
						echo '<td>' . $action . '</td>';
						echo '<td style="min-width: 250px;"><form class="rateProducts" action="add_product.php" method="post">
							<span class="fa fa-star-o" data-rating="1" style="font-size:20px;"></span>
							<span class="fa fa-star-o" data-rating="2" style="font-size:20px;"></span>
							<span class="fa fa-star-o" data-rating="3" style="font-size:20px;"></span>
							<span class="fa fa-star-o" data-rating="4" style="font-size:20px;"></span>
							<span class="fa fa-star-o" data-rating="5" style="font-size:20px;"></span>
							<input type="hidden" class="form-control rate" class="rating" name="rating" value="1"/>
							<input type="hidden" class="form-control" class="userid" name="userid" value="'.$owner.'"/>
							<input type="hidden" class="form-control" class="productid" name="productid" value="'.$row['pid'].'"/>
							<input type="submit" name="submitrating" class="ratebtn" style="display:none;"/></form></td>';
						echo "</tr>";
					}

					echo "</table>";
				}else{
					$query = "SELECT `products`.`pid`, `products`.`name`, `products`.`price`, `orders`.`quantity_ordered`, `orders`.`id`, `orders`.`date`, `orders`.`user_id`, `orders`.`status` FROM `products` INNER JOIN `orders` ON `products`.`pid` = `orders`.`product_id` WHERE `orders`.`product_id` = (SELECT `pid` FROM `products` WHERE `owner_id` = $owner AND `pid` = `orders`.`product_id`) ORDER BY `orders`.`id` ASC";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Buyer</th>
					<th>Product Name</th>
					<th>Order Units</th>
					<th>Price</font></th>
					<th>Date</th>
					<th>Action</th>
					</tr>";

					while($row = mysqli_fetch_array( $result ))
					{
						$queryname = "SELECT `name` FROM `users` WHERE `id` = ".$row['user_id'];
						$resultname = mysqli_query($conn,$queryname);
						$rowname = mysqli_fetch_array( $resultname );
						
						if($row['status'] == 0){
							$action = "<a href='status.php?accept=".$row['id']."'>Accept</a> / <a href='status.php?decline=".$row['id']."&q=".$row['quantity_ordered']."&p=".$row['pid']."'>Decline</a>";
						}elseif($row['status'] == 1){
							$action = "Processed";
						}elseif($row['status'] == 2){
							$action = "Declined";
						}else{
							$action = "";
						}
						
						echo "<tr>";
						echo '<td>' . $rowname['name'] . '</td>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td>' . $row['quantity_ordered'] . '</td>';
						echo '<td>$' . $row['price'] . '</td>';
						echo '<td>' . $row['date'] . '</td>';
						echo '<td>'.$action.'</td>';
						echo "</tr>";
					}

					echo "</table>";
				}
				?>
			</div>
			<div class="tab-pane fade" id="nav-msg" role="tabpanel" aria-labelledby="nav-msg-tab">
				<?php
					$query = "SELECT * FROM `chat` WHERE `user_to` = '$owner' ";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Sender Name</th>
					<th>Topic</th>
					<th>Message</th>
					<th>Sender Email</th>
					<th>Sender Phone</th>
					<th>Action</th>
					</tr>";

					while($row = mysqli_fetch_array( $result ))
					{
						echo "<tr>";
						echo '<td>' . $row['contactname'] . '</td>';
						echo '<td>' . $row['contacttopic'] . '</td>';
						echo '<td>' . $row['message'] . '</td>';
						echo '<td>' . $row['contactemail'] . '</td>';
						echo '<td>' . $row['contactphone'] . '</td>';
						echo '<td><a href="reply.php?id='.$row['user_from'].'">Reply</a></td>';
						echo "</tr>";
					}

					echo "</table>";
				?>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>