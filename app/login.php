<?php 
   
/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
	function verifyHashedPassword($password, $hashedPassword)
	{
		return password_verify($password, $hashedPassword) ? true : false;
	}
}

if($_SERVER['REQUEST_METHOD']=='POST'){
		//Getting values 
		$username = $_POST['email'];
		$password = $_POST['password']; 
		
		$sql = "SELECT
  tbl_users.email,
  tbl_users.password,
  tbl_users.name,
  tbl_users.mobile,
  tbl_users.roleId,
  tbl_users.isDeleted,
  tbl_roles.role
FROM tbl_users
  INNER JOIN tbl_roles
    ON tbl_users.roleId = tbl_roles.roleId
WHERE tbl_users.email = '$username'
AND tbl_users.isDeleted = 0"; 
		
		//importing dbConnect.php script 
		require_once('dbConnect.php');
		
		//executing query
		$result = mysqli_query($con,$sql);
		
		//fetching result
		$check = mysqli_fetch_array($result);
		
		//if we got some result 
		if(isset($check)){
			 if(verifyHashedPassword($password, $check['password'])){
			     //displaying success 
			     echo "success";
			 }else{
				 //displaying failure
			     echo "failure"; 
			 }
		}else{
			//displaying failure
			echo "failure";
		}
		mysqli_close($con);
	}