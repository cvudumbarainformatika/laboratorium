<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select * from lab_luar where nota='".$_GET["nota"]."'");
	$rs=$sql->fetch_object();
	if($rs->akhir=="1"){
		echo"OK";
	}else{
		echo"NOT";
	}
?>
<?php include_once "../../close.php";?>
