		<?php	
		$sqlx=$conn->query("select distinct rs51.rs1 as noreg,rs23.rs2 as norm,rs15.rs2 as nama,rs15.rs3 as status,rs15.rs17 as kelamin,rs9.rs2 as sistembayar,
							rs24.rs5 as ruang,(year(curdate())-year(rs15.rs16)) as umur,rs15.rs4 as alamat
							from rs51,rs23,rs15,rs9,rs24
							where rs51.rs1=rs23.rs1 and rs23.rs2=rs15.rs1 and rs51.rs24=rs9.rs1 and rs51.rs23=rs24.rs4 and rs51.rs1='".trim($_GET['noreg'])."'
							union all
							select distinct rs51.rs1 as noreg, rs17.rs2 as norm,rs15.rs2 as nama,rs15.rs3 as status,rs15.rs17 as kelamin,rs9.rs2 as sistembayar,
							rs19.rs2 as ruang,(year(curdate())-year(rs15.rs16)) as umur,rs15.rs4 as alamat
							from rs51,rs17,rs15,rs9,rs19
							where rs51.rs1=rs17.rs1 and rs17.rs2=rs15.rs1 and rs51.rs24=rs9.rs1 and rs51.rs23=rs19.rs1 and rs51.rs1='".trim($_GET['noreg'])."' ");
		while($rsx=$sqlx->fetch_object()){
			$noreg=$rsx->noreg;
			$nama=$rsx->nama;
			$norm=$rsx->norm;
			$nota=$rsx->nota;
			$pekerjaan=$rsx->pekerjaan;
			$poli=$rsx->poli;
			$tanggal=$rsx->tanggal;
			$ruangan=$rsx->ruangan;
			$umur=$rsx->umur;
			$alamat=$rsx->alamat;
			$tglmasuk=$rsx->tanggalmasuk;
			$tglkeluar=$rsx->tglkeluar;
			$kelas=$rsx->kelas;
			$sbayar=$rsx->sbayar;
			$sistembayar=$rsx->sistembayar;
			$kelamin=$rsx->kelamin;
			$suku=$rsx->suku;
			$agama=$rsx->agama;
			$status=$rsx->status;
			
			$dokter=$rsx->dokter;
			//$sqlz=$conn->query("select rs21.rs2 as dokter from rs21 where rs21.rs1='".$rsx->dokter."'");
			//$jmlz=$sqlz->num_rows;
			//if($jmlz==0){}else{
				//$rsz=$sqlz->fetch_object();
				//$dokter=$rsz->dokter;
			//}			
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
			</tr>
		</table>			 
		<table align="center" style="border:double #999999;padding-left:20px;padding-right:20px;"><tr><td align="center"><strong>INTERPRETASI LABORAT</strong></td></tr></table>
		<br />
		<table width="99%" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
				<td width="110">No. Nota </td>
				<td width="3">:</td>
				<td nowrap="nowrap" width="521"><?php echo $noreg;?></td>
				<td width="260">No. RM</td>
				<td width="3">:</td>
				<td width="305" nowrap="nowrap"><?php echo $norm;?></td>
			</tr>
			<tr valign="top">
				<td>Nama&nbsp;</td>
				<td width="3">:</td>
				<td><?php echo $nama;?>&nbsp;</td>
				<td>Status</td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $status;?>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td nowrap="nowrap">Jenis Kelamin&nbsp;</td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $kelamin;?></td>
				<td>Alamat&nbsp;</td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $alamat;?></td>
			</tr>
			<tr valign="top">
				<td nowrap="nowrap">Sistem Bayar </td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $sistembayar;?></td>
				<td nowrap="nowrap">Umur</td>
				<td width="3">:</td>
				<td nowrap="nowrap"><?php echo $umur;?></td>
			</tr>
		</tr>
		</table>	
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
	</tr>
</table>

<hr />
