<?php include_once "../../conn.php";?>
<?php
if ( !isset($_REQUEST['term']) )   exit;
$sql=$conn->query("select * from rs30 where rs2 like '%". $_REQUEST['term'] ."%' and rs4 like'%".$_GET['kd_ruang']."%'
order by rs1 asc limit 0,25");
$data=array();
if ($sql && $sql->num_rows){
    while( $rs = $sql->fetch_object()){	
	if($_GET['kd_ruang']=="BR"){
		if($_GET['kelas']=="3" || $_GET['kelas']=="IC" || $_GET['kelas']=="ICC" || $_GET['kelas']=="NICU" || $_GET['kelas']=="IN"){
			$sarana=$rs->rs8;
			$pelayanan=$rs->rs9;
		}else if($_GET['kelas']=="2"){
			$sarana=$rs->rs11;
			$pelayanan=$rs->rs12;
		}else if($_GET['kelas']=="1"){
			$sarana=$rs->rs14;
			$pelayanan=$rs->rs15;
		}else if($_GET['kelas']=="Utama"){
			$sarana=$rs->rs17;
			$pelayanan=$rs->rs18;
		}else if($_GET['kelas']=="VIP"){
			$sarana=$rs->rs20;
			$pelayanan=$rs->rs21;
		}else if($_GET['kelas']=="VVIP"){
			$sarana=$rs->rs23;
			$pelayanan=$rs->rs24;
		}		

	}else{
		$sarana=$rs->rs8;
		$pelayanan=$rs->rs9;

	}	
		$data[] = array(
			'label' => $rs->rs2 .' | '.rp($sarana+$pelayanan),
			'kode_tindakan' =>  $rs->rs1, 
			'sarana' =>  $sarana, 
			'pelayanan' =>$pelayanan, 
			'tarif' =>rp($sarana+$pelayanan), 
			'value' => $rs->rs2
		);
    }
}

echo json_encode($data);
flush();

?>
<?php include_once "../../close.php";?>
	