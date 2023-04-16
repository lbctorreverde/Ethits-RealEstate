<?php 

function lastChat($id_1, $id_2, $connect){
   
   $sql = "SELECT * FROM tbl_messages
           WHERE (from_id='$id_1' AND to_id='$id_2')
           OR    (to_id='$id_1' AND from_id='$id_2')
           ORDER BY conver_ID DESC LIMIT 1";
    $stmt = $connect->query($sql);

    if (mysqli_num_rows($stmt) > 0) {
    	$chat = mysqli_fetch_assoc($stmt);
    	return $chat['message'];
    }else {
    	$chat = '';
    	return $chat;
    }

}