<?php include_once "../../conn.php";?>
<script  src="calendar.js"></script>
<script language="javascript">
$(function() {	
	$("#topbar").hide();		
});
</script>
<form name="form" onSubmit="return false;">
	<input type="hidden" name="kode" id="kode" />
<table cellpadding="0" cellspacing="0" style="width:100%" border="0">
	<tr align="left" valign="top">
		<td colspan="3" class="headerform">&nbsp;Form Cari Pemeriksaan&nbsp;</td>	
	</tr>
	<tr class="header_pasien">
	  <td width="100px">&nbsp;Nama Pemeriksaan <strong style="color:#FF0000"></strong>&nbsp;</td>
	  <td colspan="1">&nbsp;
	      <input type="text" name="pemeriksaan" id="pemeriksaan" size="50" tabindex="1" onKeyPress="if(event.keyCode==13){ document.form.nama.focus();}" >
	    &nbsp;</td>
		<td colspan="1">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
	  <td>&nbsp;Tahun&nbsp;</td>
	  <td width="300">&nbsp;
	      <select name="tahun" id="tahun" tabindex="3">
              <?php for($x=(date("Y")-1);$x<=(date("Y"));$x++){ ?>
				<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
			  <?php } ?>
          </select>
	    &nbsp;</td>
		<td width="300">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
	  <td>&nbsp;Bulan&nbsp;</td>
	  <td width="300">&nbsp;
	      <select name="bulan" tabindex="3">
            <option value="01">Januari</option>
            <option value="02">Februari</option>
			<option value="03">Maret</option>
			<option value="04">April</option>
			<option value="05">Mei</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">Agustus</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
          </select>
	    &nbsp;</td>
		<td width="300">&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td colspan="5"><input type="button" tabindex="28" value="Cari" name="cari" style="width:100px;height:30px" onClick="caripemeriksaan();" /></td>
	</tr>
</table>
</form>
</div>
<div id="grid_pasien_lalu_sudah"></div>
<br>
<?php include_once "../../close.php";?>