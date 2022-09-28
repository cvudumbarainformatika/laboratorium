<?php include_once "../../conn.php";?>
<?php
$sql=$conn->query("select distinct rs2 from rs73 where rs1='".trim($_GET['noreg'])."' and rs22='LAB' order by rs2");
while($rs=$sql->fetch_object()){
	echo trim($rs->rs2)."|";
}
?>
<?php include_once "../../close.php";?>
