<?php
// some code
 
$m = $_GET['m'];
	

$con = mysql_connect("localhost","video","video");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("videos", $con);
$result = mysql_query("SELECT * FROM details");

$i=1;
while($row = mysql_fetch_array($result))
  {
  	$vids[$i]['id'] = $row['id'];
  	$vids[$i]['url'] = $row['url'];
  	$vids[$i]['thumb'] = $row['thumb'];
	if($i==$m)
	{
		$vids[$i]['featured'] = 1;	
	}
	else
	{
		$vids[$i]['featured'] = 0;	
	}
	$i++;
  	//  echo $row['id'] . " " . $row['url']."".$row['thumb'];
//  echo "<br />";
  }

mysql_close($con);
//	header( 'Location: controller.php?m=0' ) ;
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Custom Video Player</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
 </head>
 
 <body>
	 <div id="wrapper">			
 		 <header>
			<h2>Custom Video Player</h2>

	 	</header>
		
		<div id="video_area">
		<?php 
		

		for($i=1;$i<max(array_map('count', $vids))+2;$i++){
			if($vids[$i]['featured']==1){
			$vidUrl=$vids[$i]['url'];
		?>
			<div id="main_vid">
				<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo($vidUrl) ?>" frameborder="0" allowfullscreen></iframe>
			
			</div>
		
		<?php }} ?>
		
			
		
		</div>
		<div id="thumb_space">
		<?php 
			
		for($i=1;$i<max(array_map('count', $vids))+2;$i++){
			if($vids[$i]['featured']!=1){
			$vidUrl=$vids[$i]['url'];
		?>	
				<div class="thumb_vid">
				 <a href="controller.php?m=<?php echo $i ?>"> 
					<img  style="float:left" width="120" height="90" src="<?php echo $vids[$i]['thumb']?>"/>
				</a>
				</div>			
			
		<?php }} ?>	
		
		
		</div>


	</div>
 
 </body>
 <script>

</script>
 </html>

