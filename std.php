<?php
	ini_set('display_errors', 'Off'); 

	require_once('lib.php');
	require_once('conf.php'); 
        
        $facebook_app_id="936054496413817";
        
	$DBmain = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);
	if($DBmain->connect_error)
		die('Connect Error ( ' . $DBmain->connect_errno . ' ) ' . $DBmain->connect_error); 
	
	$DBmain->query('SET NAMES "utf8"; '); 
	$DBmain->query('SET CHARACTER SET "utf8"; '); 
	$DBmain->query('SET character_set_result = "utf8"; '); 
	$DBmain->query('SET character_set_client = "utf8"; '); 
	$DBmain->query('SET character_set_connection = "utf8"; '); 
	$DBmain->query('SET character_set_database = "utf8"; '); 
	$DBmain->query('SET character_set_server = "utf8"; '); 
	
	

?> 
