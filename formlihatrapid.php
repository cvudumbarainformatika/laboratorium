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
		<td colspan="3" class="headerform">&nbsp;Form Rekapitulasi Pemeriksaan Rapid&nbsp;</td>	
	</tr>
	<tr class="header_pasien">
	  <td width = "50">&nbsp;Tahun&nbsp;</td>
	  <td>&nbsp;
	      <select name="tahun" id="tahun" tabindex="3">
              <?php for($x=(date("Y")-1);$x<=(date("Y"));$x++){ ?>
				<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
			  <?php } ?>
          </select>
	    &nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="header_pasien">
	  <td>&nbsp;Bulan&nbsp;</td>
	  <td>&nbsp;
		<?php $bl_now=date("m");?>
	      <select name="bulan" tabindex="3">
            <option value="01" <?php if ($bl_now=='01') echo "selected" ;?>>Januari</option>
            <option value="02" <?php if ($bl_now=='02') echo "selected" ;?>>Februari</option>
			<option value="03" <?php if ($bl_now=='03') echo "selected" ;?>>Maret</option>
			<option value="04" <?php if ($bl_now=='04') echo "selected" ;?>>April</option>
			<option value="05" <?php if ($bl_now=='05') echo "selected" ;?>>Mei</option>
			<option value="06" <?php if ($bl_now=='06') echo "selected" ;?>>Juni</option>
			<option value="07" <?php if ($bl_now=='07') echo "selected" ;?>>Juli</option>
			<option value="08" <?php if ($bl_now=='08') echo "selected" ;?>>Agustus</option>
			<option value="09" <?php if ($bl_now=='09') echo "selected" ;?>>September</option>
			<option value="10" <?php if ($bl_now=='10') echo "selected" ;?>>Oktober</option>
			<option value="11" <?php if ($bl_now=='11') echo "selected" ;?>>November</option>
			<option value="12" <?php if ($bl_now=='12') echo "selected" ;?>>Desember</option>
          </select>
	    &nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="header_pasien">
	  <td>&nbsp;Rekap/Detil&nbsp;</td>
	  <td>&nbsp;
	      <select name="jenis" tabindex="3">
            <option value="rekap">Rekap</option>
            <option value="detail">Detail</option>
          </select>
	    &nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td colspan="5"><input type="button" tabindex="28" value="Cari" name="cari" style="width:100px;height:30px" onClick="carirapid();" /></td>
	</tr>
</table>
</form>
</div>
<div id="grid_rapid"></div>
<br>
<?php include_once "../../close.php";?>