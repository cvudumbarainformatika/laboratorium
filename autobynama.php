<?php include_once "../../conn.php";?>
<?php
if ( !isset($_REQUEST['term']) )   exit;

$sql=$conn->query("select tanggalmasuk,noreg,norm,nama,alamat,kelamin,ruang_poli,sistembayar,flag
		from(
		select distinct rs17.rs1 as noreg,rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,
		rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,
		rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,	rs15.rs17 as kelamin,rs15.rs36 as normlama,
		rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,	rs17.rs6 as kodeasalrujukan,
		rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as koderuang_poli,rs19.rs2 as ruang_poli,rs17.rs18 as userid,
		rs17.rs19 as status,rs9.rs2 as sistembayar,'Rajal' as flag
		from rs15,rs17,rs19,rs9	where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14
		and year(rs17.rs3)='".date("Y")."' and month(rs17.rs3)='".date("m")."' and dayofmonth(rs17.rs3)='".date("d")."'
		and rs15.rs2 like '%". $_REQUEST['term'] ."%' 
		union all
		select distinct rs23.rs1 as noreg,rs23.rs2 as norm,rs23.rs19 as kd_akun,rs15.rs2 as nama,
		rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,
		rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,rs15.rs17 as kelamin,rs15.rs36 as normlama,
		rs15.rs37 as tmplahir,rs23.rs3 as tanggalmasuk,rs23.rs11 as penanggungjawab,rs23.rs13 as kodeasalrujukan,
		rs23.rs20 as asalpendaftaran,rs23.rs16 as namaperujuk,rs23.rs5 as koderuang_poli,rs24.rs2 as ruang_poli,rs23.rs30 as userid,
		rs23.rs28 as status,rs9.rs2 as sistembayar,'Ranap' as flag
		from rs15,rs23,rs24,rs9 where rs15.rs1=rs23.rs2 and rs23.rs5=rs24.rs1 and rs9.rs1=rs23.rs19 
		and rs23.rs22='' and rs15.rs2 like '%". $_REQUEST['term'] ."%'
		union all
		select distinct rs23.rs1 as noreg,rs23.rs2 as norm,rs23.rs19 as kd_akun,rs15.rs2 as nama,
		rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,
		rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,rs15.rs17 as kelamin,rs15.rs36 as normlama,
		rs15.rs37 as tmplahir,rs23.rs3 as tanggalmasuk,rs23.rs11 as penanggungjawab,rs23.rs13 as kodeasalrujukan,
		rs23.rs20 as asalpendaftaran,rs23.rs16 as namaperujuk,rs23.rs5 as koderuang_poli,rs24.rs2 as ruang_poli,rs23.rs30 as userid,
		rs23.rs28 as status,rs9.rs2 as sistembayar,'Ranap' as flag
		from rs15,rs23,rs24,rs9 where rs15.rs1=rs23.rs2 and rs23.rs5=rs24.rs1 and rs9.rs1=rs23.rs19 
		and year(rs23.rs4)='".date("Y")."' and month(rs23.rs4)='".date("m")."'
		and rs15.rs2 like '%". $_REQUEST['term'] ."%'			
		)as v_15_23_17 order by nama asc limit 0,15");
$data=array();
if ($sql && $sql->num_rows){
    while( $rs = $sql->fetch_object()){
        $data[] = array(
            'label' => $rs->nama .', '. $rs->noreg .' ('. $rs->norm.')'.', '. $rs->flag.' ~> '. $rs->ruang_poli.', '. format_tgl_outxxx($rs->tanggalmasuk,"-") ,
            'noreg' =>  $rs->noreg ,
            'value' => $rs->nama
        );
    }
}

echo json_encode($data);
flush();

?>
	
<?php include_once "../../close.php";?>