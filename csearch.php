<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['user_ID'])) {
    # check if the key is submitted
    if(isset($_POST['key'])){
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
       <li class="list-group-item">
	   
	   <?php 
	   ?>
		<a href="chat.php?user=<?=$users['fName']?>"
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
		 </a>
	   </li>
       <?php  }}else { ?>
         <div class="alert alert-info 
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
           The user "<?=htmlspecialchars($_POST['key'])?>"
           is  not found.
		</div>
    <?php }
    }
}