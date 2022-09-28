<?php 
	include_once "../../conn.php";
	include_once "../../libs/phpqrcode/qrlib.php";
?>
<table width="99%">
	<tr valign="top">
		<td>
			<table style="border-bottom:double #999999" width="99%">
				<tr valign="top">
					<td width="50px"><img src="../../images/logoz.jpg" width="50"/></td>
					<td>&nbsp;&nbsp;</td>
					<td><strong><?php echo $_SESSION['rs_nama'];?></strong><br />
						<font style="font-size:12px"><?php echo $_SESSION['rs_alamat'];?><br />
						<?php echo $_SESSION['rs_telp'];?></font>
					</td>
					<td align="right" style="font-size:11px;"><?php echo date("d/m/Y H:i:s");?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" align="center">
	<tr align="center">
		<td>&nbsp;
            <strong><u>HASIL PEMERIKSAAN LABORATORIUM</u></strong><br>
            <i>LABORATORY EXAMINATION RESULTS</i>
        &nbsp;</td>
	</tr>
</table>
<br />
<?php	
	$sqlx=$conn->query("select * from lab_luar where nota='".$_GET["nota"]."';");
	while($rsx=$sqlx->fetch_object()){
		$tanggalx=$rsx->tanggal;
		$noktp=$rsx->noktp;
		$nota=$rsx->nota;
		$nama=$rsx->nama;
		$alamat=$rsx->alamat;
		$pengirim=$rsx->pengirim;
		$sampel_diambil=$rsx->sampel_diambil;
		$sampel_selesai=$rsx->sampel_selesai;
		$jam_sampel_diambil=$rsx->jam_sampel_diambil;
		$jam_sampel_selesai=$rsx->jam_sampel_selesai;
		$sampel_selesai_split = explode("-",$sampel_selesai);
		$tgl_sampel_selesai = $sampel_selesai_split[2];
		$bln_sampel_selesai = $sampel_selesai_split[1];
		$thn_sampel_selesai = $sampel_selesai_split[0];
		$tglx=$rsx->tgl;
	}
?>		
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td width="370">&nbsp;Nama / <i>Name</i>&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $nama;?>&nbsp;</td>
	</tr>	
	<tr>
		<td>&nbsp;Alamat / <i>Address</i>&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $alamat;?>&nbsp;</td>
	</tr>	
	<tr>
		<td>&nbsp;Dokter Pengirim / <i>Sending Doctor</i>&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $pengirim;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Sampel Diambil / <i>Sample Taken</i>&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $sampel_diambil;?>, Jam / <i>Clock</i> : <?php echo $jam_sampel_diambil ?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Sampel Selesai Diperiksa / <i>Sample Has Been Checked</i>&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $sampel_selesai;?>, Jam / <i>Clock</i> : <?php echo $jam_sampel_selesai ?>&nbsp;</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr valign="middle" align="center">
		<td>&nbsp;<b><u>Pemeriksaan</u></b><br><i>Checking Type</i>&nbsp;</td>
		<td>&nbsp;<b><u>Hasil</u></b><br><i>Result</i>&nbsp;</td>
		<td>&nbsp;<b><u>Nilai Normal</u></b><br><i>Normal Value</i>&nbsp;</td>
		<td>&nbsp;<b><u>Keterangan</u></b><br><i>Note</i>&nbsp;</td>
	</tr>
	
	<?php
		$sqlx=$conn->query("select * from rs215 where rs5='".$_GET['nota']."'");
		while($rsx=$sqlx->fetch_object()){
			$noreg=$rsx->rs1;
			$tanggalx=$rsx->rs2;
			$interpretasi=$rsx->rs3;
			$saran=$rsx->rs4;
			$ket=$rsx->ket;
		}
	?>	
	<?php
	$x=0;
	$z=0;
	$sql=$conn->query("select * from (
	select '' as flag,lab_luar.id,lab_luar.tgl as tgl,lab_luar.pengirim as pengirim,rs49.rs2 as keterangan,rs49.rs22 nilai,
	(lab_luar.tarif_sarana+lab_luar.tarif_pelayanan) as biaya,
	lab_luar.jml as jml,((lab_luar.tarif_sarana+lab_luar.tarif_pelayanan)*lab_luar.jml) as subtotal,
	lab_luar.hasil,lab_luar.hl,lab_luar.ket from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab and rs49.rs21=''
	and lab_luar.nota='".trim($_GET['nota'])."'
	union all
	select 'x' as flag,lab_luar.id,lab_luar.tgl as tgl,lab_luar.pengirim as pengirim,rs49.rs21 as keterangan,rs49.rs22 nilai,
	(lab_luar.tarif_sarana+lab_luar.tarif_pelayanan) as biaya,lab_luar.jml as jml,
	((lab_luar.tarif_sarana+lab_luar.tarif_pelayanan)*lab_luar.jml) as subtotal,lab_luar.hasil,
	lab_luar.hl,lab_luar.ket from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab and rs49.rs21<>''
	and lab_luar.nota='".trim($_GET['nota'])."' group by rs49.rs21) as vx order by id");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<?php if($rs->flag==""){$z=$z+1;?>	
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->hasil;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->nilai;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->ket;?>&nbsp;</td>
	</tr>
		
		<?php }else{?>
	<tr class="bodylist" valign="top">
		<td colspan="3">&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
	</tr>
			<?php			
				$sqlx=$conn->query("select lab_luar.kd_lab as kode,rs49.rs2 as nama,lab_luar.hasil,rs49.rs22 as nilai from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab 
				and lab_luar.nota='".trim($_GET['nota'])."' and rs49.rs21='".$rs->keterangan."'");
				while($rsx=$sqlx->fetch_object()){ 
				$z=$z+1;?>
				
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rsx->nama;?>&nbsp;</td>
					<td>&nbsp;<?php echo $rsx->hasil;?>&nbsp;</td>
					<td>&nbsp;<?php echo $rsx->nilai;?>&nbsp;</td>
					<td>&nbsp;<?php echo $rs->ket;?>&nbsp;</td>
				</tr>
			
			<?php	} ?>
		<?php }?>
	<?php $total=$total+$rs->subtotal; }?>
	<tr valign="middle">
		<td style="border-top:1px solid #006699;border-bottom:double #006699;height:30px;" colspan="4">
			<table width="100%"><td width="50%">&nbsp;Jml Pemeriksaan : <?php echo $z;?>&nbsp;</td>
			<!-- <td>&nbsp;Biaya : Rp. <?php echo rp($total);?>&nbsp;</td> -->
			</table>	
		</td>
	</tr>
</table>
Catatan/Note :<br>
<?php echo $ket; ?>
<br>
<table width="100%" align="center">
	<tr>
		<td>&nbsp;&nbsp;</td>
		<td width="400">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;Probolinggo, <?php echo $tgl_sampel_selesai." ".bulan($bln_sampel_selesai)." ".$thn_sampel_selesai; ?>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;Pemeriksa&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;Penanggung Jawab&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;(..................................)&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;(..................................)&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
</table>
<br>
Scan disini untuk verifikasi :<br>
<?php
	$notaqr = str_replace("/","-",$nota);
	$qr_code = base64_encode($notaqr);
	$qr_codez = $notaqr;
	$url = "http://rsudmsaleh.probolinggokota.go.id/verifikasiHasilLab?data=$qr_code";
	$filename = "../../temp/".$qr_codez.".png";
	QRcode::png($url, $filename, "L", 10, 2);
	echo "<img src='../../temp/".$qr_codez.".png' width='150'>";
	//echo "<br>URL : ".$url;
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