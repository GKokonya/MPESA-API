<?php

    # if this is your first time, you might need to check the directory 'Tutorial 1'  File first.
    require 'config.php';
    header("Content-Type: application/json");

    #Response where 0 means you have accepted or validated the tansaction
    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Confirmation Received Successfully"
}';

    // Response from M-PESA Stream
    #Receive data using file_get_contents method
    $mpesaResponse = file_get_contents('php://input');

    // log the response
    $logFile = "M_PESAConfirmationResponse.txt";


    #convert a JSON object to a PHP object 
    #true saves data in an array
    $jsonMpesaResponse = json_decode($mpesaResponse, true); // We will then use this to save to database

    $transaction = array(
            ':TransactionType'      => $jsonMpesaResponse['TransactionType'],
            ':TransID'              => $jsonMpesaResponse['TransID'],
            ':TransTime'            => $jsonMpesaResponse['TransTime'],
            ':TransAmount'          => $jsonMpesaResponse['TransAmount'],
            ':BusinessShortCode'    => $jsonMpesaResponse['BusinessShortCode'],
            ':BillRefNumber'        => $jsonMpesaResponse['BillRefNumber'],
            ':InvoiceNumber'        => $jsonMpesaResponse['InvoiceNumber'],
            ':OrgAccountBalance'    => $jsonMpesaResponse['OrgAccountBalance'],
            ':ThirdPartyTransID'    => $jsonMpesaResponse['ThirdPartyTransID'],
            ':MSISDN'               => $jsonMpesaResponse['MSISDN'],
            ':FirstName'            => $jsonMpesaResponse['FirstName'],
            ':MiddleName'           => $jsonMpesaResponse['MiddleName'],
            ':LastName'             => $jsonMpesaResponse['LastName']
    );

    // write to file

		$log = fopen($logFile, "a");

		fwrite($log, $mpesaResponse);
		fclose($log);

		echo $response;

    insert_response($transaction);
?>
