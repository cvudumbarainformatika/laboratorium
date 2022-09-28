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
		<td>&nbsp;<strong>HASIL PEMERIKSAAN LABORATORIUM</strong>&nbsp;</td>
	</tr>
</table>
<br />
<?php	
	$sqlx=$conn->query("select noktp,nota,nama,kelamin,alamat,tgl_lahir,akhir,pengirim,tgl from lab_luar where nota='".$_GET["nota"]."';");
	while($rsx=$sqlx->fetch_object()){
		$tanggalx=$rsx->tanggal;
		$noktp=$rsx->noktp;
		$nota=$rsx->nota;
		$nama=$rsx->nama;
		$alamat=$rsx->alamat;
		$pengirim=$rsx->pengirim;
		$tglx=$rsx->tgl;
	}
?>		
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td>&nbsp;TANGGAL&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $tglx;?>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;NO. NOTA&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $nota;?>&nbsp;</td>
		<td>&nbsp;NAMA&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $nama;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;PENGIRIM&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $pengirim;?>&nbsp;</td>
		<td>&nbsp;ALAMAT&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $alamat;?>&nbsp;</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr valign="middle">
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;PEMERIKSAAN&nbsp;</td>
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;HASIL&nbsp;</td>
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;NILAI NORMAL / SATUAN&nbsp;</td>
		<td style="border-top:double #006699;border-bottom:1px solid #006699;height:30px;">&nbsp;KETERANGAN&nbsp;</td>
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
			<table width="100%"><td width="50%">&nbsp;JML PEMERIKSAAN : <?php echo $z;?>&nbsp;</td>
			<!-- <td>&nbsp;Biaya : Rp. <?php echo rp($total);?>&nbsp;</td> -->
			</table>	
		</td>
	</tr>
</table>
<u>Interpretasi</u> :
<?php echo $interpretasi; ?><br>
<u>Saran</u> :
<?php echo $saran; ?><br>
<u>Keterangan</u> :
<?php echo $ket; ?></p>
<p>
<table width="100%" align="center">
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;Penanggungjawab&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;Pemeriksa&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;(.......................)&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;(.......................)&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
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
	echo "<br>URL : ".$url;
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