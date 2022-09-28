var timeout         = 1000;
var closetimer		= 0;
var ddmenuitem      = 0;
var catatan;

function jsddm_open()
{	jsddm_canceltimer();
	jsddm_close();
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}

$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
	$('#jsddm > li').bind('mouseout',  jsddm_timer);});
	$('#jsddmx > li').bind('mouseover', jsddm_open);
	$('#jsddmx > li').bind('mouseout',  jsddm_timer);

document.onclick = jsddm_close;

function fungsikomplet(){
	$("#noreg").autocomplete({
		source:'penunjang/laboratorium/autobynoreg.php',
		select:function(event, ui) {
			$('#noreg').val(ui.item.noreg);
			getkunjunganbynoreg2(ui.item.noreg);
		}
	});
	$("#nama").autocomplete({
		source:'penunjang/laboratorium/autobynama.php',
		select:function(event, ui) {
			$('#noreg').val(ui.item.noreg);
			getkunjunganbynoreg2(ui.item.noreg);
		}
	});
	$("#norm").autocomplete({
		source:'penunjang/laboratorium/autobynorm.php',
		select:function(event, ui) {
			$('#noreg').val(ui.item.noreg);
			getkunjunganbynoreg2(ui.item.noreg);
		}
	});
	$("#dokter3").autocomplete({
		source:'penunjang/laboratorium/autobydokter.php',
		select:function(event, ui) {
			$('#kodedokter3').val(ui.item.kodedokter);
		}
	});
	$("#nama_pelaksana").autocomplete({
		source:'penunjang/laboratorium/autobypelaksana.php',
		select:function(event, ui) {
			$('#kode_pelaksana').val(ui.item.kode_pelaksana);
			$('#flag_pelaksana').val(ui.item.flag_pelaksana);
		}
	});
	$("#pemeriksaan").autocomplete({
		source:'penunjang/laboratorium/autobypemeriksaan.php',
		select:function(event, ui) {
			$('#kode').val(ui.item.kode);
			//$('#flag_pelaksana').val(ui.item.flag_pelaksana);
		}
	});
	$("#nama_obat").autocomplete({
		source:'penunjang/laboratorium/autobyobat.php',
		select:function(event, ui) {
			$('#kode_obat').val(ui.item.kode_obat);
			$('#satuan').val(ui.item.satuan);
			document.frmobat.jumlah.focus();
		}
	});
}

