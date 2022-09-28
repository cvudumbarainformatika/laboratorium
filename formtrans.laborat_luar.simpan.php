<?php include_once "../../conn.php";?>
<?php
if($_SESSION['loginrsx_kodebag']<>"" || $_SESSION['loginrsx_user']=="sa"){
$pekerjaan=explode(";",$_GET['pekerjaan']);
$kodepekerjaan=$pekerjaan[0];
$namapekerjaan=$pekerjaan[1];	
$sampel_diambil=format_tgl_inx($_GET["sampel_diambil"],"/");
$sampel_selesai=format_tgl_inx($_GET["sampel_selesai"],"/");
	//buat nota lab
	if(trim($_GET['nota'])==""){
		$sqlx=$conn->query("call nota_permintaanlab(@nomor);");
		$sqlx=$conn->query("select @nomor as nomor;");
		$jmlx=$sqlx->num_rows;
		if($jmlx>0){ 
			$rsx=$sqlx->fetch_object();
			$counter=$rsx->nomor+1;
		}
		$notax=gennota($counter,"L");
	}else{
		$notax=trim($_GET['nota']);
	}
	
	// $sql_kunci_permintaan=$conn->query("select rs18 as kunci from rs51 where rs2='".$notax."' group by rs2");
	// $rs_kunci_permintaan=$sql_kunci_permintaan->fetch_object();
	// $kunci=$rs_kunci_permintaan->kunci;
	
	// if($kunci==1){
		// echo "Maaf Permintaan Ini Sudah Di kunci Oleh Petugas Laborat";
	// }else{
		//$sisbayar=$_GET['kd_akun'];
		// $sqlx=$conn->query("select rs2 as sisbayar from rs9 where rs1='".$sisbayar."'",$connection);
		// while($rsx=$sqlx->fetch_object()){
			// $sisbayar=$rsx->sisbayar;
		// }
		//$tgllahir=format_tgl_in();
		$kodelab=explode(";",trim($_GET['kode_laborat']));
		$i=1;
		while($i<count($kodelab)){	
			$sql=$conn->query("select rs3,rs4,rs5,rs6 from rs49 where rs1='".$kodelab[$i]."'");
			while($rs=$sql->fetch_object()){
				//if($_GET['kodepoli']=="POL022"){
					$hargasarana=$rs->rs3;
					$hargapelayanan=$rs->rs4;
				// }else{
					// $hargasarana=$rs->rs5;
					// $hargapelayanan=$rs->rs6;			
				// }
			}
			if(trim($_GET['flagcito'])=="cito"){
				$hargasaranax=$hargasarana+($hargasarana*25/100);
				$hargapelayananx=$hargapelayanan+($hargapelayanan*25/100);
			}else{
				$hargasaranax=$hargasarana;
				$hargapelayananx=$hargapelayanan;		
			}
			
			$nmtindakan=$kodelab[$i];
			$sql=$conn->query("select rs2 as nmtindakan from rs49 where rs1='".$nmtindakan."'");
			while($rs=$sql->fetch_object()){
				$nmtindakan=$rs->nmtindakan;
			}

			$sqlInsert = "insert into 
			lab_luar(
				nama,
				kelamin,
				alamat,
				pengirim,
				tgl_lahir,
				tgl,
				nota,
				kd_lab,
				jml,
				tarif_sarana,
				tarif_pelayanan,
				jenispembayaran,
				jam_sampel_selesai,
				jam_sampel_diambil,
				sampel_selesai,
				sampel_diambil,
				perusahaan_id,
				noktp,
				nosurat,
				temp_lahir,
				agama,nohp,
				kode_pekerjaan,
				nama_pekerjaan
				)	
			values('".$_GET["jam_sampel_selesai"]."','".$_GET["jam_sampel_diambil"]."','".$sampel_selesai."','".$sampel_diambil."','".$_GET["perusahaan"]."','".$_GET["nama"]."','".$_GET["kelamin"]."','".$_GET["alamat"]."',
			'".$_GET["pengirim"]."','".format_tgl_inx($_GET["tgllahir"],"/")."','".date("Y-m-d H:i:s")."','".$notax."',
			'".$kodelab[$i]."','".$_GET["jumlah_laborat"]."','".$hargasaranax."','".$hargapelayananx."','".$_GET["jenispembayaran"]."',
			'".$_GET["noktp"]."','".$_GET["nosurat"]."','".$_GET["templahir"]."','".$_GET["agama"]."','".$_GET["nohp"]."','".$kodepekerjaan."','".$namapekerjaan."')";
			
			/*cek data pemeriksaan jangan sampe dobel OK */
			//$conn->query("delete from rs51 where rs1='".trim($_GET['noreg'])."' and rs2='".$notax."' and rs4='".$kodelab[$i]."' and rs3='".date("Y-m-d H:i:s")."'",$connection);
			$conn->query($sqlInsert);
			
			// $sqlz=$conn->query("select id as idx from rs51 where rs1='".trim($_GET['noreg'])."' and rs2='".$notax."' and rs4='".$kodelab[$i]."'",$connection);
			// while($rsz=$sqlz->fetch_object()){
				// $idx=$rsz->idx;
			// }
			
			//$paketlaborat=explode(";",trim($_GET['paket_laborat']));
			//$connx->query("insert into laborat(noreg,nota,tanggal,kodetindakan,jumlah,sarana,saranax,kodedokter,userid,namapasien,norm,kelamin,pelayanan,pelayananx,tanggallahir,umur,alamat,ruangasal,kodeasalruang,kodesistembayar,sistembayar,namatindakan,paket,namadokter,idx)	
			//values('".trim($_GET['noreg'])."','".$notax."','".date("Y-m-d H:i:s")."',
			//'".$kodelab[$i]."','".trim($_GET['jumlah_laborat'])."','',
			//'','".trim($_GET['kodedokter'])."','".$_SESSION['loginrsx_user']."','".trim($_GET['nama'])."','".trim($_GET['norm'])."','".trim($_GET['kelamin'])."',
			//'','','".trim($_GET['tgllahir'])."',
			//'".trim($_GET['umurthn'])."','".trim($_GET['alamat'])."','".trim($_GET['poli'])."','".trim($_GET['kd_ruang'])."','".trim($_GET['kd_akun'])."','".$sisbayar."','".$nmtindakan."','".$paketlaborat[$i]."','".trim($_GET['dokter'])."','".$idx."')");
			
			$i++;
		}
		echo "OK|".$notax;
	//}
}else{
	echo "Maaf, anda tidak berhak menyimpan";
}
?>
<?php include_once "../../close.php";?>
