<?php include('header.php'); ?>
<div class="row">
	<div class="container">
		<h2 class="page-heading">Inventory</h2>
		<div class="col-sm-10 col-sm-offset-1">
			<table id="inventory" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Image</th>
						<th>Product</th>
						<th class='desc'>Description</th>
						<th>Quantity Left</th>
						<th>Price</th>
						<th class="action">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "SELECT * FROM products";
					$result = mysqli_query($conn,$query);
					while($row = mysqli_fetch_array( $result ))
					{
						echo "<tr>";
						echo '<td><image src=images/' . $row['image'] . ' width = "100px" /></td>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td class="desc">' . $row['description'] . '</td>';
						echo '<td>' . $row['quantity'] . '</td>';
						echo '<td>$' . $row['price'] . '</td>';
						echo '<td class="action"><a class="addtocart" href="cart.php?id='.$row['pid'].'">Add to Cart</a><br><br>'.(($_SESSION['usertype']=='buyer')?'<a href="contact.php?id='.$row['owner_id'].'">Contact Seller</a>':"").'</td>';
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

