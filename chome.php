<?php 
	// include_once '../header.php';
	// include_once '../dbconfig.php';

  	# database connection file
	
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	} 
	include 'dbconfig.php';
  	//include 'app/helpers/user.php';
  	include 'app/helpers/conversations.php';
    include 'app/helpers/timeAgo.php';
    include 'app/helpers/last_chat.php';

	//$user = getUser($_SESSION['user_ID'], $connect);
	$id = $_SESSION['user_ID'];
	if($_SESSION['enduser'] =='User'){
		$query   = $connect->query("SELECT * FROM tbl_user Where user_ID=$id");
		$user  = $query->fetch_assoc(); 
		$conversations = getConversation($user['user_ID'], $connect);
	}else{
		$query   = $connect->query("SELECT * FROM tbl_agent Where agent_ID=$id");
		$user  = $query->fetch_assoc(); 
		$conversations = getConversation($user['agent_ID'], $connect);
	}
	
?>
	<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"  href="css/chatstyle.css">
	<link rel="stylesheet"  href="css/chat.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<script type="text/javascript">
		function chat(filter) {
			// let filter = $('#all').val();
			$.ajax({
			type: 'POST',
			url: 'chat.php',
			data:'filter='+filter,
			success: function (html) {
				$('#result').html(html);
			}
			});
		}
	</script>
	<style>
		/* The popup chat - hidden by default */
		.chat-popup {
		display: none;
		position: fixed;
		bottom: 0;
		right: 15px;
		z-index: 9;
		}

		
	</style>
	<body>
	<div id='result'>
	<button class="btn_open" onclick="openForm()">Chat</button>

	<div class="chat-popup" id="chatForm">
    <div class="form-container">
    	<div>
    		<div class="input-group mb-3">
    			<input type="text"
    			       placeholder="Search..."
    			       id="searchText"
    			       class="form-control"
					   onkeyup="searchFil()">
    			<button class="btn btn-primary" 
    			        id="serachBtn"
						onclick="searchFil();">
    			        <i class="fa fa-search"></i>	
    			</button>       
    		</div>
    		<ul id="chatList" style="height:200px; overflow-y:auto; overflow-x:hidden;" class="list-group">
    			<?php if (!empty($conversations)) {
					$i=0;
    			    foreach ($conversations as $conversation){ 
						$i++;
					?>
	    			<li style="background-color:#f8f4f4;" class="list-group-item">
						<!-- <a href="chat.php?user=<?//=$conversation['fName']?>" class="d-flex justify-content-between align-items-center p-2"> -->
						<button class="btnAll" name="all" id="all" value="<?=$conversation['fName']?>" onclick="chat('<?=$conversation['fName']?>')">
	    					<div class="d-flex
	    					            align-items-center">
										<?php 
										echo '<img src="data:image/jpeg;base64,'.base64_encode($conversation['displayImg']).'" class="w-25 rounded-circle">';
										?>
	    					    <h3 style="text-align: left;" class="fs-xs m-2">
	    					    	<?=$conversation['lName']?><br>
                      <small id="small">
                        <?php
						
							if($_SESSION['enduser']=='User'){
								$text = lastChat($_SESSION['user_ID'], $conversation['agent_ID'], $connect);
								$agent = $conversation['agent_ID'];
								$selectSql = $connect->query( "SELECT from_ID, to_ID FROM tbl_messages WHERE (from_ID=$id AND to_ID=$agent) OR (to_ID=$id AND from_ID=$agent) ORDER BY conver_ID DESC LIMIT 1");
								$resSql = $selectSql->fetch_assoc();
								if ($resSql['to_ID'] == $conversation['agent_ID']) {
									$textY = "You: ";
								}else {
									$textY = "";
								}
								echo $textY;
								if (strlen($text) > 0 )
									echo mb_strimwidth($text, 0, 30, "...");
							}else{
								$text = lastChat($_SESSION['user_ID'], $conversation['user_ID'], $connect);
								$agent = $conversation['user_ID'];
								$selectSql = $connect->query( "SELECT from_ID, to_ID FROM tbl_messages WHERE (from_ID=$id AND to_ID=$agent) OR (to_ID=$id AND from_ID=$agent) ORDER BY conver_ID DESC LIMIT 1");
								$resSql = $selectSql->fetch_assoc();
								if ($resSql['to_ID'] == $conversation['user_ID']) {
									$textY = "You: ";
								}else {
									$textY = "";
								}
								echo $textY;
								if (strlen($text) > 0 )
									echo mb_strimwidth($text, 0, 30, "...");
							}
                        ?>
                      </small>
	    					    </h3>            	
	    					</div>
	    					<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
		    					<div title="online">
		    						<div class="online"></div>
		    					</div>
	    					<?php } ?>
						</button>
	    			</li>
    			    <?php } ?>
    			<?php }else{ ?>
    				<div class="alert alert-info 
    				            text-center">
					   <i class="fa fa-comments d-block fs-big"></i>
                       No messages yet, Start the conversation
					</div>
    			<?php } ?>
    		</ul>
    	</div>
		<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </div>
	</div>
	</div>



<script>
	function searchFil() {
			key = $('#searchText').val();
			if(key == ""){
				$.ajax({
				type: 'POST',	
				url: 'chome.php',
				success: function (html) {
					$('#result').html(html);
					document.getElementById("chatForm").style.display = "block";
				}
				});
			}else{
				$.ajax({
				type: 'POST',
				url: 'csearch.php',
				data: 'key=' + key,
				success: function(html) {
					$('#chatList').html(html);
				}
				});
			}
		}
	$(document).ready(function(){
		// console.log(change);
		// let rInterval = function ready() {
		// 	console.log("success");
		// 	if (document.getElementById("chatForm").style.display == "block") {
		// 		$.ajax({
		// 			type: 'POST',	
		// 			url: 'chome.php',
		// 			success: function (html) {
		// 				$('#result').html(html);
		// 				document.getElementById("chatForm").style.display = "block";
		// 			}
		// 		});
		// 	}else{
		// 		$.ajax({
		// 			type: 'POST',	
		// 			url: 'chome.php',
		// 			success: function (html) {
		// 				$('#result').html(html);
		// 				document.getElementById("chatForm").style.display = "none";
		// 			}
		// 		});
		// 	}
		// }
		// if (change == "") {
	
		// 	setInterval(rInterval, 100000);
		// }
    //    $("#searchText").on("input", function(){
    //    	 var searchText = $(this).val();
    //      if(searchText == "") return;
    //      $.post('csearch.php', 
    //      	     {
    //      	     	key: searchText
    //      	     },
    //      	   function(data, status){
    //               $("#chatList").html(data);
    //      	   });
    //    });

       // Search using the button
       $("#serachBtn").on("click", function(){
       	 var searchText = $("#searchText").val();
         if(searchText == "") return;
         $.post('csearch.php', 
         	     {
         	     	key: searchText
         	     },
         	   function(data, status){
                  $("#chatList").html(data);
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

