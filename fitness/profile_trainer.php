<?php include("header.php");
$owner    = $_SESSION["id"];
$usertype = $_SESSION['usertype'];
?>
<div class="container">
	<div class="row">
		<nav>
			<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Membership</a>
				<a class="nav-item nav-link" id="nav-content-tab" data-toggle="tab" href="#nav-content" role="tab" aria-controls="nav-home" aria-selected="true">Add Content</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Your Plans</a>
				<a class="nav-item nav-link" id="nav-coupon-tab" data-toggle="tab" href="#nav-coupon" role="tab" aria-controls="nav-msg" aria-selected="false">Manage Coupons</a>
				<a class="nav-item nav-link" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" <?php if($usertype != "buyer"){ ?> aria-selected="false" <?php }else{ ?> aria-selected="true" <?php }?>>Your Subscribers</a>
				<a class="nav-item nav-link" id="nav-msg-tab" data-toggle="tab" href="#nav-msg" role="tab" aria-controls="nav-msg" aria-selected="false">Messages</a>
			</div>
		</nav>
		<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
			<?php if($usertype != "buyer"){ ?>
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form class="form-horizontal" method="POST" action="add_product_trainer.php" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="product_name">MEMBERSHIP TITLE</label>  
						  <div class="col-md-4">
							<input id="product_name" name="product_name" placeholder="MEMBERSHIP TITLE" class="form-control input-md" required="" type="text">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE SLOTS</label>  
						  <div class="col-md-4">
							<input id="available_quantity" name="available_quantity" placeholder="AVAILABLE SLOTS" class="form-control input-md" required="" type="text">
						  </div>
						</div>				
						<div class="form-group">
						  <label class="col-md-4 control-label" for="price">MONTHLY PRICE</label>  
						  <div class="col-md-4">
							<input id="price" name="price" placeholder="MONTHLY PRICE" class="form-control input-md" required="" type="text">
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="product_description">DESCRIPTION</label>
						  <div class="col-md-4">                     
							<textarea class="form-control" id="product_description" name="product_description"></textarea>
						  </div>
						</div>					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="singlebutton"></label>
						  <div class="col-md-4">
							<input name="submit" type="submit" value="Submit" />
						  </div>
						</div>
						<input id="producttype" name="producttype" class="form-control input-md" required="" value="membership" type="hidden">
					</fieldset>
				</form>
			</div>
			<div class="tab-pane fade" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
				<div class="col-md-6">
					<form style="width:100%; " class="form-horizontal" method="POST" action="add_product_trainer.php" enctype="multipart/form-data">
						<fieldset>
						<div class="form-group">
						  <label class="col-md-5 control-label" for="product_name">TOPIC NAME</label>  
						  <div class="col-md-7">
						  <input id="coupon_name" name="topicname" placeholder="TOPIC NAME" class="form-control input-md" required="" type="text">
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-md-5 control-label" for="price">DESCRIPTION</label>  
						  <div class="col-md-7">
						  <textarea id="couponprice" name="description" placeholder="DESCRIPTION" class="form-control input-md" required="" type="text"></textarea>
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-md-5 control-label" for="vdescription">TUTORIAL LINK</label>  
						  <div class="col-md-7">
						  <input id="vdescription" name="externalurl" placeholder="URL (Any Link to Video or Tutorial)" class="form-control input-md" required="" type="text">
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-md-5 control-label" for="singlebutton"></label>
						  <div class="col-md-7">
							<input name="submitcontent" type="submit" value="Submit" />
						  </div>
						 </div>

						</fieldset>
					</form>
				</div>
				<div class="col-md-6">
				<?php
					$query = "SELECT * FROM gymcontent WHERE `owner_id` = '$owner' ";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>TOPIC NAME</th>
					<th>DESCRIPTION</th>
					<th>URL</th>
					<th>Delete</th>
					</tr>";

					while($row = mysqli_fetch_array( $result ))
					{
						echo "<tr>";
						echo '<td>' . $row['topicname'] . '</td>';
						echo '<td class="desc">' . $row['topicdesc'] . '</td>';
						echo '<td>' . $row['topiclink'] . '</td>';
						echo '<td><a href="delete.php?gid=' . $row['id'] . '">Delete</a></td>';
						echo "</tr>";
					}

					echo "</table>";
				?>
				</div>
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
						echo '<td><a href="delete.php?id=' . $row['pid'] . '">Delete</a></td>';
						echo "</tr>";
					}

					echo "</table>";
				?>
			</div>
			<div class="tab-pane fade" id="nav-coupon" role="tabpanel" aria-labelledby="nav-coupon-tab">
				<div class="col-md-6">
					<form style="width:100%; " class="form-horizontal" method="POST" action="add_product_trainer.php" enctype="multipart/form-data">
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
					$query = "SELECT `products`.`pid`, `products`.`name`, `products`.`price`, `orders`.`quantity_ordered`, `orders`.`id`, `orders`.`date`, `orders`.`user_id`, `orders`.`status` FROM `products` INNER JOIN `orders` ON `products`.`pid` = `orders`.`product_id` WHERE `orders`.`product_id` = (SELECT `pid` FROM `products` WHERE `owner_id` = $owner AND `pid` = `orders`.`product_id`) ORDER BY `orders`.`id` ASC";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Buyer</th>
					<th>Plan Name</th>
					<th>Subscribed on Date</th>
					<th>User Access Code</th>
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
						echo '<td>' . $row['date'] . '</td>';
						echo '<td>ONLINE' .$row['user_id']. '</td>';
						echo '<td>'.$action.'</td>';
						echo "</tr>";
					}

					echo "</table>";
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