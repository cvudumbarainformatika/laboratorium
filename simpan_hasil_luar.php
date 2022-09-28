<?php include_once "../../conn.php";?>
<?php
	$a=explode('|',$_GET['hasil']);
	$i = 0;
	while ($i < count($a)) {
	   $b = explode(';', $a[$i]);
		$conn->query("update lab_luar set hasil='".$b[1]."',hl='".$b[2]."',ket='".$b[3]."',akhirx='1' where nota='".$_GET['nota']."' and kd_lab='".$b[0]."' ");
	   $i++;
	}
	echo "OK";
?>
<?php include_once "../../close.php";?>
