<?php include_once "../../conn.php";?>
<form name="form" onsubmit="return false;">
<input type="hidden" name="thnx" value="<?php echo date("Y");?>" />
<input type="hidden" name="blnx" value="<?php echo date("m");?>" />
<input type="hidden" name="tglx" value="<?php echo date("d");?>" />
<input type="hidden" name="kd_akun"/>
<input type="hidden" name="kodepoli"/>
<input type="hidden" name="kelas"/>
<input type="hidden" name="nota"/>

<table cellpadding="0" cellspacing="0" style="width:100%" border="0">
	<tr align="left" valign="top">
		<td colspan="3"  class="headerform">&nbsp;Form Pelayanan Laboratorium&nbsp;</td>	
		<td align="right" colspan="2"  class="headerform">&nbsp;<u><?php echo $_SESSION['loginrsx_bag'];?></u>&nbsp;&nbsp;</td>	
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td width="100px">&nbsp;No.RM  <strong style="color:#FF0000">*</strong>&nbsp;</td>
		<td>&nbsp;<input type="text" name="norm" id="norm" size="15" tabindex="1" onkeypress="if(event.keyCode==13){ document.form.nama.focus();}">&nbsp;</td>
		<td width="100px"  align="right">&nbsp;No.Reg  <strong style="color:#FF0000">*</strong>&nbsp;</td>
		<td>&nbsp;<input type="text" name="noreg" id="noreg" size="25" tabindex="3" onkeypress="if(event.keyCode==13){ document.frmdiagnosa.icd.focus();}">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Nama&nbsp; <strong style="color:#FF0000">*</strong></td>
		<td>&nbsp;<input type="text" name="nama" id="nama" size="45" tabindex="2" onkeypress="if(event.keyCode==13){ document.form.norm.focus();}">&nbsp;</td>
		<td align="right">&nbsp;Tgl Lahir&nbsp;</td>
		<td>&nbsp;<input type="text" name="tgllahir" id="tgllahir" size="10" tabindex="7" readonly="yes">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Kelamin&nbsp;</td>
		<td width="300">&nbsp;<select name="kelamin" tabindex="3" disabled="disabled">
		<option value="Laki-laki">Laki-laki</option>
		<option value="Perempuan">Perempuan</option>
		</select>&nbsp;</td>
		<td align="right">&nbsp;Umur&nbsp;</td>
		<td>&nbsp;<input type="text" name="umurthn" size="2" tabindex="8" readonly="yes"> thn 
		<input type="text" name="umurbln" size="2" tabindex="9" onkeypress="if(event.keyCode==13){document.form.alamat.focus();}" disabled="disabled"> bln
		<input type="text" name="umurhari" size="2" tabindex="10" maxlength="3" onkeypress="if(event.keyCode==13){document.form.alamat.focus();}" disabled="disabled"> hari&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td rowspan="2">&nbsp;Alamat&nbsp;</td>
		<td rowspan="2">&nbsp;<textarea cols="45" rows="2" name="alamat" tabindex="10" readonly="readonly"></textarea> &nbsp;</td>
		<td align="right">&nbsp;Ruang&nbsp;</td>
		<td>&nbsp;<input type="text" name="poli" size="30" tabindex="8" readonly="yes">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Dokter Pengirim&nbsp;</td>
		<td>&nbsp;<input type="text" name="dokter" size="40" tabindex="20" onkeypress="if(event.keyCode==13){document.form.jenis.focus();}" disabled="disabled">&nbsp;</td>
		<td align="right">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td>&nbsp;</td>
		<td>&nbsp;Tanggal&nbsp;</td>
		<td>&nbsp;<input type="text" name="tanggal" size="20" value="<?php echo date("d/m/Y H:i");?>" tabindex="18" onkeypress="if(event.keyCode==13){document.form.jenis.focus();}" disabled="disabled">&nbsp;</td>
		<td align="right">&nbsp;Sistem Bayar&nbsp;</td>
		<td>&nbsp;<select name="sistembayar" id="sistembayar" tabindex="24" onkeypress="if(event.keyCode==13){ if(document.getElementById('sistembayar2').style.visibility=='hidden'){ document.frmdiagnosa.icd.focus(); }else{ document.form.sistembayar2.focus(); } }" onkeyup="getsistembayar();" onchange="getsistembayar();">
            <?php
		$sql=$conn->query("select * from rs9 where rs9<>'karyawan pop' and rs9<>'belum jelas' order by rs2");
		while($rs=$sql->fetch_object()){
		?>
            <option value="<?php echo $rs->rs1;?>"><?php echo $rs->rs2;?></option>
            <?php }?>
          </select>
		<br />
		<!--<input type="button" tabindex="14" value="Update Sistem Bayar" onclick="updatesistembayar(document.frmdiagnosa.icd.value);" />-->
	  &nbsp;</td>
	</tr>
