<?php
		session_start();
		//connect to database
		include "conn.php";
		include "func.php";
		if(!isset($_SESSION['login'])){
			header("Location: nohack.html");
	    }else{
			$userid = sanitizeStr($_POST['userid']);
			$tranbalance = sanitizeStr($_POST['balance']);
			$id=($_SESSION["login"]);

			//get owner balance status
			$qry = "SELECT * FROM users WHERE userid = ? LIMIT 1";
			$stmt = $conn->prepare($qry);
			$stmt->bind_param("s",$id);
			$stmt->execute();
			$result = $stmt->get_result();
			$arry = $result->fetch_assoc();
			$owner_balance = $arry['balance'];

			//reciver balance status
			$qry2 = "SELECT * FROM users WHERE userid = ? LIMIT 1";
			$stmt2 = $conn->prepare($qry2);
			$stmt2->bind_param("s",$userid);
			$stmt2->execute();
			$result2 = $stmt2->get_result();
			$arry2 = $result2->fetch_assoc();
			$num_rows = $result2->num_rows;

			//check if user exists
			if($num_rows>0 && $userid!= $id){
				//check if owner have enough balance
				if(($owner_balance-$tranbalance)<0 || $owner_balance<$tranbalance){
					header("Location: tmessage.html");
				}
				else{
					$reciver_balance = $arry2['balance'];
					//update reciver balance
					$qry = "UPDATE bank.users SET balance = ? + ? WHERE userid = ?";
					$stmt = $conn->prepare($qry);
					$stmt->bind_param("dds",$reciver_balance,$tranbalance,$userid);
					$stmt->execute();

					//store reciver transfer transaction into record
					$insertsql = "INSERT INTO record(userid,rsource,diff,shijian) VALUES(?,'Recive from {$id}','+ {$tranbalance}',CURDATE())";
				    $stmt2 = $conn->prepare($insertsql);
				    $stmt2->bind_param("s",$userid);
				    $stmt2->execute();

					//update owner balance
					$qry = "UPDATE bank.users SET balance = ? - ? WHERE userid = ?";
					$stmt = $conn->prepare($qry);
					$stmt->bind_param("dds",$owner_balance,$tranbalance,$id);
					$stmt->execute();	
					
					//store owner transfer transaction into record
					$insertsql = "INSERT INTO record(userid,rsource,diff,shijian) VALUES(?,'Transfer to {$userid}','- {$tranbalance}',CURDATE())";
				    $stmt2 = $conn->prepare($insertsql);
				    $stmt2->bind_param("s",$id);
				    $stmt2->execute();
				    
				    header("Location: tmessage2.html");
				}
			}
			else{
				 header("Location: tmessage3.html");
			}	
} ?>