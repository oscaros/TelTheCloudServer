<?php
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','tel_the_cloud');
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');