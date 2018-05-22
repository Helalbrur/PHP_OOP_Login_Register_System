	<?php
	$path=realpath(dirname(__FILE__));
	include_once $path.'/../lib/Session.php';
	Session::init();

	if(isset($_GET['action']) && $_GET['action']=="logout"){
		Session::destroy();
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>PHP OOP Login Register System & PDO</title>
		<link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css">
		<script type="text/javascript" src="inc/jquery.min.js"></script>
		<script type="text/javascript" src="inc/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-default bg-light" style="margin-top: 10px;">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">Login Register System</a>
					</div>
					<ul class="nav float-right">
						<a class="navbar-brand" href="index.php">Home</a>
						<?php
							$id=Session::get("id");
							$loginmsg=Session::get("login");
							if($loginmsg==true){ ?>

								<li class="nav-item"> <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a> </li>
								<li class="nav-item" > <a class="nav-link" href="?action=logout">Logout</a> </li>

							<?php	}
							else{ ?>

								<li class="nav-item" > <a class="nav-link" href="login.php">Login</a> </li>
								<li class="nav-item" > <a class="nav-link" href="register.php">Register</a> </li>
						<?php	}
						?>
						
						
						
					</ul>
				</div>
			</nav>