<?php include_once "../../conn.php";?>
<?php
if ( !isset($_REQUEST['term']) )   exit;

$sql=$conn->query("select rs1 as kode,rs2 as pemeriksaan,rs21 as kelompok FROM rs49 where concat(rs2,' ',rs21) like '%". $_REQUEST['term'] ."%' 
				and hidden<>1 ");
$data=array();
if ($sql && $sql->num_rows){
    while( $rs = $sql->fetch_object()){
		if($rs->kelompok==""){
			$data[] = array(
				'label' => $rs->pemeriksaan .', ['. $rs->kode .']' ,
				'kode' =>  $rs->kode ,
				'value' => $rs->pemeriksaan ,
			);			
		}else{
			$data[] = array(
				'label' => $rs->pemeriksaan .', ['. $rs->kode .'], ('.$rs->kelompok.')',
				'kode' =>  $rs->kode ,
				'value' => $rs->pemeriksaan ,
			);				
		}
    }
}

echo json_encode($data);
flush();

?>
	
<?php include_once "../../close.php";?>