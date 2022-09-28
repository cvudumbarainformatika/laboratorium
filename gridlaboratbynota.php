<?php include_once "../../conn.php";?>
<?php /*?><?php include_once "../../conn_sqlserver.php";?>
<?php */?><div id="dialog">
<form name="formtrans">
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="8" class="judullist">&nbsp;Permintaan Pemeriksaan&nbsp;</td>
	</tr>
	<tr  class="headerform">
		<td>&nbsp;No.&nbsp;</td>
		<td>&nbsp;Pemeriksaan&nbsp;</td>
		<td>&nbsp;Hasil&nbsp;</td>
		<td>&nbsp;Satuan&nbsp;</td>
		<td>&nbsp;Biaya&nbsp;</td>
		<td>&nbsp;Jml&nbsp;</td>
		<td>&nbsp;Sub Total&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$z=0;
	$sql=$conn->query("select * from (
	select '' as flag,rs51.id,
	rs51.rs4 as kode,
	rs49.rs2 as keterangan,
	(rs51.rs6+rs51.rs13) as biaya,
	rs51.rs5 as jml,((rs51.rs6+rs51.rs13)*rs51.rs5) as subtotal,rs51.rs21 as hasil,rs51.rs27 as status,rs49.rs22 as nilai,'1' as baris
	from rs49,rs51 where rs49.rs1=rs51.rs4 and rs51.rs2='".trim($_GET['nota'])."' and rs49.rs21=''
	union all
	select 'x' as flag,
	rs51.id,rs51.rs4 as kode,
	rs49.rs21 as keterangan,
	(rs51.rs6+rs51.rs13) as biaya,
	rs51.rs5 as jml,
	((rs51.rs6+rs51.rs13)*rs51.rs5) as subtotal,rs51.rs21 as hasil,rs51.rs27 as status,rs49.rs22 as nilai,count(*) as baris
	from rs49,rs51 where rs49.rs1=rs51.rs4 and rs51.rs2='".trim($_GET['nota'])."' and rs49.rs21<>'' group by rs49.rs21) as vx order by id");

	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<?php if($rs->flag==""){$z=$z+1;?>
	<?php /*?><?php
		$sql_lab=mssql_query("SELECT [Patient].[Lab_PatientID] as nota,[Result].[RValue] as hasil,[Result].[Unit] as satuan
		FROM [Bio-Connect].[dbo].[Result],[Bio-Connect].[dbo].[Patient]
		WHERE [Patient].[MsgID]=[Result].[MsgID] and [Patient].[Lab_PatientID]='".trim($_GET['nota'])."'");
		$rs_lab=mssql_fetch_object($sql_lab);
	?><?php */?>
	<input type="hidden" name="kodepemeriksaan<?php echo $z;?>" id="kodepemeriksaan<?php echo $z;?>" value="<?php echo $rs->kode;?>" />
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td>&nbsp;<input type="text" size="15" style="font-size:11px;text-align:right" value="<?php if($rs_lab->hasil!=''){echo $rs_lab->hasil;}else{echo $rs->hasil;}?>" name="hasil<?php echo $z;?>" id="hasil<?php echo $z;?>"/>
		<select name="hl<?php echo $z;?>" id="hl<?php echo $z;?>"><option value="">-</option><option value="H" <?php if($rs->status=="H"){ echo "selected"; } ?>>H</option><option value="N" <?php if($rs->status=="N"){ echo "selected"; } ?>>N</option><option value="L" <?php if($rs->status=="L"){ echo "selected"; } ?>>L</option></select>
		<input type="hidden" name="sts[]" value="<?php echo $rs_lab->status; ?>"  />&nbsp;</td>
		<td>&nbsp;<?php echo $rs->nilai;?>&nbsp;</td>

		<td align="right">&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->jml);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>
	</tr>
	<?php }else{?>
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td colspan="3">&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td align="right" rowspan="<?php echo ($rs->baris+1);?>">&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
		<td align="right" rowspan="<?php echo ($rs->baris+1);?>">&nbsp;<?php echo rp($rs->jml);?>&nbsp;</td>
		<td align="right" rowspan="<?php echo ($rs->baris+1);?>">&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>
	</tr>
			<?php
				$sqlx=$conn->query("select 
				rs51.rs4 as kode,
				rs49.rs2 as nama,
				rs51.rs21 as hasil,
				rs51.rs27 as status,
				rs49.rs22 as nilai 
				from rs49,rs51 
				where rs49.rs1=rs51.rs4
				and rs51.rs2='".trim($_GET['nota'])."' and rs49.rs21='".$rs->keterangan."'");
				while($rsx=$sqlx->fetch_object()){
				$z=$z+1;?>
					<?php
						//$sql_labx=$connx->query("select nota,kode_simrs,hasil,status from hasil_lab where nota='".trim($_GET['nota'])."' and kode_simrs='".trim($rsx->kode)."'");
//						$rs_labx=$sql_labx->fetch_object();
					?>
				<tr>
					<td>&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rsx->nama;?>&nbsp;</td>
					<td>&nbsp;<input type="text" size="15" style="font-size:11px;text-align:right" value="<?php if($rs_labx->hasil!=''){echo $rs_labx->hasil;}else{echo $rsx->hasil;}?>" name="hasil<?php echo $z;?>" id="hasil<?php echo $z;?>"/>
					<select name="hl<?php echo $z;?>" id="hl<?php echo $z;?>"><option value="">-</option>
																				<option value="H" <?php if($rsx->status=="H"){ echo "selected"; } ?>>H</option>
																				<option value="L" <?php if($rsx->status=="L"){ echo "selected"; } ?>>L</option>
																				<option value="L" <?php if($rsx->status=="N"){ echo "selected"; } ?>>N</option>
																				</select>
					<input type="hidden" name="sts[]" value="<?php echo $rs_labx->status; ?>" /><input type="hidden" name="kodepemeriksaan<?php echo $z;?>" id="kodepemeriksaan<?php echo $z;?>" value="<?php echo $rsx->kode;?>" />&nbsp;</td>
					<td>&nbsp;<?php echo $rsx->nilai;?>&nbsp;</td>
				</tr>

			<?php	} ?>
		<?php }?>
	<?php $total=$total+$rs->subtotal; }?>
	<tr>
		<td colspan="6">&nbsp;&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($total);?>&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="nomer" value="<?php echo $z;?>"/>
<input type="button" value="Simpan" onclick="javascript:simpanlab(<?php echo $z; ?>);" />
<input type="button" value="Cetak" name="cetak1" onclick="cetakhasily();" />
</form>
</div>
<script language="javascript">

</script>
<?php include_once "../../close.php";?>