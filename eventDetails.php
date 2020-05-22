<?php 
include "connect.php";

include "Service_Response.php";

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$res=array();
$doc_res=array();
$doc_section=array();
$hold_count=0;
$sql_approve_count=0;
$s=new EventResponseDetails();	
if(isset($_GET['id']) and isset($_GET['userId']))
{
			$sql_hold="select * from i2_holdings where eventId=".$_GET['id']." and custodian=".$_GET['userId']."";
			$hold_count = mysqli_num_rows(mysqli_query($conn,$sql_hold));	
			
			$sql_approve="select * from i2_holdings where eventId=".$_GET['id']." and custodian=".$_GET['userId']." and isApproved=1";
			$sql_approve_count = mysqli_num_rows(mysqli_query($conn,$sql_approve));	
			if($sql_approve_count>0)
			{
			
			$sql_approve_count=1;
			}
			else
			{
			
			$sql_approve_count=0;
			}
			
			$sql="select * from i2_events where id=".$_GET["id"]."";
			$rs = mysqli_query($conn,$sql);
			$i=0;
			
			while($row = mysqli_fetch_array($rs))
			{
			
			$event=new EventDetails();
			$event->eventId=$row['id'];
			$event->eventType=$row['event_type'];
			$event->eventName=$row['name'];
			$event->publicDescription=$row['public_description'];
			$event->logo=$row['logo'];
			$event->startDate=date('M d,Y',strtotime($row['start_date']));
			$event->endDate=date('M d,Y',strtotime($row['end_date']));
			$event->termsCondition=$row['terms_condition'];
			$event->holdingNumber=$row['holding_number'];
			$event->clearingSystem=$row['clearing_system'];
			$event->privateDescription=$row['private_description'];
			$event->holdingCount=$hold_count;
			$event->isApproved=$sql_approve_count;
			$i=$i+1;
			}	
			
			if($i==1)
			{
				/////Holding Detais///
				/*	$sql="select * from i2_holdings where eventId=".$_GET['id']." and custodian=".$_GET['userId']."";
					$rs = mysqli_query($conn,$sql);
					$j=0;
					while($row = mysqli_fetch_array($rs))
					{
						$holding=new HoldingDetails();
						$holding->holdingName=$row["holdingName"];
						$holding->mobile=$row["mobile"];
						$holding->email=$row["email"];
						$holding->holding_number=$row["holdingNumber"];
						$holding->amount=$row["amount"];
						$holding->custodian=$row["custodian"];
						$holding->clearing_system=$row["clearingSystem"];
						$holding->acount_number=$row["accountNumber"];
					
						$res[$j]=$holding;
						$j=$j+1;
						
						
					}*/
					///////documents details
					/*$sql="select * from i2_event_documents where event_id=".$_GET['id']."";
					$rs = mysqli_query($conn,$sql);
					$k=0;
					while($row = mysqli_fetch_array($rs))
					{
						$doc=new DocumentDetails();
						$doc->docId=$row["id"];
						$doc->documentTitle=$row["documentTitle"];
						$doc->documentDescription=$row["documentDescription"];
						$doc->documentSignature=$row["documentSignature"];
						$doc->documentUpload=$row["documentUpload"];
						$doc->documentSection=$row["documentSection"];
						
					
						$doc_res[$k]=$doc;
						$k=$k+1;
						
						
					}
					
				*/
				///////documents details
					$sqldoc="select * from i2_event_documents where event_id=".$_GET['id']." group by documentSection";
					
					$rs_doc = mysqli_query($conn,$sqldoc);
					if (mysqli_num_rows($rs_doc) > 0) 
					{
						$j=0;
						
						while($r = mysqli_fetch_array($rs_doc))
						{
						
							/////////////////////////////
							$sql_sec="select * from i2_event_documents where event_id=".$_GET['id']." and documentSection='".$r['documentSection']."'";
						
							$rs_sec = mysqli_query($conn,$sql_sec);
							
							$x=0;	
							$doc=new DocumentSectionDetails();
							while($r_sec = mysqli_fetch_array($rs_sec))
							{	
							
							$doc->docId=$r_sec["id"];
							$doc->documentTitle=$r_sec["documentTitle"];
							$doc->documentDescription=$r_sec["documentDescription"];
							$doc->documentSignature=$r_sec["documentSignature"];
							$doc->documentUpload=$r_sec["documentUpload"];
							$doc_res[$x]=$doc;
							$x=$x+1;
							
							
							}
							
							////////////////////////
								
							$d=new DocumentDetails();
							$d->documentSection=$r["documentSection"];
							$d->documentSectionDetails=$doc_res;
							$doc_section[$j]=$d;
							$j=$j+1;
							
								
						}
						
					
					}
				
					
					$s->eventDetails=$event;
					$s->status=true;
					$s->message="Successfull";
				//	$s->holdingDetails=$hold_count;
					$s->documentDetails=$doc_section;
			}
			else
			{	
				$s->status=false;
				$s->message="Something went wrong";
			}

}
else
{

			
			$sql_hold="select * from i2_holdings where eventId=".$_GET['id']."";
			$hold_count = mysqli_num_rows(mysqli_query($conn,$sql_hold));
			
	        $sql_event="select * from i2_events where id=".$_GET["id"]."";
			$rs_event = mysqli_query($conn,$sql_event);
			
			
			$sql_approve="select * from i2_holdings where eventId=".$_GET['id']." and isApproved=1";
			$sql_approve_count = mysqli_num_rows(mysqli_query($conn,$sql_approve));	
			if($sql_approve_count>0)
			{
			$sql_approve_count=1;
			}
			else
			{
			$sql_approve_count=0;
			}
			
			$i=0;
			$event=new EventDetails();
			while($row = mysqli_fetch_array($rs_event))
			{
						
			$event=new EventDetails();
			$event->eventId=$row['id'];
			$event->eventType=$row['event_type'];
			$event->eventName=$row['name'];
			$event->publicDescription=$row['public_description'];
			$event->logo=$row['logo'];
			$event->startDate=date('M d,Y',strtotime($row['start_date']));
			$event->endDate=date('M d,Y',strtotime($row['end_date']));
			$event->termsCondition=$row['terms_condition'];
			$event->holdingNumber=$row['holding_number'];
			$event->clearingSystem=$row['clearing_system'];
			$event->privateDescription=$row['private_description'];
			$event->holdingCount=0;
			$event->isApproved=0;
			$i=$i+1;
			}	
			if($i==1)
			{
				
					///////documents details
					/*$sql="select * from i2_event_documents where event_id=".$_GET['id']."";
					$rs = mysqli_query($conn,$sql);
					$k=0;
					while($row = mysqli_fetch_array($rs))
					{
						$doc=new DocumentDetails();
						$doc->docId=$row["id"];
						$doc->documentTitle=$row["documentTitle"];
						$doc->documentDescription=$row["documentDescription"];
						$doc->documentSignature=$row["documentSignature"];
						$doc->documentUpload=$row["documentUpload"];
						$doc->documentSection=$row["documentSection"];
						
					
						$doc_res[$k]=$doc;
						$k=$k+1;
						
						
					}*/
					///////documents details
					$sqldoc="select * from i2_event_documents where event_id=".$_GET['id']." group by documentSection";
					
					$rs_doc = mysqli_query($conn,$sqldoc);
					if (mysqli_num_rows($rs_doc) > 0) 
					{
						$j=0;
						
						while($r = mysqli_fetch_array($rs_doc))
						{
						
							/////////////////////////////
							$sql_sec="select * from i2_event_documents where event_id=".$_GET['id']." and documentSection='".$r['documentSection']."'";
						
							$rs_sec = mysqli_query($conn,$sql_sec);
							
							$x=0;	
							$doc=new DocumentSectionDetails();
							while($r_sec = mysqli_fetch_array($rs_sec))
							{	
							
							$doc->docId=$r_sec["id"];
							$doc->documentTitle=$r_sec["documentTitle"];
							$doc->documentDescription=$r_sec["documentDescription"];
							$doc->documentSignature=$r_sec["documentSignature"];
							$doc->documentUpload=$r_sec["documentUpload"];
							$doc_res[$x]=$doc;
							$x=$x+1;
							
							
							}
							
							////////////////////////
								
							$d=new DocumentDetails();
							$d->documentSection=$r["documentSection"];
							$d->documentSectionDetails=$doc_res;
							$doc_section[$j]=$d;
							$j=$j+1;
							
								
						}
						
					
					}
				
					
				$s->eventDetails=$event;
			//	$s->holdingDetails=$hold_count;
				$s->documentDetails=$doc_section;
				$s->status=true;
				$s->message="Successfull";		
							
			}
			else
			{
			
			$s->status=true;
			$s->message="Successfull";					
			}
		//	print_r($s);
      mysqli_close($conn);		
}		
		

	
	  header("Content-Type:application/json");
	echo json_encode($s);			
		

				
					
?> 