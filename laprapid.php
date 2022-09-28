<?php include_once "../../conn.php";?>
<?php			
	$sTitle = "Laporan Pemeriksaan Rapid Perbulan";
	if($_GET['jenis']=="rekap"){
		$sColumns = "no=No,pemeriksaan=Pemeriksaan,jumlah=Jumlah";
		$sTipeDatax = array("","","numeric");	
		$sQuery = $conn->query("
		SELECT pemeriksaan,COUNT(norm) AS jumlah FROM (
		SELECT rs15.rs49 AS nik,rs15.rs1 AS norm,rs15.rs4 AS alamat,rs51.rs1 AS noreg,rs51.rs2 AS nota,rs15.rs2 AS nama,rs51.rs3 AS tanggal,
		rs49.rs2 AS pemeriksaan,rs51.rs21 AS hasil,rs9.rs2 AS sistembayar,v_gudang.rs2 asal,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365)),FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))) AS thn,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365))*365))/30),FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))*365))/30)) AS bln,
		IF(rs15.rs16='1900-01-01',(DATEDIFF(rs23.rs3,'1970-01-01')-((FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365))*365)+(FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365))*365))/30)*30))),
		(DATEDIFF(rs23.rs3,rs15.rs16)-((FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))*365)+(FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))*365))/30)*30)))) AS hari	
		FROM rs51,rs49,rs9,rs23,rs15,v_gudang
		WHERE rs49.rs1=rs51.rs4 AND rs9.rs1=rs51.rs24 AND rs23.rs1=rs51.rs1 AND rs51.rs23=v_gudang.rs1 
		AND rs23.rs2=rs15.rs1 AND YEAR(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' AND rs49.rs2 LIKE '%rapid%'   
		UNION ALL
		SELECT rs15.rs49 AS nik,rs15.rs1 AS norm,rs15.rs4 AS alamat,rs51.rs1 AS noreg,rs51.rs2 AS nota,rs15.rs2 AS nama,rs51.rs3 AS tanggal,
		rs49.rs2 AS pemeriksaan,rs51.rs21 AS hasil,rs9.rs2 AS sistembayar,rs19.rs2 asal,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365)),FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))) AS thn,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365))*365))/30),FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))*365))/30)) AS bln,
		IF(rs15.rs16='1900-01-01',(DATEDIFF(rs17.rs3,'1970-01-01')-((FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365))*365)+(FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
		(DATEDIFF(rs17.rs3,rs15.rs16)-((FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))*365)+(FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) AS hari	
		FROM rs51,rs49,rs9,rs17,rs15,rs19
		WHERE rs49.rs1=rs51.rs4 AND rs9.rs1=rs51.rs24 AND rs17.rs1=rs51.rs1 AND rs51.rs23=rs19.rs1
		AND rs17.rs2=rs15.rs1 AND YEAR(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' AND rs49.rs2 LIKE '%rapid%'
		) AS wew GROUP BY pemeriksaan
	UNION ALL SELECT 'Jumlah' AS pemeriksaan, COUNT(norm) AS jumlah FROM
		(SELECT rs15.rs49 AS nik,rs15.rs1 AS norm,rs15.rs4 AS alamat,rs51.rs1 AS noreg,rs51.rs2 AS nota,rs15.rs2 AS nama,rs51.rs3 AS tanggal,
		rs49.rs2 AS pemeriksaan,rs51.rs21 AS hasil,rs9.rs2 AS sistembayar,v_gudang.rs2 asal,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365)),FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))) AS thn,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365))*365))/30),FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))*365))/30)) AS bln,
		IF(rs15.rs16='1900-01-01',(DATEDIFF(rs23.rs3,'1970-01-01')-((FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365))*365)+(FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs23.rs3,'1970-01-01')/365))*365))/30)*30))),
		(DATEDIFF(rs23.rs3,rs15.rs16)-((FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))*365)+(FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs23.rs3,rs15.rs16)/365))*365))/30)*30)))) AS hari	
		FROM rs51,rs49,rs9,rs23,rs15,v_gudang
		WHERE rs49.rs1=rs51.rs4 AND rs9.rs1=rs51.rs24 AND rs23.rs1=rs51.rs1 AND rs51.rs23=v_gudang.rs1 
		AND rs23.rs2=rs15.rs1 AND YEAR(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' AND rs49.rs2 LIKE '%rapid%'   
		UNION ALL
		SELECT rs15.rs49 AS nik,rs15.rs1 AS norm,rs15.rs4 AS alamat,rs51.rs1 AS noreg,rs51.rs2 AS nota,rs15.rs2 AS nama,rs51.rs3 AS tanggal,
		rs49.rs2 AS pemeriksaan,rs51.rs21 AS hasil,rs9.rs2 AS sistembayar,rs19.rs2 asal,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365)),FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))) AS thn,
		IF(rs15.rs16='1900-01-01',FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365))*365))/30),FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))*365))/30)) AS bln,
		IF(rs15.rs16='1900-01-01',(DATEDIFF(rs17.rs3,'1970-01-01')-((FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365))*365)+(FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')-(FLOOR((DATEDIFF(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
		(DATEDIFF(rs17.rs3,rs15.rs16)-((FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))*365)+(FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)-(FLOOR((DATEDIFF(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) AS hari	
		FROM rs51,rs49,rs9,rs17,rs15,rs19
		WHERE rs49.rs1=rs51.rs4 AND rs9.rs1=rs51.rs24 AND rs17.rs1=rs51.rs1 AND rs51.rs23=rs19.rs1
		AND rs17.rs2=rs15.rs1 AND YEAR(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' AND rs49.rs2 LIKE '%rapid%')AS total
		");
	}else{
		$sColumns = "noreg=Noreg,nota=No.Nota,nik=NIK,norm=No.RM,nama=Nama,alamat=Alamat,umur=Umur,tanggal=Tanggal,pemeriksaan=Pemeriksaan,hasil=Hasil,sistembayar=Sistembayar,asal=Asal Ruangan,anamnese=Anamnese";
		//$sTipeDatax = array("","","");	
		$sQuery = $conn->query("select nik,norm,alamat,noreg,nota,nama,tanggal,pemeriksaan,hasil,sistembayar,asal,IF(thn<1,IF(bln<1,concat(hari,' hari'),concat(bln,' bln')),concat(thn,' thn')) as umur from (
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
		and rs17.rs2=rs15.rs1 and year(rs51.rs3)='".trim($_GET['tahun'])."' and month(rs51.rs3)='".trim($_GET['bulan'])."' and rs49.rs2 like '%rapid%') as wew");	
	}		
	
	$sTotal = $sQuery->num_rows;
	
	$sCols=array();	
	while ($x < $sQuery->field_count) { 
		$col=$sQuery->fetch_field();
		$sCols[]= $col->name ;          
        $x++;
	}
	

	
	$sData = array(
		"Title"=>$sTitle,
		"Columns"=>$sColumns,
		"Total"=>$sTotal,
		"Cols"=>$sCols,
		"TipeDatax"=>$sTipeDatax,
		"sRow"=>array()
	);	
	
	if($_GET['jenis']=="rekap"){
		if ($sQuery && $sQuery->num_rows){
			$i=0;
			while($row = $sQuery->fetch_object()){
				$i=$i+1;
				$arr_row=array();
				if($row->pemeriksaan=="Jumlah"){
					$arr_row['no'] = "";
					$arr_row['pemeriksaan'] = $row->pemeriksaan;
					$arr_row['jumlah'] = $row->jumlah;
				}else{			
					$arr_row['no'] = $i;
					$arr_row['pemeriksaan'] = $row->pemeriksaan;
					$arr_row['jumlah'] = $row->jumlah;
				}
				$sData['sRow'][] = $arr_row;
			} 
		}    		
	}else{
		$i=0;
		if ($sQuery && $sQuery->num_rows){
			while($row = $sQuery->fetch_object()){
				$i=$i+1;
				$arr_row=array();
				$arr_row['no'] = $i;
				$arr_row['no'] = $i;
				$arr_row['noreg'] = $row->noreg;
				$arr_row['nota'] = $row->nota;
				$arr_row['nik'] = $row->nik;
				$arr_row['norm'] = $row->norm;
				$arr_row['nama'] = $row->nama;
				$arr_row['alamat'] = $row->alamat;
				$arr_row['umur'] = $row->umur;
				$arr_row['tanggal'] = $row->tanggal; 
				$arr_row['pemeriksaan'] = $row->pemeriksaan;
				$arr_row['hasil'] = $row->hasil;
				$arr_row['sistembayar'] = $row->sistembayar; 
				//$arr_row['sistembayar'] = $row->sistembayar;
				$arr_row['asal'] = $row->asal; 
				$anamnese="";
				$sql_anamnese=$conn->query("select rs4 from rs209 where rs1='".$row->noreg."'");
				while($rs_anamnese=$sql_anamnese->fetch_object()){
					$anamnese.=$rs_anamnese->rs4."; ";
				}
				$arr_row['anamnese'] = $anamnese;
				$sData['sRow'][] = $arr_row;
			} 
		}  
	}  		
				
	echo json_encode($sData);
	flush();	
?>
<?php include_once "../../close.php";?>
