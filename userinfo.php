<?php 
	//接受code
	if(isset($_GET['code'])){
		echo $_GET['code'];
	}else{
		echo 'no code';
	}
?>