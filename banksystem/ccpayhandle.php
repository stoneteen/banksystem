<?php
	session_start();
	//connect to database
	include "conn.php";
	include "func.php";
	if(!isset($_SESSION['login'])){
		header("Location: nohack.html");
    }else{
		$paybalance = sanitizeStr($_POST['balance']);
		$id=($_SESSION["login"]);

		//get owner balance status
		$qry = "SELECT * FROM users WHERE userid = ? LIMIT 1";
		$stmt = $conn->prepare($qry);
		$stmt->bind_param("s",$id);
		$stmt->execute();
		$result = $stmt->get_result();
		$arry = $result->fetch_assoc();
		$owner_balance = $arry['ccbalance'];

		//check if owner have enough balance
		if(($owner_balance-$paybalance)<0 || $paybalance<35){
			header("Location: ccpaymessage2.html");
		}
		else{
			//update owner balance
			$qry = "UPDATE bank.users SET ccbalance = ? - ? WHERE userid = ?";
			$stmt = $conn->prepare($qry);
			$stmt->bind_param("dds",$owner_balance,$paybalance,$id);
			$stmt->execute();
			

			$qry = "UPDATE bank.users SET balance = balance - ? WHERE userid = ?";
			$stmt = $conn->prepare($qry);
			$stmt->bind_param("ds",$paybalance,$id);
			$stmt->execute();	
			
			//store debit record
			$insertsql = "INSERT INTO record(userid,rsource,diff,shijian) VALUES(?,'Pay Credit Card Statement','- {$paybalance}',CURDATE())";
		    $stmt2 = $conn->prepare($insertsql);
		    $stmt2->bind_param("s",$id);
		    $stmt2->execute();

		    //store cc record
			$insertsql = "INSERT INTO ccrecord(userid,rsource,diff,shijian) VALUES(?,'Pay Credit Card Statement','- {$paybalance}',CURDATE())";
		    $stmt2 = $conn->prepare($insertsql);
		    $stmt2->bind_param("s",$id);
		    $stmt2->execute();

			header("Location: ccpaymessage.html");
		}
} ?>	