function poli_list(){
	loading_content_sub();
	$.getJSON("penunjang/laboratorium/listx.php",function(data){
		var _dataGrid = new JsonDataGrid('content_sub');
		_dataGrid.vLinkFunc="poli_trans";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function poli_list2(){
	loading_content_sub();
	$.getJSON("penunjang/laboratorium/list2x.php",function(data){
		var _dataGrid = new JsonDataGrid('content_sub');
		_dataGrid.vLinkFunc="poli_trans";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function poli_list3(){
	loading_content_sub();
	$.getJSON("penunjang/laboratorium/list3x.php",function(data){
		var _dataGrid = new JsonDataGrid('content_sub');
		_dataGrid.vLinkFunc="poli_trans";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function poli_list4(){
	loading_content_sub();
	$.getJSON("penunjang/laboratorium/list4x.php",function(data){
		var _dataGrid = new JsonDataGrid('content_sub');
		_dataGrid.vLinkFunc="poli_trans";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function poli_trans(nota,kodepoli){
	$.get("penunjang/laboratorium/cekkunci.php",{nota:nota},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				loading_content_sub();
				$.get("penunjang/laboratorium/formtrans.php",{nota:nota},function(result){
					$("#content_sub").html(result);
					//$("#tabs").tabs({event:"mouseover"});
					$("#tabs").tabs();
					$("#tabs").tabs("select",0);
					document.form.norm.focus();
					fungsikomplet();
				});
			}else{
				alert(result);
			}
		}
	})
}

function poli_trans2(){
	loading_content_sub();
    $.get("penunjang/laboratorium/formtrans2.php",function(result){
	    $("#content_sub").html(result);
		$("#tabs").tabs();
		$("#tabs").tabs("select",0);
		document.form.norm.focus();
		fungsikomplet();
    });
}

function getkunjunganbynota(nota){
	theForm=document.form;
    $.get("penunjang/laboratorium/getkunjunganbynota.php",{nota:nota},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				$("#nama_tindakan").autocomplete({
					source:'penunjang/laboratorium/autobytindakan.php?kd_ruang='+update[10]+'&kelas='+update[13],
					select:function(event, ui) {
						$('#kode_tindakan').val(ui.item.kode_tindakan);
						$('#harga_sarana').val(ui.item.sarana);
						$('#harga_pelayanan').val(ui.item.pelayanan);
						$('#tarif').val(ui.item.tarif);
						document.frmtindakan.jumlah_tindakan.value=1;
						document.frmtindakan.focus();
						$('#jumlah_tindakan').select();
						//hitung_biaya_tindakan();
					}
				});
				noreg=update[1];
				theForm.noreg.value=update[1];
				theForm.norm.value=update[2];
				theForm.nama.value=update[3];
				theForm.kelamin.value=update[4];
				theForm.poli.value=update[5];
				theForm.tgllahir.value=update[6];
				theForm.alamat.value=update[7];
				theForm.sistembayar.value=update[9];
				theForm.kd_akun.value=update[9];
				theForm.kodepoli.value=update[10];
				theForm.tanggal.value=update[11];
				theForm.dokter.value=update[12];
				theForm.kelas.value=update[13];
				getnotalaboratbynota(document.form.nota.value);
				getnotalaboratbynotax(document.form.nota.value);
				gridinterpretasi(noreg);
				//getnotalaboratbynoreg(noreg);
				getnotatindakanbynoreg(noreg);
				umur(theForm.tgllahir.value,theForm.thnx.value,theForm.blnx.value,theForm.tglx.value);
			}
		}

    });
}
function getkunjunganbynoreg(noreg){
	theForm=document.form;
	noreg=theForm.noreg.value;
    $.get("penunjang/laboratorium/getkunjunganbynoreg.php",{noreg:noreg},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				$("#nama_tindakan").autocomplete({
					source:'penunjang/laboratorium/autobytindakan.php?kd_ruang='+update[10]+'&kelas='+update[13],
					select:function(event, ui) {
						$('#kode_tindakan').val(ui.item.kode_tindakan);
						$('#harga_sarana').val(ui.item.sarana);
						$('#harga_pelayanan').val(ui.item.pelayanan);
						$('#tarif').val(ui.item.tarif);
						document.frmtindakan.jumlah_tindakan.value=1;
						document.frmtindakan.focus();
						$('#jumlah_tindakan').select();
						//hitung_biaya_tindakan();
					}
				});
				theForm.norm.value=update[2];
				theForm.nama.value=update[3];
				theForm.kelamin.value=update[4];
				theForm.poli.value=update[5];
				theForm.tgllahir.value=update[6];
				theForm.alamat.value=update[7];
				theForm.sistembayar.value=update[9];
				theForm.kd_akun.value=update[9];
				theForm.kodepoli.value=update[10];
				theForm.tanggal.value=update[11];
				theForm.dokter.value=update[12];
				theForm.kelas.value=update[13];
				getnotalaboratbynota(document.form.nota.value);
				getnotalaboratbynotax(document.form.nota.value);
				//getnotalaboratbynoreg(noreg);
				getnotatindakanbynoreg(noreg);
				umur(theForm.tgllahir.value,theForm.thnx.value,theForm.blnx.value,theForm.tglx.value);
			}
		}

    });
}

function getnotalaboratbynota(nota){
	clearCombo(document.frmlaborat.nota);
	//appendCombo(document.frmlaborat.nota,'-----Nota Baru-----','');
	appendCombo(document.frmlaborat.nota,nota,nota);
	selectCombo(document.frmlaborat.nota,nota);
	gridlaboratbynota(nota);
}

function getnotalaboratbynotax(nota){
	clearCombo(document.frminterpretasi.nota);
	//appendCombo(document.frmlaborat.nota,'-----Nota Baru-----','');
	appendCombo(document.frminterpretasi.nota,nota,nota);
	selectCombo(document.frminterpretasi.nota,nota);
	//gridlaboratbynota(nota);
}

function getnotatindakanbynoreg(noreg){
	clearCombo(document.frmtindakan.nota);
	appendCombo(document.frmtindakan.nota,'-----Nota Baru-----','');
    $.get("penunjang/laboratorium/getnotatindakanbynoreg.php",{noreg:noreg},function(result){
		var notax='';
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
		  for(i=update.length-2; i>=0; i--){
			notax=update[i];
			appendCombo(document.frmtindakan.nota,update[i],update[i]);
		  }
		}
		if(notax==""){
			selectCombo(document.frmtindakan.nota,'-----Nota Baru-----');
		}else{
			document.frmtindakan.nota.selectedIndex=1;
		}
		gridtindakanbynota(notax);

	});
}

function gridtindakanbynota(nota){
	$.getJSON("penunjang/laboratorium/gridtindakanbynota.php",{nota:nota},function(data){
		var _dataGrid = new JsonDataGridx('grid_tindakan');
		_dataGrid.vDeleteFunc="hapustindakanbyid";
		_dataGrid.cWraps="|tgl|";
		_dataGrid.cSubtotal=true;
		_dataGrid._Bismillah(data);
	});
}

function getkunjunganbynoreg2(noreg){
	theForm=document.form;
	noreg=theForm.noreg.value;
    $.get("penunjang/laboratorium/getkunjunganbynoreg2.php",{noreg:noreg},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				$("#nama_tindakan").autocomplete({
					source:'penunjang/laboratorium/autobytindakan.php?kd_ruang='+update[10]+'&kelas='+update[13],
					select:function(event, ui) {
						$('#kode_tindakan').val(ui.item.kode_tindakan);
						$('#harga_sarana').val(ui.item.sarana);
						$('#harga_pelayanan').val(ui.item.pelayanan);
						$('#tarif').val(ui.item.tarif);
						document.frmtindakan.jumlah_tindakan.value=1;
						document.frmtindakan.focus();
						$('#jumlah_tindakan').select();
						//hitung_biaya_tindakan();
					}
				});
				theForm.norm.value=update[2];
				theForm.nama.value=update[3];
				theForm.kelamin.value=update[4];
				theForm.poli.value=update[5];
				theForm.tgllahir.value=update[6];
				umur(theForm.tgllahir.value,theForm.thnx.value,theForm.blnx.value,theForm.tglx.value);
				theForm.alamat.value=update[7];
				theForm.sistembayar.value=update[9];
				theForm.kd_akun.value=update[9];
				theForm.kodepoli.value=update[14];
				theForm.tanggal.value=update[10];
				theForm.dokter.value=update[12];
				theForm.kelas.value=update[13];
				getnotalaboratbynoreg(noreg);
				getnotatindakanbynoreg(noreg);
			}
		}
    });
}

function getnotalaboratbynoreg(noreg){
	clearCombo(document.frmlaborat.nota);
	appendCombo(document.frmlaborat.nota,'-----Nota Baru-----','');
    $.get("penunjang/laboratorium/getnotalaboratbynoreg.php",{noreg:noreg},function(result){
		var notax='';
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
		  for(i=update.length-2; i>=0; i--){
			notax=update[i];
			appendCombo(document.frmlaborat.nota,update[i],update[i]);
		  }
		}
		if(notax==""){
			selectCombo(document.frmlaborat.nota,'-----Nota Baru-----');
		}else{
			document.frmlaborat.nota.selectedIndex=1;
		}
		gridlaboratbynota(notax);
	});
}

function gridlaboratbynota(nota){
	loading_grid_laborat();
	$.get("penunjang/laboratorium/gridlaboratbynota.php",{nota:nota},function(resultx){
		$("#grid_laborat").html(resultx);
	});
}
function loading_grid_laborat(){$("#grid_laborat").html("<center><br><img src='images/loading.gif'></center>");}

