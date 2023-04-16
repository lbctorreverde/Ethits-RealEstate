<?php 

session_start();

# check if the user is logged in
if (isset($_SESSION['user_ID'])) {

	if (isset($_POST['id_2'])) {
	
	# database connection file
	include 'dbconfig.php';

	$id_1  = $_SESSION['user_ID'];
	$id_2  = $_POST['id_2'];
	$opend = 0;

	$sql = "SELECT * FROM tbl_messages
	        WHERE to_ID='".$id_1."'
	        AND   from_ID= '".$id_2."'
	        ORDER BY conver_ID ASC";
	$stmt = $connect->query($sql);

	if (mysqli_num_rows($stmt) > 0) {
	    $chats = mysqli_fetch_all($stmt);
	    # looping through the chats
	    foreach($chats as $chat){
	    	if ($chat[4] == "0") {
	    		
	    		$opened = 1;
	    		$chat_id = $chat[0];

	    		$sql2 = "UPDATE tbl_messages
	    		         SET opened = '".$opened."'
	    		         WHERE conver_ID = '".$chat_id."'";
	    		$stmt2 = $connect->query($sql2);

	            ?>
                   <p style="overflow-wrap: anywhere;" class="ltext border 
		 			        rounded p-2 mb-1">
		 			    <?=$chat[3]?> 
		 			    <small class="d-block">
		 			    	<?=$chat[5]?>
					    </small>      	
		 		  </p>        
	             <?php
	    	}
	    }
	}

 }

}