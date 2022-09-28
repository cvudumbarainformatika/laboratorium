<?php include_once "../../conn.php";?>
<body topmargin="0" leftmargin="0" rightmargin="0" style="font-family:Tahoma;font-size:14px;">
		<table width="99%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
			<tr><td colspan="10" style="border-top:double #006699;">&nbsp;</td></tr>
			<tr valign="top">
				<td colspan="8" style="font-weight:bold;">&nbsp;Data Permintaan Laborat Yang Terhapus&nbsp;</td>
			</tr>	
			<tr>
					<td width="32" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;No.&nbsp;</td>
					<td width="148" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Noreg&nbsp;</td>
					<td width="54" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Norm&nbsp;</td>
					<td width="87" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Nota&nbsp;</td>
					<td width="173" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Nama&nbsp;</td>
					<td width="164" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Ruangan&nbsp;</td>
					<td width="136" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Pemeriksaan&nbsp;</td>
					<td width="76" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Biaya&nbsp;</td>
					<td width="28" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Jml&nbsp;</td>
					<td width="155" align="right" style="border-top:solid 1px #006699;border-bottom:solid 1px #006699;">&nbsp;Sub Total&nbsp;</td>
		  </tr>
						
			<?php
				$x=0;
				$total=0;
				$sqlz=$conn->query("select noreg,nota,norm,nama,poli from (
							select rs51_rslog.rs1 as noreg,rs51_rslog.rs2 as nota,rs17.rs2 as norm,rs15.rs2 as nama,rs19.rs2 as poli
							from rs51_rslog,rs17,rs15,rs19
							where rs51_rslog.rs1=rs17.rs1 and rs17.rs2=rs15.rs1 and rs51_rslog.rs23=rs19.rs1 group by rs51_rslog.rs2
							union all
							select rs51_rslog.rs1 as noreg,rs51_rslog.rs2 as nota,rs23.rs2 as norm,rs15.rs2 as nama,rs24.rs2 as poli
							from rs51_rslog,rs23,rs15,rs24
							where rs51_rslog.rs1=rs23.rs1 and rs23.rs2=rs15.rs1 and rs51_rslog.rs23=rs24.rs1 group by rs51_rslog.rs2) as lab order by nota");
				while($rsz=$sqlz->fetch_object()){
				$noreg=$rsx->noreg;
				$nota=$rsx->nota;
				$norm=$rsx->norm;
				$nama=$rsx->nama;
				$poli=$rsx->poli;
				$x=$x+1;
			?>	
			<tr>	
				<td>&nbsp;<?php echo $x;?>&nbsp;</td>
			</tr>	
				<?php
				$z=0;
				$laboratorium=0;
				$sql=$conn->query("select * from (
					select '' as flag,rs51_rslog.id,rs51_rslog.rs4 as kode,rs49.rs2 as keterangan,(rs51_rslog.rs6+rs51_rslog.rs13) as biaya,
					rs51_rslog.rs5 as jml,((rs51_rslog.rs6+rs51_rslog.rs13)*rs51_rslog.rs5) as subtotal,rs51_rslog.rs21 as hasil,rs49.rs22 as nilai,'1' as baris
					from rs49,rs51_rslog where rs49.rs1=rs51_rslog.rs4 and rs51_rslog.rs2='".$rsz->nota."' and rs49.rs21=''
					union all
					select 'x' as flag,rs51_rslog.id,rs51_rslog.rs4 as kode,rs49.rs21 as keterangan,(rs51_rslog.rs6+rs51_rslog.rs13) as biaya,rs51_rslog.rs5 as jml,
					((rs51_rslog.rs6+rs51_rslog.rs13)*rs51_rslog.rs5) as subtotal,rs51_rslog.rs21 as hasil,rs49.rs22 as nilai,count(*) as baris
					from rs49,rs51_rslog where rs49.rs1=rs51_rslog.rs4 and rs51_rslog.rs2='".$rsz->nota."' and rs49.rs21<>'' group by rs49.rs21) as vx ");
				while($rs=$sql->fetch_object()){
											
				?>
				<?php if($rs->flag==""){$z=$z+1;?>	
					<tr class="bodylist" valign="top">
						<td>&nbsp;&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->noreg;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->norm;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->nota;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->nama;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->poli;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
						<td align="right">&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
						<td align="right">&nbsp;<?php echo rp($rs->jml);?>&nbsp;</td>
						<td align="right">&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>	
					</tr>	
				<?php }else{?>
					<tr class="bodylist" valign="top">
						<td>&nbsp;&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->noreg;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->norm;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->nota;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->nama;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rsz->poli;?>&nbsp;</td>
						<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
						<td align="right">&nbsp;<?php echo rp($rs->biaya);?>&nbsp;</td>
						<td align="right">&nbsp;<?php echo rp($rs->jml);?>&nbsp;</td>
						<td align="right">&nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</td>
					</tr>
					<?php }?>	
				<?php $total=$total+$rs->subtotal; }?>
				<?php }?>
					<tr class="bodylist" valign="top">
						<td colspan="11" style="border-top:solid 1px #006699;">&nbsp;&nbsp;</td>
						<td width="234" align="right"  style="border-top:solid 1px #006699;">&nbsp;<?php echo rp($laboratorium);?>&nbsp;</td>
					</tr>		
			
			<tr valign="top">
				<td colspan="9" style="font-weight:bold;" align="right">&nbsp;TOTAL&nbsp;&nbsp;&nbsp;</td>
				<td align="right" style="border-top:double #006699;font-weight:bold;border-bottom:dotted #006699 1px;">&nbsp;<?php echo rp($total);?>&nbsp;</td>
			</tr>
		</table>
		<br />
</body>
<?php include_once "../../close.php";?>