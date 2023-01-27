<?php
	function sanitizeStr($input){
		$input = htmlspecialchars($input);
		return $input;
	}
?>