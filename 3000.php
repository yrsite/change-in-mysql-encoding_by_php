<?php
$WR = "";
$fp = fopen('1000.txt', 'w');
$con=mysqli_connect("localhost","facemasr_usoo","nocasio2014","facemasr_news");
if (mysqli_connect_errno()) {echo "Failed to connect to MySQL: " . mysqli_connect_error();}
$result = mysqli_query($con,"SELECT * FROM news order by id limit 2001,1000");
while($row = mysqli_fetch_array($result)) {
	$TxTCNT = str_replace("'", '`', $row['details']);
	$TxTTTL = str_replace("'", '`', $row['title']);
	$PressDT = "".$row['date']." ".$row['time']."";
	$WR .= "INSERT INTO FM_press (press_xd, DUserName, press_cat, press_title, press_suptitle, press_content, press_useradd, press_dateadd, press_imgttl, press_visits, press_editor, press_image, press_abstract) VALUES ('".$row['id']."', 'FaceMasr', '".$row['newspart']."', '".$TxTTTL."', '".$row['title2']."', '".$TxTCNT."', '".$row['useridd']."', '".$PressDT."', '".$row['imgs_2']."', '".$row['VISITS']."', '".$row['editor']."', '".$row['imgs_1']."', '".$row['datasml']."');\r\n";
}
mysqli_close($con);
fwrite($fp, $WR);
fclose($fp);
?>