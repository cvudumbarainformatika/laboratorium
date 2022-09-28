<?php include_once "../../conn.php";?>
<div id="dialog">
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="7" class="judullist">&nbsp;DIAGNOSA&nbsp;</td>
	</tr>
	<tr class="headerlist">
		<td>&nbsp;NO&nbsp;</td>
		<td>&nbsp;Tanggal&nbsp;</td>
		<td>&nbsp;Icd&nbsp;</td>
		<td>&nbsp;Diagnosa;</td>
		<td>&nbsp;Kasus&nbsp;</td>
		<td>&nbsp;Type&nbsp;</td>
		<td>&nbsp;Dokter&nbsp;</td>
	</tr>
	<?php
		$sql=$conn->query("select rs101.id as id,rs101.rs12 as tgl,rs101.rs3 as icd,rs99x.rs4 as diagnosa,rs101.rs7 as kasus,
								rs101.rs4 as tipe,rs21.rs2 as dokter from rs101,rs99x,rs21 where rs99x.rs1=rs101.rs3 
								and rs21.rs1=rs101.rs10 and rs101.rs1='".trim($_GET['noreg'])."'");
		$i=1;
	?>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
				<td align="center"><?php echo $i++; ?></td>
				<td><?php echo $rs->tgl; ?></td>
				<td><?php echo $rs->icd; ?></td>
				<td><?php echo $rs->diagnosa; ?></td>
				<td><?php echo $rs->kasus; ?></td>
				<td><?php echo $rs->tipe; ?></td>
				<td><?php echo $rs->dokter; ?></td>
		</tr>
		<?php }?>
		
</div>

<?php include_once "../../close.php";?>