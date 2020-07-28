<?php

  $CallbackResponse = file_get_contents('php://input');
  $logFile = "CallbackResponse.json";

  // will be used when we want to save the response to database for our reference
  $log = fopen($logFile, "a");
  fwrite($log, $CallbackResponse);
  fclose($log);








?>