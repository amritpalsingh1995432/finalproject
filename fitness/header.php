<?php include('db.php'); ?>
<?php session_start(); ?>
<?php 
	ini_set('display_errors','Off');
	ini_set('error_reporting', E_ALL );
	$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<html>
	<head>
		<title>Buy & Sell Fitness</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/style.css"/>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
		<script src="assets/script.js"></script>
	</head>
	<body class="login-page <?php echo $activePage; ?>">
		<header>
			<div class="row">
				<div class="container head-row">
					<h1 class="logo">Buy & Sell Fitness</h1>
					<ul class="menu">
						<li class="<?php if($activePage =='index'){ echo 'active'; } ?>"><a href="index.php">Shop</a></li>
						<li class="<?php if($activePage =='memberships'){ echo 'active'; } ?>"><a href="memberships.php">Gym Packages</a></li>
						<?php if(!empty($_SESSION['id']) && $_SESSION['id'] != "") {
						if($_SESSION['usertype'] == "buyer"){ ?>
						<li class="<?php if($activePage =='cart'){ echo 'active'; } ?>"><a href="cart.php">Cart</a></li>
						<?php }if($_SESSION['usertype'] != "trainer"){ ?>
						<li class="<?php if($activePage =='profile'){ echo 'active'; } ?>"><a href="profile.php">Profile</a></li>
						<?php }if($_SESSION['usertype'] == "trainer"){ ?>
						<li class="<?php if($activePage =='profile_trainer'){ echo 'active'; } ?>"><a href="profile_trainer.php">Profile</a></li>
						<?php } ?>
						<li class="<?php if($activePage =='logout'){ echo 'active'; } ?>"><a href="logout.php">Logout</a></li>
						<?php }else{ ?>
					    <li class="<?php if($activePage =='login'){ echo 'active'; } ?>"><a href="login.php">Login</a></li>
						<li class="<?php if($activePage =='register'){ echo 'active'; } ?>"><a href="register.php">Register</a></li>
					    <?php } ?>
					</ul>
				</div>
			</div>
		</header>
		<div class="page-container">
		<?php 
			if($_SESSION['message'] != "" && !empty($_SESSION['message'])){
				echo "<div class='notification'>".$_SESSION['message']."</div>"; //Global Notifications
				$_SESSION['message'] = "";
			}
		
		?>
		