<?php include("header.php");
$owner = $_SESSION["id"];
$id = $_GET["id"];
$query = "SELECT * FROM products WHERE `pid` = '$id' ";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array( $result ))
{
?>
<div class="container">
	<div class="row">
		<h2 style="text-align:center; margin-bottom:50px;">UPDATE DATA</h3>
		<form class="form-horizontal" method="POST" action="edit_product.php" enctype="multipart/form-data">
			<fieldset>
			<input type="hidden" name="product_id" value="<?php echo $id; ?>"/>
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
			  <div class="col-md-4">
			  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" value="<?php echo $row['name'] ?>" class="form-control input-md" required="" type="text">
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>  
			  <div class="col-md-4">
			  <input id="available_quantity" name="available_quantity" value="<?php echo $row['quantity'] ?>" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">
				
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="price">PRODUCT PRICE</label>  
			  <div class="col-md-4">
			  <input id="price" name="price" placeholder="PRODUCT PRICE" value="<?php echo $row['price'] ?>" class="form-control input-md" required="" type="text">
				
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="date">PUBLISH DATE</label>  
			  <div class="col-md-4">
			  <input id="date" name="date" placeholder="PUBLISH DATE" value="<?php echo $row['date'] ?>" class="form-control input-md" required="" type="text">
				
			  </div>
			</div>

			<!-- Textarea -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
			  <div class="col-md-4">                     
				<textarea class="form-control" id="product_description" name="product_description" value="<?php echo $row['description'] ?>"></textarea>
			  </div>
			</div>
	
			 <!-- File Button --> 
			<div class="form-group">
			  <label class="col-md-4 control-label" for="filebutton">PRODUCT IMAGE</label>
			  <div class="col-md-4">
				<input id="filebutton" name="filebutton" class="input-file" type="file">
			  </div>
			</div>
			
			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="singlebutton"></label>
			  <div class="col-md-4">
				<input name="submit" type="submit" value="Update" />
			  </div>
			  </div>

			</fieldset>
		</form>		
	</div>
</div>

<?php 
}
include("footer.php"); ?>