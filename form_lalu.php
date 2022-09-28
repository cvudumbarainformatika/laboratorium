<form name="frm_periode" id="frm_periode">
	Periode :
	<select name="thn" id="thn">
	<?php for($i=2012;$i<=date("Y");$i++){ ?>
		<option value="<?php echo $i; ?>" <?php if($i==date("Y")){ echo "selected"; }?>><?php echo $i; ?></option>
	<?php } ?>
	</select>
	<select name="bln" id="bln">
	<?php for($i=1;$i<=12;$i++){ ?>
		<option value="<?php echo $i; ?>" <?php if($i==(date("m"))){ echo "selected"; }?>><?php echo $i; ?></option>
	<?php } ?>		
	</select>
	<input type="button" value="Lihat" onclick="lihat_form_lalu(document.frm_periode.thn.value,document.frm_periode.bln.value);">
</form>
<div id="content_subz"></div>