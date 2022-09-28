<?php include_once "../../conn.php";?>
<?php
$tanggal=format_tgl_inx(trim($_GET['tanggal_tindakan']),"/");
//buat nota tindakan
if(trim($_GET['nota'])==""){
	$sqlx=$conn->query("select rs14 from rs1");
	$jmlx=$sqlx->num_rows;
	if($jmlx>0){ 
		$rsx=$sqlx->fetch_object();
		$counter=$rsx->rs14+1;
	}		
	$notax=gennota($counter,"T");
	$conn->query("update rs1 set rs14=rs14+1");
}else{
	$notax=trim($_GET['nota']);
}

if($_GET['kd_ruang']=="POL014"){
	$flag="LAB2";
}else{
	$flag="LAB";
}
$conn->query("delete from rs73 where rs1='".trim($_GET['noreg'])."' and rs2='".$notax."' and rs4='".trim($_GET['kode_tindakan'])."' and rs3='".$tanggal."'");
$conn->query("insert into rs73(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17,rs18,rs19,rs22)	
values('".trim($_GET['noreg'])."','".$notax."','".$tanggal."',
'".trim($_GET['kode_tindakan'])."','".trim($_GET['jumlah_tindakan'])."','".trim($_GET['harga_sarana'])."',
'".trim($_GET['harga_sarana'])."','".trim($_GET['kode_pelaksana'])."','".$_SESSION['loginrsx_user']."','','','',
'".trim($_GET['harga_pelayanan'])."','".trim($_GET['harga_pelayanan'])."','".trim($_GET['flag_pelaksana'])."',
'','','','','".$flag."')");
echo "OK|".$notax;

?>
<?php include_once "../../close.php";?>
