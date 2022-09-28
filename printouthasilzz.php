<?php include_once "../../conn.php";?>
<table cellpadding="0" cellspacing="0" align="center">
	<tr align="center">
		<td>&nbsp;<strong><?php echo $_SESSION['rs_nama'];?></strong>&nbsp;</td>
	</tr>
	<tr align="center">
		<td>&nbsp;<strong><?php echo $_SESSION['rs_alamat'];?></strong>&nbsp;</td>
	</tr>
	<tr align="center">
		<td>&nbsp;<strong><?php echo $_SESSION['rs_telp'];?></strong>&nbsp;</td>
	</tr>
	<tr align="center">
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td>&nbsp;<strong>HASIL PEMERIKSAAN LABORATORIUM</strong>&nbsp;</td>
	</tr>
</table>
<BR />
<?php	
		$sqlx=$conn->query("select tanggal,noreg,nota,norm,nama,alamat,kelamin,IF(thn<1,IF(bln<1,concat(hari,' hari'),concat(bln,' bln')),concat(thn,' thn')) as umur,
	poli,tipe,pengirim,sistembayar,'' as cetak from(
	select distinct rs51.rs1 as noreg,rs51.rs2 as nota,IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')/365)),floor((datediff(rs17.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs17.rs3,'1970-01-01')-((floor((datediff(rs17.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs17.rs3,'1970-01-01')-(floor((datediff(rs17.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs17.rs3,rs15.rs16)-((floor((datediff(rs17.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs17.rs3,rs15.rs16)-(floor((datediff(rs17.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs17.rs2 as norm,rs17.rs14 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs17.rs3 as tanggalmasuk,rs17.rs4 as penanggungjawab,
	rs17.rs6 as kodeasalrujukan,rs17.rs20 as asalpendaftaran,rs17.rs7 as namaperujuk,rs17.rs8 as kodepoli,rs19.rs2 as poli,
	rs17.rs18 as userid,rs17.rs19 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,rs51.rs3 as tgl,
	concat(dayofmonth(rs51.rs3),'-',month(rs51.rs3),'-',year(rs51.rs3),' ',time(rs51.rs3)) as tanggal,rs21.rs2 as pengirim 
	from rs15,rs17,rs19,rs9,rs51,rs21 where rs15.rs1=rs17.rs2 and rs17.rs8=rs19.rs1 and rs9.rs1=rs17.rs14 and rs51.rs1=rs17.rs1 and rs21.rs1=rs51.rs8
	and rs51.rs2='".trim($_GET['nota'])."'
	and (isnull(rs51.rs23) or rs51.rs23='POL014' or rs51.rs23='' or rs51.rs23='POL001' or rs51.rs23='POL002' or rs51.rs23='POL003'
	or rs51.rs23='POL004' or rs51.rs23='POL005' or rs51.rs23='POL006' or rs51.rs23='POL007' or rs51.rs23='POL008' or rs51.rs23='POL009' 
	or rs51.rs23='POL010' or rs51.rs23='POL011' or rs51.rs23='POL012' or rs51.rs23='POL013' or rs51.rs23='POL015' or rs51.rs23='POL016' 
	or rs51.rs23='POL017' or rs51.rs23='POL018' or rs51.rs23='POL019' or rs51.rs23='POL020' or rs51.rs23='POL021' or rs51.rs23='POL022' 
	or rs51.rs23='POL023' or rs51.rs23='POL024' or rs51.rs23='POL025' or rs51.rs23='POL026' or rs51.rs23='POL027' or rs51.rs23='POL028' or rs51.rs23='POL034' or rs51.rs23='POL035')
	group by rs51.rs2
	union all
	select distinct rs51.rs1 as noreg,rs51.rs2 as nota,IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')/365)),floor((datediff(rs23.rs3,rs15.rs16)/365))) as thn,
	IF(rs15.rs16='1900-01-01',floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30),floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)) as bln,
	IF(rs15.rs16='1900-01-01',(datediff(rs23.rs3,'1970-01-01')-((floor((datediff(rs23.rs3,'1970-01-01')/365))*365)+(floor((datediff(rs23.rs3,'1970-01-01')-(floor((datediff(rs23.rs3,'1970-01-01')/365))*365))/30)*30))),
	(datediff(rs23.rs3,rs15.rs16)-((floor((datediff(rs23.rs3,rs15.rs16)/365))*365)+(floor((datediff(rs23.rs3,rs15.rs16)-(floor((datediff(rs23.rs3,rs15.rs16)/365))*365))/30)*30)))) as hari,
	rs23.rs2 as norm,rs23.rs19 as kd_akun,rs15.rs2 as nama,rs15.rs3 as sapaan,rs15.rs4 as alamat,rs15.rs5 as kelurahan,
	rs15.rs6 as kecamatan,rs15.rs7 as rt,rs15.rs8 as rw,rs15.rs10 as propinsi,rs15.rs11 as kabupaten,rs15.rs16 as tgllahir,
	rs15.rs17 as kelamin,rs15.rs36 as normlama,rs15.rs37 as tmplahir,rs23.rs3 as tanggalmasuk,rs23.rs11 as penanggungjawab,
	rs23.rs13 as kodeasalrujukan,rs23.rs20 as asalpendaftaran,rs23.rs16 as namaperujuk,rs23.rs5 as koderuang,rs24.rs2 as ruang,
	rs23.rs30 as userid,rs23.rs28 as status,rs9.rs2 as sistembayar,IF(rs15.rs31>1,'Lama','Baru') as tipe,rs51.rs3 as tgl,
	concat(dayofmonth(rs51.rs3),'-',month(rs51.rs3),'-',year(rs51.rs3),' ',time(rs51.rs3)) as tanggal,rs21.rs2 as pengirim 
	from rs15,rs23,rs24,rs9,rs51,rs21 where rs15.rs1=rs23.rs2 and rs23.rs5=rs24.rs1 and rs9.rs1=rs23.rs19 and rs51.rs1=rs23.rs1 and rs21.rs1=rs51.rs8 and rs51.rs2='".trim($_GET['nota'])."'
	and (rs51.rs23='ME' or rs51.rs23='FA' or rs51.rs23='MA' or rs51.rs23='WK' or rs51.rs23='BG' or rs51.rs23='IC' or rs51.rs23='ICC'
	or rs51.rs23='DA' or rs51.rs23='BR' or rs51.rs23='WKVVIP' or rs51.rs23='WKUT' or rs51.rs23='KA' or rs51.rs23='ISHK' or rs51.rs23='TR')
	group by rs51.rs2
	) as v_15_17_23_51 order by tgl");
		while($rsx=$sqlx->fetch_object()){
			$tanggalx=$rsx->tanggal;
			$noreg=$rsx->noreg;
			$norm=$rsx->norm;
			$poli=$rsx->poli;
			$nama=$rsx->nama;
			$umur=$rsx->umur;
			$alamat=$rsx->alamat;
			$sistembayar=$rsx->sistembayar;
			$pengirim=$rsx->pengirim;
		}
