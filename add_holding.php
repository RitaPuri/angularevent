<?php 

include "connect.php";

include "Service_Response.php";

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 $res=array();	
if(isset($_POST['b_email']) and isset($_POST['b_name']) and isset($_POST['b_contact']) and isset($_POST['b_isin']) and isset($_POST['b_amount']) and isset($_POST['b_clearing_system']) and isset($_POST['b_clearing_system_account']) and isset($_POST['b_event_id']) and isset($_POST['user_id']) and $_POST['b_email']!='' and $_POST['b_name']!='' and $_POST['b_contact']!='' and $_POST['b_amount']!='' and $_POST['b_clearing_system_account']!='' and $_POST['b_event_id']!='' and $_POST['user_id']!='' and $_POST['eventType']=='Holder' )
{

		 	$sql = "INSERT INTO i2_holdings (eventId,holdingName,email,mobile,holdingNumber,amount,clearingSystem,accountNumber,custodian) values (".$_POST['b_event_id'].",'".$_POST['b_name']."','".$_POST['b_email']."',".$_POST['b_contact'].",".$_POST['b_isin'].",".$_POST['b_amount'].",'".$_POST['b_clearing_system']."',".$_POST['b_clearing_system_account'].",".$_POST['user_id'].")";
			
			
         $result = mysqli_query($conn, $sql);
		 $id=mysqli_insert_id($conn);
		 
		$time=time();
		$ext = pathinfo($_FILES['documentUpload']['name'], PATHINFO_EXTENSION);
		$filename=pathinfo($_FILES['documentUpload']['name'], PATHINFO_FILENAME);
		move_uploaded_file($_FILES['documentUpload']['tmp_name'], 'uploads/'.$filename.'_'.$time.'.'.$ext);
					
		$doc= $filename.'_'.$time.'.'.$ext;
	    $sql_update="update i2_holdings set holdingDocument='".$doc."' where id=".$id."";
		 $result_update = mysqli_query($conn, $sql_update);
		
		 if($result)
		 {
		 	$res['status'] = true; 
		    $res['message'] = 'Added Successfully';
		 }
		 else
		 {
		 	$res['status'] = false; 
		    $res['message'] = 'Something Went Wrong';
		 }
         mysqli_close($conn);
 }
 else if(isset($_POST['b_email']) and isset($_POST['b_name']) and isset($_POST['b_contact']) and isset($_POST['b_event_id']) and isset($_POST['user_id']) and $_POST['eventType']=='Lender')
{
 
		 	$sql = "INSERT INTO i2_holdings (eventId,holdingName,email,mobile,custodian) values (".$_POST['b_event_id'].",'".$_POST['b_name']."','".$_POST['b_email']."',".$_POST['b_contact'].",".$_POST['user_id'].")";
	
         $result = mysqli_query($conn, $sql);
		
		 
		 if($result)
		 {
		 	$res['status'] = true; 
		    $res['message'] = 'Added Successfully';
		 }
		 else
		 {
		 	$res['status'] = false; 
		    $res['message'] = 'Something Went Wrong';
		 }
		 
         mysqli_close($conn);
 }   
 else
 {
 	   $res['status'] = false; 
		 $res['message'] = 'Something Went Wrong';
 }
	  header('Authorization: ApiAuth xyz');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
	  header("Content-Type:application/json");
	  echo json_encode($res);			

				
					
?> 