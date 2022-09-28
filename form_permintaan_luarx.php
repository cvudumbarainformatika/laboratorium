<?php include_once "../../conn.php";?>
<?php
	$sql=$conn->query("select nota,nama,kelamin,alamat,tgl_lahir,akhir,pengirim,lunas,akhirx,jenispembayaran from lab_luar where nota='".$_GET["nota"]."';");
	$rs=$sql->fetch_object();
?>
<form name="form" onsubmit="return false;">
<input type="hidden" name="thnx" value="<?php echo date("Y");?>" />
<input type="hidden" name="blnx" value="<?php echo date("m");?>" />
<input type="hidden" name="tglx" value="<?php echo date("d");?>" />
<input type="hidden" name="kd_akun"/>
<input type="hidden" name="kodepoli"/>
<input type="hidden" name="kelas"/>
<table cellpadding="0" cellspacing="0" style="width:100%" border="0">
	<tr align="left" valign="top">
		<td colspan="3"  class="headerform">&nbsp;Form Permintaan Luar Laboratorium&nbsp;</td>	
		<td align="right" colspan="2"  class="headerform">&nbsp;<u><?php echo $_SESSION['loginrsx_bag'];?></u>&nbsp;&nbsp;</td>	
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td width="100">&nbsp;Nota&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="nota" id="nota" value="<?php echo $rs->nota; ?>" readonly="readonly" size="30" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td width="100">&nbsp;No. Surat&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="nosurat" id="nosurat" value="<?php echo $rs->nosurat; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td width="100">&nbsp;No. KTP&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="noktp" id="noktp" value="<?php echo $rs->noktp; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td width="100">&nbsp;Nama&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="nama" id="nama" value="<?php echo $rs->nama; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td width="100">&nbsp;Tempat Lahir&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="templahir" id="templahir" value="<?php echo $rs->templahir; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Tgl Lahir&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="tgllahir" id="tgllahir" value="<?php if(isset($_GET["nota"])==true){echo format_tgl_outx($rs->tgl_lahir,"-");} ?>" size="10" tabindex="7">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Kelamin&nbsp;</td>
		<td width="300">&nbsp;<select name="kelamin" tabindex="3">
		<option value="Laki-laki" <?php if($rs->kelamin=="Laki-laki"){ echo"selected"; } ?> >Laki-laki</option>
		<option value="Perempuan" <?php if($rs->kelamin=="Perempuan"){ echo"selected"; } ?>>Perempuan</option>
		</select>&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td rowspan="2">&nbsp;Alamat&nbsp;</td>
		<td rowspan="2">&nbsp;<textarea cols="45" rows="2" name="alamat" tabindex="10" ><?php echo $rs->alamat; ?></textarea> &nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Jenis Pembayaran&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<select name="jenispembayaran" tabindex="6" id="jenispembayaran" >
			<option value="">--Pilih Jenis Pembayaran--</option>
			<option value="Perorangan" <?php if($rs->jenispembayaran=="Perorangan"){ echo"selected"; } ?> >Perorangan</option>
			<option value="Perusahaan" <?php if($rs->jenispembayaran=="Perusahaan"){ echo"selected"; } ?>>Perusahaan</option>
		</select> &nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Dokter Pengirim&nbsp;</td>
		<td>&nbsp;<input type="text" name="pengirim" id="pengirim" size="30" value="<?php echo $rs->pengirim; ?>" tabindex="7">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td><input type="button" tabindex="21" value="Baru" name="baru" style="width:100px;height:30px" onclick="permintaan_luar_pasien();" /></td>
		<td><?php if($rs->akhir!="1"){ ?><input type="button" tabindex="21" value="Kunci" name="baru" style="width:100px;height:30px" onclick="permintaan_luar_sudah_dilayani();" /><?php } ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Pemeriksaan</a></li>
	</ul>	
	<div id="tabs-1">
		<form name="frmlaborat" onsubmit="return false;">
		<input type="hidden" name="kode_laborat" id="kode_laborat"/>
		<input type="hidden" name="paket_laborat" id="paket_laborat"/>
		<input type="hidden" name="kodedokter" id="kodedokter3" />
		<input type="hidden" name="harga_sarana" id="harga_sarana3" />
		<input type="hidden" name="harga_pelayanan" id="harga_pelayanan3" />
		<table><tr valign="top"><td width="299">
		<table cellpadding="0" cellspacing="0">
			<tr valign="top">
				<td>&nbsp;Pemeriksaan&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<input type="text" name="nama_pemeriksaan" id="nama_pemeriksaan" size="30" tabindex="15" onkeypress="if(event.keyCode==13){ document.frmlaborat.jumlah_laborat.focus();}"/>

				&nbsp;</td>
			</tr>
			<tr valign="top"><td>&nbsp;&nbsp;</td>
				<td colspan="2" style="height:50px;vertical-align:middle">&nbsp;
				<div id="loads">
					<?php if($rs->akhir!="1"){ ?><input type="button" tabindex="21" value="Simpan Permintaan" name="simpan_lab" style="width:150px;height:30px" onclick="simpanlaborat_luar();" /><?php } ?>
				</div>&nbsp;</td>
			</tr>
		</table>
		</td><td width="234">
		<?php if($rs->lunas=="1"){ ?><input type="button" onclick="simpan_hasil();" value="Simpan Hasil" style="width:150px;height:30px"><?php } ?>
		 <div id="grid_laborat"></div>
		</td></tr></table>
		</form>
	</div>
</div>
<br>
<?php include_once "../../close.php";?>