</table>
</form>
<div id="tabs">
	<ul>
		<li><a href="#tabs-6">Laboratorium</a></li>
		<li><a href="#tabs-2">Tindakan</a></li>
	</ul>
	<div id="tabs-6">
		<form name="frmlaborat" onsubmit="return false;">
		<!--<input type="hidden" name="kode_laborat" id="kode_laborat"/>
		<input type="hidden" name="kodedokter" id="kodedokter3" />
		<input type="hidden" name="harga_sarana" id="harga_sarana3" />
		<input type="hidden" name="harga_pelayanan" id="harga_pelayanan3" />
		<table><tr valign="top"><td>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td width="90">&nbsp;Tanggal&nbsp;</td>
				<td>&nbsp;<input type="text" name="tanggal_laborat" size="20" value="" tabindex="14">&nbsp;</td>
			</tr>
			<tr valign="top">
			</tr>
			<tr valign="top">
				<td>&nbsp;Pemeriksaan&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<input type="text" name="nama_pemeriksaan" id="nama_pemeriksaan" size="30" tabindex="15" onkeypress="if(event.keyCode==13){ document.frmlaborat.jumlah_laborat.focus();}"/><a href="javascript:void(0);" onclick="dialogx();"><img src="images/search.gif" border="0" width="15" /></a>
				
				&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Tarif&nbsp;</td>
				<td>&nbsp;<input type="text" name="tarif" id="tarif3" style="text-align:right" onChange="hitung_biaya_laborat();" readonly="yes" size="15" tabindex="16" onkeypress="if(event.keyCode==13){document.frmtindakan.harga_jrs_split.focus();}else{return chek(event,'angka')}" />&nbsp;
				&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Jumlah&nbsp;</td>
				<td>&nbsp;<input type="text" name="jumlah_laborat" id="jumlah_laborat" style="text-align:right" onchange="javascript:hitung_biaya_laborat();" onkeyup="javascript:hitung_biaya_laborat();" size="5" tabindex="17" onkeypress="if(event.keyCode==13){document.frmlaborat.dokter.focus();}else{return chek(event,'angka')}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Sub Total&nbsp;</td>
				<td>&nbsp;<input type="text" name="total_biaya_laborat" style="text-align:right" readonly="yes" size="15" tabindex="18" onkeypress="if(event.keyCode==13){document.frmtindakan.nama_pelaksana.focus();}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Pengirim&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<input type="text" name="dokter" id="dokter3" size="30" tabindex="19" onkeypress="if(event.keyCode==13){ document.frmlaborat.cito.focus();}"/>
				&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Cito&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<input type="checkbox" name="cito" tabindex="20" onkeypress="if(event.keyCode==13){ document.frmlaborat.simpan.focus();}"/> Ya
				&nbsp;</td>
			</tr>
			<tr valign="top"><td>&nbsp;&nbsp;</td>
				<td colspan="2" style="height:50px;vertical-align:middle">&nbsp;<input type="button" tabindex="21" value="Simpan" name="simpan" style="width:100px;height:30px" onclick="simpanlaborat();" />&nbsp;</td>
			</tr>
		</table>
		</td><td></td></tr></table>-->		
		<table><tr valign="top"><td>
		No. Nota : <select name="nota" id="nota2" onchange="gridlaboratbynota(this.value);">&nbsp;<input type="button" tabindex="14" value="Diagnosa" name="diagnosa" style="width:100px;height:30px" onclick="viewdiagnosa();" /><input type="button" tabindex="14" value="KET KLINIS" name="ketklinis" style="width:100px;height:30px" onclick="viewketklinis();" />
		</select></form><div id="grid_laborat"></div>
		</td></tr></table>
		
	
	<hr/>
	<form name="frminterpretasi" onsubmit="return false;">
	No. Nota : <select name="nota" id="nota2" onchange="gridlaboratbynota(this.value);">
					</select>
        	<table><tr valign="top"><td> 
			<table cellpadding="0" cellspacing="0">
			<tr>
			  <td>&nbsp;Tanggal&nbsp;</td>
			  <td>&nbsp;<input size="20" name="tanggal_interpretasi" readonly="yes" value="<?php echo date("d/m/Y H:i:s")?>">&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Interpretasi&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<textarea cols="35" rows="6" name="interpretasi" tabindex="12"></textarea>&nbsp;</td>
			</tr>
            <tr valign="top">
				<td>&nbsp;Saran&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<textarea cols="35" rows="6" name="saran" tabindex="12"></textarea>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Keterangan&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<textarea cols="35" rows="6" name="ket" tabindex="12"></textarea>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;</td>
				<td style="height:50px;vertical-align:middle">&nbsp;<input type="button" tabindex="14" value="Simpan" name="simpan" style="width:100px;height:30px" onclick="simpaninterpretasi();" />&nbsp;
				<!--<input type="button" tabindex="14" value="Cetak" name="cetak" style="width:100px;height:30px" onclick="cetakhasilx();" />&nbsp;</td>-->
			</tr>
            </table>
            </td><td>
				<div id="grid_interpretasi"></div>
			</td></tr></table>
    	</form>
	</div>	
	<div id="tabs-2">
		<form name="frmtindakan" onsubmit="return false;">
		<input type="hidden" name="kddep" size="15" value="ranap">
		<input type="hidden" name="kode_tindakan" id="kode_tindakan" size="15">
		<input type="hidden" name="kode_pelaksana" size="15" id="kode_pelaksana">
		<input type="hidden" name="flag_pelaksana" size="15" id="flag_pelaksana">
		<input type="hidden" name="harga_sarana" id="harga_sarana" />
		<input type="hidden" name="harga_pelayanan" id="harga_pelayanan" />
		<table><tr valign="top"><td>
		<table cellpadding="0" cellspacing="0">
			<tr>
			  <td>&nbsp;Tanggal&nbsp;</td>
			  <td>&nbsp;<input size="20" name="tanggal_tindakan" value="<?php echo date("d/m/Y H:i:s")?>">&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Tindakan&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<input type="text" name="nama_tindakan" id="nama_tindakan" size="30" tabindex="15"/>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Tarif&nbsp;</td>
				<td>&nbsp;<input type="text" name="tarif" id="tarif" style="text-align:right" onChange="hitung_biaya_tindakan();" readonly="yes" size="15" tabindex="16" onkeypress="if(event.keyCode==13){document.frmtindakan.harga_jrs_split.focus();}else{return chek(event,'angka')}" />&nbsp;
				&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Jumlah&nbsp;</td>
				<td>&nbsp;<input type="text" name="jumlah_tindakan" id="jumlah_tindakan" style="text-align:right" onchange="javascript:hitung_biaya_tindakan();" onkeyup="javascript:hitung_biaya_tindakan();" size="5" tabindex="22" onkeypress="if(event.keyCode==13){document.frmtindakan.nama_pelaksana.focus();}else{return chek(event,'angka')}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Total Tarif&nbsp;</td>
				<td>&nbsp;<input type="text" name="total_biaya_tindakan" style="text-align:right" readonly="yes" size="15" tabindex="22" onkeypress="if(event.keyCode==13){document.frmtindakan.nama_pelaksana.focus();}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Pelaksana&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<input type="text" name="nama_pelaksana" id="nama_pelaksana" size="30" tabindex="26" onkeypress="if(event.keyCode==13){document.frmtindakan.simpan2.focus();}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td colspan="2" style="height:50px;vertical-align:middle">&nbsp;<input type="button" tabindex="27" value="Simpan" name="simpan2" style="width:100px;height:30px" onclick="simpantindakan();" />
				<input type="button" tabindex="27" value="Cetak" name="cetak2" style="width:100px;height:30px" onclick="cetaktindakan();" />&nbsp;</td>
			</tr>
		</table>
		</td><td>
		No. Nota : <select name="nota" id="nota" onchange="gridtindakanbynota(this.value);">
		<option value="">-----Nota Baru-----</option>	
			
		</select><!-- <input type="button" value="Cek Pembayaran" onclick="javascript:getstatustindakanbynota(document.frmtindakan.nota.value);"> <span id="status_tindakan" style="color:#FF0000;font-weight:bold;"></span> -->
		<div id="grid_tindakan"></div>
		</td></tr></table>
		</form>
	</div>
</div>
<?php if($_GET['nota']==""){}else{ echo"<script>document.form.nota.value='$_GET[nota]';getkunjunganbynota('$_GET[nota]');</script>";} ?>
<br>
<?php include_once "../../close.php";?>