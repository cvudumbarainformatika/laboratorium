<?php include_once "../../conn.php";?>
<form name="frm" onsubmit="return false;"><input type="hidden" name="filex" value="list" /></form>
<table width="99%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr class="headerlist">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Obat&nbsp;</td>
		<td>&nbsp;Satuan&nbsp;</td>
		<td>&nbsp;Jumlah Yang Diminta&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$total=0;
	$sql=$conn->query("select id,rs267.rs1 as nopermintaan,rs267.rs2 as kodeobat,rs32.rs2 as obat,rs32.rs7 as satuan,rs267.rs3 as jumlah from rs267,rs32 where rs267.rs1='".trim($_GET['nopermintaan'])."' and rs267.rs2=rs32.rs1");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<tr class="bodylist" bgcolor="<?php echo warna($x);?>" height="10">
		<td height="10px">&nbsp;<?php echo $x;?>.&nbsp;</td>
		<td nowrap="nowrap">&nbsp;<?php echo $rs->obat;?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo $rs->satuan;?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo $rs->jumlah;?>&nbsp;</td>
		<td>&nbsp;<a href="javascript:void(0);" onclick="javascript:hapuspermintaan('<?php echo $rs->id;?>','<?php echo $rs->nopermintaan;?>','<?php echo $rs->kodeobat;?>','<?php echo $rs->jumlah;?>');" style="text-decoration:none;"><font style="color:#FF0000;font-weight:bold;text-decoration:none;">X</font></a>&nbsp;</td>
	</tr>
	<?php }?>
</table>
<?php include_once "../../close.php";?>