<?php include_once "../../conn.php";?>
<div id="dialog">
<?php
	$sqlx=$conn->query("select noreg,nota,norm,nama,poli from (
	select rs51_rslog.rs1 as noreg,rs51_rslog.rs2 as nota,rs17.rs2 as norm,rs15.rs2 as nama,rs19.rs2 as poli
	from rs51_rslog,rs17,rs15,rs19
	where rs51_rslog.rs1=rs17.rs1 and rs17.rs2=rs15.rs1 and rs51_rslog.rs23=rs19.rs1 group by rs51_rslog.rs2
	union all
	select rs51_rslog.rs1 as noreg,rs51_rslog.rs2 as nota,rs23.rs2 as norm,rs15.rs2 as nama,rs24.rs2 as poli
	from rs51_rslog,rs23,rs15,rs24
	where rs51_rslog.rs1=rs23.rs1 and rs23.rs2=rs15.rs1 and rs51_rslog.rs23=rs24.rs1 group by rs51_rslog.rs2) as lab order by nota");
	while($rsx=$sqlx->fetch_object()){
		$noreg=$rsx->noreg;
		$nota=$rsx->nota;
		$norm=$rsx->norm;
		$nama=$rsx->nama;
		$poli=$rsx->poli;
?>
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="8" class="judullist">Noreg:<?php echo $noreg ?> &nbsp;Nota:<?php echo $nota ?>&nbsp;Norm: <?php echo $norm ?>&nbsp;Nama: <?php echo $nama ?>&nbsp;Ruangan <?php echo $poli ?></td>
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
		select '' as flag,rs51_rslog.id,rs51_rslog.rs4 as kode,rs49.rs2 as keterangan,(rs51_rslog.rs6+rs51_rslog.rs13) as biaya,
		rs51_rslog.rs5 as jml,((rs51_rslog.rs6+rs51_rslog.rs13)*rs51_rslog.rs5) as subtotal,rs51_rslog.rs21 as hasil,rs49.rs22 as nilai,'1' as baris
		from rs49,rs51_rslog where rs49.rs1=rs51_rslog.rs4 and rs51_rslog.rs2='".$nota."' and rs49.rs21=''
		union all
		select 'x' as flag,rs51_rslog.id,rs51_rslog.rs4 as kode,rs49.rs21 as keterangan,(rs51_rslog.rs6+rs51_rslog.rs13) as biaya,rs51_rslog.rs5 as jml,
		((rs51_rslog.rs6+rs51_rslog.rs13)*rs51_rslog.rs5) as subtotal,rs51_rslog.rs21 as hasil,rs49.rs22 as nilai,count(*) as baris
		from rs49,rs51_rslog where rs49.rs1=rs51_rslog.rs4 and rs51_rslog.rs2='".$nota."' and rs49.rs21<>'' group by rs49.rs21) as vx order by id");
		
		while($rs=$sql->fetch_object()){
		$x=$x+1;
		?>
	<?php if($rs->flag==""){$z=$z+1;?>	
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td>&nbsp;<?php if($rs_lab->hasil!=''){echo $rs_lab->hasil;}else{echo $rs->hasil;}?>
		<?php echo $rs_lab->status; ?>&nbsp;</td>
		<td>&nbsp;<?php echo $rs->nilai;?>&nbsp;</td>

		<td align="right">&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->jml);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>	
	</tr>
	<?php }else{?>
	<tr class="bodylist" valign="top">
		<td>&nbsp;<?php echo $x;?>&nbsp;</td>
		<td colspan="3">&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->jml);?>&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>
	</tr>
	
	<?php }?>
	<?php $total=$total+$rs->subtotal; }?>	
<?php }?>
	<tr>
		<td colspan="6">&nbsp;&nbsp;</td>
		<td align="right">&nbsp;<?php echo rp($total);?>&nbsp;</td>
	</tr>
	
	
</table>
</div>
<script language="javascript">

</script>
<?php include_once "../../close.php";?>