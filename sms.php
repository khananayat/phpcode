<?php
	function sendSMS($message,$mnumber){
		if (function_exists("curl_init")) 
		{
			// initialize a new curl resource
			$ch = curl_init();
			//$baseURL = "https://164.100.14.211/failsafe/HttpLink?username=DGFT.AUTH&pin=Y*53sx%24f";
			$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=DGFT.AUTH&pin=Y*53sx%24f";
			$replyTo = "NICSMS";
			$recipient = $mnumber;
			$messageBody = $message;
			// URL encode message body
			$messageBody = urlencode($messageBody);
			$URI = $baseURL;
			$URI .= "&signature=".$replyTo;
			$URI .= "&mnumber=" . $recipient;
			$URI .= "&message=" . $messageBody;
			// Set URL to connect to
			curl_setopt($ch, CURLOPT_URL, $URI);
			// Set header supression
			curl_setopt($ch, CURLOPT_HEADER, 0);
			// Disable SSL peer verification
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			// Indicate that the message should be returned to a variable
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// Make request
			$content = curl_exec($ch);
			print_r($content);
			curl_close($ch);
		}
		else 
		{
			print("ERROR: curl library is not installed");
		} 
	} 
	$message = "Your OTP is:".rand(0,9);
	$mnumber = "919990157283";
	$returnVal=sendSMS($message,$mnumber);
	print_r($returnVal);
?>