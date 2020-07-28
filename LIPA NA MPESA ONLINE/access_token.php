<?php 
 

    #Credentials
	$consumerKey = '7CAxsXwj9Nk52oh4GGejBnaJPpPSbxt8'; //Fill with your app Consumer Key
	$consumerSecret = '3AdKdrdtgvLLX1WK'; // Fill with your app Secret


	$headers = ['Content-Type:application/json; charset=utf8'];

	$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

     #Intialize Curl Session
	$curl = curl_init($url);

	#Set Option  for curl session
	#Set option take 3 parameters i.e curl session variable, Curl options, value 
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

   
	#return page contents. If set 0 then no output will be returned.
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

	#TRUE to include the header in the output. 
	curl_setopt($curl, CURLOPT_HEADER, 0);

	#A username and password to use for the connection. 
	curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

	#rab URL and pass it to the variable for showing output
	$result = curl_exec($curl);

    #curl_getinfo Gets information about the last transfer. 
	#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	#Return result in json format
	$result = json_decode($result);

	$access_token = $result->access_token;

	#echo $access_token;
	
	curl_close($curl);
?>
