<?php
spl_autoload_register(function ($class){
	include "lib/".$class.".php";
});

class User 
{
	private $db;
	
	public function __construct()
	{
		$this->db=new 	Database();
	}

	public function userRegistration($data){
		$name		=  $this->validation($data['name']);
		$username	=  $this->validation($data['username']);
		$email		=  $this->validation($data['email']);
		$password	=  md5($this->validation($data['password']));
		$chk_email  =  $this->emailCheck($email);

		if($name=="" || $username=="" || $email=="" ||$password==""){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Field must not be empty </center></div>";
			return $msg;
		}
		else if(strlen($username)<3){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> User name is too short</center> </div>";
			return $msg;
		}
		else if(preg_match('/[^a-z0-9_-]+/i',$username)){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Username must only contain alphanumerical , dashes and underscores!</center> </div>";
			return $msg;
		}
		else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Email is not valid </center></div>";
			return $msg;
		}
		else if($chk_email==true){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Email already exist</center> </div>";
			return $msg;
		}else{
			$sql="insert into tbl_user(name,username,email,password) values(:name,:username,:email,:password)";
			$query=$this->db->pdo->prepare($sql);
			$query->bindValue(':name',$name);
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':password',$password);
			$res=$query->execute();
			if($res){
				$msg="<div class='alert alert-success'><center><strong>Successful ! </strong> Registration successful</center> </div>";
				//return $msg;
				Session::init();
				Session::set("login",true);
				Session::set("id",$res->id);
				Session::set("name",$name);
				Session::set("username",$username);
				Session::set("email",$email);
				Session::set("loginmsg",$msg);
				header("Location: index.php");
			}
			else{
				$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Registration failed</center> </div>";
				return $msg;
			}
		}
	}
	public function getLoginUser($email,$password){
		$sql="select * from tbl_user where email=:email && password=:password LIMIT 1";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$query->execute();
		$res=$query->fetch(PDO::FETCH_OBJ);
		return $res;
	}
	public function userLogin($data){
		$email		=  $this->validation($data['email']);
		$password	=  md5($this->validation($data['password']));

		$chk_email  =  $this->emailCheck($email);

		if( $email=="" ||$password==""){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Field must not be empty </center></div>";
			return $msg;
		}
		else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Email is not valid </center></div>";
			return $msg;
		}
		else if($chk_email==false){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> User does not exist</center> </div>";
			return $msg;
		}else{
			$data=$this->getLoginUser($email,$password);
			if($data){
				$msg="<div class='alert alert-success'><center><strong>Successful ! </strong> You  are loged in</center> </div>";
				Session::init();
				Session::set("login",true);
				Session::set("id",$data->id);
				Session::set("name",$data->name);
				Session::set("username",$data->username);
				Session::set("email",$data->email);
				Session::set("loginmsg",$msg);
				header("Location: index.php");
			}
			else{
				$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Email or password does not match</center> </div>";
				return $msg;
			}

		}

	}
	public function validation($data){
		$data=htmlspecialchars(trim($data));
		return $data;
	}
	public function emailCheck($email){
		$sql="select email from tbl_user where email=:email";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->execute();
		if($query->rowCount()> 0){
			return true;
		}
		else{
			return false;
		}
	}
	public function readAll(){
		$sql="select * from tbl_user order by id desc";
		$query=$this->db->pdo->prepare($sql);
		$query->execute();
		$res=$query->fetchAll();
		return $res;
	}
	public function readById($id){
		$sql="select * from tbl_user where id=:id";
		$query=$this->db->pdo->prepare($sql);
		$query->bindValue(':id',$id);
		$query->execute();
		$res=$query->fetch(PDO::FETCH_OBJ);
		return $res;
	}
	public function userUpdate($id,$data){
		$name		=  $this->validation($data['name']);
		$username	=  $this->validation($data['username']);
		$email		=  $this->validation($data['email']);
		$password	=  md5($this->validation($data['password']));
		$chk_email  =  $this->emailCheck($email);

		if($name=="" || $username=="" || $email=="" ||$password==""){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Field must not be empty </center></div>";
			return $msg;
		}
		else if(strlen($username)<3){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> User name is too short</center> </div>";
			return $msg;
		}
		else if(preg_match('/[^a-z0-9_-]+/i',$username)){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Username must only contain alphanumerical , dashes and underscores!</center> </div>";
			return $msg;
		}
		else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
			$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Email is not valid </center></div>";
			return $msg;
		}
		else{
			$sql="update tbl_user set name=:name,username=:username,email=:email,password=:password where id=:id";
			$query=$this->db->pdo->prepare($sql);
			$query->bindValue(':name',$name);
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':password',$password);
			$query->bindValue(':id',$id);
			$res=$query->execute();
			if($res){
				$msg="<div class='alert alert-success'><center><strong>Successful ! </strong> Update successfully</center> </div>";
				//return $msg;
				Session::init();
				Session::set("login",true);
				Session::set("id",$id);
				Session::set("name",$name);
				Session::set("username",$username);
				Session::set("email",$email);
				Session::set("loginmsg",$msg);
				header("Location: index.php");
			}
			else{
				$msg="<div class='alert alert-danger'><center><strong>Error ! </strong> Update failed</center> </div>";
				return $msg;
			}

	}
}
}

?>