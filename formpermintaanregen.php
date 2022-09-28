<?php include_once "../../conn.php";?>
<?php
$sql=$conn->query("select * from rs266 where rs1='".trim($_GET['nopermintaan'])."'");
$rs=$sql->fetch_object();
?>
<form name="form" onsubmit="return false;">
<input type="hidden" name="nopermintaan" value="<?php echo $rs->rs1;?>"/>
<input type="hidden" name="kunci"/>

<table cellpadding="0" cellspacing="0" style="width:100%" border="0">
	<tr align="left" valign="top">
		<td colspan="3"  class="headerform">&nbsp;Form Permintaan Reagen&nbsp;<u><?php echo $_SESSION['loginrsx_bag'];?></u></td>		
	</tr>
	<tr class="header_pasien">
		<td width="100px">&nbsp;Yang Meminta  <strong style="color:#FF0000">*</strong>&nbsp;</td>
		<td>&nbsp;<input type="text" name="peminta" id="peminta" size="25" tabindex="1" onkeypress="if(event.keyCode==13){ document.form.keterangan.focus();}" value="<?php echo $rs->rs2;?>">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="100px"  align="right">&nbsp;Keterangan  <strong style="color:#FF0000">*</strong>&nbsp;</td>
		<td>&nbsp;<textarea cols="45" rows="2" name="keterangan" tabindex="10" onkeypress="if(event.keyCode==13){ document.frmobat.nama.focus();}"><?php echo $rs->rs3;?></textarea>&nbsp;</td>
	</tr>
</table>
</form>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Detail Obat</a></li>
	</ul>
	<div id="tabs-1">
		<form name="frmobat" onsubmit="return false;">
		<input type="hidden" name="kode" id="kode_obat" size="15">
		<table><tr valign="top"><td>
		<table cellpadding="0" cellspacing="0">
			<tr valign="top">
				<td>&nbsp;Obat&nbsp;</td>
				<td>&nbsp;&nbsp;</td>
			</tr>
			<tr valign="top">
				<td colspan="2">&nbsp;<input type="text" name="nama" id="nama_obat" size="35" tabindex="8" onkeypress="if(event.keyCode==13){document.frmobat.jumlah.focus();}"/>&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;Satuan&nbsp;</td>
			</tr>
			<tr valign="top">
				<td>&nbsp;<input type="text" name="satuan" id="satuan" style="text-align:right" size="12" tabindex="10" readonly="yes" onkeypress="if(event.keyCode==13){document.frmobat.jumlah.focus();}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td colspan="2">&nbsp;Jumlah&nbsp;</td>
			</tr>
			<tr valign="top">
				<td colspan="2">&nbsp;<input type="text" name="jumlah" style="text-align:right" size="15" tabindex="11" onkeypress="if(event.keyCode==13){document.frmobat.simpan.focus();}else{return chek(event,'angka')}" />&nbsp;</td>
			</tr>
			<tr valign="top">
				<td colspan="2" style="height:50px;vertical-align:middle">&nbsp;<input type="button" tabindex="14" value="Simpan" name="simpan" style="width:100px;height:30px" onclick="simpanobat();" />&nbsp;
				<input type="button" tabindex="14" value="Batal" name="batal" style="width:100px;height:30px" onclick="bataltrans();" />&nbsp;<input type="button" tabindex="14" value="Cetak" name="cetak" style="width:100px;height:30px" onclick="cetakpermintaanreagenx();" /></td>
			</tr>
		</table>
		</td><td><div id="gridobat"></div>
		</td></tr></table>
		</form>
	</div>
</div>
<br>
<?php include_once "../../close.php";?>