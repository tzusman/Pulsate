<?php include("login.php"); ?>
<?php include("config.php"); ?>
<!doctype html>

<html>
	<head>
		<title>Pulse Content Manager</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="styles.css" rel="stylesheet" type="text/css" />
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
	</head>
	
	<body>		

	
	<div class="header"><div class="inner">	
	
	<a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/"><img src="img/new-logo.png" alt="Pulse CMS"></a>
		
	</div></div>		
	
	
	<div class="nav"><div class="inner">
	
	<ul>
	<li><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/">Content Blocks</a></li>
	<li class="current"><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/blocks/img/manage.php">Image Manager</a></li>
	<li><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/list-backups.php">Backup</a></li>
	<li><a href="http://pulsecms.com/help.php" target="_blank" >Help</a></li>
	</ul><div style="clear: both;"></div>
	
	</div></div>
		
	<div class="content">
	
	
	<p class="left-pad"><b>Please select your file below and then click submit.</b></p>

<div class="upload">	<img src="img/fileupload.png">	

<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="file" /> <br><br>
<input type="submit" name="submit" value="Submit" />
</form>
</div>


<p class="left-pad">Max size: 150K (JPG, GIF, PNG only)</p>
	
	
<div style="clear: both;"></div>
	
	</div>
	
<div class="footer"><a href="http://pulsecms.com">PulseCMS.com Ver 1.2</a></div>		
	
	</body>
	
	
</html>
