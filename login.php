<?php 
	header('Authorization: ApiAuth xyz');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		header("Content-Type:application/json");
$conn = mysqli_connect('localhost','root','','i2capmarkets');
include "Service_Response.php";

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
		 $sql = "SELECT * from i2_user where email='".$_POST['email']."'and password='".md5($_POST['password'])."'";
         $result = mysqli_query($conn, $sql);
		 $user=new User_login();
		 $res=array();	
         if (mysqli_num_rows($result) > 0) 
		 {
		 $i=0;
		 	 while($row = mysqli_fetch_assoc($result))
			 {
		     $user->user_id=$row['id'];
			 $user->name=$row['name'];
		 	 $user->status = true; 
		     $user->message = 'Successful';
			 $res[$i]=$user;
			  $i=$i+1;

			 }
		 }
		 else
		 {
		 	 $res['status'] = false; 
		     $res['message'] = 'invalid login credentials';
		 } 
         mysqli_close($conn);
    
		echo json_encode($res);			

				
					
?> 