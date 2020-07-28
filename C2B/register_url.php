<?php
require 'access_token.php';
	$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

	$shortCode = '600446'; // provide the short code obtained from your test credentials

	/* This two files are provided in the project. */
	$confirmationUrl = 'https://kokonya.000webhostapp.com/PESA/C2B/confirmation_url.php'; // path to your confirmation url. can be IP address that is publicly accessible or a url
	$validationUrl = 'https://kokonya.000webhostapp.com/PESA/C2B/validation_url.php'; // path to your validation url. can be IP address that is publicly accessible or a url



	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header

#Send request to API and it will save validationUrl & confirmationUrl
#when making reuest it will first check the validationUrl
#
	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'ShortCode' => $shortCode,
	  'ResponseType' => 'Confirmed',
	  'ConfirmationURL' => $confirmationUrl,
	  'ValidationURL' => $validationUrl
	);
      
	$data_string = json_encode($curl_post_data);


	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
	#TRUE to do a regular HTTP POST
	curl_setopt($curl, CURLOPT_POST, true);

	#It returns a pointer to an encoded string that can be passed as postdata
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);

	echo $curl_response;
?>
