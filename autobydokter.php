<?php include_once "../../conn.php";?>
<?php
if ( !isset($_REQUEST['term']) )   exit;

$sql=$conn->query("select * from rs21 where rs2 like '%". $_REQUEST['term'] ."%' 
and rs13='1' order by rs2 asc limit 0,15");
$data=array();
if ($sql && $sql->num_rows){
    while( $rs = $sql->fetch_object()){
        $data[] = array(
            'label' => $rs->rs2 ,
            'kodedokter' =>  $rs->rs1 ,
            'value' => $rs->rs2
        );
    }
}

echo json_encode($data);
flush();

?>
	
<?php include_once "../../close.php";?>