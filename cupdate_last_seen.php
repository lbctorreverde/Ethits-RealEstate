<?php  

session_start();

# check if the user is logged in
if (isset($_SESSION['enduser'])) {
	
	# database connection file
	include 'dbconfig.php';

	# get the logged in user's username from SESSION
	$id = $_SESSION['user_ID'];

	if($_SESSION['enduser']=='User'){
		$sql = "UPDATE tbl_agent
	        SET last_seen = NOW() 
	        WHERE user_ID = $id";
	}else {
		$sql = "UPDATE tbl_user
	        SET last_seen = NOW() 
	        WHERE agent_ID = $id";
	}
	$res = $connect->query($sql);
	
}else {
	header("Location: ../../index.php");
	exit;
}
?>
<script>
	console.log('AAAA');
</script>