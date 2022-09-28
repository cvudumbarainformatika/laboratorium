<?php include_once "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<body>
<?php include_once "headerlaborat_bebas_narkoba.php";?>
		<script type="text/javascript" src="../../html2pdf/html2pdf.bundle.js"></script>
		<script type="text/javascript">document.onkeydown=function(event){pdfConvertFunc(event,document.body,'<?php echo str_replace("/","",$_GET['noreg'])."_".$nama."_".$norm."_FAKTUR_REKAP"; ?>');}</script>
		<table width="90%" cellpadding="0" cellspacing="0" border="0" align="center">
			<tr valign="top" align="center">
				<td colspan="4">&nbsp;Dokter RSUD Dokter Mohamad Saleh Kota Probolinggo Menerangkan Bahwa : &nbsp;</td>
			<tr>
			<?php
				$sql=$conn->query("select *,day(tgl_lahir) as tanggaltok,month(tgl_lahir) as bulan,year(tgl_lahir) as thn from lab_luar where nosurat='".$_GET['nosurat']."' ");
				$rs=$sql->fetch_object();
			?>
			<tr valign="top">
					<td width="1%">&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp; &nbsp;</td>
					<td>&nbsp;&nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;1.&nbsp;</td>
					<td>&nbsp;Nama Lengkap &nbsp;</td>
					<td>&nbsp; : &nbsp;</td>
					<td>&nbsp; <?php echo $rs->nama ;?> &nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;2.&nbsp;</td>
					<td>&nbsp;Tempat dan tanggal lahir &nbsp;</td>
					<td>&nbsp; : &nbsp;</td>
					<td>&nbsp; <?php echo $rs->temp_lahir.', '.$rs->tanggaltok.' '.bulan($rs->bulan).' '.$rs->thn; ?> &nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;3.&nbsp;</td>
					<td>&nbsp;Jenis Kelamin &nbsp;</td>
					<td>&nbsp; : &nbsp;</td>
					<td>&nbsp; <?php echo $rs->kelamin ;?> &nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;4.&nbsp;</td>
					<td>&nbsp;Agama &nbsp;</td>
					<td>&nbsp; : &nbsp;</td>
					<td>&nbsp; <?php echo $rs->agama ;?> &nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;5.&nbsp;</td>
					<td>&nbsp;Pekerjaan &nbsp;</td>
					<td>&nbsp; : &nbsp;</td>
					<td>&nbsp; <?php echo $rs->nama_pekerjaan ;?> &nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;6.&nbsp;</td>
					<td>&nbsp;Alamat &nbsp;</td>
					<td>&nbsp; : &nbsp;</td>
					<td>&nbsp; <?php echo $rs->alamat ;?> &nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp; &nbsp;</td>
					<td>&nbsp;&nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp; &nbsp;</td>
					<td>&nbsp;&nbsp;</td>
			</tr>
			<tr valign="top">
				<td colspan="4">&nbsp;Berdasarkan hasil pemeriksaan, nama yang bersangkutan pada saat ini dinyatakan bebas / tidak bebas*)
				narkoba Amphetamin, Cocain, THC, Morphine, Methaphetamine, dan Benzodiazephine dalam sample urine. &nbsp;</td>
			<tr>
			<tr valign="top">
					<td width="1%">&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp; &nbsp;</td>
					<td>&nbsp;&nbsp;</td>
			</tr>
			<tr valign="top">
					<td width="1%">&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp; &nbsp;</td>
					<td>&nbsp;&nbsp;</td>
			</tr>
				<tr valign="top">
				<td colspan="4">&nbsp;Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat digunakan sebagai Persyaratan Melamar Pekerjaan. &nbsp;</td>
			<tr>
		</table>
		<br />
		<br />
		<br />
		<table align="right" cellpadding="0" cellspacing="0" border="0" style="border-bottom:double #999999">
			<tr>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;Dibuat Di&nbsp;</td>
				<td style="font-weight:bold;">&nbsp;: &nbsp;</td>
				<td style="font-weight:bold;">&nbsp; Probolinggo&nbsp;</td>
			</tr>
			<tr>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;Pada Tanggal&nbsp;</td>
				<td style="font-weight:bold;">&nbsp;: &nbsp;</td>
				<td style="font-weight:bold;">&nbsp; <?php echo date("d")." ".bulan(date("m"))." ".date("Y");?>&nbsp;</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<br />
		<table align="right">
			<tr valign="bottom">
				<td align="center" colspan="3" style="font-weight:bold;">&nbsp;Dokter Rumah Sakit&nbsp;</td>
			</tr>
			<tr valign="bottom">
				<td align="center" colspan="3" style="font-weight:bold;">&nbsp;Spesialis Patologi Klinik&nbsp;</td>
			</tr>
			<tr valign="bottom">
				<td align="center" colspan="3" style="font-weight:bold;">&nbsp;&nbsp;</td>
			</tr>
			<tr valign="bottom">
				<td align="center" colspan="3" style="font-weight:bold;">&nbsp;&nbsp;</td>
			</tr>
			<tr valign="bottom">
				<td align="center" colspan="3" style="font-weight:bold;">&nbsp;( ............................... )&nbsp;</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<br />
		<br />
		<table cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
			<tr>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;Keterangan :&nbsp;</td>
			</tr>
			<tr>
				<td nowrap="nowrap" style="font-weight:bold;">&nbsp;*) : Coret yang tidak diperlukan &nbsp;</td>
			</tr>
		</table>
</body>
</html>
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
<?php include_once "../../close.php";?>