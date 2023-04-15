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
<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['user_ID'])) {
    # check if the key is submitted
       # database connection file
	   include_once 'dbconfig.php';

	   # creating simple search algorithm :) 
		$key = "%{$_POST['key']}%";
	   	if($_SESSION['enduser'] =='User'){
			$sql = "SELECT * FROM tbl_agent
			WHERE fName LIKE '".$key."' OR lName LIKE '".$key."' LIMIT 4";
		}else{
			$sql = "SELECT * FROM tbl_user
			WHERE fName
			LIKE '".$key."' OR lName LIKE '".$key."' LIMIT 4";
		}
	
	   
       $stmt = $connect->query($sql);

       if(mysqli_num_rows($stmt) > 0){ 
         //$users = $stmt->fetch_all();
		 while($users = mysqli_fetch_assoc($stmt)) {
       ?>
	   
       <li style="background-color:#f8f4f4;" class="list-group-item">
		<button class="btnAll" name="all" id="all" value="<?=$users['fName']?>" onclick="chat('<?=$users['fName']?>')"
		   class="d-flex
		          justify-content-between
		          align-items-center p-2">
			<div class="d-flex
			            align-items-center">
				<?php 
				echo '<img src="data:image/jpeg;base64,'.base64_encode($users['displayImg']).'" class="w-25 rounded-circle">';
				?>

			    <h3 class="fs-xs m-2">
			    	<?=$users['lName'].", ".$users['fName']?>
			    </h3>            	
			</div>
		 </button>
	   </li>
		 </ul>
       <?php  }}else { ?>
         <div class="alert alert-info 
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
           The user "<?=htmlspecialchars($_POST['key'])?>"
           is  not found.
		</div>
    <?php }
}