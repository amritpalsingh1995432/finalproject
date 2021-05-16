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
						<th>Company</th>
						<th>Category</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><img src="images/img.png"/></td>
						<td>Spark</td>
						<td>Chevrolet</td>
						<td>Economy</td>
						<td>4</td>
						<td><a href="cart.php?id=1">Add to Cart</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

