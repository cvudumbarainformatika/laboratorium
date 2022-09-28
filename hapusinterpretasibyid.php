<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select * from rs215 where id='".trim($_GET['id'])."'");
	$jml=$sql->num_rows;
	if($jml>0){
		$rs=$sql->fetch_object();
		if($rs->rs6=="1"){
			echo "Maaf, Data telah dikunci";
		}else{
			$conn->query("delete from rs215 where id='".trim($_GET['id'])."'");	
			echo "OK";
		}
	}
?>
<?php include_once "../../close.php";?>
