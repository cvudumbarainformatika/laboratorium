<?php include_once "../../conn.php";?>
<?php
$sql=$conn->query("select tanggal,noreg,norm,nama,alamat,kelamin,IF(thn<1,IF(bln<1,concat(hari,' hari'),concat(bln,' bln')),concat(thn,' thn')) as umur,
	poli,tipe,dokter,sistembayar,kodepoli,kd_akun,tgllahir,kelas from(
	select distinct rs17.rs1 as noreg,IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')/365)),floor((datediff(rs17.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs17.rs3,'1970-01-01')-((floor((datediff(rs17.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs17.rs3,rs15.rs16)-((floor((datediff(rs17.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,
	rs17.rs6 as kodeasalrujukan,rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as kodepoli,rs19.rs2 as poli,
	rs17.rs18 as userid,rs17.rs19 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,'' as kelas,
	concat(dayofmonth(rs17.rs3),'/',month(rs17.rs3),'-/',year(rs17.rs3),' ',time(rs17.rs3)) as tanggal,'' as dokter
	from rs15,rs17,rs19,rs9	where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14
	and rs17.rs1='".trim($_GET['noreg'])."'	and rs17.rs8='PEN002' group by rs17.rs1
	union all
	select distinct rs17.rs1 as noreg,IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')/365)),floor((datediff(rs17.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs17.rs3,'1970-01-01')-((floor((datediff(rs17.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs17.rs3,rs15.rs16)-((floor((datediff(rs17.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,
	rs17.rs6 as kodeasalrujukan,rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as kodepoli,rs19.rs2 as poli,
	rs17.rs18 as userid,rs17.rs19 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,'' as kelas,
	concat(dayofmonth(rs51.rs3),'/',month(rs51.rs3),'/',year(rs51.rs3),' ',time(rs51.rs3)) as tanggal,rs21.rs2 as dokter 
	from rs15,rs17,rs19,rs9,rs51,rs21 where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14 and rs51.rs1=rs17.rs1 and rs21.rs1=rs51.rs8
	and rs51.rs1='".trim($_GET['noreg'])."'
	and (isnull(rs51.rs23) or rs51.rs23='POL014' or rs51.rs23='' or rs51.rs23='POL001' or rs51.rs23='POL002' or rs51.rs23='POL003'
	or rs51.rs23='POL004' or rs51.rs23='POL005' or rs51.rs23='POL006' or rs51.rs23='POL007' or rs51.rs23='POL008' or rs51.rs23='POL009' 
	or rs51.rs23='POL010' or rs51.rs23='POL011' or rs51.rs23='POL012' or rs51.rs23='POL013' or rs51.rs23='POL015' or rs51.rs23='POL016' 
	or rs51.rs23='POL017' or rs51.rs23='POL018' or rs51.rs23='POL019' or rs51.rs23='POL020' or rs51.rs23='POL021' or rs51.rs23='POL022' 
	or rs51.rs23='POL023' or rs51.rs23='POL024' or rs51.rs23='POL025' or rs51.rs23='POL026' or rs51.rs23='POL027' or rs51.rs23='POL032' or rs51.rs23='PEN005' or rs51.rs23='POL034' or rs51.rs23='POL035')
	group by rs51.rs2
	union all
	select distinct rs23.rs1 as noreg,IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')/365)),floor((datediff(rs23.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs23.rs3,'1970-01-01')-((floor((datediff(rs23.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs23.rs3,rs15.rs16)-((floor((datediff(rs23.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs23.rs2 as norm,rs23.rs19 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs23.rs3 as tanggalmasuk,rs23.rs11 as penanggungjawab,
	rs23.rs13 as kodeasalrujukan,rs23.rs20 as asalpendaftaran,rs23.rs16 as namaperujuk,rs24.rs4 as koderuang,rs24.rs2 as ruang,
	rs23.rs30 as userid,rs23.rs28 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,rs24.rs3 as kelas,
	concat(dayofmonth(rs51.rs3),'/',month(rs51.rs3),'/',year(rs51.rs3),' ',time(rs51.rs3)) as tanggal,rs21.rs2 as dokter 
	from rs15,rs23,rs24,rs9,rs51,rs21 where rs15.rs1=rs23.rs2 and rs23.rs5=rs24.rs1 and rs9.rs1=rs23.rs19 and rs51.rs1=rs23.rs1 and rs21.rs1=rs51.rs8
	and rs51.rs1='".trim($_GET['noreg'])."'
	and (rs51.rs23='ME' or rs51.rs23='FA' or rs51.rs23='MA' or rs51.rs23='WK' or rs51.rs23='BG' or rs51.rs23='IC' or rs51.rs23='ICC'
	or rs51.rs23='DA' or rs51.rs23='BR' or rs51.rs23='WKVVIP' or rs51.rs23='WKUT' or rs51.rs23='KA' or rs51.rs23='ISHK' or rs51.rs23='TR')
	group by rs51.rs2
	) as v_15_17_23_51 order by tanggal desc");
while($rs=$sql->fetch_object()){
	echo "OK|".trim($rs->noreg)."|".trim($rs->norm)."|".trim($rs->nama)."|".trim($rs->kelamin)."|".trim($rs->poli)
	."|".idate('d',strtotime($rs->tgllahir))."/".idate('m',strtotime($rs->tgllahir))."/".idate('Y',strtotime($rs->tgllahir))."|"
	.trim($rs->alamat)."|".trim($rs->sistembayar)."|".trim($rs->kd_akun)."|".trim($rs->kodepoli)."|".trim($rs->tanggal)."|".trim($rs->dokter)."|".trim($rs->kelas)."|";
}
echo "EOF";
?>
<?php include_once "../../close.php";?>
