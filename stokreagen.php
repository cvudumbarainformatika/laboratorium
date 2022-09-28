<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Stok Laborat";
	$sColumns = "kode=Kode Barang,nama=Nama Barang,jumlah=Jumlah";
	$sIndexColumn = "nokwitansi";
	$sHeaderDetail = false;	
	$sColsHeader = "";
	$sColsDetail = "";
	$sQuery = $conn->query("select rs98x.rs1 as kode,rs32.rs2 as nama,rs98x.rs2 as jumlah from rs32,rs98x where rs32.rs1=rs98x.rs1 and rs98x.rs4='PEN002' order by rs98x.rs1");
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

	$sTipeDatax = array("","","numeric");
	
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
			$arr_row['kode'] = $row->kode;
			$arr_row['nama'] = $row->nama;
			$arr_row['jumlah'] = $row->jumlah;
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
