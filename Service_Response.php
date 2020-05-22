<?php 
	Class EventResponse
	{
		var $id;
		var $name;
		var $logo;
		var $public_description;
		var $start_date;
		var $status;
		var $message;
	}
	Class HoldingResponse
	{
		var $id;
		var $event_id;
		var $user_id;
		var $holding_name;
		var $status;
		var $message;
	}
	
	Class HoldingResponseList
	{
		var $HoldingDetailsList;
		var $status;
		var $message;
		
	}
	Class HoldingDetailsList
	{
		var $holdingId;
		var $holdingName;
		var $HoldingEmail;
		var $HoldingContact;
		var $holdingISIN;
		var $HoldingAmount;
		var $custodian;
		var $HoldingClearingsystem;
		var $HoldingAcountNumber;
		var $HoldingDocument;
		var $HoldingStatus;
		
	}
	
	Class User_login
	{
		var $user_id;
		var $name;
		var $email;
		var $password;
		var $user_type;
		var $status;
		var $message;
		
	}
	
	Class HoldingDetails
	{
		var $holdingName;
		var $email;
		var $mobile;
		var $holding_number;
		var $amount;
		var $custodian;
		var $clearing_system;
		var $acount_number;
		
		
	}
	Class EventResponseDetails
	{
		
		var $eventDetails;
		var $documentDetails;
		var $status;
		var $message;
	}
	
	Class EventDetails
	{
		var $eventId;
		var $eventType;
		var $eventName;
		var $publicDescription;
		var $logo;
		var $startDate;
		var $endDate;
		var $privateDescription;
		var $termsCondition;
		var $holdingNumber;
		var $clearingSystem;
		var $holdingCount;
		var $isApproved;

	}
	
	Class DocumentDetails
	{
		var $documentSection;
		var $documentSectionDetails;
		
	}
	
	Class DocumentSectionDetails
	{
		var $docId;
		var $documentTitle;
		var $documentDescription;
		var $documentSignature;
		var $documentUpload;
		
	}
?>