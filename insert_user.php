<?php
include("includes/connection.php");
if(isset($_POST['sign_up'])){
	$first_name=htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
	$last_name=htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
	$email=htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
	$pass=htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
	$country=htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
	$gender=htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
	$birthday=htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
	$status="varified";
	$posts="no";
	$newgid=sprintf('%05d' ,rand(0,999999));
	$username=strtolower($first_name."_".$last_name."_".$newgid);
	$check_username_query="select user_name from users where user_email='$email'";
	$run_username= mysqli_query($con,$check_username_query);
	if(strlen($pass)<9){
		echo"<script>alert('Password should be minimum 9 characters')</script>";
		exit();
	}
	$check_email="select*from users where user_email='$email'";
	$run_email=mysqli_query($check_email);
	$check=mysqli_num_rows($run_email);
	if($check==1){
		echo"<script>alert('Email already exixts, pls try using another email')</script>";
		echo"<script>window.open('signup.php','_self')</script>";
		exit();
	}
	$rand=rand(1, 3);//for random no 1-3
	if($rand==1)
		$profile_pic="head_red.png";
	else if ($rand==2)
		$profile_pic="head_sunflower.png";
	else if ($rand==3)
		$profile_pic="head_turtoise.png";

	$insert="insert into users(f_name,l_name,user_name,describe_user,Relationship,user_email,user_pass,
user_country,user_gender,user_birthday,user_image,user_cover,user_reg_date,status,posts,recovery_account)values('$first_name','$last_name','$username','Hello Connect It this is my default status !','...','$email','$pass','$country','$gender','$birthday','$profile_pic','default_cover.jpg',NOW(),'$status','$posts','Iwanttoputadingintheuniverse.')";
$query= mysqli_query($con,$insert);
if($query){
	echo "<script>alert('Well done $first_name, You are good to go ')</script>";
	echo"<script>window.open('signin.php','_self')</script>";
}
else{
	echo "<script>alert('Registration failed pls try again ')</script>";
	echo"<script>window.open('signup.php','_self')</script>";
}
}





?>