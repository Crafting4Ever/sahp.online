<?php
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in and be verified to access this page.";
  header("location: error.php");    
}
else {
    // Makes it easier to read
   	$first_name = $_SESSION['first_name'];
    	$last_name = $_SESSION['last_name'];
    	$email = $_SESSION['email'];
   	$active = $_SESSION['active'];
	$rt = $_SESSION['roletext'];
	$role = $_SESSION['role'];
	$status = $_SESSION['status'];
	$id = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
  <?php include 'css/popup.html'; ?>
</head>

<body>
  
  <center><a href="profile.php"><button class="button button2">Back to Profile</button></a></center>
  <h2><?php echo $first_name.' '.$last_name.' - Active '.$rt;?></h2>
    <hr>
	<center><button class="button button2" id="status">Change current status</button></center>

<div id="myModal" class="modal">

  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3>Please select your status (Current: <?php echo($status); ?> )</h3>
    </div>
    <div class="modal-body">
      <?php
		if($role == 0) { // recruit
			echo('<center><h3>Recruit</h3><br><button class="button button2">I\'m Looking for a ride along.</button></center><br>
			<center><button class="button button2">I\'m Looking for an evaluation.</button></center>
			');
		} else if($role == 1) { // fta
			echo('<center><h3>F.T.A.</h3><br><button class="button button2">I\'m available to perform ride-alongs.</button></center>
			');
		} else if($role == 2) { // fto
			echo('<center><h3>F.T.O.</h3><br><button class="button button2">I\'m available to perform ride-alongs.</button></center><br>
			<center><button class="button button2">I\'m available to perform ride-alongs and evaluations.</button></center>
			');
		} else if($role == 3) { // admin
			echo('
			<center><h3>Recruit</h3><br><button class="button button2">I\'m Looking for a ride along.</button></center><br>
			<center><button class="button button2">I\'m Looking for an evaluation.</button></center><br>
			<center><h3>F.T.A.</h3><br><button class="button button2">I\'m available to perform ride-alongs.</button></center><br>
			<center><h3>F.T.O.</h3><br><button class="button button2">I\'m available to perform ride-alongs.</button></center><br>
			<center><button class="button button2">I\'m available to perform ride-alongs and evaluations.</button></center>
			');
		}
	  ?>
    </div>
  </div>

</div>
<script>
// ALL FROM W3SCHOOLS
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("status");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
