<?php include_once "../../conn.php";?>
<div id="dialog">
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="8" class="judullist">&nbsp;KETERANGAN KLINIS LABORAT&nbsp;</td>
	</tr>
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Tanggal&nbsp;</td>
		<td>&nbsp;Keterangan Klinis&nbsp;</td>	
	</tr>
	<?php
	$x=0;
	$sqlx=$conn->query("select * from rs296 where rs1='".$noreg."' ");
	while($rsx=$sqlx->fetch_object()){
	$x=$x+1;
	?>
	<tr class="bodylist" bgcolor="<?php echo warna($x);?>" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td>&nbsp;<?php echo format_tgl_outxxx($rsx->rs3,"-");?>&nbsp;</td>
		<td>&nbsp;<?php echo $rsx->rs4;?>&nbsp;</td>
	</tr>
	<?php  }?>
</table>
		
</div>

<?php include_once "../../close.php";?>