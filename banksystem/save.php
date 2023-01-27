<?php
	session_start();
	//connect to database
	include "conn.php";
	include "func.php";
	if(!isset($_SESSION['login'])){
		header("Location: nohack.html");
	}else{
		$checknum = sanitizeStr($_POST['checknum']);
		$amount = sanitizeStr($_POST['amount']);
		$id=($_SESSION["login"]);

		//check database
		$qry = "SELECT * FROM users WHERE userid = ? LIMIT 1";
		$stmt = $conn->prepare($qry);
		$stmt->bind_param("s",$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$arry = $result->fetch_assoc();
		$owner_balance = $arry['balance'];
		
		//deposit
		if(is_numeric($amount) && $amount>0 ){
			//update owner balance
			$qry = "UPDATE bank.users SET balance = ? + ? WHERE userid = ?";
			$stmt = $conn->prepare($qry);
			$stmt->bind_param("dds",$owner_balance,$amount,$id);
			$stmt->execute();	
			//store deposit transaction into record
			$insertsql = "INSERT INTO record(userid,rsource,diff,shijian) VALUES(?,'Check Deposit {$checknum}','+ {$amount}',CURDATE())";
		    $stmt2 = $conn->prepare($insertsql);
		    $stmt2->bind_param("s",$id);
		    $stmt2->execute();
		    header("Location: dmessage.html");
		}
		else{
			header("Location: dmessage2.html");
		}
	}
?>