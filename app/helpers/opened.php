<?php 

function opened($id_1, $connect, $chats){
	$count = count($chats);
	echo $count;
	$i = 0;
	while ($i != $count){
    	if ($chats['opened'] == "0") {
    		$opened = 1;
    		$chat_id = $chats['conver_ID'];

    		$sql = "UPDATE tbl_messages
    		        SET  opened = '".$opened."'
    		        WHERE from_ID= '".$id_1."'
    		        AND conver_ID = '".$chat_id."'";
            $stmt = $connect->query($sql);
    	}else {
			break;
		}
		$i++;
    }
}