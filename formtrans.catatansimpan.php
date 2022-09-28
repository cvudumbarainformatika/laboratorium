<?php include_once "../../conn.php";?>
<?php
	$tanggal=format_tgl_inx(trim($_POST['tanggalinterpretasi']),"/");
		
	//$conn->query("delete from rs215 where rs1='".$_POST['noreg']."' and rs2='".$_POST['norm']."' and rs3='".$tanggal."'");
	$conn->query("insert into rs215(rs1,rs2,rs3,rs4,rs5,ket) values('".$_POST['noreg']."',
	'".$tanggal."','".$_POST['interpretasi']."','".$_POST['saran']."',
	'".$_POST['nota']."','".$_POST['ket']."')");
    echo "200";
?>