<?php 
$conn = mysqli_connect('localhost','root','','i2capmarkets');
include "Service_Response.php";

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 $res=array();	
if(isset($_POST['email']))
{
		 $sql = "SELECT * from i2_user where email='".$_POST['email']."'";
         $result = mysqli_query($conn, $sql);
		 $res=array();	
         if (mysqli_num_rows($result) > 0) 
		 {
		 	$res['error'] = false; 
		     $res['message'] = 'User already Exists';
		 }
		 else
		 {
		 	$sql = "INSERT INTO i2_user (name,email,mobile,user_type,password) values ('".$_POST['name']."','".$_POST['email']."',".$_POST['mobile'].",'Investors','".md5($_POST['password'])."')";
         $result = mysqli_query($conn, $sql);
		 $res['error'] = true; 
		 $res['message'] = 'Registered Successfully';
		 } 
         mysqli_close($conn);
 }
 else
 {
 	$res['error'] = true; 
	$res['message'] = 'No parameter';
 }   
	header('Authorization: ApiAuth xyz');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		header("Content-Type:application/json");
		echo json_encode($res);			

				
					
?> 