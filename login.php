<?php
ob_start();
//Here clear current credentials and authorization

session_start();
header('HTTP/1.0 401 Unauthorized');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MySearch Front</title>
<?php include 'inc/meta.php';?>
</head>
<body class="signin">

<div class="container">
	<section id="body-content" class="row">
  <div class="col-xs-8">
<?php

			$username = "";
			$userpass = "";
			
			isset($_POST['username'])?$username = $_POST['username']:$username = false;
			isset($_POST['userpass'])?$userpass = trim($_POST['userpass']):$userpass = false;
			isset($_POST['userpass'])?$originalpass = trim($_POST['userpass']):$originalpass = false;
			isset($_POST['submit'])?$submit = $_POST['submit']:$submit=false;
			
			if($submit){
				if($username && $userpass){
					include 'inc/mysqlconnect.php';
					include 'inc/functions.php';
					
					$getUser =	"SELECT *
					FROM kb_users
					WHERE username = '$username'";
					
					$getUserQuery = mysqli_query($conx, $getUser);
					
					if(!$getUserQuery){
					  die("Error: ".mysqli_error($conx));
					}
					
					$getSalt = mysqli_fetch_assoc($getUserQuery);
					$salt = trim($getSalt['userpass2']);	
					
					mysqli_free_result($getUserQuery);
					
					$crypted = trim(crypt($userpass, $salt));
					
					$userpass = $crypted;
					
					$matchPass =	"SELECT *
					FROM kb_users
					WHERE username = '$username' 
					AND userpass1 = '$userpass'";
					
					$matchPassQuery = mysqli_query($conx, $matchPass);
					
					if(!$matchPassQuery){
					  die("Error ".mysqli_error($conx));
					}
					
					$numrows = mysqli_num_rows($matchPassQuery);
					
					mysqli_free_result($matchPassQuery);
															
					if($numrows == 1){
						$_SESSION['logged'] = true;
						$_SESSION['username'] = $username;			
						
						$newsalt = '_'.generateRandomString(2).'..'.generateRandomString(4);
						$newcrypted = crypt($originalpass, $newsalt);
						$newpass = $newcrypted;
						
						$sql =	"UPDATE kb_users
						SET userpass1 = '$newpass', userpass2= '$newsalt'
						WHERE username = '$username'";
						
						$update = mysqli_query($conx, $sql);
						
						if(!$update){
							die("Error :".mysqli_error($conx));
						}
												
						mysqli_close($conx);	

						header('Location:index.php');						
						exit();
					}		
					
					else{
						$_SESSION['logged'] = false;						
						mysqli_close($conx);
						header_remove(); 
					}
				}
				
				$_SESSION['logged'] = false;
				header_remove(); 
			}
?>
		
		<form id="login-form" name="login" class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			
			<h2 class="form-signin-heading">Please sign in</h2>
			
			<label class="sr-only">User name</label>
			<input id="input-user" type="text" name="username" class="form-control" placeholder="User name" required autofocus autocomplete="off"/>
			<label class="sr-only">Password</label>
			<input id="input-pass" type="password" name="userpass" class="form-control" placeholder="Password" required autofocus />
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Sign in" />
			
		</form>
<?php 
			
			if($submit){
				if($_SESSION['logged']==false){
					echo "<h3 class=\"red-text\" align=\"center\">";
					echo "Try again";		
					echo "</h3>\n";
				}
			}
?>
	</div>	
	</section>
</div>

<?php include 'inc/bottomscripts.php'; ?>

</body>
</html>
<?php
ob_end_flush();
?>
