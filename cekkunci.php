<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select rs18 as kunci from rs51 where rs2='".trim($_GET['nota'])."' group by rs2");
	$rs=$sql->fetch_object();
	
	if($rs->kunci==0){
		echo "MAAF Permintaan ini Belum Dikunci...!!!";
	}else{
		echo "OK|";
	}
	

?>
<?php include_once "../../close.php";?>
