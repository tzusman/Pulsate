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
	<li class="current"><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/">Content Blocks</a></li>
	<li><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/blocks/img/manage.php">Image Manager</a></li>
	<li><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/list-backups.php">Backup</a></li>
	<li><a href="http://pulsecms.com/help.php" target="_blank" >Help</a></li>
	</ul><div style="clear: both;"></div>
	
	</div></div>
		
	<div class="content">
	
	 <div class="left-pad">
	 <?php 
$filename = $_GET['f'];
$upload_dir = './blocks/img/';
$file_path = $upload_dir . $filename;
if(is_file($file_path)) {
	unlink($file_path);
	echo "<p>The file: <b>" . $filename . "</b> has been deleted.</p>";
	echo "<p>Back to <a href=\"http://$domain/$pulse_dir/blocks/img/manage.php\">Image Manager</a></p>";
} 

?>

	 </div>
	 
<div style="clear: both;"></div>
	
	</div>
	
<div class="footer"><a href="http://pulsecms.com">PulseCMS.com Ver 1.2</a></div>		
	
	</body>
	
	
</html>
