<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select * from rs85 where rs6='".trim($_GET['nopermintaan'])."'");
	$trans=$sql->num_rows;
	
	if($trans>0){
		echo "Permintaan ini Sudah Di transaksikan...!!!";
	}else{
		$conn->query("delete from rs266 where rs1='".trim($_GET['nopermintaan'])."'");
		$conn->query("delete from rs267 where rs1='".trim($_GET['nopermintaan'])."'");
		echo "OK";
	}
	

?>
<?php include_once "../../close.php";?>
