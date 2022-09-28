<?php include_once "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nota Resep</title>
<style type="text/css" media="print">
@page { size: 85.5mm 53.6mm }
</style>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0">
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="7" class="judullist">&nbsp;Transaksi Tindakan&nbsp;</td>
	</tr>
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Tanggal&nbsp;</td>
		<td>&nbsp;Nama Tindakan&nbsp;</td>
		<td>&nbsp;Biaya&nbsp;</td>
		<td>&nbsp;Jml&nbsp;</td>
		<td>&nbsp;Sub Total&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$sql=$conn->query("select rs73.*,rs30z.rs2 as tindakan from rs73,rs30z where rs30z.rs1=rs73.rs4 and  trim(rs73.rs2)='".trim($_GET['nota'])."' order by rs73.rs1,rs73.id limit 0,20");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	$biaya=$rs->rs7+$rs->rs14+$rs->rs18;
	$subtotal=$rs->rs5*$biaya;
	?>
	<tr class="bodylist" bgcolor="<?php echo warna($x);?>" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td>&nbsp;<?php echo format_tgl_outxxx($rs->rs3,"-");?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->tindakan;?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($biaya);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->rs5);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($subtotal);?>&nbsp;</td>
	</tr>
	<?php $total=$total+$subtotal; }?>
	<tr>
		<td colspan="5">&nbsp;&nbsp;</td>
		<td align="right">&nbsp;<?php //echo rp($total);?>&nbsp;</td>
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