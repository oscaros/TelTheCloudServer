<?php
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','oscaros');
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');