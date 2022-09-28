<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Catantan";
	$sColumns = "ket=Catatan";
	$sIndexColumn = "id";
	$sQuery = $conn->query("select id,rs2 as tanggal,rs3 as interpretasi,
	rs4 as saran,ket from rs215 where rs1='".trim($_GET['noreg'])."' order by id");
	$sTotal = $sQuery->num_rows;
	
	$sCols=array();	
	while ($x < $sQuery->field_count) { 
		$col=$sQuery->fetch_field();
		$sCols[]= $col->name ;          
        $x++;
	}
	
		
	$countCols = $x;

	$sTipeDatax = array("");
	
	$sData = array(
		"Title"=>$sTitle,
		"Columns"=>$sColumns,
		"IndexColumn"=>$sIndexColumn,
		"Total"=>$sTotal,
		"Cols"=>$sCols,
		"countCols"=>$countCols,
		"TipeDatax"=>$sTipeDatax,
		"sRow"=>array()
	);
	
	if ($sQuery && $sQuery->num_rows){
		while($row = $sQuery->fetch_object()){
			$arr_row=array();
			$arr_row['id'] = $row->id;
			$arr_row['ket'] = $row->ket;
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
