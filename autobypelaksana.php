<?php include_once "../../conn.php";?>
<?php
if ( !isset($_REQUEST['term']) )   exit;

$sql=$conn->query("select * from rs21 where rs2 like '%". $_REQUEST['term'] ."%' order by rs2 asc limit 0,15");
$data=array();
if ($sql && $sql->num_rows){
    while( $rs = $sql->fetch_object()){
        $data[] = array(
            'label' => $rs->rs2 ,
            'kode_pelaksana' =>  $rs->rs1 ,
            'flag_pelaksana' =>  $rs->rs13 ,
            'value' => $rs->rs2
        );
    }
}

echo json_encode($data);
flush();

?>
	
<?php include_once "../../close.php";?>