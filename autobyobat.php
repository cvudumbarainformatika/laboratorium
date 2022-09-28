<?php include_once "../../conn.php";?>
<?php
if($_SESSION['loginrsx']==""){ exit; }
if ( !isset($_REQUEST['term']) )   exit;

$sql=$conn->query('select rs98x.rs1 as kode,rs32.rs2 as nama,rs32.rs7 as satuan,rs98x.rs2 as stok from rs32,rs98x where rs32.rs3="Bahan Laborat" 
				   and rs98x.rs1=rs32.rs1 and rs98x.rs4="RC0001" and rs32.rs2 like "%'. $_REQUEST['term'] .'%"');
$data=array();
if ($sql && $sql->num_rows){
    while( $rs = $sql->fetch_object()){
        $data[] = array(
            'label' => $rs->nama. "|" .$rs->kode. "|" .$rs->stok,
            'kode_obat' =>  $rs->kode,
			'nama' =>  $rs->nama, 
            'satuan' =>  $rs->satuan ,
            'value' => $rs->nama
        );
    }
}

echo json_encode($data);
flush();

?>
	
<?php include_once "../../close.php";?>