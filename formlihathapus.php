<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "DATA PEMERIKSAAN PASIEN DIHAPUS";
	$sColumns = "tanggal=Tanggal,nota=No.Nota,norm=No.RM,nama=Nama,alamat=Alamat,kelamin=Kelamin,poli=Poli,sistembayar=Sistem Bayar";
	$sIndexColumn = "nota";
	$sHeaderDetail = false;	
	$sColsHeader = "";
	$sColsDetail = "";
	$sQuery = $conn->query("");
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
