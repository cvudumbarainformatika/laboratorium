<?php include_once "../../conn.php";?>
<?php
$sql=$conn->query("select distinct rs17.rs1 as noreg,rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,
		rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,
		rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,	rs15.rs17 as kelamin,rs15.rs36 as normlama,
		rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,	rs17.rs6 as kodeasalrujukan,'' as kelas,
		rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as koderuang_poli,rs19.rs2 as ruang_poli,rs17.rs18 as userid,
		rs17.rs19 as status,rs9.rs2 as sistembayar,'' as flag,IF(rs17.rs19='',datediff('".date("Y-m-d")."',rs17.rs3),'1')  as lama,
		'x' as kelas,'' as kd_ruangpoli from rs15,rs17,rs19,rs9	where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14
		and rs17.rs1='".trim($_GET['noreg'])."'
		union all
		select distinct rs23.rs1 as noreg,rs23.rs2 as norm,rs23.rs19 as kd_akun,rs15.rs2 as nama,
		rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,
		rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,rs15.rs17 as kelamin,rs15.rs36 as normlama,
		rs15.rs37 as tmplahir,rs23.rs3 as tanggalmasuk,rs23.rs11 as penanggungjawab,rs23.rs13 as kodeasalrujukan,rs24.rs3 as kelas,
		rs23.rs20 as asalpendaftaran,rs23.rs16 as namaperujuk,rs23.rs5 as koderuang_poli,rs24.rs2 as ruang_poli,rs23.rs30 as userid,
		rs23.rs28 as status,rs9.rs2 as sistembayar,'Ranap' as flag,IF(rs23.rs4='0000-00-00 00:00:00',datediff('".date("Y-m-d")."',rs23.rs3),
		datediff(rs23.rs4,rs23.rs3))  as lama,rs24.rs3 as kelas,rs24.rs4 as kd_ruangpoli
		from rs15,rs23,rs24,rs9 where rs15.rs1=rs23.rs2 and rs23.rs5=rs24.rs1 and rs9.rs1=rs23.rs19 
		and rs23.rs1='".trim($_GET['noreg'])."'");
while($rs=$sql->fetch_object()){
	echo "OK|".trim($rs->noreg)."|".trim($rs->norm)."|".trim($rs->nama)."|".trim($rs->kelamin)."|".trim($rs->ruang_poli)
	."|".idate('d',strtotime($rs->tgllahir))."/".idate('m',strtotime($rs->tgllahir))."/".idate('Y',strtotime($rs->tgllahir))."|"
	.trim($rs->alamat)."|".trim($rs->sistembayar)."|".trim($rs->kd_akun)."|".trim(format_tgl_outxxx($rs->tanggalmasuk,"-"))."|"
	.trim($rs->lama)."|".trim($rs->flag)."|".trim($rs->kelas)."|".trim($rs->koderuang_poli)."|";
}
echo "EOF";
?>
<?php include_once "../../close.php";?>
