<?php include_once "../../conn.php";?>
<script src="penunjang/laboratorium/script.js"></script>
<table bordercolordark="#999999" bordercolorlight="#999999"  align="left" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td  align="left">
		<table bordercolordark="#999999" bordercolorlight="#999999"  cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr>
				<td width="35"><img src="images/nurse.gif"></td>
				<td background="images/nursegaris.gif" width="80%" align="left">  
					<table bordercolordark="#999999" bordercolorlight="#999999" width="100%">
					<tr>
						<td align="left">
							  <ul id="jsddm">
								<!--<li><a href="javascript:void(0);" onclick="poli_trans2();">Form Pelayanan</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>-->
								<li><a href="javascript:void(0);" onclick="poli_list();">Pasien Hari Ini</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="poli_list2();">Pasien Hari Ini Sudah</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="poli_list3();">Pasien Lalu</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="form_lalu();">Pasien Lalu Sudah</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="permintaan_luar_pasien();">Form Permintaan Luar</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="data_permintaan_luar_pasien();">Data Permintaan Luar</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="form_permintaan_reagen();">Form Permintaan Reagen</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="datareagen();">Data Permintaan Reagen</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="stokreagen();">Data Stok</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);" onclick="form_log_dokter('<?php echo $_SESSION['loginrsx_kodebag']; ?>');">Log Dokter</a></li>
								<li style="padding: 0px 2px;color: #556DCE;">|</li>
								<li><a href="javascript:void(0);">Laporan</a>
									<ul>
										<li><a href="javascript:void(0);" onclick="formcaripemeriksaan();">Laporan Pemeriksaan</a></li>
										<li><a href="javascript:void(0);" onclick="formlihatkunjungan();">Laporan Kunjungan Pasien Laborat</a></li>
										<li><a href="javascript:void(0);" onclick="formlihathapus();">Laporan Pemeriksaan Yang dihapus</a></li>
										<li><a href="javascript:void(0);" onclick="formlihatrapid();">Laporan Pemeriksaan Rapid</a></li>
									</ul>
								</li>
							</ul>	
						
						</td>
					</tr>
					</table>
				</td>
				<td background="images/nursegaris.gif" class="sub2" nowrap="nowrap">
					<ul id="jsddm">
						<li><a href="javascript:void(0);" style="text-decoration:none;color:#000000"><?php echo "<u>".$_SESSION['loginrsx_nama']."</u>";?></a>
							<ul>
								<li><a href="logout.php" style="text-decoration:none;color:#000000">Logout</a></li>
								<li><a href="javascript:void(0);" style="text-decoration:none;color:#000000">Ganti Password</a></li>
							</ul>								
						</li>
					</ul>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="left"><div id="content_sub"></div>
		</td>
</tr>
		
	</td>
</tr>
</table>
<script>
	// function autorefreshzzxx(){
		// $.get("alarms_get.php",function(result){
			// var update = result.split("|");
			// if(result=="1"){ 
				// playsound_lab(); 
			// }
		// });	
		// tick=setTimeout("autorefreshzzxx()",30000);
	// }
	// function playsound_lab(x) {
		// var audio = document.createElement('audio');
		// audio.setAttribute('controls', 'controls');
		// audio.setAttribute('autoplay', true);
		// audio.setAttribute('hidden', true);

		// var mp3 = document.createElement('source');
		// mp3.setAttribute('src', 'alarms.mp3');
		// mp3.setAttribute('type', 'audio/mp3');

		// audio.appendChild(mp3);	
		// document.body.appendChild(audio);
	// }
	// autorefreshzzxx();
</script>