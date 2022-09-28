		<?php	
		$sqlx=$conn->query("select rs73.rs1 as noreg,rs73.rs2 as nota,date(rs73.rs3) as tanggal,rs21.rs2 as dokter,
							rs23.rs2 as norm,rs9.rs2 as sistembayar,rs15.rs2 as nama,rs15.rs17 as kelamin,rs24.rs2 as ruangan
							from rs73,rs21,rs23,rs9,rs15,rs24
							where rs73.rs11=rs21.rs1 and rs23.rs1=rs73.rs1 and rs23.rs19=rs9.rs1
							and rs23.rs2=rs15.rs1 and rs24.rs1=rs23.rs5 and rs73.rs2='".trim($_GET['nota'])."' group by noreg 
							UNION all                            
                            select rs73.rs1 as noreg,rs73.rs2 as nota,date(rs73.rs3) as tanggal,rs21.rs2 as dokter,
							rs17.rs2 as norm,rs9.rs2 as sistembayar,rs15.rs2 as nama,rs15.rs17 as kelamin,rs19.rs2 as ruangan
							from rs73,rs21,rs17,rs9,rs15,rs24,rs19
							where rs73.rs11=rs21.rs1 and rs17.rs1=rs73.rs1 and rs17.rs14=rs9.rs1
							and rs17.rs2=rs15.rs1 and rs19.rs1=rs17.rs8 and rs73.rs2='".trim($_GET['nota'])."' group by noreg;");
		while($rsx=$sqlx->fetch_object()){
			$noreg=$rsx->noreg;
			$nota=$rsx->nota;
			$nama=$rsx->nama;
			$kelamin=$rsx->kelamin;
			$ruang=$rsx->ruang;
			$norm=$rsx->norm;
			$ruangan=$rsx->ruangan;
			$sistembayar=$rsx->sistembayar;
			$tanggal=$rsx->tanggal;
			$dokter=$rsx->dokter;
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
			  <td align="right"><div align="center" class="style1">BUKTI PERMINTAAN TINDAKAN RUANG HEMODIALISA </div></td>
			</tr>
		</table><br />
		<table width="99%" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
				<td width="208">Nama</td>
				<td width="10">:</td>
				<td nowrap="nowrap" width="462"><?php echo $nama;?></td>
				<td width="212">No. RM</td>
				<td width="3">:</td>
				<td width="311" nowrap="nowrap"><?php echo $norm;?></td>
			</tr>
			<tr valign="top">
				<td>Tanggal&nbsp;</td>
				<td width="10">:</td>
				<td><?php echo $tanggal;?>&nbsp;</td>
				<td>Ruangan&nbsp;</td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $ruangan;?>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>Sistem Bayar&nbsp;</td>
				<td width="10">:</td>
				<td><?php echo $sistembayar;?>&nbsp;</td>
				<td>Kelamin&nbsp;</td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $kelamin;?>&nbsp;</td>
			</tr>
		</tr>
		</table>	
