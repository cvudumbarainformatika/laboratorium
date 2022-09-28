<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Laporan Pemeriksaan Rapid Perbulan";
	$sColumns = "pemeriksaan=Pemeriksaan,jumlah=Jumlah";
	$sIndexColumn = "noreg";
	//$sHeaderDetail = false;	
	//$sColsHeader = "";
	//$sColsDetail = "";
	$sQuery = $conn->query("SELECT pemeriksaan,COUNT(norm) AS jumlah FROM (
	select rs15.rs49 as nik,rs15.rs1 as norm,rs15.rs4 as alamat,rs51.rs1 as noreg,rs51.rs2 as nota,rs15.rs2 as nama,rs51.rs3 as tanggal,
	rs49.rs2 as pemeriksaan,rs51.rs21 as hasil,rs9.rs2 as sistembayar,v_gudang.rs2 asal,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')/365)),floor((datediff(rs23.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs23.rs3,'1970-01-01')-((floor((datediff(rs23.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs23.rs3,rs15.rs16)-((floor((datediff(rs23.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari	
	from rs51,rs49,rs9,rs23,rs15,v_gudang
	where rs49.rs1=rs51.rs4 and rs9.rs1=rs51.rs24 and rs23.rs1=rs51.rs1 and rs51.rs23=v_gudang.rs1 
	and rs23.rs2=rs15.rs1 and year(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' and rs49.rs2 like '%rapid%'   
	union all
	select rs15.rs49 as nik,rs15.rs1 as norm,rs15.rs4 as alamat,rs51.rs1 as noreg,rs51.rs2 as nota,rs15.rs2 as nama,rs51.rs3 as tanggal,
	rs49.rs2 as pemeriksaan,rs51.rs21 as hasil,rs9.rs2 as sistembayar,rs19.rs2 asal,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')/365)),floor((datediff(rs17.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs17.rs3,'1970-01-01')-((floor((datediff(rs17.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs17.rs3,rs15.rs16)-((floor((datediff(rs17.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari	
	from rs51,rs49,rs9,rs17,rs15,rs19
	where rs49.rs1=rs51.rs4 and rs9.rs1=rs51.rs24 and rs17.rs1=rs51.rs1 and rs51.rs23=rs19.rs1
	and rs17.rs2=rs15.rs1 and year(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' and rs49.rs2 like '%rapid%') as wew GROUP BY pemeriksaan");
	$sTotal = $sQuery->num_rows;
	
	$sCols=array();	
	while ($x < $sQuery->field_count) { 
		$col=$sQuery->fetch_field();
		$sCols[]= $col->name ;          
        $x++;
	}
	
	/*if($sHeaderDetail==true){
		$jml = explode('|',$sColsHeader);
		for($i=1;$i<=count($jml)-2;$i++){}
		$x=$i-1;
	}*/
		
	$countCols = $x;

	//$sTipeDatax = array("","","","","","","","","","","numeric");
	
	$sData = array(
		"Title"=>$sTitle,
		"Columns"=>$sColumns,
		"Total"=>$sTotal,
		"Cols"=>$sCols,
		"TipeDatax"=>$sTipeDatax,
		"sRow"=>array()
	);
			

	if ($sQuery && $sQuery->num_rows){
		while($row = $sQuery->fetch_object()){
			$arr_row=array();
			$arr_row['pemeriksaan'] = $row->pemeriksaan;
			$arr_row['jumlah'] = $row->jumlah;
			$sData['sRow'][] = $arr_row;
		} 
	}    					
	
	if($sQuery && $sQuery->num_rows){
		while($sRow=$sQuery->fetch_object()){
			$sData['sRow'][] = $sRow;
		}
	}
	
	echo json_encode($sData);
	flush();	
?>
<?php include_once "../../close.php";?>
