<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Pasien Hari Ini Sudah";
	$sColumns = "tanggal=Tanggal,nota=No.Nota,norm=No.RM,nama=Nama,alamat=Alamat,kelamin=Kelamin,umur=Umur,poli=Poli,kamar=Kamar,tipe=Tipe,dokter=Dokter,sistembayar=Sistem Bayar,cetak=Cetak,kuncitrans=Kunci Transaksi";
	$sIndexColumn = "nota";
	$sHeaderDetail = false;	
	$sColsHeader = "";
	$sColsDetail = "";
	$sQuery = $conn->query("select kamar,tanggal,nota,norm,nama,alamat,kelamin,IF(thn<1,IF(bln<1,concat(hari,' hari'),concat(bln,' bln')),concat(thn,' thn')) as umur,
	poli,kunci,tipe,dokter,sistembayar,'' as cetak from(
	/*select distinct rs17.rs1 as nota,IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')/365)),floor((datediff(rs17.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs17.rs3,'1970-01-01')-((floor((datediff(rs17.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs17.rs3,rs15.rs16)-((floor((datediff(rs17.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,
	rs17.rs6 as kodeasalrujukan,rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as kodepoli,rs19.rs2 as poli,
	rs17.rs18 as userid,rs17.rs19 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,rs17.rs3 as tgl,
	concat(dayofmonth(rs17.rs3),'-',month(rs17.rs3),'-',year(rs17.rs3),' ',time(rs17.rs3)) as tanggal,'' as dokter
	from rs15,rs17,rs19,rs9	where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14
	and rs17.rs19='1' and year(rs17.rs3)='".date("Y")."' and month(rs17.rs3)='".date("m")."' and dayofmonth(rs17.rs3)='".date("d")."'
	and rs17.rs8='PEN002' group by rs17.rs1
	union all*/
	select v_lab.*,rs15.rs2 as nama,rs15.rs4 as alamat,rs15.rs17 as kelamin,
	IF(rs15.rs16='1900-01-01',floor((datediff(v_lab.kunjungan,'1970-01-01')/365)),floor((datediff(v_lab.kunjungan,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(v_lab.kunjungan,'1970-01-01')-(floor((datediff(v_lab.kunjungan,'1970-01-01')/365))*365))/30),
	floor((datediff(v_lab.kunjungan,rs15.rs16)-(floor((datediff(v_lab.kunjungan,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(v_lab.kunjungan,'1970-01-01')-((floor((datediff(v_lab.kunjungan,'1970-01-01')/365))*365)+(floor((datediff(v_lab.kunjungan,'1970-01-01')-(floor((datediff(v_lab.kunjungan,'1970-01-01')/365))*365))/30)*30))),
	(datediff(v_lab.kunjungan,rs15.rs16)-((floor((datediff(v_lab.kunjungan,rs15.rs16)/365))*365)+(floor((datediff(v_lab.kunjungan,rs15.rs16)-(floor((datediff(v_lab.kunjungan,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs19.rs2 as poli,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,'' as cetak from (
	select distinct rs51.rs2 as nota,rs17.rs1 as noreg,'' as kamar,rs17.rs2 as norm,rs17.rs3 as kunjungan,rs51.rs3 as tanggal,rs51.rs18 as kunci,
	rs21.rs2 as dokter,rs17.rs8 as kd_poli,rs17.rs14 as kd_sistem_bayar from rs51,rs17,rs21 where rs51.rs1=rs17.rs1 and rs51.rs8=rs21.rs1
	and year(rs51.rs3)='".date("Y")."' and month(rs51.rs3)='".date("m")."' and dayofmonth(rs51.rs3)='".date("d")."' and rs51.rs20='2'
	and (isnull(rs51.rs23) or rs51.rs23='POL014' or rs51.rs23='' or rs51.rs23='POL001' or rs51.rs23='POL002' or rs51.rs23='POL003'
	or rs51.rs23='POL004' or rs51.rs23='POL005' or rs51.rs23='POL006' or rs51.rs23='POL007' or rs51.rs23='POL008' or rs51.rs23='POL009' 
	or rs51.rs23='POL010' or rs51.rs23='POL011' or rs51.rs23='POL012' or rs51.rs23='POL013' or rs51.rs23='POL015' or rs51.rs23='POL016' 
	or rs51.rs23='POL017' or rs51.rs23='POL018' or rs51.rs23='POL019' or rs51.rs23='POL020' or rs51.rs23='POL021' or rs51.rs23='POL022' 
	or rs51.rs23='POL023' or rs51.rs23='POL024' or rs51.rs23='POL025' or rs51.rs23='POL026' or rs51.rs23='POL027' or rs51.rs23='POL028' 
	or rs51.rs23='POL032' or rs51.rs23='PEN005' or rs51.rs23='POL034' or rs51.rs23='POL035' or rs51.rs23='POL036' or rs51.rs23='POL037' 
	or rs51.rs23='POL038' or rs51.rs23='POL039' or rs51.rs23='POL040')
	group by rs51.rs2 ) as v_lab,rs15,rs19,rs9 where v_lab.norm=rs15.rs1 and v_lab.kd_poli=rs19.rs1 and v_lab.kd_sistem_bayar=rs9.rs1
	union all
	select v_lab.*,rs15.rs2 as nama,rs15.rs4 as alamat,rs15.rs17 as kelamin,
	IF(rs15.rs16='1900-01-01',floor((datediff(v_lab.kunjungan,'1970-01-01')/365)),floor((datediff(v_lab.kunjungan,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(v_lab.kunjungan,'1970-01-01')-(floor((datediff(v_lab.kunjungan,'1970-01-01')/365))*365))/30),
	floor((datediff(v_lab.kunjungan,rs15.rs16)-(floor((datediff(v_lab.kunjungan,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(v_lab.kunjungan,'1970-01-01')-((floor((datediff(v_lab.kunjungan,'1970-01-01')/365))*365)+(floor((datediff(v_lab.kunjungan,'1970-01-01')-(floor((datediff(v_lab.kunjungan,'1970-01-01')/365))*365))/30)*30))),
	(datediff(v_lab.kunjungan,rs15.rs16)-((floor((datediff(v_lab.kunjungan,rs15.rs16)/365))*365)+(floor((datediff(v_lab.kunjungan,rs15.rs16)-(floor((datediff(v_lab.kunjungan,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs24.rs2 as poli,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,'' as cetak from (
	select distinct rs51.rs2 as nota,rs23.rs1 as noreg,rs23.rs6 as kamar,rs23.rs2 as norm,rs23.rs3 as kunjungan,rs51.rs3 as tanggal,rs51.rs18 as kunci,
	rs21.rs2 as dokter,rs23.rs5 as kd_poli,rs23.rs19 as kd_sistem_bayar from rs51,rs23,rs21 where rs51.rs1=rs23.rs1 and rs51.rs8=rs21.rs1
	and year(rs51.rs3)='".date("Y")."' and month(rs51.rs3)='".date("m")."' and dayofmonth(rs51.rs3)='".date("d")."' and rs51.rs20='2'
	and (rs51.rs23='ME' or rs51.rs23='FA' or rs51.rs23='MA' or rs51.rs23='WK' or rs51.rs23='BG' or rs51.rs23='IC' or rs51.rs23='ICC'
	or rs51.rs23='DA' or rs51.rs23='BR' or rs51.rs23='WKVVIP' or rs51.rs23='WKUT' or rs51.rs23='WKKB' or rs51.rs23='KA' or rs51.rs23='ISHK' or rs51.rs23='TR')
	group by rs51.rs2 ) as v_lab,rs15,rs24,rs9 where v_lab.norm=rs15.rs1 and v_lab.kd_poli=rs24.rs1 and v_lab.kd_sistem_bayar=rs9.rs1
	) as v_15_17_23_51 order by tanggal");
	$sTotal = $sQuery->num_rows;
	
	$sCols=array();	
	while ($x < $sQuery->field_count) { 
		$col=$sQuery->fetch_field();
		$sCols[]= $col->name ;          
        $x++;
	}
	
	if($sHeaderDetail==true){
		$jml = explode('|',$sColsHeader);
		for($i=1;$i<=count($jml)-2;$i++){}
		$x=$i-1;
	}
		
	$countCols = $x;

//	$sTipeDatax = array("","","","","","numeric","","","","","numeric","","","numeric","numeric","numeric","","","numeric","","","numeric","numeric","numeric","","");
	
	$sData = array(
		"Title"=>$sTitle,
		"Columns"=>$sColumns,
		"IndexColumn"=>$sIndexColumn,
		"Total"=>$sTotal,
		"HeaderDetail"=>$sHeaderDetail,
		"ColsHeader"=>$sColsHeader,
		"ColsDetail"=>$sColsDetail,
		"Cols"=>$sCols,
		"countCols"=>$countCols,
		"TipeDatax"=>$sTipeDatax,
		"sRow"=>array()
	);
			

	if ($sQuery && $sQuery->num_rows){
		while($row = $sQuery->fetch_object()){
			$arr_row=array();
			$arr_row['no'] = $i;
			$arr_row['tanggal'] = $row->tanggal;
			$arr_row['nota'] = $row->nota;
			$arr_row['norm'] = $row->norm;
			$arr_row['nama'] = $row->nama;
			$arr_row['alamat'] = $row->alamat;  
			$arr_row['kelamin'] = $row->kelamin;
			$arr_row['umur'] = $row->umur; 
			$arr_row['poli'] = $row->poli;
			$arr_row['kamar'] = $row->kamar;
			$arr_row['tipe'] = $row->tipe;
			$arr_row['dokter'] = $row->dokter; 
			$arr_row['sistembayar'] = $row->sistembayar;   
			$cetak="";
			$cetak="<input type='button' value='Cetak' onclick='cetakhasil(\"$row->nota\");'>";
			$arr_row['cetak'] = $cetak;
			$arr_row['kunci'] = $row->kunci;
			$sqlx=$conn->query("select rs18 as kunci from rs51 where rs2='".$arr_row['nota']."' group by rs2");
			$rsx=$sqlx->fetch_object();
			if($rsx->kunci==1){
				$arr_row['kuncitrans'] = "<span id='c_kesesuaian_".$i."'>
				<input type='button' value='Batal Kunci' onclick='batalKunci(\"c_kesesuaian_".$i."\",\"$row->nota\");'>";
			}else{
				$arr_row['kuncitrans'] = "<span id='c_kesesuaian_".$i."'>
				<input type='button' value='Kunci' onclick='kuncipermintaan(\"c_kesesuaian_".$i."\",\"$row->nota\");'>";
			}
			$sData['sRow'][] = $arr_row;
		} 
	}    			
	
//	if($sQuery && $sQuery->num_rows){
//		while($sRow=$sQuery->fetch_object()){
//			$sData['sRow'][] = $sRow;
//		}
//	}
	
	echo json_encode($sData);
	flush();	
?>
<?php include_once "../../close.php";?>
