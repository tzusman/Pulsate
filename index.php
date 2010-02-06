<?php include("login.php"); ?>
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
	
	 <?/*php
            $files = glob("blocks/*.html");
            foreach ($files as $file) { if (!is_dir($file)) {?>

            <div class="icon">
                <a href="view.php?f=<?php echo $file; ?>"><img src="img/block-icon-sm.gif" alt="Page Block Icon">
                <span><?php echo basename($file); ?></span></a>
               
            </div><?php }}*/ ?>
  
		<? if ( array_key_exists('m',$_GET) ): ?>
		<div class='message'><?= $_GET['m']; ?></div>
		<? endif; ?>
        
		<?
			$blocks = list_blocks( );
			foreach ( $blocks as $block ): 
		?>
		<div class="icon">
			<a href="view.php?f=<?php echo $block['file']; ?>&t=<?php echo $block['title']; ?>"><img src="img/block-icon-sm.gif" alt="Page Block Icon">
			<span><?php echo humanize(basename($block['title'])); ?></span></a>
		</div>
		<? endforeach; ?>  
            
            <?#<div class="button"><a href="createblock.php">New Block</a></div>?>
            <div class="button"><a href="syncblocks.php">Update Website</a></div>
<div style="clear: both;"></div>
	
	</div>
	
<div class="footer"><a href="http://pulsecms.com">PulseCMS.com Ver 1.2</a> | <a href="#">Augmented with Pulsate</a></div>		
	
	</body>
	
	
</html>
