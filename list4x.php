<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Pasien Lalu Sudah";
	$sColumns = "tanggal=Tanggal,nota=No.Nota,norm=No.RM,nama=Nama,alamat=Alamat,kelamin=Kelamin,umur=Umur,poli=Poli,tipe=Tipe,dokter=Dokter,sistembayar=Sistem Bayar,cetak=Cetak";
	$sIndexColumn = "nota";
	$sHeaderDetail = false;	
	$sColsHeader = "";
	$sColsDetail = "";
	$sQuery = $conn->query("select tanggal,nota,norm,nama,alamat,kelamin,IF(thn<1,IF(bln<1,concat(hari,' hari'),concat(bln,' bln')),concat(thn,' thn')) as umur,
	poli,tipe,dokter,sistembayar,'' as cetak from(
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
	and rs17.rs19='1' and month(rs17.rs3)='".date("Y")."'
	and rs17.rs8='PEN002' group by rs17.rs1
	union all*/
	select distinct rs51.rs2 as nota,IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')/365)),floor((datediff(rs17.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs17.rs3,'1970-01-01')-((floor((datediff(rs17.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs17.rs3,rs15.rs16)-((floor((datediff(rs17.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,
	rs17.rs6 as kodeasalrujukan,rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as kodepoli,rs19.rs2 as poli,
	rs17.rs18 as userid,rs17.rs19 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,rs51.rs3 as tgl,
	concat(dayofmonth(rs51.rs3),'-',month(rs51.rs3),'-',year(rs51.rs3),' ',time(rs51.rs3)) as tanggal,rs21.rs2 as dokter 
	from rs15,rs17,rs19,rs9,rs51,rs21 where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14 and rs51.rs1=rs17.rs1 and rs21.rs1=rs51.rs8
	and rs51.rs20='2' and year(rs51.rs3)='".date("Y")."' and (isnull(rs51.rs23) or rs51.rs23='POL014' or rs51.rs23='' or rs51.rs23='POL001' or rs51.rs23='POL002' or rs51.rs23='POL003'
	or rs51.rs23='POL004' or rs51.rs23='POL005' or rs51.rs23='POL006' or rs51.rs23='POL007' or rs51.rs23='POL008' or rs51.rs23='POL009' 
	or rs51.rs23='POL010' or rs51.rs23='POL011' or rs51.rs23='POL012' or rs51.rs23='POL013' or rs51.rs23='POL015' or rs51.rs23='POL016' 
	or rs51.rs23='POL017' or rs51.rs23='POL018' or rs51.rs23='POL019' or rs51.rs23='POL020' or rs51.rs23='POL021' or rs51.rs23='POL022' 
	or rs51.rs23='POL023' or rs51.rs23='POL024' or rs51.rs23='POL025' or rs51.rs23='POL026' or rs51.rs23='POL027' or rs51.rs23='POL028' 
	or rs51.rs23='POL032' or rs51.rs23='PEN005' or rs51.rs23='POL034' or rs51.rs23='POL035' or rs51.rs23='POL036' or rs51.rs23='POL037' 
	or rs51.rs23='POL038' or rs51.rs23='POL039' or rs51.rs23='POL040')
	group by rs51.rs2
	union all
	select distinct rs51.rs2 as nota,IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')/365)),floor((datediff(rs23.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs23.rs3,'1970-01-01')-((floor((datediff(rs23.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs23.rs3,rs15.rs16)-((floor((datediff(rs23.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs23.rs2 as norm,rs23.rs19 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs23.rs3 as tanggalmasuk,rs23.rs11 as penanggungjawab,
	rs23.rs13 as kodeasalrujukan,rs23.rs20 as asalpendaftaran,rs23.rs16 as namaperujuk,rs23.rs5 as koderuang,rs24.rs2 as ruang,
	rs23.rs30 as userid,rs23.rs28 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,rs51.rs3 as tgl,
	concat(dayofmonth(rs51.rs3),'-',month(rs51.rs3),'-',year(rs51.rs3),' ',time(rs51.rs3)) as tanggal,rs21.rs2 as dokter 
	from rs15,rs23,rs24,rs9,rs51,rs21 where rs15.rs1=rs23.rs2 and rs23.rs5=rs24.rs1 and rs9.rs1=rs23.rs19 and rs51.rs1=rs23.rs1 and rs21.rs1=rs51.rs8
	and rs51.rs20='2' and year(rs51.rs3)='".date("Y")."'
	and (rs51.rs23='ME' or rs51.rs23='FA' or rs51.rs23='MA' or rs51.rs23='WK' or rs51.rs23='BG' or rs51.rs23='IC' or rs51.rs23='ICC'
	or rs51.rs23='DA' or rs51.rs23='BR' or rs51.rs23='WKVVIP' or rs51.rs23='WKUT' or rs51.rs23='WKKB' or rs51.rs23='KA' or rs51.rs23='ISHK' or rs51.rs23='TR')
	group by rs51.rs2
	) as v_15_17_23_51 order by tgl");
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
			$arr_row['tipe'] = $row->tipe;
			$arr_row['dokter'] = $row->dokter; 
			$arr_row['sistembayar'] = $row->sistembayar; 
			$cetak="";
			$cetak="<input type='button' value='Cetak' onclick='cetakhasil(\"$row->nota\");'>";
			$arr_row['cetak'] = $cetak;  
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
