<?php
	include "conn.php";
	include "func.php";
	if(isset($_POST['button'])){
		$userid = sanitizeStr($_POST['userid']);
		$pssw = sanitizeStr($_POST['pssw']);

		//fetch from database
		$qry = "SELECT * FROM users WHERE userid = ? LIMIT 1";
		$stmt = $conn->prepare($qry);
		$stmt->bind_param("s",$userid);
		$stmt->execute();
		$result = $stmt->get_result();
		$arry = $result->fetch_assoc();
		$num_rows = $result->num_rows;

		//vertifly password
		if($num_rows > 0 && password_verify($pssw, $arry['pssw'])){
		    session_start();
		    $_SESSION['login'] = $userid;
		    $_SESSION['balance'] = $arry['balance'];
		    $_SESSION['ccbalance'] = $arry['ccbalance'];
		    header("Location: menu.php");
		}else{
		    header("Location: message.html");
		}
	}
	else{
		header("Location: nohack.html");
	}
?>
</p>