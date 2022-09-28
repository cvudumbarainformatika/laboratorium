<?php include_once "../../conn.php";?>
<form name="frm" onsubmit="return false;"><input type="hidden" name="filex" value="list" /></form>
<?php
	$sqlx=$conn->query("select id,rs1 as kuitansi,rs2 as pengambil,rs3 as keterangan,rs4 as tanggal from rs266 where rs1='".trim($_GET['nopermintaan'])."' ");
	while($rsx=$sqlx->fetch_object()){
	$nopermintaan=$rsx->kuitansi;
	$pengambil=$rsx->pengambil;
	$keterangan=$rsx->keterangan;
	$tanggal=$rsx->tanggal;
	}
?>
<table align="center">
	<tr>
		<td>&nbsp;No. Permintaan&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $nopermintaan ?>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;Tanggal&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $tanggal ?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Pengambil&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $pengambil ?>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;Keterangan&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $keterangan ?>&nbsp;</td>
	</tr>
</table>
<table width="99%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Obat&nbsp;</td>
		<td>&nbsp;Satuan&nbsp;</td>
		<td>&nbsp;Jumlah Yang Diminta&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
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
		<td align="center"><a href="javascript:void(0);" onclick="javascript:hapuspermintaanbykode('<?php echo $rs->id;?>','<?php echo $rsx->kuitansi ;?>');" style="text-decoration:none;"><font style="color:#FF0000;font-weight:bold;text-decoration:none;">X</font></a></td>
	</tr>
	<?php }?>
</table>
<table>
	<tr valign="top">
				<td colspan="2" style="height:50px;vertical-align:middle">&nbsp;<input type="button" tabindex="10" value="Cetak" name="cetak" style="width:50px;height:30px" onclick="cetakpermintaanreagen('<?php echo $nopermintaan; ?>');" />&nbsp;</td>
			</tr>
</table>
<?php include_once "../../close.php";?>