?>		
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td>&nbsp;TANGGAL&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td colspan="4">&nbsp;<?php echo $tanggalx;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;NO. REG&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $noreg;?>&nbsp;</td>
		<td>&nbsp;NAMA&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $nama;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;NO. RM&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $norm;?>&nbsp;</td>
		<td>&nbsp;UMUR&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $umur;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;PENGIRIM&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $pengirim;?>&nbsp;</td>
		<td>&nbsp;ALAMAT&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $alamat;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;POLI / RUANG &nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $poli;?>&nbsp;</td>
		<td>&nbsp;SISTEM BAYAR&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $sistembayar;?>&nbsp;</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr valign="middle">
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;PEMERIKSAAN&nbsp;</td>
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;HASIL&nbsp;</td>
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;NILAI NORMAL / SATUAN&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$z=0;
	$sql=$conn->query("select * from (
	select '' as flag,rs51.id,rs51.rs3 as tgl,rs51.rs4 as kode,rs51.rs8 as kodedokter,rs49.rs2 as keterangan,(rs51.rs6+rs51.rs13) as biaya,
	rs51.rs5 as jml,((rs51.rs6+rs51.rs13)*rs51.rs5) as subtotal,rs51.rs21 as hasil,rs49.rs22 as nilai from rs49,rs51 where rs49.rs1=rs51.rs4 and rs49.rs21=''
	and rs51.rs2='".trim($_GET['nota'])."'
	union all
	select 'x' as flag,rs51.id,rs51.rs3 as tgl,rs51.rs4 as kode,rs51.rs8 as kodedokter,rs49.rs21 as keterangan,(rs51.rs6+rs51.rs13) as biaya,rs51.rs5 as jml,
	((rs51.rs6+rs51.rs13)*rs51.rs5) as subtotal,rs51.rs21 as hasil,rs49.rs22 as nilai from rs49,rs51 where rs49.rs1=rs51.rs4 and rs49.rs21<>''
	and rs51.rs2='".trim($_GET['nota'])."' group by rs49.rs21) as vx order by id");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<?php if($rs->flag==""){$z=$z+1;?>	
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->hasil;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->nilai;?>&nbsp;</td>
	</tr>
		
		<?php }else{?>
	<tr class="bodylist" valign="top">
		<td colspan="3">&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
	</tr>
			<?php			
				$sqlx=$conn->query("select rs51.rs4 as kode,rs49.rs2 as nama,rs51.rs21 as hasil,rs49.rs22 as nilai from rs49,rs51 where rs49.rs1=rs51.rs4 
				and rs51.rs2='".trim($_GET['nota'])."' and rs49.rs21='".$rs->keterangan."'");
				while($rsx=$sqlx->fetch_object()){ 
				$z=$z+1;?>
				
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rsx->nama;?>&nbsp;</td>
					<td>&nbsp;<?php echo $rsx->hasil;?>&nbsp;</td>
					<td>&nbsp;<?php echo $rsx->nilai;?>&nbsp;</td>
				</tr>
			
			<?php	} ?>
		<?php }?>
	<?php $total=$total+$rs->subtotal; }?>
	<?php
	$sample=0;
	$sqlx=$conn->query("select sum(rs5*rs6) as sample from rs73 where rs1='".$_GET['noreg']."' 
	and (rs4='T00086' or rs4='T00176' or rs4='T00299' or rs4='T00337' or rs4='T00386' or rs4='T00387') and rs22='LAB'");
	while($rsx=$sqlx->fetch_object()){ 
		$sample=$rsx->sample;
	}
	$total=$total+$sample;
	?>
	<tr valign="middle">
		<td style="border-top:1px solid #006699;border-bottom:double #006699;height:30px;" colspan="3">
			<table width="100%"><td width="50%">&nbsp;JML PEMERIKSAAN : <?php echo $z;?>&nbsp;</td><td>&nbsp;Biaya : Rp. <?php echo rp($total);?>&nbsp;</td></table>	
		</td>
	</tr>
</table>
<p>Interpretasi: <?php echo $interpretasi; ?> </p>
<p>&nbsp;</p>
<p>Saran: <?php echo $saran; ?> </p>
<p>&nbsp;</p>
<p>
<table width="100%" align="center">
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;Penanggungjawab&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;Pemerriksa&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;( ....................... )&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;( ....................... )&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
</table>
<?php	
		$sqlx=$conn->query("select * from rs215 where rs5='".$_GET['nota']."'");
		while($rsx=$sqlx->fetch_object()){
			$noreg=$rsx->rs1;
			$tanggalx=$rsx->rs2;
			$interpretasi=$rsx->rs3;
			$saran=$rsx->rs4;
			$nota=$rsx->nota;
		}
?>	
  <script language="javascript">
if(navigator.appName == "Microsoft Internet Explorer"){
  var PrintCommand = '<object ID="PrintCommandObject" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>';
  document.body.insertAdjacentHTML('beforeEnd', PrintCommand);
  PrintCommandObject.ExecWB(6, 2);
  PrintCommandObject.outerHTML = "";
  window.close();
} else {
  window.print();
  window.close();
}
</script>
  
 
</p>

<?php include_once "../../close.php";?>
