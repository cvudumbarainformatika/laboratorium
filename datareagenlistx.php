<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Permintaan Reagen";
	$sColumns = "nokwitansi=No. Permintaan,pengambil=Peminta,keterangan=Keterangan,tanggalminta=Tanggal Peminta";
	$sIndexColumn = "nokwitansi";
	$sHeaderDetail = false;	
	$sColsHeader = "";
	$sColsDetail = "";
	$sQuery = $conn->query("select rs1 as nokwitansi,rs2 as pengambil,rs3 as keterangan,rs4 as tanggalminta from rs266");
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
			$arr_row['nokwitansi'] = $row->nokwitansi;
			$arr_row['pengambil'] = $row->pengambil;
			$arr_row['keterangan'] = $row->keterangan;
			$arr_row['tanggalminta'] = $row->tanggalminta;
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
