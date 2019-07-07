        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Sistem Produksi</h1>
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
                                <strong class="card-title">Tambah Produksi</strong>
                            </div>
                            <div class="card-body">

                                <button onclick="tambahProduksi()" class="btn btn-success" style="margin-bottom: 10px;">Tambah Produksi</button>
                            
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Kode Produksi</td>
                                            <td>Tanggal</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                            <td>Save PDF</td>
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
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="namaProduk" class=" form-control-label">Nama Produk</label>
                                <select name="namaProduk" id="namaProduk"></select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jumlahProduksi" class=" form-control-label">Jumlah Produksi</label>
                                <input type="text" name="jumlahProduksi" id="jumlahProduksi" class="form-control numeric">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <p><strong>Kebutuhan Bahan</strong></p>
                            <table id="tabelBahan" class="table table-striped table-bordered text-center" style="width: 100%;" width="100%">
                                <thead>
                                    <tr>
                                        <td>Nama Bahan</td>
                                        <td>Jumlah Bahan (kg)</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="form-group">
                            <label for="hasilSebenarnya" class=" form-control-label">Hasil Sebenarnya</label>
                            <input type="text" name="hasilSebenarnya" id="hasilSebenarnya" class="form-control numeric">
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
        var jenisAksi;

        function reloadTable() {
            tabel.api().ajax.reload(null,false);
        }

        function tambahProduksi() {
            jQuery('#hasilSebenarnya').prop('disabled', true);
            jQuery('#modalEdit').modal('show');
            jenisAksi = 'tambah';
        }

        function editProduksi(kode) {
            jQuery('#tabelBahan tbody').remove();
            jenisAksi = 'edit';
            
            jQuery.ajax({
                type    : 'post',
                url     : '<?=base_url('admin/ambilProduksi');?>',
                dataType: 'json',
                data    : { kode : kode },
                success : function(data) {
                    if(data == '') {
                        var tabelBahan = '<tbody>'+
                            '<tr>'+
                                '<td colspan="3" class="text-center">Tidak ada data.</td>'+
                            '</tr>'+
                        '<tbody>';
                        jQuery('#tabelBahan').append(tabelBahan);
                    }
                    else {
                        var tabelBahan = '<tbody>';
                        for(var i=0; i<data.length; i++) {
                            tabelBahan += '<tr>'+
                                '<td>'+data.resep[i].nama_bahan_baku+'</td>'+
                                '<td>'+data.resep[i].jumlah_bahan_baku+'</td>'+
                            '</tr>';
                        }
                        tabelBahan += '</tbody>';
                        jQuery('#tabelBahan').append(tabelBahan);
                    }
                    jQuery('#modalEdit').modal('show');
                },
                error   : function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function simpanEdit() {
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

        function hapusProduksi(nomor) {
            if( confirm('Apakah Anda yakin ingin menghapus data ' + nomor + '?') ) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('admin/hapusProduksi');?>',
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
                    url     : '<?=base_url('admin/daftarProduksi');?>',
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            returnData.push({
                                'kode_produksi'     : datatable.data[i].kode_produksi,
                                'tanggal_produksi'  : datatable.data[i].tanggal_produksi,
                                'edit'              : '<button onclick=\"editProduksi(\''+datatable.data[i].kode_produksi+'\')\" class="btn btn-warning" style="color:white;">Edit</button>',
                                'hapus'             : '<button onclick=\"hapusProduksi(\''+datatable.data[i].kode_produksi+'\')\" class="btn btn-danger" style="color:white;">Hapus</button>',
                            });
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data  : 'kode_produksi' },
                    { data  : 'tanggal_produksi' },
                    { data  : 'edit', orderable : false, searchable : false },
                    { data  : 'hapus', orderable : false, searchable : false },
                ],
                columnDefs : [
                    { targets : 1, render : $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'D MMMM YYYY HH:mm', 'id') },
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

            jQuery(document).on('input', '.numeric', function() {
                if(this.value == '' || parseInt(this.value) == 0) {
                    jQuery(this).addClass('is-invalid');
                }
                else {
                    jQuery(this).removeClass('is-invalid');
                }
            });

            
        });
    </script>

    