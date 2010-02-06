<?php

include("config.php");

session_start();

### LOGIN OPTIONS, PLEASE CHANGE THE DEFAULT PASSWORD:
$max_session_time = 3600;
$cmp_pass = Array();
$cmp_pass[] = md5("$pulse_pass");
$max_attempts = 10;
$session_expires = $_SESSION['mpass_session_expires'];
$max_attempts++;

if(!empty($_POST['mpass_pass']))
{
	$_SESSION['mpass_pass'] = md5($_POST['mpass_pass']);
}

if(empty($_SESSION['mpass_attempts']))
{
	$_SESSION['mpass_attempts'] = 0;
}

if(($max_session_time>0 && !empty($session_expires) && mktime()>$session_expires) || empty($_SESSION['mpass_pass']) || !in_array($_SESSION['mpass_pass'],$cmp_pass))
{
	if(!empty($alert) && !in_array($_SESSION['mpass_pass'],$cmp_pass))
	{

		$_SESSION['mpass_attempts']++;
		
		$alert_str = $_SERVER['REMOTE_ADDR']." entered ".htmlspecialchars($_POST['mpass_pass'])." on page ".$_SERVER['PHP_SELF']." on ".date("l dS of F Y h:i:s A")."\r\n";
		
		if(stristr($alert,"@")!==false)
		{
			@mail($alert,"Bad Login on ".$_SERVER['PHP_SELF'],$alert_str,"From: ".$alert);
		} else {
			$handle = @fopen($alert,'a');
			if($handle)
			{
				fwrite($handle,$alert_str);
				fclose($handle);
			}
		}
	}
	if($max_attempts>1 && $_SESSION['mpass_attempts']>=$max_attempts)
	{
		exit("Too many login failures.");
	}


	$_SESSION['mpass_session_expires'] = "";

	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
	<style type="text/css">

	body {
		font-size: 14px;
		margin-top: 75px;
		margin-bottom: 0px;
		padding: 0px;
		margin-right: auto;
		margin-left: auto;
		width: 300px;
		font-family: sans-serif;
	}

	form {
		padding-left: 0px;
		padding-bottom: 25px;
		padding-right: 0px;
		padding-top: 0px;
		width: 275px;
		margin: 0px;
		border-color: #dddddd;
		border-width: 1px;
		border-style: solid;
		background-color: #eeeeee;
	}

	h2 {
		border-bottom-color: #336699;
		border-bottom-width: 4px;
		border-bottom-style: solid;
		font-size: 20px;
		color: white;
		padding: 15px;
		background-color: #333333;
		margin: 0px;
	}

	form p {
		color: #333333;
		padding-left: 15px;
		padding-bottom: 0px;
		padding-right: 15px;
		padding-top: 15px;
	}

	form input {
		margin-left: 15px;
	}

	</style>
		<title>Pulse Content Manager</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	</head>
	<body onload="document.login.mpass_pass.focus()">				
			
			
	<form name="login" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<h2>Pulse CMS</h2>
	<p>Please enter your password:</p>
	<input type="password" size="30" name="mpass_pass" ><br><br>
	<input type="submit" value="Login">
	</form><br><br>


</body>

</html>

<?php 
exit();
}

$_SESSION['mpass_attempts'] = 0;

$_SESSION['mpass_session_expires'] = mktime()+$max_session_time;

// end password protection code

?>
