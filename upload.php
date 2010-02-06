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
	<div class="left-pad">

<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 150000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    

    if (file_exists("blocks/img/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "blocks/img/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "blocks/img/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "<b>Invalid file:</b> 150K max size and JPG, GIF, PNG only";
  }
?>

<p><a href="http://<?php echo $domain?>/<?php echo $pulse_dir?>/blocks/img/manage.php">View Images</a></p>
</div>

<div style="clear: both;"></div>
	
	</div>
	
<div class="footer"><a href="http://pulsecms.com">PulseCMS.com Ver 1.2</a></div>		
	
	</body>
	
	
</html>
