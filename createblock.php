<?php include("login.php"); ?>
<?php include("config.php"); ?>
<?php

		@$filename = strip_tags($_POST['blockname']) . ".html";
		$blockname = str_replace(' ', '-', $filename);	

?>
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
	<h1>Create a block</h1>						
			
			<div class="new-block">
			
			
			
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<label for="blockname">Block Name:</label>
					<input type="text" name="blockname" id="blockname" /></label>
					<input type="submit" name="submit" value="Create" />			
			</form>
			</div><br>
			<?php
			
				if(strlen(@$_POST['blockname']) == 0) {
					
					
				}
				else {
					$block_total = "blocks/" . $blockname;
					$block_handle = fopen($block_total, 'w') or die("{$blockname} could not be created.");
					fclose($block_handle);
					echo "<p class=\"created\"><b>" . $blockname . "</b> was successfully created. Go <a href=\"view.php?f=blocks/{$blockname}\">edit</a> it!</p>";
				}
			
			?>

			<div style="clear: both;"></div> 

			</div>
<div style="clear: both;"></div>
	
	</div>
	
<div class="footer"><a href="http://pulsecms.com">PulseCMS.com Ver 1.2</a></div>		
	
	</body>
	
	
</html>
