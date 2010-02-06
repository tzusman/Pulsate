<?php include("login.php"); ?>
<?php 

/*
if (isset($_POST["filename"])) {
	$fname = $_POST["filename"];
	$block = stripslashes($_POST["block"]);
	$fp = @fopen($fname, "w");
	if ($fp) {
		fwrite($fp, $block);
		fclose($fp);
	}
	
}

if (isset($_GET["f"])) 
	$fname = stripslashes($_GET["f"]);
if (file_exists($fname)) 
	$fp = @fopen($fname, "r");
	if (filesize($fname) !== 0) 
		$loadblock = fread($fp, filesize($fname));
		$loadblock = htmlspecialchars($loadblock);
		fclose($fp);
*/

#####################

$fname = get_path( $_GET['f'], $_GET['t'] );
if ( isset($_POST['filename']) ) {
	$block = stripslashes( $_POST['block'] );
	if ( file_exists($fname) )
		backup_block( $fname );
	$fp = @fopen( $fname, 'w' );
	if ( $fp ) {
		fwrite( $fp, $block );
		fclose( $fp );

	###################
	$new = substr( $_GET['f'], strlen($rootpath)+1 );
	$new = str_replace( 'build/', 'webroot/', $new );
	$html = file_get_contents( $_GET['f'] );
	$regex = sprintf( '#(<([\w]+)[^>]*class=[\'"][^\'"]*pulse[^\'"]*[\'"][^>]*(title=[\'"]%s[\'"])[^>]*>)(.*?)(</\\2>)#', $_GET['t'] );
	preg_match( $regex, $html, $match );
	$block = get_block( $_GET['f'], $_GET['t'] );
	$html = str_replace( $match[0], $match[1].$block.$match[5], $html );
	file_put_contents( $new, $html );
	###################

	}
}

$loadblock = get_block( $_GET['f'], $_GET['t'] );
$loadblock = htmlspecialchars( $loadblock );
#####################

?>
<!doctype html>

<html>
	<head>
		<title>Pulse Content Manager</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="styles.css" rel="stylesheet" type="text/css" />
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
	</head>
	
	<body>	
	
	<script type="text/javascript"> 
	function select_all(obj) 
	{ var text_val=eval(obj); 
	text_val.select(); } 
	</script>	

	
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
	
	 <div class="breadcrumb"><a href=".">Home</a> | <?php echo humanize(basename($_GET['t'])); ?></div>					
		<form class="editor" method="post" action="">	
		<input type="hidden" name="filename" value="<?php echo $fname; ?>" />
		<textarea class="ckeditor" id="area2" name="block" cols="110" rows="20"><?php echo $loadblock; ?></textarea><br>
		<input type="submit" name="save_file" value="Save" /> &nbsp;
		Saved: <?php echo file_exists($fname) ? date("M j, Y g:i a", filemtime($fname)) : 'never changed from default'; ?>
	</form>
	
<?/*	
	<div class="howto">
	Embed Code:
	<input value='&lt;?php include("<?php echo $rootpath ?>/<?php echo $pulse_dir ?>/<?php echo $fname; ?>"); ?&gt;' onclick="select_all(this)" size="50">
	</div>	          
*/?>

	<? $revs = get_revisions( $_GET['f'], $_GET['t'] ); ?>
	<? if ( count($revs) > 0 && false ): ?>
	<div class="howto">
		<? foreach ( $revs as $rev ): ?>
		<p><?= date( 'n/j/Y g:ia', filemtime($rev) ); ?></p>
		<? endforeach; ?>
	</div>
	<? endif; ?>
            
<div style="clear: both;"></div>
	
	</div>
	
<div class="footer"><a href="http://pulsecms.com">PulseCMS.com Ver 1.2</a></div>		
	
	</body>
	
	
</html>
