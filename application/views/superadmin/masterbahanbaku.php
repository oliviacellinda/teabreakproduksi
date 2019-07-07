        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Master Data Bahan Baku</h1>
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
                                <strong class="card-title">Tambah Bahan Baku</strong>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="kode" class=" form-control-label">Kode Bahan Baku</label>
                                                <input type="text" id="kode" placeholder="Masukkan Kode Barang" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nama" class=" form-control-label">Nama Bahan Baku</label>
                                                <input type="text" id="nama" placeholder="Masukkan Nama Barang" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="harga" class=" form-control-label">Harga Beli Bahan Baku</label>
                                                <input type="text" id="harga" placeholder="Masukkan Harga Beli" class="form-control numeric">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-btn"><button onclick="tambahBahanBaku()" class="btn btn-success">Tambah Bahan Baku</button></div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-12 -->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Bahan Baku</strong>
                            </div>
                            <div class="card-body">
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Kode Bahan Baku</td>
                                            <td>Nama Bahan Baku</td>
                                            <td>Harga Beli</td>
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
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="editKode" class=" form-control-label">Kode Bahan Baku</label>
                                <input type="text" id="editKode" placeholder="Masukkan Kode Barang" class="form-control">
                                <input type="hidden" name="kodeLama" id="kodeLama">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="editNama" class=" form-control-label">Nama Bahan Baku</label>
                                <input type="text" id="editNama" placeholder="Masukkan Nama Barang" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="editHarga" class=" form-control-label">Harga Beli Bahan Baku</label>
                                <input type="text" id="editHarga" placeholder="Masukkan Harga Beli" class="form-control numeric">
                            </div>
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

    <script type="text/javascript">
        moment.locale('id');
        var tabel;
        var jumlahData;

        function reloadTable() {
            tabel.api().ajax.reload(null,false);
        }

        function tambahBahanBaku() {
            var kode = jQuery('#kode').val().trim();
            var nama = jQuery('#nama').val().trim();
            var harga = jQuery('#harga').val().trim();

            if(kode.length > 0 && nama.length > 0 && harga.length > 0) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/tambahBahanBaku');?>',
                    data    : {
                        kode    : kode,
                        nama    : nama,
                        harga   : harga,
                    },
                    success : function(response) {
                        if(response == 'Data berhasil ditambahkan') {
                            reloadTable();

                            jQuery('#kode').removeClass('is-invalid');
                            jQuery('#nama').removeClass('is-invalid');
                            jQuery('#harga').removeClass('is-invalid');

                            jQuery('#kode').val('');
                            jQuery('#nama').val('');
                            jQuery('#harga').val('');

                            jQuery('#kode').focus();

                            alert(response);
                        }
                        else if(response == 'Kode sudah ada di dalam database') {
                            jQuery('#kode').addClass('is-invalid');
                            alert(response);
                        }
                        else if(response == 'Data gagal ditambahkan') {
                            alert(response);
                        }
                    },
                    error   : function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
            else {
                if(kode.length <= 0) {
                    jQuery('#kode').addClass('is-invalid');
                }
                else {
                    jQuery('#kode').removeClass('is-invalid');
                }

                if(nama.length <= 0) {
                    jQuery('#nama').addClass('is-invalid');
                }
                else {
                    jQuery('#nama').removeClass('is-invalid');
                }

                if(harga.length <= 0) {
                    jQuery('#harga').addClass('is-invalid');
                }
                else {
                    jQuery('#harga').removeClass('is-invalid');
                }

                alert('Silakan periksa kembali data Anda.');
            }
        }

        function editBahanBaku(kode) {
            jQuery.ajax({
                type    : 'post',
                url     : '<?=base_url('superadmin/ambilBahanBaku');?>',
                dataType: 'json',
                data    : { kode : kode },
                success : function(data) {
                    jQuery('#editKode').val(data.kode_bahan_baku);
                    jQuery('#kodeLama').val(data.kode_bahan_baku);
                    jQuery('#editNama').val(data.nama_bahan_baku);
                    jQuery('#editHarga').val(data.harga_beli);
                    jQuery('#modalEdit').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function simpanEdit() {
            var kode = jQuery('#editKode').val().trim();
            var kodeLama = jQuery('#kodeLama').val().trim();
            var nama = jQuery('#editNama').val().trim();
            var harga = jQuery('#editHarga').val().trim();

            if(kode.length > 0 && nama.length > 0 && harga.length > 0) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/editBahanBaku');?>',
                    data    : {
                        kode    : kode,
                        kodeLama: kodeLama,
                        nama    : nama,
                        harga   : harga,
                    },
                    success : function(response) {
                        if(response == 'Data berhasil diubah') {
                            reloadTable();

                            jQuery('#editKode').removeClass('is-invalid');
                            jQuery('#editNama').removeClass('is-invalid');
                            jQuery('#editHarga').removeClass('is-invalid');

                            jQuery('#kodeLama').val('');
                            jQuery('#editKode').val('');
                            jQuery('#editNama').val('');
                            jQuery('#editHarga').val('');

                            jQuery('#modalEdit').modal('hide');

                            alert(response);
                        }
                        else if(response == 'Kode sudah ada di dalam database') {
                            jQuery('#editKode').addClass('is-invalid');
                            alert(response);
                        }
                        else if(response == 'Data gagal diubah') {
                            alert(response);
                        }
                    },
                    error : function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
            else {
                if(kode.length <= 0) {
                    jQuery('#editKode').addClass('is-invalid');
                }
                else {
                    jQuery('#editKode').removeClass('is-invalid');
                }

                if(nama.length <= 0) {
                    jQuery('#editNama').addClass('is-invalid');
                }
                else {
                    jQuery('#editNama').removeClass('is-invalid');
                }

                if(harga.length <= 0) {
                    jQuery('#editHarga').addClass('is-invalid');
                }
                else {
                    jQuery('#editHarga').removeClass('is-invalid');
                }

                alert('Silakan periksa kembali data Anda.');
            }
        }

        function hapusBahanBaku(kode) {
            if( confirm('Apakah Anda yakin ingin menghapus data ' + kode + '?') ) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/hapusBahanBaku');?>',
                    data    : { kode : kode },
                    success : function() {
                        reloadTable();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        }

        jQuery(document).ready(function($) {
            tabel = jQuery('#tabelData').dataTable({
                oLanguage : { sProcessing : "Loading..." },
                responsive : true,
                serverSide : true,
                ajax : {
                    type    : 'POST',
                    url     : '<?=base_url('superadmin/daftarBahanBaku');?>',
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            returnData.push({
                                'kode_bahan_baku'   : datatable.data[i].kode_bahan_baku,
                                'nama_bahan_baku'   : datatable.data[i].nama_bahan_baku,
                                'harga_beli'        : datatable.data[i].harga_beli,
                                'edit'              : '<button onclick=\"editBahanBaku(\''+datatable.data[i].kode_bahan_baku+'\')\" class="btn btn-warning" style="color:white;">Edit</button>',
                                'hapus'             : '<button onclick=\"hapusBahanBaku(\''+datatable.data[i].kode_bahan_baku+'\')\" class="btn btn-danger" style="color:white;">Hapus</button>',
                            });
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data  : 'kode_bahan_baku' },
                    { data  : 'nama_bahan_baku' },
                    { data  : 'harga_beli' },
                    { data  : 'edit', orderable : false, searchable : false },
                    { data  : 'hapus', orderable : false, searchable : false },
                ],
                columnDefs : [
                    { targets : 2, render : $.fn.dataTable.render.number('.', ',', 2, 'Rp ') },
                ],
                dom : 'Bfrtlip',
                buttons : [
                    {
                        extend      : 'excelHtml5',
                        title       : 'Laporan Daftar Bahan Baku',
                        messageTop  : 'Tanggal : ' + moment().format('D MMMM YYYY'),
                        text        : '<i class="fa fa-fw fa-download"></i> Download Excel',
                        filename    : 'Laporan Daftar Bahan Baku - ' + moment().format('D MMMM YYYY'),
                        customize   : function ( xlsx ){
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
        
                            // jQuery selector to add a border
                            $('row c[r*="3"]', sheet).attr( 's', '27' );

                            for(var i=0; i<jumlahData; i++) {
                                var row = i+4;
                                $('row c[r*="'+row+'"]', sheet).attr( 's', '25' );
                            }
                        },
                        exportOptions: {
                            columns : [ 0, 1, 2 ]
                        },
                    }
                ]
            }); // End DataTable
        });
    </script>

    