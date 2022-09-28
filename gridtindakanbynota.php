<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Tindakan";
	$sColumns = "tgl=Tanggal,keterangan=Keterangan,biaya=Biaya,jml=Jml,subtotal=Sub Total";
	$sIndexColumn = "id";
	$sQuery = $conn->query("select rs73.id as id,rs73.rs3 as tgl,rs30.rs2 as keterangan,round(rs73.rs7+rs73.rs13,0) as biaya,
	rs73.rs5 as jml,((rs73.rs7+rs73.rs13)*rs73.rs5) as subtotal from rs73,rs30 where rs30.rs1=rs73.rs4 
	and rs73.rs2='".trim($_GET['nota'])."' order by rs73.id");
	$sTotal = $sQuery->num_rows;
	
	$sCols=array();	
	while ($x < $sQuery->field_count) { 
		$col=$sQuery->fetch_field();
		$sCols[]= $col->name ;          
        $x++;
	}
	
		
	$countCols = $x;

	$sTipeDatax = array("","","numeric","numeric","numeric");
	
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
	
	if($sQuery && $sQuery->num_rows){
		while($sRow=$sQuery->fetch_object()){
			$sData['sRow'][] = $sRow;
		}
	}
	
	echo json_encode($sData);
	flush();	
?>
<?php include_once "../../close.php";?>
