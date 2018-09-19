<?php
	$id = $_GET['id'];
	//$id = intval($id);
	$id = addslashes($id);
	$sql = "DELETE  FROM user WHERE uid = '$id'";
	echo $sql;
	echo "<br>";
	$sql2 = "INSERT INTO user VALUE (NULL,'$id','123213')";
	echo $sql2;
?>