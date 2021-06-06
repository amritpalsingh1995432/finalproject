<?php include('header.php'); ?>
<?php 
	$usertype = $_SESSION['usertype']; 
	$user_id  = $_SESSION["id"];
?>
<div class="row">
	<div class="container">
		<h2 class="page-heading">Membership Programs</h2>
		<div class="col-sm-10 col-sm-offset-1">
			<table class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Plan</th>
						<th class='desc'>Description</th>
						<th class="pricee">Monthly Price</th>
						<?php if(($usertype != "seller") && ($usertype != "trainer")){ ?>
						<th class="action mm">Action</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "SELECT `products`.`pid`, `products`.`name`, `products`.`description`, `products`.`price`, `products`.`owner_id`  FROM `products` WHERE `producttype` = 'membership'";
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
						echo '<td>' . $row['name'] . '<br>'.$rating.'</td>';
						echo '<td class="desc">' . $row['description'] . '</td>';
						echo '<td class="pricee">$' . $row['price'] . '</td>';
						if(($usertype != "seller") && ($usertype != "trainer")){
							$querys = "SELECT * FROM `orders` WHERE `orders`.`product_id` =  ".$row['pid']." AND `orders`.`user_id` = $user_id";
							$results = mysqli_query($conn,$querys);
							$rows = mysqli_fetch_array( $results );
							//echo $rows['date'];
							$renew = false;
							if(strtotime($rows['date']) < strtotime('-30 days')) {
								$renew = true;
							}else{
								$renew = false;
							}
							if($rows['id']){
								if($renew){
									echo '<td class="action mm"><a class="addtocart" href="cart.php?id='.$row['pid'].'&q=1&renew=1">Renew</a><br><br>Your Code: <br>ONLINE'.$user_id.'<br><br>'.(($_SESSION['usertype']=='buyer')?'<a href="contact.php?id='.$row['owner_id'].'">Contact Seller</a>':"").'</td>';						
								}else{
									echo '<td class="action mm">Already Subscribed<br><br>Your Code: <br>ONLINE'.$user_id.'<br><br>'.(($_SESSION['usertype']=='buyer')?'<a href="contact.php?id='.$row['owner_id'].'">Contact Seller</a>':"").'</td>';						
								}
							}else{
								echo '<td class="action mm"><a class="addtocart" href="cart.php?id='.$row['pid'].'&q=1">Subscribe</a><br><br>'.(($_SESSION['usertype']=='buyer')?'<a href="contact.php?id='.$row['owner_id'].'">Contact Seller</a>':"").'</td>';						
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
<div class="row">
	<div class="container">
		<h2 class="page-heading">Valuable Content</h2>
		<div class="col-sm-10 col-sm-offset-1">
			<?php
				$query = "SELECT *  FROM `gymcontent`";
				$result = mysqli_query($conn,$query);
				
				while($row = mysqli_fetch_array( $result ))
				{
					echo '<div class="row">';
					echo '<h3>'.$row['topicname'].'</h3>';
					echo '<p>'.$row['topicdesc'].'</p>';
					echo '<iframe width="853" height="480" src="'.$row['topiclink'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					echo '</div>';
				}
			?>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>

