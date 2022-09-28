<?php include_once "../../conn.php";?>
<?php

	
	$conn->query("delete from rs267 where rs1='".trim($_GET['nopermintaan'])."' ");
	$conn->query("delete from rs266 where rs1='".trim($_GET['nopermintaan'])."' ");

echo "OK";
?>
<?php include_once "../../close.php";?>
