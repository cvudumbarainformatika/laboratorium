<?php include_once "../../conn.php";?>
<script src="calendar.js"></script>
<?php
	$sql=$conn->query("select * from lab_luar where nota='".$_GET["nota"]."';");
	$rs=$sql->fetch_object();

?>
<form name="form" onsubmit="return false;">
<input type="hidden" name="thnx" value="<?php echo date("Y");?>" />
<input type="hidden" name="blnx" value="<?php echo date("m");?>" />
<input type="hidden" name="tglx" value="<?php echo date("d");?>" />
<input type="hidden" name="kd_akun"/>
<input type="hidden" name="kodepoli"/>
<input type="hidden" name="noreg" id="noreg" value="<?php echo $_GET["nota"]; ?>"/>
<input type="hidden" name="kelas"/>
<table cellpadding="0" cellspacing="0" style="width:100%" border="0">
	<tr align="left" valign="top">
		<td colspan="3"  class="headerform">&nbsp;Form Permintaan Luar Laboratorium&nbsp;</td>	
		<td align="right" colspan="2"  class="headerform">&nbsp;<u><?php echo $_SESSION['loginrsx_bag'];?></u>&nbsp;&nbsp;</td>	
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td width="130">&nbsp;Nota&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="nota" id="nota" value="<?php echo $rs->nota; ?>" readonly="readonly" size="30" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td>&nbsp;No. Surat&nbsp; <strong style="color:#FF0000"></strong></td>
		<td>&nbsp;<input type="text" name="nosurat" id="nosurat" value="<?php echo $rs->nosurat; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td>&nbsp;No. KTP&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="noktp" id="noktp" value="<?php echo $rs->noktp; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;<input type="button" value="CEK NO KTP" name="capil" id="capil" onclick="cekcapil();" /></td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td>&nbsp;Nama&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="nama" id="nama" value="<?php echo $rs->nama; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="1">&nbsp;</td>
		<td>&nbsp;Tempat Lahir&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="templahir" id="templahir" value="<?php echo $rs->temp_lahir; ?>" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Tgl Lahir&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="tgllahir" readonly="yes" id="tgllahir" value="<?php if(isset($_GET["nota"])==true){echo format_tgl_outx($rs->tgl_lahir,"-");} ?>" size="10" tabindex="7">&nbsp;<a href="javascript: void(0);" onClick="return getCalendar(document.form.tgllahir);"><img src="images/1icon_cal.gif"  border="0" alt=""></a></td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Sampel Diambil&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="sampel_diambil" readonly="yes" id="sampel_diambil" value="<?php if(isset($_GET["nota"])==true){echo format_tgl_outx($rs->sampel_diambil,"-");}else{ echo date("d/m/Y"); } ?>" size="10" tabindex="7">&nbsp;<a href="javascript: void(0);" onClick="return getCalendar(document.form.sampel_diambil);"><img src="images/1icon_cal.gif"  border="0" alt=""></a>
		Jam <input type="text" name="jam_sampel_diambil" id="jam_sampel_diambil" value="<?php if(isset($_GET["nota"])==true){echo $rs->jam_sampel_diambil; }else{echo date("H:i:s");} ?>" size="10" tabindex="7"></td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Sampel Selesai&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="sampel_selesai" readonly="yes" id="sampel_selesai" value="<?php if(isset($_GET["nota"])==true){echo format_tgl_outx($rs->sampel_selesai,"-"); }else{echo date("d/m/Y");} ?>" size="10" tabindex="7">&nbsp;<a href="javascript: void(0);" onClick="return getCalendar(document.form.sampel_selesai);"><img src="images/1icon_cal.gif"  border="0" alt=""></a>
		Jam <input type="text" name="jam_sampel_selesai" id="jam_sampel_selesai" value="<?php if(isset($_GET["nota"])==true){echo $rs->jam_sampel_selesai; }else{echo date("H:i:s");} ?>" size="10" tabindex="7">
		</td>
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
		<td>&nbsp;Agama&nbsp;</td>
		<td>&nbsp;<select name="agama" tabindex="6" id="agama"  onkeypress="if(event.keyCode==13){document.form.tmplahir.focus();}">
		<?php
		$sqlx=$conn->query("select * from rs12");
		while($rsx=$sqlx->fetch_object()){
		?>
			<option value="<?php echo $rsx->rs2;?>" <?php if($rs->agama==$rsx->rs2){ echo"selected"; } ?>><?php echo $rsx->rs2;?></option>
		<?php }?>
		</select>&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Pekerjaan&nbsp;</td>
		<td>&nbsp;<select name="pekerjaan" tabindex="6" id="pekerjaan"  onkeypress="if(event.keyCode==13){document.form.tmplahir.focus();}">
		<option value="">---PILIH PEKERJAAN---</option>
		<?php
		$sqlx=$conn->query("select * from masterpekerjaan");
		while($rsx=$sqlx->fetch_object()){
		?>
			<option value="<?php echo $rsx->rs2.';'. $rsx->rs2;?>" <?php if($rs->nama_pekerjaan==$rsx->rs2){ echo"selected"; } ?>><?php echo $rsx->rs2;?></option>
		<?php }?>
		</select>&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Jenis Pembayaran&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<select name="jenispembayaran" tabindex="6" id="jenispembayaran" onChange="cekPembayaran(this.value);" >
			<option value="">--Pilih Jenis Pembayaran--</option>
			<option value="Perorangan" <?php if($rs->jenispembayaran=="Perorangan"){ echo"selected"; } ?> >Perorangan</option>
			<option value="Perusahaan" <?php if($rs->jenispembayaran=="Perusahaan"){ echo"selected"; } ?>>Perusahaan</option>
		</select> 
		<select name="perusahaan" tabindex="6" id="perusahaan" style="visibility:hidden;" onkeypress="if(event.keyCode==13){document.form.tmplahir.focus();}">
		<option value="">---PILIH PERUSAHAAN---</option>
		<?php
			$sqlPerusahaan=$conn->query("select * from perusahaan where aktif is null or aktif='' order by perusahaan asc;");
			while($rsPerusahaan=$sqlPerusahaan->fetch_object()){
		?>
			<option value="<?php echo $rsPerusahaan->id; ?>" <?php if($rs->perusahaan_id==$rsPerusahaan->id){ echo"selected"; } ?>><?php echo $rsPerusahaan->perusahaan;?></option>
		<?php }?>
		</select>
		&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;No. Telepon&nbsp;</td>
		<td>&nbsp;<input type="text" name="nohp" id="nohp" size="30" value="<?php echo $rs->nohp; ?>" tabindex="7">&nbsp;</td>
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
		<li><a href="#tabs-2">Catatan</a></li>
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
		<?php if($rs->lunas=="1" || $rs->jenispembayaran=="Perusahaan"){ ?><input type="button" onclick="simpan_hasil();" value="Simpan Hasil" style="width:150px;height:30px"><input type="button" onclick="cetaksurat();" value="Cetak Surat" style="width:150px;height:30px"><?php } ?>
		 <div id="grid_laborat"></div>
		</td></tr></table>
		</form>
	</div>
	<div id="tabs-2">
	<form name="frminterpretasi" onsubmit="return false;">
			<input type="hidden" name="nota" id="nota" value="<?php echo $rs->nota; ?>">
			<input type="hidden" name="interpretasi" id="interpretasi" value="-" value="<?php echo $rs->nota; ?>">
			<input type="hidden" name="saran" id="saran" value="-" value="<?php echo $rs->nota; ?>">
			<input type="hidden" name="tanggal_interpretasi" id="tanggal_interpretasi" value="<?php echo $rs->nota; ?>">
        	<table><tr valign="top"><td>
			<table cellpadding="0" cellspacing="0">
			<!-- <tr valign="top">
				<td>&nbsp;Interpretasi&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<textarea cols="35" rows="6" name="interpretasi" tabindex="12"></textarea>&nbsp;</td>
			</tr>
            <tr valign="top">
				<td>&nbsp;Saran&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<textarea cols="35" rows="6" name="saran" tabindex="12"></textarea>&nbsp;</td>
			</tr> -->
			<tr valign="top">
				<td>&nbsp;&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<textarea cols="130" rows="6" name="ket" id="catatan" tabindex="12"></textarea>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;</td>
				<td style="height:50px;vertical-align:middle">&nbsp;<input type="button" tabindex="14" value="Simpan" name="simpan" style="width:100px;height:30px" onclick="simpanCatatan();" />
				<input type="button" tabindex="14" value="Catatan" style="width:100px;height:30px" onclick="getCatatan('catatan');" />
				&nbsp;
				<!--<input type="button" tabindex="14" value="Cetak" name="cetak" style="width:100px;height:30px" onclick="cetakhasilx();" />&nbsp;</td>-->
			</tr>
            </table>
			</td></tr></table>
			<div id="grid_interpretasi"></div>
    	</form>
	</div>
</div>
<br>
<?php include_once "../../close.php";?>