        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Bahan Baku Masuk</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Tambah Bahan Baku Masuk</strong>
                            </div>
                            <div class="card-body">

                                <button onclick="tambahDataMasuk()" class="btn btn-success" style="margin-bottom: 10px;">Bahan Baku Masuk</button>
                            
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Nomor Surat Jalan</td>
                                            <td>Tanggal</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </tr>
                                    </thead>
                                </table>
                                        
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-12-->

                </div>
            </div>
        </div>

    </div> <!-- /.right-panel -->

    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="header modal-header">
                    <h4 class="modal-title">Tambah Bahan Baku Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nomor" class=" form-control-label">Nomor Surat Jalan</label>
                                    <input type="text" id="nomor" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tanggal" class=" form-control-label">Tanggal Surat Jalan</label>
                                    <input type="text" id="tanggal" class="form-control" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <p><strong>Daftar Bahan Baku</strong></p>
                            <div class="input-group">
                                <div class="input-group-btn"><button onclick="daftarBahanBaku()" class="btn btn-success">Tambah Bahan Baku</button></div>
                            </div> 
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <table id="tabelBahanBakuMasuk" class="table table-striped table-bordered text-center" style="width: 100%;" width="100%">
                                <thead>
                                    <tr>
                                        <td>Nama Bahan Baku</td>
                                        <td>Jumlah Bahan (kg)</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                    <button type="button" onclick="simpanEdit()" class="btn add_field_button btn-info">Simpan</button>
                </div>
            </div>
        </div>
    </div> <!-- /.modal -->

    <div class="modal fade" id="modalBahan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="header modal-header">
                    <h4 class="modal-title">Pilih Bahan Baku</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <table id="tabelBahan" class="table table-striped table-bordered text-center" style="width: 100%;" width="100%">
                                <thead>
                                    <tr>
                                        <td>Nama Bahan Baku</td>
                                        <td>Tambah</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
                </div>
            </div>
        </div>
    </div> <!-- /.modal -->

    <script src=<?php echo base_url("assets/js/popper.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/plugins.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/main.js"); ?>></script>
    <script src=<?php echo base_url("assets/datatable/dataTables.min.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/dataTables.buttons.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.print.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.html5.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.flash.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/JSZip-2.5.0/jszip.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/pdfmake.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/vfs_fonts.js")?>></script>
    <script src=<?php echo base_url("assets/js/jquery.easy-autocomplete.js")?>></script>
    <script src=<?php echo base_url("assets/vendors/moment/min/moment-with-locales.min.js")?>></script>
    <script src=<?php echo base_url("assets/js/teabreak.js")?>></script>
    <script src=<?php echo base_url("assets/js/datetime-moment.js")?>></script>
    <script src=<?php echo base_url("assets/js/datetime.js")?>></script>

    <script type="text/javascript">
        moment.locale('id');
        var tabel;
        var jumlahData;
        var daftar = new Array();
        var jenisAksi;

        function reloadTable() {
            tabel.api().ajax.reload(null,false);
        }

        function tambahDataMasuk() {
            daftar = new Array();
            jQuery('#nomor').val('');
            jQuery('#tanggal').val(moment().format('D MMMM YYYY'));
            jQuery('#tabelBahanBakuMasuk tbody').remove();
            jQuery('#modalEdit').modal('show');
            jenisAksi = 'tambah';
        }

        function editBahanBakuMasuk(nomor) {
            daftar = new Array();
            jQuery('#nomor').val(nomor);
            jQuery('#nomor').prop('readonly', true);
            jQuery('#tabelBahanBakuMasuk tbody').remove();
            jenisAksi = 'edit';
            
            jQuery.ajax({
                type    : 'post',
                url     : '<?=base_url('admin/ambilBahanBakuMasuk');?>',
                dataType: 'json',
                data    : { nomor : nomor },
                success : function(data) {
                    if(data == '') {
                        var tabelBahanBakuMasuk = '<tbody>'+
                            '<tr>'+
                                '<td colspan="3" class="text-center">Tidak ada data.</td>'+
                            '</tr>'+
                        '<tbody>';
                        jQuery('#tabelBahanBakuMasuk').append(tabelBahanBakuMasuk);
                    }
                    else {
                        var tabelBahanBakuMasuk = '<tbody>';
                        for(var i=0; i<data.length; i++) {
                            tabelBahanBakuMasuk += '<tr data-kode="'+data[i].kode_bahan_baku+'">'+
                                '<td>'+data[i].nama_bahan_baku+'</td>'+
                                '<td><input type="text" class="form-control numeric" value="'+data[i].jumlah+'" style="width: 130px"></td>'+
                                '<td><button onclick="hapusBahanBaku(\''+data[i].kode_bahan_baku+'\')" class="btn btn-danger" style="color:white;">Delete</button></td>'+
                            '</tr>';
                            var row = {
                                kode    : data[i].kode_bahan_baku,
                                nama    : data[i].nama_bahan_baku,
                                jumlah  : data[i].jumlah
                            };
                            daftar.push(row);
                        }
                        tabelBahanBakuMasuk += '</tbody>';
                        jQuery('#tabelBahanBakuMasuk').append(tabelBahanBakuMasuk);
                    }
                    jQuery('#modalEdit').modal('show');
                },
                error   : function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function daftarBahanBaku() {
            jQuery('#tabelBahan tbody').remove();
            jQuery.ajax({
                url     : '<?=base_url('superadmin/daftarBahanBaku');?>',
                dataType: 'json',
                success : function(datatable) {
                    var tabelBahan = '<tbody>';
                    for(var i=0; i<datatable.data.length; i++) {
                        var cek = daftar.find(arr => arr.kode === datatable.data[i].kode_bahan_baku);
                        if(cek == null) {
                            tabelBahan += '<tr>'+
                                '<td>'+datatable.data[i].nama_bahan_baku+'</td>'+
                                '<td><button onclick="tambahBahanBaku(this, \''+datatable.data[i].kode_bahan_baku+'\', \''+datatable.data[i].nama_bahan_baku+'\')" class="btn btn-success" style="color:white;">Tambah</button></td>'+
                            '</tr>';
                        }
                    }
                    tabelBahan += '</tbody>';
                    jQuery('#modalEdit').modal('hide');
                    jQuery('#modalBahan').modal('show');
                    jQuery('#tabelBahan').append(tabelBahan);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function tambahBahanBaku(button, kode, nama) {
            var row = {
                kode    : kode,
                nama    : nama,
                jumlah  : 0,
            };
            daftar.push(row);

            jQuery(button).attr('disabled', true);
        }

        function hapusBahanBaku(kode) {
            var index;
            for(var i=0; i<daftar.length; i++) {
                if(daftar[i].kode == kode) index = i;
            }
            daftar.splice(index, 1);
            refreshDaftar();
        }

        function refreshDaftar() {
            jQuery('#tabelBahanBakuMasuk tbody').remove();
            var tabelBahanBakuMasuk = '<tbody>';
            for(var i=0; i<daftar.length; i++) {
                tabelBahanBakuMasuk += '<tr data-kode="'+daftar[i].kode+'">'+
                    '<td>'+daftar[i].nama+'</td>'+
                    '<td><input type="text" class="form-control numeric" value="'+daftar[i].jumlah+'" style="width: 130px"></td>'+
                    '<td><button onclick="hapusBahanBaku(\''+daftar[i].kode+'\')" class="btn btn-danger" style="color:white;">Delete</button></td>'+
                '</tr>';
            }
            tabelBahanBakuMasuk += '</tbody>';
            jQuery('#tabelBahanBakuMasuk').append(tabelBahanBakuMasuk);
        }

        function simpanEdit() {
            var flag = false;
            for(var i=0; i<daftar.length; i++) {
                if(daftar[i].jumlah == 0) {
                    flag = true;
                    break;
                }
            }
            
            if(daftar.length == 0) {
                alert('Data tidak ada!');
            }
            else if(flag) {
                alert('Periksa kembali data Anda');
            }
            else {
                var daftarString = JSON.stringify(daftar);
                var nomor = jQuery('#nomor').val();
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('admin/simpanBahanBakuMasuk');?>',
                    data    : { 
                        nomor       : nomor,
                        daftarString: daftarString,
                        jenisAksi   : jenisAksi
                    },
                    success : function(data) {
                        if(data == 'Data berhasil disimpan') {
                            daftar = new Array();
                            jQuery('#nomor').val('');
                            jQuery('#tanggal').val('');
                            jQuery('#tabelBahanBakuMasuk tbody').remove();
                            jQuery('#modalEdit').modal('hide');
                            reloadTable();
                            alert(data);
                        }
                        else {
                            alert(data);
                        }
                    },
                    error   : function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        }

        function hapusBahanBakuMasuk(nomor) {
            if( confirm('Apakah Anda yakin ingin menghapus data ' + nomor + '?') ) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('admin/hapusBahanBakuMasuk');?>',
                    data    : { nomor : nomor },
                    success : function(data) {
                        reloadTable();
                    },
                    error   : function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        }

        jQuery(document).ready(function($) {
            $.fn.dataTable.moment('D MMMM YYYY', 'id');
            tabel = jQuery('#tabelData').dataTable({
                oLanguage : { sProcessing : "Loading..." },
                responsive : true,
                serverSide : true,
                ajax : {
                    type    : 'POST',
                    url     : '<?=base_url('admin/daftarBahanBakuMasuk');?>',
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            if(datatable.data[i].flag_edit_admin == 1) {
                                returnData.push({
                                    'no_surat_jalan'        : datatable.data[i].no_surat_jalan,
                                    'tanggal_surat_jalan'   : datatable.data[i].tanggal_surat_jalan,
                                    'edit'                  : '<button onclick=\"editBahanBakuMasuk(\''+datatable.data[i].no_surat_jalan+'\')\" class="btn btn-warning" style="color:white;">Edit</button>',
                                    'hapus'                 : '<button onclick=\"hapusBahanBakuMasuk(\''+datatable.data[i].no_surat_jalan+'\')\" class="btn btn-danger" style="color:white;">Hapus</button>',
                                });
                            }
                            else {
                                returnData.push({
                                    'no_surat_jalan'        : datatable.data[i].no_surat_jalan,
                                    'tanggal_surat_jalan'   : datatable.data[i].tanggal_surat_jalan,
                                    'edit'                  : '<button onclick=\"editBahanBakuMasuk(\''+datatable.data[i].no_surat_jalan+'\')\" class="btn btn-warning" style="color:white;" disabled>Edit</button>',
                                    'hapus'                 : '<button onclick=\"hapusBahanBakuMasuk(\''+datatable.data[i].no_surat_jalan+'\')\" class="btn btn-danger" style="color:white;" disabled>Hapus</button>',
                                });
                            }
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data  : 'no_surat_jalan' },
                    { data  : 'tanggal_surat_jalan' },
                    { data  : 'edit', orderable : false, searchable : false },
                    { data  : 'hapus', orderable : false, searchable : false },
                ],
                columnDefs : [
                    { targets : 1, render : $.fn.dataTable.render.moment('YYYY-MM-DD', 'D MMMM YYYY', 'id') },
                ],
                // dom : 'Bfrtlip',
                // buttons : [
                //     {
                //         extend      : 'excelHtml5',
                //         title       : 'Laporan Daftar Bahan Baku',
                //         messageTop  : 'Tanggal : ' + moment().format('D MMMM YYYY'),
                //         text        : '<i class="fa fa-fw fa-download"></i> Download Excel',
                //         filename    : 'Laporan Daftar Bahan Baku - ' + moment().format('D MMMM YYYY'),
                //         customize   : function ( xlsx ){
                //             var sheet = xlsx.xl.worksheets['sheet1.xml'];
        
                //             // jQuery selector to add a border
                //             $('row c[r*="3"]', sheet).attr( 's', '27' );

                //             for(var i=0; i<jumlahData; i++) {
                //                 var row = i+4;
                //                 $('row c[r*="'+row+'"]', sheet).attr( 's', '25' );
                //             }
                //         },
                //         exportOptions: {
                //             columns : [ 0, 1, 2 ]
                //         },
                //     }
                // ]
            }); // End DataTable

            jQuery('#modalBahan').on('hidden.bs.modal', function() {
                refreshDaftar();
                jQuery('#modalEdit').modal('show');
            });

            jQuery(document).on('input', '.numeric', function() {
                if(this.value == '' || parseInt(this.value) == 0) {
                    jQuery(this).addClass('is-invalid');
                }
                else {
                    jQuery(this).removeClass('is-invalid');
                }

                var jumlah = (this.value == '') ? 0 : parseInt(this.value);
                var kode = jQuery(this).closest('tr').data('kode');
                var index;
                for(var i=0; i<daftar.length; i++) {
                    if(daftar[i].kode == kode) index = i;
                }
                daftar[index].jumlah = jumlah;
            });

            
        });
    </script>

    