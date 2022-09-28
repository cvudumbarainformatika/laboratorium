<?php include_once "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css" media="print">

</style>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0">
<?php include_once "headerinterpretasi.php";?>
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="5" class="judullist">&nbsp;Interpretasi&nbsp;</td>
	</tr>
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Tanggal&nbsp;</td>
		<td>&nbsp;Interpretasi&nbsp;</td>
		<td>&nbsp;Saran&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$sql=$conn->query("select date(rs2) as tanggal,rs3 as interpretasi,rs4 as saran from rs215 where rs1='".trim($_GET['noreg'])."' ");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<tr class="bodylist" bgcolor="<?php echo warna($x);?>" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td>&nbsp;<?php echo format_tgl_outxxx($rs->tanggal,"-");?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->interpretasi;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->saran;?>&nbsp;</td>
	</tr>
	<?php $total=$total+$subtotal; }?>
</table>
<hr />
<p>&nbsp;</p>
<table align="right" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
			<?php 
				$tgl='';
				$sqlx=$conn->query("select date(rs2) as tanggal from rs215 where rs1='".trim($_GET['noreg'])."' order by rs3 desc");
				while($rsx=$sqlx->fetch_object()){
				$tgl=$rsx->tanggal;
				//$tglx=date('Y-m-d',strtotime('+1 day',strtotime($tgl)));
				?>
			<?php }?>
			<tr>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;&nbsp;</td>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;Probolinggo, <?php echo $tgl;?> , </td>
			</tr>
			<tr>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;&nbsp;</td>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dokter Pelaksana, </td>
			</tr>
			<?php 
			$dokter="";
			$sql=$conn->query("select rs21.rs2 as dokter from rs51,rs21 where rs51.rs8=rs21.rs1 and rs51.rs1='".trim($_GET['noreg'])."' ");
			while($rs=$sql->fetch_object()){
				$dokter=$rs->dokter;
			}
			?>
			<tr height="45px" valign="bottom">
				<td align="right" style="font-weight:bold;">&nbsp;&nbsp;</td>
				<td align="right" style="font-weight:bold;">&nbsp;&nbsp;( <?php echo $dokter;?> )</td>
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