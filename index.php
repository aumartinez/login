<?php

session_start();

if(isset($_SESSION['logged'])){
	$logged = $_SESSION['logged'];
}
else{
	$logged = false;
}

if(!$logged){
	header('Location:login.php');
	exit();
}

if(isset($_SESSION['username'])){
	$user = $_SESSION['username'];	
}

include 'inc/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MySearch Front</title>
<?php include 'inc/meta.php';?>
</head>

<body>
<div class="jumbotron">
 <div class="container">
   <div class="row">
     <div class="col-xs-12">
       <h1><a href="index.php">Home page title</a></h1>
     </div>
   </div>
 </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h2>You made it to the landing page</h2>
      
      <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
      Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
      Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
      Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </div>
</div>

<?php include 'inc/bottomscripts.php'; ?>

</body>
</html>
