 <?php

 include 'inc/header.php';
 include 'lib/User.php';
  Session::checkLogin();

 $user=new User();
 if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['register'])){
 	$userRegister=$user->userRegistration($_POST);
 }
?> 


<div class="card" style="margin-top: 20px;">
	<div class="card-header">
		<h2>User Registration <span class="float-right"> <a class="btn btn-success" href="index.php">Back</a>  </span> </h2>
	</div>
	<div class="card-body">

		<div style="max-width:500px;margin: 0 auto; ">

			<?php 
				if(isset($userRegister)){
					echo $userRegister;
				}
			?>
			
			<form action="" method="post">
				<div class="form-group">
					<label for="name" >Your name</label>
					<input type="text" name="name" id="name" class="form-control" required="">	
				</div>
				<div class="form-group">
					<label for="username" >Username</label>
					<input type="text" name="username" id="username" class="form-control" required="">	
				</div>
				<div class="form-group">
					<label for="email" >Email Address</label>
					<input type="email" name="email" id="email" class="form-control" required="">	
				</div>
				<div class="form-group">
					<label for="password" >Password</label>
					<input type="password" name="password" id="password" class="form-control" required="">	
				</div>
				<button type="register" class="btn btn-success" name="register" >Register</button>
				
			</form>
		</div>
	</div>
</div>


 <?php	

 include 'inc/footer.php';
?>