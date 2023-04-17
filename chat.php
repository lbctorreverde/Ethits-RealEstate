<?php 
  session_start();
if(isset($_POST['filter'])){ 
  	# database connection file
  	include 'dbconfig.php';

  	include 'app/helpers/chat.php';
  	include 'app/helpers/opened.php';
  	include 'app/helpers/timeAgo.php';

  	// if (!isset($_GET['user'])) {
  	// 	header("Location: home.php");
  	// 	exit;
  	// }
	
	$id = $_POST['filter'];
  	# Getting User data data
	if($_SESSION['enduser']== 'User'){
		$query   = $connect->query("SELECT * FROM tbl_agent Where fName= '".$id."'");
		$chatWith  = $query->fetch_assoc(); 
		$idd = $chatWith['agent_ID'];
	}else{
		$query   = $connect->query("SELECT * FROM tbl_user Where fName= '".$id."'");
		$chatWith  = $query->fetch_assoc(); 
		$idd = $chatWith['user_ID'];
	}

  	if (empty($chatWith)) {
  		header("Location: home.php");
  		exit;
  	}

	if($_SESSION['enduser']=='User'){
		$chats = getChats($_SESSION['user_ID'], $chatWith['agent_ID'], $connect);
		$count = count($chats);
		//opened($chatWith['agent_ID'], $connect, $chats);
	}else{
		$chats = getChats($_SESSION['user_ID'], $chatWith['user_ID'], $connect);
		$count = count($chats);
		//opened($chatWith['user_ID'], $connect, $chats);
	}

?>

	<link rel="icon" href="img/logo.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
		function chat() {
			// let filter = $('#all').val();
			$.ajax({
			type: 'POST',	
			url: 'chome.php',
			success: function (html) {
				$('#chatResult').html(html);
				document.getElementById("chatForm").style.display = "block";
			}
			});
		}
	</script>
	<link rel="stylesheet" href="css/chatstyle.css">
	<link rel="stylesheet" href="css/chat.css">
	<style>
		/* The popup chat - hidden by default */
		.chat-popup {
		display: block;
		position: fixed;
		bottom: 0;
		right: 15px;
		z-index: 9;
		}
	</style>

<body>
<div id='chatResult'>
<button class="btn_open" onclick="openForm()">Chat</button>

<div class="chat-popup" id="chatForm">
<div id="form-container" class="form-container">
    <div class="w-300 rounded">
		   <button class="btnAll" style="background-color: white;" name="all" id="all" onclick="chat()"><i class='bx bx-arrow-back'></i></button>
    	   <div class="d-flex align-items-center">
		   	<?php 
				echo '<img src="data:image/jpeg;base64,'.base64_encode($chatWith['displayImg']).'" class="w-25 rounded-circle">';
				?>

               <h3 class="display-4 fs-sm m-2">
               	  <?=$chatWith['lName'].", ".$chatWith['fName']?> <br>
               	  <div class="d-flex
               	              align-items-center"
               	        title="online">
               	    <?php
                        if (last_seen($chatWith['last_seen']) == "Active") {
               	    ?>
               	        <div class="online"></div>
               	        <small id="small" class="d-block p-1">Online</small>
               	  	<?php }else{ ?>
               	         <small id="small" class="d-block p-1">
               	         	Last seen:
               	         	<?=last_seen($chatWith['last_seen'])?>
               	         </small>
               	  	<?php } ?>
               	  </div>
               </h3>
    	   </div>

    	   <div class="shadow p-4 rounded
    	               d-flex flex-column
    	               mt-2 chat-box"
    	        id="chatBox">
    	        <?php 
                     if (!empty($chats)) {
                     foreach($chats as $chat){
                     	if($chat[1] == $_SESSION['user_ID'])
							{ ?>
							<p style="overflow-wrap: anywhere;" id="rightChat" class="rtext align-self-end
									border rounded p-2 mb-1">
								<?=$chat[3]?> 
								<small id="small" class="d-block">
									<?php echo date("d-m-Y h:i a", strtotime($chat[5]))?>
								</small>      	
							</p>
						<?php }else{ ?>
						<p style="overflow-wrap: anywhere;" id="leftChat" class="ltext border 
								rounded p-2 mb-1">
							<?=$chat[3]?> 
							<small id="small" class="d-block">
								<?php echo date("d-m-Y h:i a", strtotime($chat[5]))?>
							</small>      	
						</p>
                    <?php }
                    }	
    	        }else{ ?>
               <div class="alert alert-info 
    				            text-center">
				   <i class="fa fa-comments d-block fs-big"></i>
	               No messages yet, Start the conversation
			   </div>
    	   	<?php } ?>
    	   </div>
    	   <div class="input-group mb-3">
    	   	   <textarea cols="3"
    	   	             id="message"
    	   	             class="form-control"></textarea>
    	   	   <button class="btn btn-primary"
    	   	           id="sendBtn">
    	   	   	  <i class="fa fa-paper-plane"></i>
    	   	   </button>
    	   </div>
    </div>
	<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </div>
	</div>
</div>


<script>
	var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
	}

	scrollDown();

	$(document).ready(function(){
      
      $("#sendBtn").on('click', function(){
      	message = $("#message").val();
      	if (message == "") return;
      	$.post("cinsert.php",
      		   {
      		   	message: message,
      		   	to_id: <?=$idd?>
      		   },
      		   function(data, status){
                  $("#message").val("");
                  $("#chatBox").append(data);
                  scrollDown();
      		   });
      });

      /** 
      auto update last seen 
      for logged in user
      **/
      let lastSeenUpdate = function(){
      	$.get("cupdate_last_seen.php");
      }
      lastSeenUpdate();
      /** 
      auto update last seen 
      every 10 sec
      **/
      setInterval(lastSeenUpdate, 10000);



      // auto refresh / reload
      let fechData = function(){
      	$.post("cgetMessage.php", 
      		   {
      		   	id_2: <?=$idd?>
      		   },
      		   function(data, status){
                  $("#chatBox").append(data);
                  if (data != " ");
      		    });
      }

      fechData();
      /** 
      auto update last seen 
      every 0.5 sec
      **/
      setInterval(fechData, 5000);
    
    });

	function openForm() {
	document.getElementById("chatForm").style.display = "block";
	}

	function closeForm() {
	document.getElementById("chatForm").style.display = "none";
	}
</script>
 </body>
 </html>
<?php
  }
 ?>