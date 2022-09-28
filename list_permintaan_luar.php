<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Pasien Permintaan Luar RS";
	$sColumns = 
	"nota=Nota,
	tgl=Tanggal,
	nama=Nama,
	kelamin=Kelamin,
	alamat=Alamat,
	tgl_lahir=
	Tgl Lahir,
	pengirim=Dokter Pengirim,
	perusahaan=Perusahaan,
	lunas=Lunas,
	akhir=Kunci,
	akhirx=Akhir,
	cetak=Cetak";
	$sIndexColumn = "nota";
	$sHeaderDetail = false;	
	$sColsHeader = "";
	$sColsDetail = "";
	$sQuery = $conn->query("SELECT if(perusahaan.perusahaan is null,'',perusahaan.perusahaan) 
	perusahaan,
	lab_luar.nota,
	lab_luar.tgl,
	lab_luar.nama,
	lab_luar.kelamin,
	lab_luar.alamat,
	lab_luar.tgl_lahir,
	lab_luar.pengirim,
	if(lab_luar.lunas='1','Lunas','Belum Lunas') as lunas,
	if(lab_luar.akhir='1','Terkunci','Belum Terkunci') as akhir,
	if(lab_luar.akhirx='1','Terlayani','Belum Terlayani') as akhirx,
	if(lab_luar.akhir='1' and lab_luar.akhirx='',concat('<input type=\'button\' value=\'Pengantar\' onclick=\'cetak_lab_luar(\"',lab_luar.nota,'\");\'>'),
	if(lab_luar.akhir='1' and lab_luar.akhirx='1',concat('<input type=\'button\' value=\'Hasil\' onclick=\'cetak_hasil_lab_luar(\"',lab_luar.nota,'\");\'>'),'')) as cetak
	FROM lab_luar left join perusahaan on lab_luar.perusahaan_id=perusahaan.id WHERE YEAR(lab_luar.tgl)='".$_GET["thn"]."' AND MONTH(lab_luar.tgl)='".$_GET["bln"]."' GROUP BY lab_luar.nota order by lab_luar.tgl desc;");
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
			$arr_row['nota'] = $row->nota;
			$arr_row['tgl'] = $row->tgl;
			$arr_row['nama'] = $row->nama;
			$arr_row['kelamin'] = $row->kelamin;
			$arr_row['alamat'] = $row->alamat; 
			$arr_row['tgl_lahir'] = $row->tgl_lahir;  
			$arr_row['pengirim'] = $row->pengirim; 
			$arr_row['perusahaan'] = $row->perusahaan; 
			$arr_row['lunas'] = $row->lunas;
			$arr_row['akhir'] = $row->akhir;
			$arr_row['akhirx'] = $row->akhirx;
			$arr_row['cetak'] = $row->cetak; 			
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
