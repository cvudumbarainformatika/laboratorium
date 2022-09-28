<?php include_once "../../conn.php";?>
<?php
	$a=explode(';',$_GET['hasil']);
	$status=explode(';',$_GET['status']);
	$i = 0;
	while ($i < count($a)) {
	   $b = explode('=', $a[$i]);
		$conn->query("update rs51 set rs21='".$b[1]."',rs27='".$b[2]."',rs20='2',rs26='1' where rs1='".$_GET['noreg']."'
		and rs2='".$_GET['nota']."' and rs4='".$b[0]."' ");
	   $i++;
	}
	echo "OK";
?>
<?php include_once "../../close.php";?>
