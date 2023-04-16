<?php 

function getConversation($user_id, $connect){
    /** Getting all the conversations for current (logged in) user **/
    // $sql = "SELECT * FROM tbl_chats
    // WHERE agentmsg_ID='$user_id' OR usermsg_ID=$user_id
    // ORDER BY chat_ID DESC";
    if ($_SESSION['enduser'] == 'User') {
      $sql = "SELECT * FROM tbl_chats
      WHERE usermsg_ID=$user_id
      ORDER BY createdAt DESC";
    }else {
      $sql = "SELECT * FROM tbl_chats
      WHERE agentmsg_ID=$user_id
      ORDER BY createdAt DESC";
    }
    

    $conversations = $connect->query($sql);

    if(mysqli_num_rows($conversations) > 0){
        /**creating empty array to 
        store the user conversation
        **/
        $i = 0;
        # looping through the conversations
        while($conversation = $conversations->fetch_assoc()){
            # if conversations agentmsg_ID row equal to user_id
            if ($conversation['agentmsg_ID'] == $user_id) {
            	$user2 = $conversation['usermsg_ID'];
            	$sql2  = "SELECT * FROM tbl_user WHERE user_ID='$user2'";
            	$stmt2 = $connect->query($sql2);
            }else {
            	$user1 = $conversation['agentmsg_ID'];
            	$sql2  = "SELECT * FROM tbl_agent WHERE agent_ID='$user1'";
            	$stmt2 = $connect->query($sql2);
            }

            $allConversations = $stmt2->fetch_assoc();
            
            # pushing the data into the array
            $user_data[$i] = $allConversations;
            $i++;
        }

        return $user_data;

    }else {
    	$conversations = [];
    	return $conversations;
    }  

}