<?php include_once "../../conn.php";?>
<form name="frm" onsubmit="return false;"><input type="hidden" name="filex" value="list" /></form>
<?php
	$sqlx=$conn->query("select id,rs1 as kuitansi,rs2 as pengambil,rs3 as keterangan,rs4 as tanggal from rs266 where rs1='".trim($_GET['nopermintaan'])."' ");
	while($rsx=$sqlx->fetch_object()){
	$kuitansi=$rsx->kuitansi;
	$pengambil=$rsx->pengambil;
	$keterangan=$rsx->keterangan;
	$tanggal=$rsx->tanggal;
	}
?>
<table style="border-bottom:double #999999" width="100%">
						<tr valign="top">
							<td width="50px"><img src="../../images/logoz.jpg" width="50"/></td>
							<td>&nbsp;&nbsp;</td>
							<td><strong><?php echo $_SESSION['rs_nama'];?></strong><br />
								<font style="font-size:12px"><?php echo $_SESSION['rs_alamat'];?><br />
								<?php echo $_SESSION['rs_telp'];?></font>							</td>
							<td align="right" style="font-size:11px;"></td>
						</tr>
					</table>
<table align="center" width="100%">
	<tr>
		<td>&nbsp;No. Permintaan&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $kuitansi ?>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td align="right">&nbsp;Tanggal&nbsp;</td>
		<td align="right">&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $tanggal ?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Yang Meminta &nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $pengambil ?>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td align="right">&nbsp;Keterangan&nbsp;</td>
		<td align="right">&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $keterangan ?>&nbsp;</td>
	</tr>
</table>
<table width="99%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Obat&nbsp;</td>
		<td>&nbsp;Satuan&nbsp;</td>
		<td>&nbsp;Jumlah Yang Diminta&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$total=0;
	$sql=$conn->query("select id,rs32.rs2 as obat,rs32.rs7 as satuan,rs267.rs3 as jumlah from rs267,rs32 where rs267.rs1='".trim($_GET['nopermintaan'])."' and rs267.rs2=rs32.rs1");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<tr class="bodylist" bgcolor="<?php echo warna($x);?>" height="10">
		<td height="10px">&nbsp;<?php echo $x;?>.&nbsp;</td>
		<td nowrap="nowrap">&nbsp;<?php echo $rs->obat;?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo $rs->satuan;?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo $rs->jumlah;?>&nbsp;</td>
	</tr>
	<?php }?>
</table>
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