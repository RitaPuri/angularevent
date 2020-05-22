<?php 
$conn = mysqli_connect('localhost','root','','i2capmarkets');
include "Service_Response.php";

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$res=array();
$doc_res=array();
$s=new HoldingResponseList();	
if(isset($_GET['id']) and isset($_GET['userId']))
{
			$sql="select * from i2_holdings where eventId=".$_GET['id']." and custodian=".$_GET['userId']."";
			$rs =mysqli_query($conn,$sql);	
			$i=0;
			while($row = mysqli_fetch_array($rs))
			{
			
			$event=new HoldingDetailsList();
			$event->holdingId=$row['id'];
			$event->holdingName=$row['holdingName'];
			$event->HoldingEmail=$row['email'];
			$event->HoldingContact=$row['mobile'];
			$event->holdingISIN=$row['holdingNumber'];
			$event->HoldingAmount=$row['amount'];
			$event->custodian=$row['custodian'];
			$event->HoldingClearingsystem=$row['clearingSystem'];
			$event->HoldingAcountNumber=$row['accountNumber'];
			$event->HoldingDocument=$row['holdingDocument'];
			$event->HoldingStatus=$row['holdingStatus'];
			$res[$i]=$event;
			$i=$i+1;
			}	
					
			//	$s->holdingDetails=$hold_count;
				$s->HoldingDetailsList=$res;
				$s->status=true;
				$s->message="Successfull";		
}							
		

	  header('Authorization: ApiAuth xyz');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
	  header("Content-Type:application/json");
	echo json_encode($s);			
		

				
					
?> 