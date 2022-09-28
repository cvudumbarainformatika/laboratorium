<?php include_once "../../conn.php";?>
<?php	
	$sTitle = "Laborat";
	$sColumns = "tgl=Tanggal,pengirim=Dokter Pengirim,keterangan=Pemeriksaan,jml=Jml,hasil=Hasil,hl=High Low,ket=Keterangan";
	$sIndexColumn = "id";
	$sQuery = $conn->query("
	select '' as flag,lab_luar.id,lab_luar.tgl as tgl,lab_luar.pengirim as pengirim,if(rs49.rs21='',rs49.rs2,concat(rs49.rs2,' ','(',rs49.rs21,')')) as keterangan,
	(lab_luar.tarif_sarana+lab_luar.tarif_pelayanan) as biaya,
	lab_luar.jml as jml,((lab_luar.tarif_sarana+lab_luar.tarif_pelayanan)*lab_luar.jml) as subtotal,
	lab_luar.hasil,lab_luar.hl,lab_luar.ket,lab_luar.kd_lab from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab
	and lab_luar.nota='".trim($_GET['nota'])."'");
	$sTotal = $sQuery->num_rows;
	
	$sCols=array();	
	while ($x < $sQuery->field_count) { 
		$col=$sQuery->fetch_field();
		$sCols[]= $col->name ;          
        $x++;
	}
	
		
	$countCols = $x;

	$sTipeDatax = array("","","","numeric","numeric","numeric");
	
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
			$arr_row['tgl'] = $row->tgl;	
			$arr_row['pengirim'] = $row->pengirim;
			$keterangan="";
			//if($row->flag==""){ 	
				$arr_row['keterangan'] = $row->keterangan;
			// }else{
				// $sql=$conn->query("select rs49.rs2 as nama from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab 
				// and lab_luar.nota='".trim($_GET['nota'])."' and rs49.rs21='".$row->keterangan."'");
				// while($rs=$sql->fetch_object()){
					// $keterangan=$keterangan." <br>-".$rs->nama;
				// }
				// $arr_row['keterangan'] = $row->keterangan.$keterangan;			
			// }
			$arr_row['jml'] = $row->jml;
			if($row->hasil==""){
				$arr_row['hasil'] = "<input type='hidden' value='".$row->kd_lab."' name='ckd_lab[]'><input type='text' name='chasil_lab[]' size='10'>";
			}else{
				$arr_row['hasil'] = "<input type='hidden' value='".$row->kd_lab."' name='ckd_lab[]'><input type='text' name='chasil_lab[]' size='10' value='".$row->hasil."'>";
			}
			if($row->hl==""){
				$arr_row['hl'] = "<select name='chl[]'><option value=''>-</option><option value='H'>High</option><option value='L'>Low</option></select>";
			}else{
				$arr_row['hl'] = $row->hl;
				$hl1="";
				$hl2="";
				if($row->hl=="H"){
					$hl1="selected";
				}
				if($row->hl=="L"){
					$hl2="selected";
				}
				$arr_row['hl'] = "<select name='chl[]'><option value=''>-</option><option ".$hl1." value='H'>High</option><option ".$hl2." value='L'>Low</option></select>";
			}
			if($row->ket=="" || is_null($row->ket)==true){
				$arr_row['ket'] = "<input type='text' name='cket[]' size='30'>";
			}else{
				$arr_row['ket'] = "<input type='text' name='cket[]' size='30' value='".$row->ket."'>";
			}
			//$arr_row['keterangan'] = $row->keterangan.$keterangan;
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
