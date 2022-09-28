<?php include_once "../../conn.php";?>
<?php
$tanggal=format_tgl_inx(trim($_GET['tanggal_laborat']),"/");
//buat nota lab
if(trim($_GET['nota'])==""){
	$sqlx=$conn->query("select rs28 from rs1");
	$jmlx=$sqlx->num_rows;
	if($jmlx>0){ 
		$rsx=$sqlx->fetch_object();
		$counter=$rsx->rs28+1;
	}		
	$notax=gennota($counter,"L");
	$conn->query("update rs1 set rs28=rs28+1");
}else{
	$notax=trim($_GET['nota']);
}

	$kodelab=explode(";",trim($_GET['kode_laborat']));
	$i=1;
	while($i<count($kodelab)){	
		$sql=$conn->query("select rs3,rs4,rs5,rs6 from rs49 where rs1='".$kodelab[$i]."'");
		while($rs=$sql->fetch_object()){
			if($_GET['kodepoli']=="POL022"){
				$hargasarana=$rs->rs3;
				$hargapelayanan=$rs->rs4;
			}else{
				$hargasarana=$rs->rs5;
				$hargapelayanan=$rs->rs6;			
			}
		}
		if(trim($_GET['flagcito'])=="cito"){
			$hargasaranax=$hargasarana+($hargasarana*25/100);
			$hargapelayananx=$hargapelayanan+($hargapelayanan*25/100);
		}else{
			$hargasaranax=$hargasarana;
			$hargapelayananx=$hargapelayanan;		
		}
		
		/*cek data pemeriksaan jangan sampe dobel OK */
		$conn->query("delete from rs51 where rs1='".trim($_GET['noreg'])."' and rs2='".$notax."' and rs4='".$kodelab[$i]."' and rs3='".$tanggal."'");
		$conn->query("insert into rs51(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12,rs13,rs14,rs15,rs16,rs17,rs18,rs19)	
		values('".trim($_GET['noreg'])."','".$notax."','".$tanggal."',
		'".$kodelab[$i]."','".trim($_GET['jumlah_laborat'])."','".$hargasarana."',
		'".$hargasarana."','".trim($_GET['kodedokter'])."','".$_SESSION['loginrsx_user']."','','','',
		'".$hargapelayanan."','".$hargapelayanan."','',
		'','','','')");
		$i++;
	}
	$conn->query("update rs51 set rs20='2' where rs1='".trim($_GET['noreg'])."'");
	echo "OK|".$notax;
?>
<?php include_once "../../close.php";?>
