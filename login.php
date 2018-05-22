 <?php

 include 'inc/header.php';
 include 'lib/User.php';
 Session::checkLogin();

 $user=new User();
 if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['login'])){
 	$userLogin=$user->userLogin($_POST);
 }
?> 


<div class="card" style="margin-top: 20px;">
	<div class="card-header">
		<h2>User Login <span class="float-right"> <a class="btn btn-success" href="index.php">Back</a> </span> </h2>
	</div>
	<div class="card-body">
		<div style="max-width:500px;margin: 0 auto; ">

			<?php 
				if(isset($userLogin)){
					echo $userLogin;
				}
			?>
			
			<form action="" method="post">
				<div class="form-group">
					<label for="email" >Email Address</label>
					<input type="text" name="email" id="email" class="form-control" required="1">	
				</div>
				<div class="form-group">
					<label for="password" >Password</label>
					<input type="password" name="password" id="password" class="form-control" required="1">	
				</div>
				<button type="submit" class="btn btn-success" name="login" >Login</button>
				
			</form>
		</div>
	</div>
</div>


 <?php	

 include 'inc/footer.php';
?>