function simpanlab(z){
	noreg=document.form.noreg.value;
	nota=document.frmlaborat.nota.value;
	x=document.formtrans.nomer.value;
	data='';
	for(i=1;i<=x;i++){
		kodepemeriksaan='kodepemeriksaan'+i;
		hasil='hasil'+i;
		hl='hl'+i;
		data=data+document.getElementById(kodepemeriksaan).value+'='+document.getElementById(hasil).value+'='+document.getElementById(hl).value+';';
	}
	sts=document.getElementsByName("sts[]");
	tsts='';
	for(i=0;i<sts.length;i++){
		tsts=tsts+sts[i].value+";";
	}
    $.get("penunjang/laboratorium/simpanlab.php",{hasil:data,noreg:noreg,nota:nota,status:tsts},function(result){
		if(result=="OK"){
			gridlaboratbynota(nota);
			alert('Data Telah disimpan');
		}
		//$("#content_sub").html(result);
    });
}

function hapuslaboratbyid(id){
	noreg=document.form.noreg.value;
	nota=document.frmlaborat.nota.value;
	$.get("penunjang/laboratorium/hapuslaboratbyid.php",{id:id},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				gridlaboratbynota(nota);
			}else{
				alert(update[0]);
			}
		}
	});
}
function cetaktindakan(){
	nota=document.frmtindakan.nota.value;
	window.open('penunjang/laboratorium/printouttindakan.php?nota='+nota,'','height=700,width=800,scrollbars=yes,resizable=yes');
}
function cetakhasil(nota){
	//nota=document.frmlaborat.nota.value;
	window.open('penunjang/laboratorium/printouthasil.php?nota='+nota,'','height=700,width=800,scrollbars=yes,resizable=yes');
}
function cetakhasily(){
	nota=document.frmlaborat.nota.value;
	window.open('penunjang/laboratorium/printouthasil.php?nota='+nota,'','height=700,width=800,scrollbars=yes,resizable=yes');
}
function dialogx(){
	kodepoli=document.form.kodepoli.value;
	$.fancybox({
		'href'			:'penunjang/laboratorium/dialog.laborat.php?kodepoli='+kodepoli,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax',
		'z-index'		: '-1'
	});
}

function simpanlaborat(){
	theForm=document.form;
	noreg=theForm.noreg.value;
	norm=theForm.norm.value;
	nama=theForm.nama.value;
	kd_akun=theForm.kd_akun.value;

	kode_laborat=document.frmlaborat.kode_laborat.value;
	kodedokter=document.frmlaborat.kodedokter.value;
	dokter=document.frmlaborat.dokter.value;

	nonota=document.frmlaborat.nota.value;

	tanggal_laborat=document.frmlaborat.tanggal_laborat.value;
	harga_sarana=document.frmlaborat.harga_sarana.value;
	harga_pelayanan=document.frmlaborat.harga_pelayanan.value;

	jumlah_laborat=document.frmlaborat.jumlah_laborat.value;
	total_biaya_laborat=document.frmlaborat.total_biaya_laborat.value;

	if(document.frmlaborat.cito.checked==true){ flagcito="cito"; }
	if(document.frmlaborat.cito.checked==false){ flagcito=""; }

	if(noreg==""){
		alert("maaf, noreg kosong");
		theForm.noreg.focus();
	}else if(nama==""){
		alert("maaf, nama kosong");
		theForm.nama.focus();
	}else if(norm==""){
		alert("maaf, norm kosong");
		theForm.norm.focus();
	}else if(kode_laborat==""){
		alert("maaf, pemeriksaan salah / tidak terdaftar");
		document.frmlaborat.nama_pemeriksaan.focus();
	}else if(dokter==""){
		alert("maaf, dokter salah / tidak terdaftar");
		document.frmlaborat.dokter.focus();
	}else{
		document.frmlaborat.kode_laborat.value="";
		$.get("penunjang/laboratorium/formtrans.laborat.simpan.php",{noreg:noreg,norm:norm,kd_akun:kd_akun,kode_laborat:kode_laborat,kodedokter:kodedokter,nota:nonota,harga_sarana:harga_sarana,harga_pelayanan:harga_pelayanan,jumlah_laborat:jumlah_laborat,tanggal_laborat:tanggal_laborat,flagcito:flagcito},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {
				if(update[0]=="OK"){
					var cek='';
					for(i=document.frmlaborat.nota.length-1; i>=0; i--){
						if(document.frmlaborat.nota.options[i].value==update[1]){ cek='1'; }
					}
					if(cek==''){
						appendCombo(document.frmlaborat.nota,update[1],update[1]);
					}
					selectCombo(document.frmlaborat.nota,update[1]);
					//$.get("ranap/pelayanan/gridtindakanbynota.php",{nota:update[1]},function(resultx){
//						$("#grid_laborat").html(resultx);
//					});
					gridlaboratbynota(update[1]);
					clearlaborat();
				}
			}
		});

	}
}


function clearlaborat(){
	theForm=document.frmlaborat;
	theForm.kode_laborat.value='';
	theForm.kodedokter.value='';
	theForm.nama_pemeriksaan.value='';
	theForm.dokter.value='';
	theForm.jumlah_laborat.value='';
	theForm.total_biaya_laborat.value='';
	theForm.harga_sarana.value='';
	theForm.harga_pelayanan.value='';
	theForm.tarif.value='';
}

