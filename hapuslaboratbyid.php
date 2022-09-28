<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select rs49.rs21 as grup,rs51.rs2 as nota from rs49,rs51 where rs49.rs1=rs51.rs4 
	and rs49.rs21<>'' and rs51.id='".trim($_GET['id'])."'");
	while($rs=$sql->fetch_object()){
		$sqlx=$conn->query("select rs1 as kode from rs49 where rs21='".$rs->grup."'");
		while($rsx=$sqlx->fetch_object()){
			$conn->query("delete from rs51 where rs2='".$rs->nota."' and rs4='".$rsx->kode."'");
		}
	}
	$conn->query("delete from rs51 where id='".trim($_GET['id'])."'");
	echo "OK";
?>
<?php include_once "../../close.php";?>
