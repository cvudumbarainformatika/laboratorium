<?php include_once "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title></title>
	<style type="text/css" media="print"></style>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0">
<?php include_once "headerlaborat_luar.php";?>
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="8" class="judullist">&nbsp;PERMINTAAN LABORAT&nbsp;</td>
	</tr>
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Nama Permintaan&nbsp;</td>
		<td>&nbsp;Jumlah&nbsp;</td>
		<td>&nbsp;Biaya&nbsp;</td>
		<td>&nbsp;Sub Total&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$z=0;
	$sql=$conn->query("select * from (
	select '' as flag,
	lab_luar.id,
	lab_luar.tgl as tgl,
	lab_luar.pengirim as pengirim,
	rs49.rs2 as keterangan,
	(lab_luar.tarif_sarana+lab_luar.tarif_pelayanan) as biaya,
	lab_luar.jml as jml,
	((lab_luar.tarif_sarana+lab_luar.tarif_pelayanan)*lab_luar.jml) as subtotal,
	lab_luar.hasil,
	lab_luar.hl,
	lab_luar.ket from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab and rs49.rs21=''
	and lab_luar.nota='".trim($_GET['nota'])."'
	union all
	select 'x' as flag,lab_luar.id,lab_luar.tgl as tgl,lab_luar.pengirim as pengirim,rs49.rs21 as keterangan,
	(lab_luar.tarif_sarana+lab_luar.tarif_pelayanan) as biaya,lab_luar.jml as jml,
	((lab_luar.tarif_sarana+lab_luar.tarif_pelayanan)*lab_luar.jml) as subtotal,lab_luar.hasil,
	lab_luar.hl,lab_luar.ket from rs49,lab_luar where rs49.rs1=lab_luar.kd_lab and rs49.rs21<>''
	and lab_luar.nota='".trim($_GET['nota'])."' group by rs49.rs21) as vx order by id");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<?php if($rs->flag==""){$z=$z+1;?>	
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->jml;?>&nbsp;</td>
		<td>&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
		<td>&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>
	</tr>
		
		<?php }else{?>
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td colspan="2">&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td>&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
		<td>&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>
	</tr>
			<?php			
				$sqlx=$conn->query("
				select lab_luar.kd_lab as kode,rs49.rs2 as nama,lab_luar.hasil,lab_luar.jml,rs49.rs22 as nilai from rs49,lab_luar 
				where rs49.rs1=lab_luar.kd_lab 
				and lab_luar.nota='".trim($_GET['nota'])."' and rs49.rs21='".$rs->keterangan."'");
				while($rsx=$sqlx->fetch_object()){ 
				$z=$z+1;?>
				
				<tr>
					<td></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rsx->nama;?>&nbsp;</td>
					<td>&nbsp;<?php echo $rsx->jml;?>&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
				</tr>
			
			<?php	} ?>
		<?php }?>
	<?php $total=$total+$rs->subtotal; }?>
	<tr valign="middle">
		<td style="border-top:1px solid #006699;border-bottom:double #006699;height:30px;" colspan="5">
			<table width="100%"><td width="50%">&nbsp;JML PEMERIKSAAN : <?php echo $z;?>&nbsp;</td><td>&nbsp;Biaya : Rp. <?php echo rp($total);?>&nbsp;</td></table>	
		</td>
	</tr>	
</table>
<p>&nbsp;</p>
<table align="right" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<?php 
		$tgl='';
		$sqlx=$conn->query("select date(tgl) as tgl from lab_luar where nota='".trim($_GET['nota'])."' order by tgl desc");
		while($rsx=$sqlx->fetch_object()){
		$tgl=$rsx->tgl;
		//$tglx=date('Y-m-d',strtotime('+1 day',strtotime($tgl)));
		?>
	<?php }?>
	<tr>
		<td nowrap="nowrap" style="font-weight:bold;">&nbsp;&nbsp;</td>
		<td nowrap="nowrap" align="center" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;Probolinggo, <?php echo $tgl;?> , </td>
	</tr>
	<tr>
		<td nowrap="nowrap" style="font-weight:bold;">&nbsp;&nbsp;</td>
		<td nowrap="nowrap" align="center" style="font-weight:bold;">Petugas, </td>
	</tr>
</table>
</body>
</html>
<script language="javascript">
//if(navigator.appName == "Microsoft Internet Explorer"){
//  var PrintCommand = '<object ID="PrintCommandObject" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>';
//  document.body.insertAdjacentHTML('beforeEnd', PrintCommand);
//  PrintCommandObject.ExecWB(6, 2);
//  PrintCommandObject.outerHTML = "";
//  window.close();
//} else {
  window.print();
  window.close();
//}
</script>
<?php include_once "../../close.php";?>