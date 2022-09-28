<?php	
	$sqlx=$conn->query("select nota,nama,kelamin,alamat,tgl_lahir,akhir,pengirim,tgl from lab_luar where nota='".$_GET["nota"]."' group by nota;");
	while($rsx=$sqlx->fetch_object()){
		$tanggalx=$rsx->tgl;
		$nota=$rsx->nota;
		$nama=$rsx->nama;
		$alamat=$rsx->alamat;
		$pengirim=$rsx->pengirim;
		$tglx=$rsx->tgl;
		$kelamin=$rsx->kelamin;
	}
?>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
<table width="100%">
	<tr valign="top">
		<td>
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
		</td>
	</tr>
	<tr>
	  <td align="right"><div align="center" class="style1">PERMINTAAN LABORAT </div></td>
	</tr>
</table><br />
<table width="99%" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="208">Nama</td>
		<td width="10">:</td>
		<td nowrap="nowrap" width="462"><?php echo $nama;?></td>
		<td width="212">Dokter Pengirim</td>
		<td width="3">:</td>
		<td width="311" nowrap="nowrap"><?php echo $pengirim;?></td>
	</tr>
	<tr valign="top">
		<td>Tanggal&nbsp;</td>
		<td width="10">:</td>
		<td><?php echo $tanggalx; ?>&nbsp;</td>
		<td>&nbsp;Alamat&nbsp;</td>
		<td width="3">:</td>
		<td nowrap="nowrap"><?php echo $alamat;?>&nbsp;</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;Nota</td>
		<td width="10">:</td>
		<td>&nbsp;<?php echo $nota;?>&nbsp;</td>
		<td>Kelamin&nbsp;</td>
		<td width="3">:</td>
		<td nowrap="nowrap"><?php echo $kelamin; ?>&nbsp;</td>
	</tr>
</tr>
</table>	
