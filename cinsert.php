<?php 

session_start();

# check if the user is logged in
if (isset($_SESSION['user_ID'])) {

	if (isset($_POST['message']) &&
        isset($_POST['to_id'])) {
	
	# database connection file
	include 'dbconfig.php';

	# get data from XHR request and store them in var
	$message = $_POST['message'];
	$to_id = $_POST['to_id'];

	# get the logged in user's username from the SESSION
	$from_id = $_SESSION['user_ID'];
	if ($_SESSION['enduser'] == 'User') {
		$sql = "UPDATE tbl_chats SET createdAt=CURRENT_TIMESTAMP WHERE usermsg_ID=$from_id AND agentmsg_ID=$to_id";
		$res = $connect->query($sql);
	}else {
		$sql = "UPDATE tbl_chats SET createdAt=CURRENT_TIMESTAMP WHERE agentmsg_ID=$from_id AND usermsg_ID=$to_id";
		$res = $connect->query($sql);
	}
	

	$sql = "INSERT INTO 
	       tbl_messages (from_ID, to_ID, message) 
	       VALUES ('$from_id', '$to_id', '$message')";
	$res = $connect->query($sql);
    
    # if the message inserted
    if ($res) {
    	/** check if this is the first conversation between them **/
		if ($_SESSION['enduser'] == 'User') {
			$sql2 = "SELECT * FROM tbl_chats WHERE (agentmsg_ID=$from_id AND usermsg_ID=$to_id) OR (usermsg_ID=$from_id AND agentmsg_ID=$to_id)";
		}else {
			$sql2 = "SELECT * FROM tbl_chats WHERE (agentmsg_ID=$to_id AND usermsg_ID=$from_id) OR (usermsg_ID=$to_id AND agentmsg_ID=$from_id)";
		}
       $stmt2 = $connect->query($sql2);

	    // setting up the time Zone
		// It Depends on your location or your P.c settings
		define('TIMEZONE', 'Hongkong');
		date_default_timezone_set(TIMEZONE);

		$time = date("d-m-Y h:i a");

		if (mysqli_num_rows($stmt2) == 0 ) {
			# insert them into conversations table 
			if ($_SESSION['enduser'] == 'User') {
				$sql3 = "INSERT INTO tbl_chats(usermsg_ID, agentmsg_ID) VALUES ('$from_id','$to_id')";
			}else{
				$sql3 = "INSERT INTO tbl_chats(agentmsg_ID, usermsg_ID) VALUES ('$from_id','$to_id')";
			}
			$stmt3 = $connect->query($sql3); 
		}
		?>

		<p class="rtext align-self-end
		          border rounded p-2 mb-1">
		    <?=$message?>  
		    <small style="color: #bbb; font-size: 0.7rem; text-align: right;" class="d-block"><?=$time?></small>      	
		</p>

    <?php 
     }
  }
}