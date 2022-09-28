<?php include_once "../../conn.php";?>
<?php //include_once "../../koneksi.php";?>
<?php
if($_SESSION['loginrsx_kodebag']<>"" || $_SESSION['loginrsx_user']=="sa"){
	$sqlz=$conn->query("select * from lab_luar where id='".trim($_GET['id'])."'");
	$jmlz=$sqlz->num_rows;
	// if($jmlz>0){
		// $rsz=$sqlz->fetch_object();
		// if($rsz->rs18=="1"){
			// echo "Maaf, Data telah dikunci Oleh Petugas Laborat";
		// }else{
			$sql=$conn->query("select rs49.rs21 as grup,lab_luar.nota as nota from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab 
			and rs49.rs21<>'' and lab_luar.id='".trim($_GET['id'])."'");
			while($rs=$sql->fetch_object()){
				$sqlx=$conn->query("select rs1 as kode from rs49 where rs21='".$rs->grup."'");
				while($rsx=$sqlx->fetch_object()){
					$conn->query("delete from lab_luar where nota='".$rs->nota."' and kd_lab='".$rsx->kode."'");
					//$connx->query("delete from laborat where nota='".$rs->nota."' and kodetindakan='".$rsx->kode."' ");
				}
			}
			$conn->query("delete from lab_luar where id='".trim($_GET['id'])."'");
			//$connx->query("delete from laborat where idx='".trim($_GET['id'])."'");
			echo "OK";
		// }
	// }
}else{
	echo "Maaf, anda tidak berhak menyimpan";
}
?>
<?php include_once "../../close.php";?>
