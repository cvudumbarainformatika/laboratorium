<?php include_once "../../conn.php";?>
<?php
//if($_SESSION['loginrsx']==""){ exit; }
//$tanggal=date("Y-m-d H:i:s");
$tanggal=format_tgl_inx(trim($_GET['tanggal']),"/");

if($_GET['nopermintaan']==""){
	//jk kosong ambil dari counter
	$sqlx=$conn->query("select rs64 from rs1");
	$jmlx=$sqlx->num_rows;
	if($jmlx>0){ 
		$rsx=$sqlx->fetch_object();
		$counter_nota=$rsx->rs64 +1;
	}		
	$notax=gennota($counter_nota,"L");
 	$conn->query("update rs1 set rs64=rs64+1");	
}else{
	//jk isi, cek di rs38x
	$notax=trim($_GET['nopermintaan']);
}

if($_GET['nopermintaan']==""){
	/* insert resep */
	$conn->query("delete from rs266 where rs1='".trim($_GET['nopermintaan'])."'");
	$conn->query("insert into rs266(rs1,rs2,rs3,rs4) 
	values('".$notax."','".trim($_GET['peminta'])."',
	'".trim($_GET['keterangan'])."','".date('Y-m-d H:i:s')."')");		
	
	//$conn->query("delete from rs267 where rs1='".trim($_GET['nopermintaan'])."'");
	$conn->query("insert into rs267(rs1,rs2,rs3,rs4) 
	values('".$notax."','".trim($_GET['kodeobat'])."',
	'".trim($_GET['jumlah'])."','".date('Y-m-d H:i:s')."')");
}else{
	$conn->query("insert into rs267(rs1,rs2,rs3,rs4) 
	values('".$notax."','".trim($_GET['kodeobat'])."',
	'".trim($_GET['jumlah'])."','".date('Y-m-d H:i:s')."')");
}
	
	echo "OK|".$notax;
	
//	$conn->query("delete from rs35 where rs1='".trim($_GET['noreg'])."' and rs2='".$notax."' and rs3='F1'");
//	$conn->query("insert rs35 select 0 id,noreg,nonota,'F1','".$tanggal."','D','Farmasi Ranap - Resep',sum(jml) as jml,'".$carabayar."' 
//	,' ','".$_SESSION['loginrsx_user']."' as userr,0,'' ,'1' as shift from vw_farmasi 
//	where noreg='".trim($_GET['noreg'])."' and nonota='".$notax."' group by  noreg,nonota");	
	
	
	
?>
<?php include_once "../../close.php";?>
