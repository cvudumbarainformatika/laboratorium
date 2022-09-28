<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select rs1 as notransaksi from rs85 where rs6='".trim($_GET['nopermintaan'])."'");
	$rs=$sql->fetch_object();
	
	$sqlx=$conn->query("select * from rs95 where rs1='".$rs->notransaksi."' and rs2='".trim($_GET['kodeobat'])."' and rs3='".trim($_GET['jumlah'])."' and rs6='RC0001'");
	$xxx=$sqlx->num_rows;
	
	if($xxx==0){
		$conn->query("delete from rs267 where id='".trim($_GET['id'])."'");
		echo "OK";
	}else{
		echo "Permintaan ini Sudah Di transaksikan...!!!";
	}
	

?>
<?php include_once "../../close.php";?>
