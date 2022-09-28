<?php include_once "../../conn.php";?>
<?php
	$conn->query("update lab_luar set akhir='1' where nota='".$_GET["nota"]."'");
	echo"OK";
?>
<?php include_once "../../close.php";?>
