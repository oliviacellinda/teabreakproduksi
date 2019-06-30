function uidate(datestring) {
	

	if (datestring.substring(4,5) == '/') {
		var date = datestring.split("/");

		var tanggal = date[2];
		var bulan = date[1];
		var tahun = date[0];
	}else if (datestring.substring(4,5) == '-') {
		var date = datestring.split("-");

		var tanggal = date[2];
		var bulan = date[1];
		var tahun = date[0];
	}else if (datestring.substring(2,3) == '/') {
		var date = datestring.split("/");

		var tanggal = date[0];
		var bulan = date[1];
		var tahun = date[2];
	}else{
		var date = datestring.split("-");

		var tanggal = date[0];
		var bulan = date[1];
		var tahun = date[2];
	}

	var newdate = new Date(tahun+"/"+bulan+"/"+tanggal);
	var d = newdate.getDay();

	if (d == 0) {
		var hari =  "Minggu";
	}else if (d == 1) {
		var hari =  "Senin";
	}else if (d == 2) {
		var hari =  "Selasa";
	}else if (d == 3) {
		var hari =  "Rabu";
	}else if (d == 4) {
		var hari =  "Kamis";
	}else if (d == 5) {
		var hari =  "Jumat";
	}else if (d == 6) {
		var hari =  "Sabtu";
	}

	var all = hari+", "+tanggal+"/"+bulan+"/"+tahun;
	return all;
}

function getimageteabreak() {
	var imgData = 'data:image/jpeg;base64,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';

	return imgData;
}

function currency(x) {
	var minus;
	if (x<0) {
		minus = '-';
	}else{
		minus = '';
	}
	var retVal=x.toString().replace(/[^\d]/g,'');
	while(/(\d+)(\d{3})/.test(retVal)) {
	  retVal=retVal.replace(/(\d+)(\d{3})/,'$1'+'.'+'$2');
	}
	return minus+retVal;
}

function currency_special(x) {
	var all = x.toString().split('.');
	var awal = all[0];
	var koma='';
	if (all[1] == null) {
		koma = '-';
	}else{
		koma = all[1]+'';
	}
	var retVal=awal.replace(/[^\d]/g,'');
	while(/(\d+)(\d{3})/.test(retVal)) {
	  retVal=retVal.replace(/(\d+)(\d{3})/,'$1'+'.'+'$2');
	}
	return retVal+","+koma;
}

function strtobln(bln) {
	if (bln == "01") {
        return 'Januari';
    }else if (bln == '02'){
        return 'Februari';
    }else if (bln == '03'){
        return 'Maret';
    }else if (bln == '04'){
        return 'April';
    }else if (bln == '05'){
        return 'Mei';
    }else if (bln == '06'){
        return 'Juni';
    }else if (bln == '07'){
        return 'Juli';
    }else if (bln == '08'){
        return 'Agustus';
    }else if (bln == '09'){
        return 'September';
    }else if (bln == '10'){
        return 'Oktober';
    }else if (bln == '11'){
        return 'November';
    }else if (bln == '12'){
        return 'Desember';
    }
}

jQuery(document).on('input', '.numeric', function (event) { 
	this.value = this.value.replace(/[^0-9]/g, '');
	if(this.value != '') {
		this.value = parseInt(this.value);
	}
});

jQuery(document).on('blur', '.numeric', function() {
	if(this.value == '') {
		this.value = 0;
	}
});