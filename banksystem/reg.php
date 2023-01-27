<?php
	include "conn.php";
	include "func.php";
    if(isset($_POST['button'])){
    	$userid = sanitizeStr($_POST['userid']);
    	$pssw = sanitizeStr($_POST['pssw']);

        //Get the rows number
    	$CheckQ = "SELECT * FROM USERS WHERE userid = ? LIMIT 1 ";
        $stmt = $conn->prepare($CheckQ);
        $stmt->bind_param("s",$userid);
        $stmt->execute(); 
        $result = $stmt->get_result();

        //if the row existed
        if($result->num_rows > 0){
           header("Location: regmessage.html");
        } else{
            $insertsql = "INSERT INTO users(userid,pssw) VALUES(?,?)";
            //hash the password
            $hashed_pwd = password_hash($pssw, PASSWORD_DEFAULT);
            $stmt2 = $conn->prepare($insertsql);
            $stmt2->bind_param("ss",$userid,$hashed_pwd);
            $stmt2->execute();
            header("Location: regmessage2.html");
        }
    }else{
        header("Location: nohack.html");
    }
?>