<?php
	# SETTINGS
	$max_width = 135;
	$max_height = 135;
	$per_page = 40;	
	$page = $_GET['page'];	
	$has_previous = false;
	$has_next = false;	
	
	function getPictures() {
		
	$pulse_dir = "pulse";	

	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	
	include("$rootpath/$pulse_dir/config.php");
		global $page, $per_page, $has_previous, $has_next;
		if ( $handle = opendir("$rootpath/$pulse_dir/blocks/img/") ) {			
			
			$count = 0;
			$skip = $page * $per_page;
			
			if ( $skip != 0 )
				$has_previous = true;
			
			while ( $count < $skip && ($filename = readdir($handle)) !== false ) {
				if ( !is_dir($filename) && ($type = getPictureType($filename)) != '' )
					$count++;
			}
			$count = 0;			
			
			
			
			while ( $count < $per_page && ($filename = readdir($handle)) !== false ) {
				if ( !is_dir($filename) && ($type = getPictureType($filename)) != '' ) {
					if ( ! is_dir("$rootpath/$pulse_dir/blocks/img/gallery/") ) {
						mkdir("$rootpath/$pulse_dir/blocks/img/gallery/");
					}
					if ( ! file_exists("$rootpath/$pulse_dir/blocks/img/gallery/".$filename) ) {
						makeThumb( $filename, $type );
					}
					echo "<div class=\"gallery\">";
					echo '<a href="http://'.$domain.'/'.$pulse_dir.'/blocks/img/'.$filename.'" rel="lightbox" >';
					echo '<img src="http://'.$domain.'/'.$pulse_dir.'/blocks/img/gallery/'.$filename.'" alt="" />';
					echo '</a>';
					echo "</div>";
					$count++;
				}
			}
			
			
			while ( ($filename = readdir($handle)) !== false ) {
				if ( !is_dir($filename) && ($type = getPictureType($filename)) != '' ) {
					$has_next = true;
					break;
				}
			}
		}
	}
	
	function getPictureType($filename) {
		$split = explode('.', $filename); 
		$ext = $split[count($split) - 1];
		if ( preg_match('/jpg|jpeg/i', $ext) ) {
			return 'jpg';
		} else if ( preg_match('/png/i', $ext) ) {
			return 'png';
		} else if ( preg_match('/gif/i', $ext) ) {
			return 'gif';
		} else {
			return '';
		}
	}
	
	function makeThumb( $filename, $type ) {
		global $max_width, $max_height;
		if ( $type == 'jpg' ) {
			$src = imagecreatefromjpeg($filename);
		} else if ( $type == 'png' ) {
			$src = imagecreatefrompng($filename);
		} else if ( $type == 'gif' ) {
			$src = imagecreatefromgif($filename);
		}
		if ( ($oldW = imagesx($src)) < ($oldH = imagesy($src)) ) {
			$newW = $oldW * ($max_width / $oldH);
			$newH = $max_height;
		} else {
			$newW = $max_width;
			$newH = $oldH * ($max_height / $oldW);
		}
		$new = imagecreatetruecolor($newW, $newH);
		imagecopyresampled($new, $src, 0, 0, 0, 0, $newW, $newH, $oldW, $oldH);
		if ( $type == 'jpg' ) {
			imagejpeg($new, 'gallery/'.$filename);
		} else if ( $type == 'png' ) {
			imagepng($new, 'gallery/'.$filename);
		} else if ( $type == 'gif' ) {
			imagegif($new, 'gallery/'.$filename);
		}
		imagedestroy($new);
		imagedestroy($src);
	}
?>
<?php
$pulse_dir = "pulse";	
$domain = $_SERVER['HTTP_HOST'];
?>

<style type="text/css">

.gallery {
	padding: 20px;
	height: 150px;
	text-align: center;
	width: 150px;
	margin: 0px;
	float: left;
}

.gallery img {	
	margin: 0px;	
	border-color: #cccccc;	
	border-width: 1px;	
	border-style: solid;	
	padding: 5px;	
}

</style>

<script type="text/javascript" src="http://<?php echo $domain?>/<?php echo $pulse_dir?>/slimbox/js/mootools.js"></script>
<script type="text/javascript" src="http://<?php echo $domain?>/<?php echo $pulse_dir?>/slimbox/js/slimbox.js"></script>
<link rel="stylesheet" href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/slimbox/css/slimbox.css" type="text/css" media="screen" />
		
<?php getPictures(); ?>	

<div style="clear:both"></div>

<?php
	if ( $has_previous )
		echo '<p class="prev"><a href="?page='.($page - 1).'">&larr; Previous Page</a></p>';

	if ( $has_next )
		echo '<p class="next"><a href="?page='.($page + 1).'">Next Page &rarr;</a></p>';
?>

<div style="clear:both"></div>