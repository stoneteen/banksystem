<?php
	//will have you report mysqli errors
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try{
		//define a constant
		define("DOMAIN", "localhost");
		define("USERNAME", "root");
		define("PWD", "");
		define("DATABASE", "bank");

		//It requires 4 parameters: domainname, username, password, database
		$conn = new mysqli(DOMAIN, USERNAME, PWD, DATABASE);

		//There is a conflict btw utf8 (up to 4 bytes) on the website and utf8 (2-3 bytes) in the database
		$conn->set_charset("utf8mb4");
	} catch(Exception $e){
		error_log($e->getMessage());
		exit("Error connecting to databases");//print out need information for users
	}
?>