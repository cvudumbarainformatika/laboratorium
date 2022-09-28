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
	  <td align="right"><div align="center" class="style1">SURAT KETERANGAN BEBAS NARKOBA </div></td>
	</tr>
	<tr>
	  <td align="right"><div align="center"><u>Nomor : <?php echo $_GET['nosurat'] ;?> </u></div></td>
	</tr>
</table><br />