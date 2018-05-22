 <?php

 include 'inc/header.php';
 include 'lib/User.php';
 Session::checkSession();
 $user=new User();
 $name=$username=$email=$password="";
 $id;
 if(isset($_GET['id'])){
 	$id=$_GET['id'];
 	$data=$user->readById($id);
 	if(isset($data)){
 		$name=$data->name;
 		$username=$data->username;
 		$email=$data->email;
 		$password=md5($data->password);
 	}
 }

 if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update'])){
 	$userUpdate=$user->userUpdate($id,$_POST);
 }
?> 


<div class="card" style="margin-top: 20px;">
	<div class="card-header">
		<h2>User Profile <span class="float-right"> <a class="btn btn-success" href="index.php">Back</a>  </span> </h2>
	</div>
	<div class="card-body">
		<div style="max-width:500px;margin: 0 auto; ">
			<form action="" method="post">
				<div class="form-group">
					<label for="name" >Your name</label>
					<input type="text" name="name" id="name" class="form-control" required="1"  value="<?php echo $name; ?>">	
				</div>
				<div class="form-group">
					<label for="username" >Username</label>
					<input type="text" name="username" id="username" class="form-control" required="1" value="<?php echo $username; ?>">	
				</div>
				<div class="form-group">
					<label for="email" >Email Address</label>
					<input type="email" name="email" id="email" class="form-control" required="1" value="<?php echo $email; ?>">	
				</div>
				<div class="form-group">
					<label for="password" >Password</label>
					<input type="password" name="password" id="password" class="form-control" required="1" value="<?php echo $password; ?>">	
				</div>
				<?php 

					$sesid=Session::get("id");
					$id=$_GET['id'];
					if($id==$sesid)

					{ ?>

						<button type="update" class="btn btn-success" name="update" >Update</button>
				<?php	}
				?>
				
			</form>
		</div>
	</div>
</div>


 <?php	

 include 'inc/footer.php';
?>