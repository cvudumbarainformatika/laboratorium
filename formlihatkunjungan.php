<?php include_once "../../conn.php";?>
<script  src="calendar.js"></script>
<script language="javascript">
$(function() {	
	$("#topbar").hide();		
});
</script>
<form name="form" onsubmit="return false;">
	<input type="hidden" name="thnx" value="<?php echo date("Y");?>" />
	<input type="hidden" name="blnx" value="<?php echo date("m");?>" />
	<input type="hidden" name="tglx" value="<?php echo date("d");?>" />
	<input type="hidden" name="kd_akun"/>
	<input type="hidden" name="kodepoli"/>
	<input type="hidden" name="kodedokterutama" id="kodedokterutama"/>
	<input type="hidden" name="kodedokterutamax" id="kodedokterutamax"/>
	<input type="hidden" name="kunci"/>
	<input type="hidden" name="noreg" id="noreg" />
<table cellpadding="0" cellspacing="0" style="width:100%" border="0">
	<tr align="left" valign="top">
		<td colspan="3" class="headerform">&nbsp;Form Pasien Lalu Sudah&nbsp;</td>	
		<td width="35%" colspan="2" align="right" class="headerform">&nbsp;&nbsp;&nbsp;</td>	
	</tr>
	<tr class="header_pasien">
		<td width="4%">&nbsp;</td>
		<td width="4%">&nbsp;Tanggal&nbsp;</td>
	  	<td colspan="3">&nbsp;<select name="tanggal">
				<option value="1">Januari</option>
				<option value="2">Februari</option>
				<option value="3">Maret</option>
				<option value="4">April</option>
				<option value="5">Mei</option>
				<option value="6">Juni</option>
				<option value="7">Juli</option>
				<option value="8">Agustus</option>
				<option value="9">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
				</select>&nbsp;</td>
	</tr>
	<tr class="header_pasien">
		<td width="4%">&nbsp;</td>
		<td width="4%">&nbsp;Tanggal&nbsp;</td>
		<td colspan="3">&nbsp;<select name="tanggalx">
			<?php for($i=2014;$i<=date('Y');$i++){ ?>
			<option value="<?php echo $i; ?>" <?php if($i==date('Y')) echo "selected"; ?>><?php echo $i; ?></option>
			<?php } ?>
				</select>&nbsp;<input type="button" tabindex="10" value="Cari" name="cari" style="width:100px;height:25px" onclick="cari_pasien_lalu_sudah();" /></td>
	</tr>
</table>
</form>
</div>
<div id="grid_pasien_lalu_sudahx"></div>
<?php if($_GET['noreg']==""){}else{ echo"<script>document.form.noreg.value='$_GET[noreg]';getkunjunganbynoreg('$_GET[noreg]');</script>";} ?>
<br>
<?php include_once "../../close.php";?>