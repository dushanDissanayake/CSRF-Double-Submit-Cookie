<?php
if(isset($_POST['unametxt'],$_POST['passtxt'])){
	$uname = $_POST['unametxt'];
	$pwd = $_POST['passtxt'];
	if($uname == 'admin' && $pwd == 'admin'){
		echo '<h3>You have successfully logged in.</h3>';

    //generate set session cookie and csrfTokenCookie
		session_start();
		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
		$session_id = session_id();
		setcookie('sessionCookie',$session_id,time()+ 60*60*24*365 ,'/');
		setcookie('csrfTokenCookie',$_SESSION['token'],time()+ 60*60*24*365 ,'/');
	}
	else{
		echo 'Invalid Credentials. Please try again.';
		exit();
	}
}
else{
	header('Location:./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>

  	$(document).ready(function(){

  	var cookie_value = "";
  	//get all cookies from document.cookie
      var dCookie = decodeURIComponent(document.cookie);
  	//split from 2nd ";" and get csrfTokenCookie
  	var csrfC = dCookie.split(';')[2]
  	if(csrfC.split('=')[0] = "csrfTokenCookie" ){
  		cookie_value = csrfC.split('csrfTokenCookie=')[1];
  		document.getElementById("token_value").setAttribute('value', cookie_value) ;
  	}
  	});

  </script>

</head>

<body>

<div class="login-page">
  <div class="form">
    <form class="login-form" action="result.php" method="post" name="update_form">

      <input type="text" id="msgTxt" name="msgTxt" placeholder="Update your status" class="cred"/>
      <input type="hidden" name="token" value="" id="token_value"/>
      <input name="cSubmit" type="submit" value="Update" class="login">

    </form>
  </div>
</div>

</body>
</html>
