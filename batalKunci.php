<?php include_once "../../conn.php";?>
<?php
    $conn->query("update rs51 set rs18='',rs19='".date('Y-m-d H:i:s')."' where rs2='".trim($_GET['nota'])."' ");
    $sqlx=$conn->query("select * from rs51 where rs2='".trim($_GET['nota'])."'");
    $rsx=$sqlx->fetch_object();
    echo "OK|".$rsx->rs18;
?>
<?php include_once "../../close.php";?>