function simpantindakan(){
	theForm=document.form;
	noreg=theForm.noreg.value;
	norm=theForm.norm.value;
	nama=theForm.nama.value;
	kd_akun=theForm.kd_akun.value;
	kd_ruang=theForm.kodepoli.value;

	kode_tindakan=document.frmtindakan.kode_tindakan.value;
	kode_pelaksana=document.frmtindakan.kode_pelaksana.value;
	flag_pelaksana=document.frmtindakan.flag_pelaksana.value;

	nonota=document.frmtindakan.nota.value;

	tanggal_tindakan=document.frmtindakan.tanggal_tindakan.value;
	harga_sarana=document.frmtindakan.harga_sarana.value;
	harga_pelayanan=document.frmtindakan.harga_pelayanan.value;

	jumlah_tindakan=document.frmtindakan.jumlah_tindakan.value;
	total_biaya_tindakan=document.frmtindakan.total_biaya_tindakan.value;

	if(noreg==""){
		alert("maaf, noreg kosong");
		theForm.noreg.focus();
	}else if(nama==""){
		alert("maaf, nama kosong");
		theForm.nama.focus();
	}else if(norm==""){
		alert("maaf, norm kosong");
		theForm.norm.focus();
	}else if(kode_tindakan==""){
		alert("maaf, tindakan salah / tidak terdaftar");
		document.frmtindakan.nama_tindakan.focus();
	}else if(kode_pelaksana==""){
		alert("maaf, pelaksana salah / tidak terdaftar");
		document.frmtindakan.nama_pelaksana.focus();
	}else{
		document.frmtindakan.kode_tindakan.value="";
		$.get("penunjang/laboratorium/formtrans.tindakan.simpan.php",{noreg:noreg,norm:norm,kd_akun:kd_akun,kd_ruang:kd_ruang,kode_tindakan:kode_tindakan,kode_pelaksana:kode_pelaksana,flag_pelaksana:flag_pelaksana,nota:nonota,harga_sarana:harga_sarana,harga_pelayanan:harga_pelayanan,jumlah_tindakan:jumlah_tindakan,tanggal_tindakan:tanggal_tindakan},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {
				if(update[0]=="OK"){
					var cek='';
					for(i=document.frmtindakan.nota.length-1; i>=0; i--){
						if(document.frmtindakan.nota.options[i].value==update[1]){ cek='1'; }
					}
					if(cek==''){
						appendCombo(document.frmtindakan.nota,update[1],update[1]);
					}
					selectCombo(document.frmtindakan.nota,update[1]);
					gridtindakanbynota(update[1]);
					cleartindakan();
				}
			}
		});

	}
}

function simpaninterpretasi(){
	theForm=document.form;
	noreg=theForm.noreg.value;
	//norm=theForm.norm.value;
	//kodedokterutama=theForm.kodedokterutama.value;
	//kd_ruang=theForm.kd_ruang.value;
	//kd_akun=theForm.kd_akun.value;
	//kunci=theForm.kunci.value;


	nota=document.frminterpretasi.nota.value;
	tanggalinterpretasi=document.frminterpretasi.tanggal_interpretasi.value;
	interpretasi=cekKar(document.frminterpretasi.interpretasi.value);
	ket=cekKar(document.frminterpretasi.ket.value);
	saran=cekKar(document.frminterpretasi.saran.value);
	if(noreg==""){
		alert("maaf, noreg kosong");
		theForm.noreg.focus();
	}else{
		$.get("penunjang/laboratorium/formtrans.interpretasisimpan.php",{ket:ket,noreg:noreg,nota:nota,tanggalinterpretasi:tanggalinterpretasi,interpretasi:interpretasi,saran:saran},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {
				if(update[0]=="OK"){
					gridinterpretasi(noreg);
					alert('telah di simpan');
					clearinterpretasi();
				}else{
					alert(result);
				}
			}
		});

	}
}

function gridinterpretasi(noreg){
	$.getJSON("penunjang/laboratorium/gridinterpretasi.php",{noreg:noreg},function(data){
		var _dataGrid = new JsonDataGridx('grid_interpretasi');
		_dataGrid.vDeleteFunc="hapusinterpretasibyid";
		_dataGrid.cWraps="|tgl|keterangan|";
		_dataGrid._Bismillah(data);
	});
}

function hapusinterpretasibyid(id){
	noreg=document.form.noreg.value;
	$.get("penunjang/laboratorium/hapusinterpretasibyid.php",{id:id},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				gridinterpretasi(noreg);
			}else{
				alert(update[0]);
			}
		}
	});
}

function clearinterpretasi(){
	theForm=document.frminterpretasi;
	theForm.interpretasi.value='';
	theForm.saran.value='';
	theForm.ket.value='';
	theForm.interpretasi.focus();
}

function cetakhasilx(){
	noreg=document.form.noreg.value;
	window.open('penunjang/laboratorium/printoutinterpretasi.php?noreg='+noreg,'','height=700,width=800,scrollbars=yes,resizable=yes');
}

function formcaripemeriksaan(){
	$.get("penunjang/laboratorium/formcaripemeriksaan.php",function(result){
		$("#content_sub").html(result);
		fungsikomplet();
	});
}

function formlihatkunjungan(){
	$.get("penunjang/laboratorium/formlihatkunjungan.php",function(result){
		$("#content_sub").html(result);
		fungsikomplet();
	});
}

function formlihatrapid(){
	$.get("penunjang/laboratorium/formlihatrapid.php",function(result){
		$("#content_sub").html(result);
		fungsikomplet();
	});
}

