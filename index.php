<?php

	include 'inc/header.php';
	include 'lib/User.php';
	Session::checkSession();
	$user =new User();

	$loginmsg=Session::get("loginmsg");
	if(isset($loginmsg)){
		echo $loginmsg;
		Session::set("loginmsg",NULL);
	}
?> 


<div class="card" style="margin-top: 20px;">
	<div class="card-header">
		<h2>User list <span class="float-right"> <strong>Welcome!</strong>

		<?php
			$name=Session::get("name");
			if(isset($name)){
				echo $name;
			}

		?>  </span> </h2>
	</div>
	<div class="card-body">
		<table class="table table-striped">

			<tr>
				<th width="20%">Serial</th>						
				<th width="20%">Name</th>						
				<th width="20%">Username</th>						
				<th width="20%">Email</th>						
				<th width="20%">Action</th>
			</tr>
			<?php
				$userdata=$user->readAll();
				$i=0;
				foreach ($userdata as $data)
				 {
					$i++; ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $data['name']; ?></td>
						<td><?php echo $data['username']; ?></td>
						<td><?php echo $data['email']; ?></td>
						<td><a class="btn btn-primary" href="profile.php?id=<?php echo $data['id']; ?>">View</a></td>
					</tr>
					
			<?php	}

			?>
					 			
		</table>
	</div>
</div>


<?php	

include 'inc/footer.php';
?>