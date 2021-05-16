<?php include("header.php");
$owner = $_SESSION["id"];
?>
<div class="container">
	<div class="row">
		<nav>
			<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add New Product</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Your Products</a>
				<a class="nav-item nav-link" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" aria-selected="false">Your Orders</a>
			</div>
		</nav>
		<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
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
					<th>Description</th>
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
						echo '<td>' . $row['description'] . '</td>';
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
			
			<div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
				<?php
					$query = "SELECT `products`.`image`,`products`.`product`,`products`.`category`, `products`.`price`, `order`.`date` FROM `products` INNER JOIN `order` ON `products`.`pid` = `order`.`product_id` WHERE `order`.`user_id` = '$owner' ";
					$result = mysqli_query($conn,$query);
					echo "<table class='table'>";
					echo "<tr>
					<th>Product Image</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Price</font></th>
					<th>Date</th>
					<th>Status</th>
					</tr>";

					while($row = mysqli_fetch_array( $result ))
					{
						echo "<tr>";
						echo '<td><image src=images/' . $row['image'] . ' width = "100px" /></td>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td>' . $row['category'] . '</td>';
						echo '<td>$' . $row['price'] . '</td>';
						echo '<td>' . $row['date'] . '</td>';
						echo '<td>Confirmed</td>';
						echo "</tr>";
					}

					echo "</table>";
				?>
			</div>
	</div>
</div>

<?php include("footer.php"); ?>