function cari_pasien_lalu_sudah(){
	tanggal=document.form.tanggal.value;
	tanggalx=document.form.tanggalx.value;
	$("#grid_pasien_lalu_sudahx").html("<br><img src='images/loading-xyz.gif'>");
	$.getJSON("penunjang/laboratorium/formcaripasienlalu.php",{tanggal:tanggal,tanggalx:tanggalx},function(data){
		var _dataGrid = new JsonDataGrid('grid_pasien_lalu_sudahx');
		_dataGrid.vLinkFunc="poli_trans";
		_dataGrid.vDoubleClickFunc="dialog_detail";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function caripemeriksaan(){
	kode=document.form.kode.value;
	bulan=document.form.bulan.value;
	tahun=document.form.tahun.value;
	$("#grid_pasien_lalu_sudah").html("<br><img src='images/loading-xyz.gif'>");
	$.getJSON("penunjang/laboratorium/lappemeriksaan.php",{kode:kode,tahun:tahun,bulan:bulan},function(data){
		var _dataGrid = new JsonDataGrid('grid_pasien_lalu_sudah');
		//_dataGrid.vLinkFunc="poli_trans";
		//_dataGrid.vDoubleClickFunc="dialog_detail";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function carirapid(){
	bulan=document.form.bulan.value;
	tahun=document.form.tahun.value;
	jenis=document.form.jenis.value;
	$("#grid_rapid").html("<br><img src='images/loading-xyz.gif'>");
		$.getJSON("penunjang/laboratorium/laprapid.php",{tahun:tahun,bulan:bulan,jenis:jenis},function(data){
			var _dataGrid = new JsonDataGrid('grid_rapid');
			_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
			_dataGrid.cShowNumber=false;
			_dataGrid.cShowFilter=false;
			_dataGrid.cShowExport=true;
			_dataGrid._Bismillah(data);
		});
}

function form_lalu(){
	loading_content_sub();
	$.get("penunjang/laboratorium/form_lalu.php",function(rs){
		$("#content_sub").html(rs);
		lihat_form_lalu($("#thn").val(),$("#bln").val());
	});
}
function lihat_form_lalu(thn,bln){
	$("#content_subz").html("<img src='images/loading-xyz.gif'>");
	$.getJSON("penunjang/laboratorium/list4xz.php",{thn:thn,bln:bln},function(data){
		var _dataGrid = new JsonDataGrid('content_subz');
		_dataGrid.vLinkFunc="poli_trans";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}
function form_log_dokter(kode_ruang){
	$.get("rajal/poli/form_log_dokter.php",function(result){
		$("#content_sub").html(result);
		fungsikomplet();
		data_log_dokter(kode_ruang);
		log_dokter(kode_ruang);
	});
}
function data_log_dokter(kode_ruang){
	$.get("rajal/poli/data_log_dokter.php",{kode_ruang:kode_ruang},function(result){
		$("#data_dokter").html(result);
	});
}
function log_dokter(kode_ruang){
	$.get("rajal/poli/log_dokter.php",{kode_ruang:kode_ruang},function(result){
		$("#log_dokter").html(result);
	});
}
function simpan_log_dokter(kode_dokter,kode_ruang){
	$.get("rajal/poli/simpan_log_dokter.php",
		{kode_dokter:kode_dokter,kode_ruang:kode_ruang},
		function(result){
			data=result.split('|');
			if(data[0]=='OK'){
				alert('Data telah disimpan.');
				data_log_dokter(kode_ruang);
				log_dokter(kode_ruang);
				bersih_data_log_dokter();
			}else{
				alert(data[1]);
				bersih_data_log_dokter();
			}
		}
	);
}
function bersih_data_log_dokter(){
	forms=document.form_log_dokter;
	forms.kodedokter3.value='';
	forms.dokter3.value='';
}
function update_log_dokter(status,kode_dokter,kode_ruang){
	q=confirm('ingin menyimpannya?');
	if(q==true){
		$.get("rajal/poli/update_log_dokter.php",
			{kode_dokter:kode_dokter,kode_ruang:kode_ruang,status:status},
			function(result){
				data=result.split('|');
				if(data[0]=='OK'){
					data_log_dokter(kode_ruang);
					log_dokter(kode_ruang);
				}else{
					alert(data[1]);
				}
			}
		);
	}
}

function form_permintaan_reagen(){
	loading_content_sub();
    $.get("penunjang/laboratorium/formpermintaanregen.php",function(result){
	    $("#content_sub").html(result);
		$( "#tabs" ).tabs();
		gridobatbynopermintaan();
		fungsikomplet();
    });
}

function simpanobat(){
	theForm=document.form;
	nopermintaan=theForm.nopermintaan.value;
	peminta=theForm.peminta.value;
	keterangan=theForm.keterangan.value;
	kunci=theForm.kunci.value;

	kodeobat=document.frmobat.kode.value;
	jumlah=document.frmobat.jumlah.value;

	if(peminta==""){
		alert("maaf, nama yang peminta kosong");
		theForm.nama.focus();
	}else if(kunci==1){
		alert("maaf anda tidak bisa menambah item pada transaksi ini..");
	}else if(kodeobat==""){
		alert("maaf, obat salah / tidak terdaftar");
		document.frmobat.peminta.focus();
	}else if(jumlah==""){
		alert("maaf, jumlah harus di isi..");
		document.frmobat.jumlah.focus();
	}else{
		clearformobat();
		$.get("penunjang/laboratorium/formtrans.reagen.simpan.php",{nopermintaan:nopermintaan,peminta:peminta,keterangan:keterangan,kodeobat:kodeobat,jumlah:jumlah},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {
				if(update[0]=="OK"){
					document.form.nopermintaan.value=update[1];
					gridobatbynopermintaan(update[1]);
				}else{
					alert(update[0]);
				}
			}
		});
	}
}

function clearformobat(){
	theForm=document.frmobat;
	theForm.kode.value='';
	theForm.nama.value='';
	theForm.satuan.value='';
	theForm.jumlah.value='';
	theForm.nama.focus();

}

function gridobatbynopermintaan(nopermintaan){
	$.get("penunjang/laboratorium/gridobatbynota.php",{nopermintaan:nopermintaan},function(result){
		$("#gridobat").html(result);
		//gettotaltrans(nota);
	});
}

function hapuspermintaan(id,nopermintaan,kodeobat,jumlah){ 
	$.get("penunjang/laboratorium/hapuspermintaan.php",{id:id,nopermintaan:nopermintaan,kodeobat:kodeobat,jumlah:jumlah},function(result){ 
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				gridobatbynopermintaan(nopermintaan);
			}else{
				alert(result);
			}
		}
	});
}

function bataltrans(){
	nopermintaan=document.form.nopermintaan.value;
	var answer=confirm ("Apakan yakin transaksi dibatalkan?");
	if(answer){
		$.get("penunjang/laboratorium/batalpermintaanreagen.php",{nopermintaan:nopermintaan},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {
				if(update[0]=="OK"){
					gridobatbynopermintaan(nopermintaan);
				}else{
					alert(update[0]);
				}
			}
		});
	}
}

function datareagen(){
	loading_content_sub();
	$.getJSON("penunjang/laboratorium/datareagenlistx.php",function(data){
		var _dataGrid = new JsonDataGrid('content_sub');
		_dataGrid.vLinkFunc="poli_trans_reagen";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function cetakpermintaanreagen(nopermintaan){
	window.open('penunjang/laboratorium/printoutpermintaanreagen.php?nopermintaan='+nopermintaan,'','height=700,width=800,scrollbars=yes,resizable=yes');
}

function cetakpermintaanreagenx(){
	nopermintaan=document.form.nopermintaan.value;
	window.open('penunjang/laboratorium/printoutpermintaanreagen.php?nopermintaan='+nopermintaan,'','height=700,width=800,scrollbars=yes,resizable=yes');
}

function formlihathapus(){
	loading_content_sub();
	$.get("penunjang/laboratorium/formlihathapusxz.php",function(result){
		$("#content_sub").html(result);
		//fungsikomplet();
	});
}

//function hapuspermintaanbykode(id,nopermintaan){ 
//	$.get("penunjang/laboratorium/hapuspermintaan.php",{id:id,nopermintaan:nopermintaan},function(result){ 
//		var update = new Array();
//		update = result.split('|');
//		if(result.indexOf('|' != -1)) {
//			if(update[0]=="OK"){
//				gridobatbynopermintaan(nopermintaan);
//			}else{
//				alert(result);
//			}
//		}
//	});
//}

function poli_trans_reagen(nopermintaan){
	loading_content_sub();
    $.get("penunjang/laboratorium/formpermintaanregen.php",{nopermintaan:nopermintaan},function(result){ 
	    $("#content_sub").html(result);
		//$("#tabs").tabs({event:"mouseover"});
		$("#tabs").tabs();
		$("#tabs").tabs("select",0);
		fungsikomplet();
		gridobatbynopermintaan(nopermintaan);
		document.form.kunci.value=1;
    });
}

function stokreagen(){
	loading_content_sub();
	$.getJSON("penunjang/laboratorium/stokreagen.php",function(data){
		var _dataGrid = new JsonDataGrid('content_sub');
		_dataGrid.vLinkFunc="poli_trans_reagen";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}

function kuncipermintaan(c_kesesuaian,nota){
	q=confirm("APAKAH ANDA INGIN MENGUNCI NOTA PERMINTAAN INI...???");
	if(q==true){
		$.get("penunjang/laboratorium/kuncipermintaan.php",{nota:nota},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {			
				if(update[0]=="OK"){ 
					if(update[1]=='1'){ 
						document.getElementById(c_kesesuaian).innerHTML="<input type='button' value='Batal Kunci' onclick='batalKunci(\""+c_kesesuaian+"\",\""+nota+"\");'>"; 
					}
				}else{
					alert(result);
				}
			}
		});
	}
}

function batalKunci(c_kesesuaian,nota){
	q=confirm("APAKAH ANDA INGIN MEMBUKA KUNCI NOTA PERMINTAAN INI...???");
	if(q==true){
		$.get("penunjang/laboratorium/batalKunci.php",{nota:nota},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {			
				if(update[0]=="OK"){ 
					if(update[1]==''){ 
						document.getElementById(c_kesesuaian).innerHTML="<input type='button' value='Kunci' onclick='kuncipermintaan(\""+c_kesesuaian+"\",\""+nota+"\");'>"; 
					}
				}else{
					alert(result);
				}
			}
		});
	}
}

function permintaan_luar_pasien(nota){
	loading_content_sub();
    $.get("penunjang/laboratorium/form_permintaan_luar.php",{nota:nota},function(result){
	    $("#content_sub").html(result);
		$("#tabs").tabs();
		$("#nama_pemeriksaan").autocomplete({
			source:'penunjang/laboratorium/autobypemeriksaan_luar.php',
			select:function(event, ui) {
				$('#kode_laborat').val(';'+ui.item.kode);
				$('#nama_pemeriksaan').val(ui.item.value);
			}
		});
		gridlaboratbynota_luar(nota);
		gridinterpretasi(nota);
		catatan = SUNEDITOR.create('catatan', {
			buttonList: [
				['undo', 'redo'],
				['fontSize', 'formatBlock'],
				['blockquote'],
				['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
				['removeFormat'],
				['outdent', 'indent'],
				['align', 'horizontalRule', 'list', 'lineHeight'],
				['table', 'link', 'image']
			],
			textTags: {bold: 'B'},
			defaultTag: 'div'
		});
		// $("#tabs").tabs("select",0);
		// document.form.noreg.focus();
		// fungsikomplet();
    });	
}
function dialogx_permintaan_luar(){
	kodepoli="PEN002";
	$.fancybox({
		'href'			:'penunjang/laboratorium/dialog.laborat_luar.php?kodepoli='+kodepoli,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax',
		'z-index'		: '-1'
	});
}
function simpanlaborat_luar(){
	theForm=document.form;
	nama=theForm.nama.value;
	kelamin=theForm.kelamin.value;
	tgllahir=theForm.tgllahir.value;
	alamat=theForm.alamat.value;
	nonota=theForm.nota.value;
	pengirim=theForm.pengirim.value;
	jenispembayaran=theForm.jenispembayaran.value;
	nosurat=theForm.nosurat.value;
	noktp=theForm.noktp.value;
	templahir=theForm.templahir.value;
	agama=theForm.agama.value;
	nohp=theForm.nohp.value;
	pekerjaan=theForm.pekerjaan.value;
	perusahaan=theForm.perusahaan.value;
	sampel_diambil=theForm.sampel_diambil.value;
	sampel_selesai=theForm.sampel_selesai.value;
	jam_sampel_diambil=theForm.jam_sampel_diambil.value;
	jam_sampel_selesai=theForm.jam_sampel_selesai.value;

	kode_laborat=document.frmlaborat.kode_laborat.value;
	// hasil=document.frmlaborat.hasil.value;
	// hl=document.frmlaborat.hl.value;
	// ket=document.frmlaborat.ket.value;
	paket_laborat=document.frmlaborat.paket_laborat.value;

	jumlah_laborat=1;
	flagcito="";

	if(nama==""){
		alert("maaf, nama kosong");
		theForm.nama.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(pengirim==""){
		alert("maaf, harus ada rujukan dokter pengirim.");
		theForm.pengirim.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(jenispembayaran==""){
		alert("maaf, Jenis Pembayaran Tidak Boleh Kosong...!!!!.");
		theForm.jenispembayaran.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(kode_laborat==""){
		alert("maaf, pemeriksaan salah / tidak terdaftar");
		document.frmlaborat.nama_pemeriksaan.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(noktp==""){
		alert("maaf, no ktp harus diisi");
		document.form.noktp.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(jenispembayaran=="Perusahaan" && perusahaan==''){
		alert("maaf, perusahaan harus disi");
		document.form.noktp.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(tgllahir==""){
		alert("maaf, tanggal lahir tidak boleh kosong...!!!");
		document.form.tgllahir.focus();
		$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else if(pekerjaan==""){
	alert("maaf, pekerjaan harus dipilih...!!!");
	document.form.pekerjaan.focus();
	$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat();" />');
	}else{
		document.frmlaborat.kode_laborat.value="";
		$("#loads").html("<img src='images/loading.gif' width='50'>");
		$.get("penunjang/laboratorium/formtrans.laborat_luar.simpan.php",{
		perusahaan:perusahaan,sampel_diambil:sampel_diambil,sampel_selesai:sampel_selesai,jam_sampel_selesai:jam_sampel_selesai,jam_sampel_diambil:jam_sampel_diambil,nama:nama,alamat:alamat,kelamin:kelamin,tgllahir:tgllahir,
		kode_laborat:kode_laborat,pengirim:pengirim,nota:nonota,jumlah_laborat:jumlah_laborat,flagcito:flagcito,paket_laborat:paket_laborat,jenispembayaran:jenispembayaran,
		nosurat:nosurat,noktp:noktp,agama:agama,nohp:nohp,templahir:templahir,pekerjaan:pekerjaan},function(result){
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) {
				if(update[0]=="OK"){
					document.form.nota.value=update[1];
					gridlaboratbynota_luar(update[1]);
					document.frmlaborat.nama_pemeriksaan.focus();
					// document.form.nama.value="";
					// document.form.alamat.value="";
					// document.form.tgllahir.value="";
					document.frmlaborat.nama_pemeriksaan.value="";
					// document.frmlaborat.hasil.value="";
					// selectCombo(document.frmlaborat.hl,"");
					$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat_luar();" /> <input type="button" tabindex="21" value="Baru" name="baru" style="width:100px;height:30px" onclick="permintaan_luar_pasien();" />');
				}else{
					alert(update[0]);
					$("#loads").html('<input type="button" tabindex="21" value="Simpan" name="simpan_lab" style="width:100px;height:30px" onclick="simpanlaborat_luar();" /> <input type="button" tabindex="21" value="Baru" name="baru" style="width:100px;height:30px" onclick="permintaan_luar_pasien();" />');
				}
			}
		});

	}
}
function gridlaboratbynota_luar(nota){
	$.get("penunjang/laboratorium/cek_permintaan_luar.php",{nota:nota},function(rs){
		if(rs=="OK"){
			$.getJSON("penunjang/laboratorium/gridlaboratbynota_luar.php",{nota:nota},function(data){
				var _dataGrid = new JsonDataGridx('grid_laborat');
				//_dataGrid.vDeleteFunc="hapuslaboratbyid_luar";
				//_dataGrid.vDoubleClickFunc="dialog_detail";
				_dataGrid.cWraps="|tgl|keterangan|";
				_dataGrid.cSubtotal=true;
				_dataGrid._Bismillah(data);
			});
		}else{
			$.getJSON("penunjang/laboratorium/gridlaboratbynota_luar.php",{nota:nota},function(data){
				var _dataGrid = new JsonDataGridx('grid_laborat');
				_dataGrid.vDeleteFunc="hapuslaboratbyid_luar";
				//_dataGrid.vDoubleClickFunc="dialog_detail";
				_dataGrid.cWraps="|tgl|keterangan|";
				_dataGrid.cSubtotal=true;
				_dataGrid._Bismillah(data);
			});
		}
	});
}
function hapuslaboratbyid_luar(id){
	nota=document.form.nota.value;
	$.get("penunjang/laboratorium/hapuslaboratbyid_luar.php",{id:id},function(result){
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) {
			if(update[0]=="OK"){
				gridlaboratbynota_luar(nota);
			}else{
				alert(update[0]);
			}
		}
	});
}
function data_permintaan_luar_pasien(){
	loading_content_sub();
	$.get("penunjang/laboratorium/form_lalu_permintaan_luar.php",function(rs){
		$("#content_sub").html(rs);
		lihat_data_permintaan_luar($("#thn").val(),$("#bln").val());
	});
}
function lihat_data_permintaan_luar(thn,bln){
	$("#content_subz").html("<img src='images/loading-xyz.gif'>");
	$.getJSON("penunjang/laboratorium/list_permintaan_luar.php",{thn:thn,bln:bln},function(data){
		var _dataGrid = new JsonDataGrid('content_subz');
		_dataGrid.vLinkFunc="permintaan_luar_pasien";
		_dataGrid.cWraps="|noreg|norm|nama|sistembayar|";
		_dataGrid.cShowNumber=true;
		_dataGrid.cShowFilter=true;
		_dataGrid.cShowExport=true;
		_dataGrid._Bismillah(data);
	});
}
function permintaan_luar_sudah_dilayani(){
	nota=document.form.nota.value;
	$.get("penunjang/laboratorium/permintaan_luar_sudah_dilayani.php",{nota:nota},function(rs){
		if(rs=="OK"){
			data_permintaan_luar_pasien();
		}else{
			alert(rs);
		}
	});
}
function cetak_lab_luar(nota){
	//nota=document.frmlaborat.nota.value;
	window.open('penunjang/laboratorium/permintaan_printoutlaborat_luar.php?nota='+nota,'','height=700,width=800,scrollbars=yes,resizable=yes');
}
function cetak_hasil_lab_luar(nota){
	//nota=document.frmlaborat.nota.value;
	window.open('penunjang/laboratorium/printouthasil_permintaan_luar_2.php?nota='+nota,'','height=700,width=800,scrollbars=yes,resizable=yes');
}
function simpan_hasil(){
	nota=document.form.nota.value;
	ckd_lab=document.getElementsByName("ckd_lab[]");
	chasil=document.getElementsByName("chasil_lab[]");
	chl=document.getElementsByName("chl[]");
	cket=document.getElementsByName("cket[]");
	var hasil="";
	for(m=0;m<ckd_lab.length;m++){
		if(chasil[m].value!=""){
			hasil=hasil+ckd_lab[m].value+";"+chasil[m].value+";"+chl[m].value+";"+cket[m].value+"|";
		}else{
			hasil="";
			break;
		}
	}
	if(hasil==""){
		alert("maaf, hasil atau high low ada yg kosong.")
	}else{
		$.get("penunjang/laboratorium/simpan_hasil_luar.php",{nota:nota,hasil:hasil},function(rs){
			if(rs=="OK"){
				alert("Hasil telah disimpan.");
				data_permintaan_luar_pasien();
			}else{
				alert(rs);
			}
		});		
	}
}

function viewdiagnosa(){
	noreg=document.form.noreg.value;
	
	$.fancybox({
		'href'			:'penunjang/laboratorium/dialog.diagnosa.php?noreg='+noreg,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax',
		'z-index'		: '-1'
	});
}

function viewketklinis(){
	noreg=document.form.noreg.value;
	
	$.fancybox({
		'href'			:'penunjang/laboratorium/dialog.ketklinis.php?noreg='+noreg,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax',
		'z-index'		: '-1'
	});
}

function cekcapil(){
	nik=document.form.noktp.value;	
	if(nik==""){
		alert("Nomor KTP kosong.");
		document.form.nik.focus();
	}else{
		$.getJSON("capil/ceknik.php",{nik:nik},function(result){ 
			cData = new Array();cData=result; 
			cPenduduk=cData.content;
				//alert("Nik : "+cPenduduk[0].NIK+"\n\nNama : "+cPenduduk[0].NAMA_LGKP+"\n\nAgama : "+cPenduduk[0].AGAMA+"\n\nAlamat : "+cPenduduk[0].ALAMAT+"\n\nRT/RW : "+cPenduduk[0].NO_RT+"/"+cPenduduk[0].NO_RW+"\n\nKelurahan : "+cPenduduk[0].KEL_NAME+"\n\nKecamatan : "+cPenduduk[0].KEC_NAME+"\n\nTempat Lahir : "+cPenduduk[0].TMPT_LHR+"\n\nStatus : "+cPenduduk[0].STATUS_KAWIN+"\n\nKelamin : "+cPenduduk[0].JENIS_KLMIN+"\n\nTanggal Lahir : "+cPenduduk[0].TGL_LHR);
				if(cPenduduk[0].NIK==undefined){
						alert("KTP Belum Terupdate Di Dinas Kependudukan Probolinggo");
				}else if(cPenduduk[0].NIK!=''){	
					if(cPenduduk[0].JENIS_KLMIN=='LAKI-LAKI'){
						document.form.kelamin.value='Laki-laki';
					}else{
						document.form.kelamin.value='Perempuan';
					}
					document.form.nama.value=cPenduduk[0].NAMA_LGKP;
					
					document.form.alamat.value=cPenduduk[0].ALAMAT+' RT/'+cPenduduk[0].NO_RT+' RW/'+cPenduduk[0].NO_RW+' KEL '+cPenduduk[0].KEL_NAME+' KEC '+cPenduduk[0].KEC_NAME;
					document.form.templahir.value=cPenduduk[0].TMPT_LHR;
					
					
					var today = new Date(cPenduduk[0].TGL_LHR); 
					var dd = today.getDate(); 
					var mm = today.getMonth()+1; //January is 0!
					
					var yyyy = today.getFullYear();
					if(dd<10){
						dd='0'+dd;
					} 
					if(mm<10){
						mm='0'+mm;
					} 
					var today = dd+'/'+mm+'/'+yyyy; 
					document.form.tgllahir.value = today;
					//umur(theForm.tgllahir.value,theForm.thnx.value,theForm.blnx.value,theForm.tglx.value); 
					alert('Data Terupdate dari Dinas Kependudukan Probolinggo...!!!')
				}else{
					alert('Data Tidak Ditemukan...!!!');
				}
		});
	}
}

function cetaksurat(){
	nosurat=document.form.nosurat.value;
	window.open('penunjang/laboratorium/printousurat_bebas_narkoba.php?nosurat='+nosurat,'','height=700,width=800,scrollbars=yes,resizable=yes');
}

function cekPembayaran(jenis){
	if(jenis=='Perusahaan'){
		document.querySelector('#perusahaan').style.visibility="visible";
	}
	else{
		selectCombo(document.form.perusahaan,'');
		document.querySelector('#perusahaan').style.visibility="hidden";
	}
}

function pilihCatatan(catatanContent){
	catatan.setContents(catatanContent); 
}

function simpanCatatan(){
	ket = catatan.getContents();
	theForm=document.form;
	noreg=theForm.noreg.value;
	nota=document.frminterpretasi.nota.value;
	tanggalinterpretasi=document.frminterpretasi.tanggal_interpretasi.value;
	interpretasi=cekKar(document.frminterpretasi.interpretasi.value);
	saran=cekKar(document.frminterpretasi.saran.value);
	if(noreg==""){
		alert("maaf, nota kosong");
		theForm.noreg.focus();
	}
	else{
		$.ajax({
			url: "penunjang/laboratorium/formtrans.catatansimpan.php",
			type: "POST",
			data: {
				noreg:noreg,
				nota:nota,
				tanggalinterpretasi:tanggalinterpretasi,
				interpretasi:interpretasi,
				interpretasi:interpretasi,
				ket:ket,
				saran:saran
			},
			dataType: "json",
			cache: false,
			success: function(result){
				if(result==200)
					gridinterpretasi(noreg);
				else
					alert(result.msg);
			}
		});
	}
}