<?php 
include "connect.php";
include "Service_Response.php";

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
         $sql = 'SELECT * from i2_events where is_published=1 and start_date>=CURDATE()';
         $result = mysqli_query($conn, $sql);
		 $res=array();	
         if (mysqli_num_rows($result) > 0) 
		 {
		 $i=0;
		 
            while($row = mysqli_fetch_assoc($result))
			 {
			          $s=new EventResponse();
			            $s->id= $row['id'];	
						$s->name= $row['name'];	
						$s->logo= $row['logo'];	
						$s->public_description=$row['public_description'];	
						$s->start_date=date('M d,Y',strtotime($row['start_date']));
						$res[$i]=$s;
						$i=$i+1;
            }
         } 
		
         mysqli_close($conn);
	
		header("Content-Type:application/json");
		echo json_encode($res);			

				
					
?> 