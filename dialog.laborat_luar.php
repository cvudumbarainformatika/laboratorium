<?php include_once "../../conn.php";?>
<div id="dialog">
<?php
$groppemeriksaan="";
if($_GET["cito"]=="1"){
	$sql=$conn->query("select rs21,rs23 from rs49 where rs25='1' and rs1<>'LAB126' group by rs21");
}else{
	$sql=$conn->query("select rs21,rs23 from rs49 where (rs25='' or rs25='1') and rs1<>'LAB126' group by rs21");
}
while($rs=$sql->fetch_object()){
	$groppemeriksaan=$groppemeriksaan."|cek".$rs->rs23;
}
?>
<form name="formcek" id="formcek" onsubmit="return false;">
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td height="21" colspan="7" class="judullist">&nbsp;Data Pemeriksaan&nbsp;</td>
	</tr>
	<tr class="headerlist">
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;Nama Pemeriksaan&nbsp;</td>
		<td>&nbsp;Nilai Normal&nbsp;</td>
		<td>&nbsp;Sarana&nbsp;</td>
		<td>&nbsp;Pelayanan&nbsp;</td>
		<td>&nbsp;Total Tarif&nbsp;</td>
	</tr>
	<?php
	$z=0;
	if($_GET["cito"]=="1"){
		$sql=$conn->query("select rs21,rs23,rs3,rs4,rs5,rs6,count(*) as jml from rs49 where rs25='1' and rs1<>'LAB126' group by rs21");
	}else{
		$sql=$conn->query("select rs21,rs23,rs3,rs4,rs5,rs6,count(*) as jml from rs49 where (rs25='' or rs25='1') and rs1<>'LAB126' group by rs21");
	}
	while($rs=$sql->fetch_object()){
	$z=$z+1;
	?>
		<?php if($rs->rs21==""){}else{?>
		<tr class="headerlist">
			<td><input type="checkbox" style="font-size:7px" onclick="CekUnCek(cek<?php echo $rs->rs23;?>);"/></td>
			<td colspan="3">&nbsp;<strong style="font-weight:bold;"><?php echo $rs->rs21;?></strong>&nbsp;</td>
			<?php if($_GET['kodepoli']=="POL022"){?>
			<td align="right" rowspan="<?php echo $rs->jml+1;?>">&nbsp;<?php echo rp($rs->rs3);?>&nbsp;</td>
			<td align="right" rowspan="<?php echo $rs->jml+1;?>">&nbsp;<?php echo rp($rs->rs4);?>&nbsp;</td>
			<td align="right" rowspan="<?php echo $rs->jml+1;?>">&nbsp;<?php echo rp($rs->rs3+$rs->rs4);?>&nbsp;</td>
			<?php }else{?>
			<td align="right" rowspan="<?php echo $rs->jml+1;?>">&nbsp;<?php echo rp($rs->rs5);?>&nbsp;</td>
			<td align="right" rowspan="<?php echo $rs->jml+1;?>">&nbsp;<?php echo rp($rs->rs6);?>&nbsp;</td>
			<td align="right" rowspan="<?php echo $rs->jml+1;?>">&nbsp;<?php echo rp($rs->rs5+$rs->rs6);?>&nbsp;</td>
			<?php }?>
		</tr>
		<?php }?>
		<?php
		$x=0;
		if($_GET["cito"]=="1"){
			$sqlx=$conn->query("select * from rs49 where rs21='".$rs->rs21."' and rs25='1' and rs1<>'LAB126' order by rs2");
		}else{
			$sqlx=$conn->query("select * from rs49 where rs21='".$rs->rs21."' and (rs25='' or rs25='1') and rs1<>'LAB126' order by rs2");
		}
		while($rsx=$sqlx->fetch_object()){
		$x=$x+1;
		$z=$z+1;
		?>
		<?php if($rs->rs21==""){?>
		<tr class="bodylist" bgcolor="<?php echo warna($x);?>">
			<td>&nbsp;&nbsp;</td>
			<td><input type="checkbox" name="cek<?php echo $rs->rs23;?>" value="<?php echo $rsx->rs1;?>|<?php echo $rsx->rs21;?>" style="font-size:7px" onclick="PeriksaIsikan();" /></td>
			<td>&nbsp;<?php echo $rsx->rs2;?>&nbsp;</td>
			<td>&nbsp;<?php echo $rsx->rs22;?>&nbsp;</td>
			<?php if($_GET['kodepoli']=="POL022"){?>
			<td align="right">&nbsp;<?php echo rp($rsx->rs3);?>&nbsp;</td>
			<td align="right">&nbsp;<?php echo rp($rsx->rs4);?>&nbsp;</td>
			<td align="right">&nbsp;<?php echo rp($rsx->rs3+$rsx->rs4);?>&nbsp;</td>
			<?php }else{?>
			<td align="right">&nbsp;<?php echo rp($rsx->rs5);?>&nbsp;</td>
			<td align="right">&nbsp;<?php echo rp($rsx->rs6);?>&nbsp;</td>
			<td align="right">&nbsp;<?php echo rp($rsx->rs5+$rsx->rs6);?>&nbsp;</td>
			<?php }?>
		</tr>
		<?php }else{?>
		<tr class="bodylist" bgcolor="<?php echo warna($x);?>">
			<td>&nbsp;&nbsp;</td>
			<td><input type="checkbox" name="cek<?php echo $rs->rs23;?>" value="<?php echo $rsx->rs1;?>|<?php echo $rsx->rs21;?>" style="font-size:7px" onclick="PeriksaIsikan();" /></td>
			<td>&nbsp;<?php echo $rsx->rs2;?>&nbsp;</td>
			<td>&nbsp;<?php echo $rsx->rs22;?>&nbsp;</td>
		</tr>
		<?php }?>
		<?php }?>
	<?php }?>
</table>
</form>
<script>
function CekUnCek(chk){
	if(chk.length==undefined){
		if(chk.checked==true) { chk.checked = false ; }else{ chk.checked = true ; }
	}
	for (i=0;i<chk.length;i++){
		if(chk[i].checked==true) { chk[i].checked = false ; }else{ chk[i].checked = true ; }
	}
	PeriksaIsikan();
}

function PeriksaIsikan(){
	var x='';
	var kode='';
	var paket='';
	var c = document.getElementById('formcek').getElementsByTagName('input');
	var c1 = document.getElementsByName('checkbox');
    for (var i = 0; i < c.length; i++) {
        if (c[i].checked==true && c[i].value!="on") {
            x=x+';'+c[i].value;
        }
    }
	y=x.split(';');
	for(j = 1 ; j < y.length ; j++){
		y1=y[j].split('|');
		kode=kode+';'+y1[0];
		paket=paket+';'+y1[1];
	}
	document.frmlaborat.kode_laborat.value=kode;
	document.frmlaborat.paket_laborat.value=paket;
	document.frmlaborat.nama_pemeriksaan.value='Lebih dari satu pemeriksaan';
	document.frmlaborat.jumlah_laborat.value="1";
}
</script>
</div>

<?php include_once "../../close.php";?>