<?php 

function getChats($id_1, $id_2, $connect){
   
   $sql = "SELECT * FROM tbl_messages WHERE (from_ID='$id_1' AND to_ID='$id_2') 
   OR (to_ID='$id_1' AND from_ID='$id_2') ORDER BY conver_ID ASC";
    $stmt = $connect->query($sql);

    if (mysqli_num_rows($stmt) > 0) {
    	$chats = mysqli_fetch_all($stmt);
    	return $chats;
    }else {
    	$chats = [];
    	return $chats;
    }

}