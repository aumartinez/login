<?php
//Here clear current credentials and authorization

session_start();

//Clear authorization
unset($_SERVER['PHP_AUTH_USER']);
unset($_SERVER['PHP_AUTH_PW']);

header('HTTP/1.0 401 Unauthorized');

//Clear any session variable
session_unset();

//Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MySearch Front</title>
<?php include 'inc/meta.php'; ?>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-xs-8">
      <h1>Signed out</h1>
      <p>If you are not redirected in <span id="countdown">4</span> seconds please <a href="login.php">click here</a></p>
    </div>
  </div>
</div>

<script type="text/javascript">
var seconds;
var counter;
var timecount;

function countdown(){
	seconds = document.getElementById("countdown").innerHTML;
	seconds = parseInt(seconds,10);	
	
	counter = document.getElementById("countdown");
	timecount = setTimeout(countdown, 1000);
	seconds--;
	
	if(seconds > 0){
		counter.innerHTML = seconds;
	}
	else{
		counter.innerHTML = 0;
		redirect();
	}	
}

function redirect(){
	location.href='login.php';
}

countdown();
</script>

<?php include 'inc/bottomscripts.php'; ?>

</body>
</html>
