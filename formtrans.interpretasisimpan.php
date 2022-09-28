<?php include_once "../../conn.php";?>
<?php
if($_SESSION['loginrsx_kodebag']<>"PEN002" || $_SESSION['loginrsx_user']=="sa"){
	echo "OK|";
	$tanggal=format_tgl_inx(trim($_GET['tanggalinterpretasi']),"/");
		
	//$conn->query("delete from rs215 where rs1='".$_GET['noreg']."' and rs2='".$_GET['norm']."' and rs3='".$tanggal."'");
	$conn->query("insert into rs215(rs1,rs2,rs3,rs4,rs5,ket) values('".$_GET['noreg']."',
	'".$tanggal."','".$_GET['interpretasi']."','".$_GET['saran']."',
	'".$_GET['nota']."','".$_GET['ket']."')");
}else{
	echo "Maaf, anda tidak berhak menyimpan";
}
?>