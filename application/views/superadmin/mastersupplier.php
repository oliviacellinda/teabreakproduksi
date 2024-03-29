        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Master Data Supplier</h1>
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
                                <strong class="card-title">Tambah Supplier</strong>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nama" class=" form-control-label">Nama Supplier</label>
                                                <input type="text" id="nama" placeholder="Masukkan Nama Supplier" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="alamat" class=" form-control-label">Alamat Supplier</label>
                                                <input type="text" id="alamat" placeholder="Masukkan Alamat Supplier" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="telepon" class=" form-control-label">Telepon Supplier</label>
                                                <input type="text" id="telepon" placeholder="Masukkan Telepon Supplier" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-btn"><button onclick="tambahSupplier()" class="btn btn-success">Tambah Supplier</button></div>
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
                                <strong class="card-title">Data Supplier</strong>
                            </div>
                            <div class="card-body">
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Nama Supplier</td>
                                            <td>Alamat Supplier</td>
                                            <td>Telepon Supplier</td>
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
                                <label for="editNama" class=" form-control-label">Nama Supplier</label>
                                <input type="text" id="editNama" placeholder="Masukkan Nama Supplier" class="form-control">
                                <input type="hidden" name="kode" id="kode">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="editAlamat" class=" form-control-label">Alamat Supplier</label>
                                <input type="text" id="editAlamat" placeholder="Masukkan Alamat Supplier" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="editTelepon" class=" form-control-label">Telepon Supplier</label>
                                <input type="text" id="editTelepon" placeholder="Masukkan Telepon Supplier" class="form-control">
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

        function tambahSupplier() {
            var nama = jQuery('#nama').val().trim();
            var alamat = jQuery('#alamat').val().trim();
            var telepon = jQuery('#telepon').val().trim();

            if(nama.length > 0 && alamat.length > 0 && telepon.length > 0) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/tambahSupplier');?>',
                    data    : {
                        nama      : nama,
                        alamat    : alamat,
                        telepon   : telepon,
                    },
                    success : function(response) {
                        if(response == 'Data berhasil ditambahkan.') {
                            reloadTable();

                            jQuery('#nama').removeClass('is-invalid');
                            jQuery('#alamat').removeClass('is-invalid');
                            jQuery('#telepon').removeClass('is-invalid');

                            jQuery('#nama').val('');
                            jQuery('#alamat').val('');
                            jQuery('#telepon').val('');

                            jQuery('#nama').focus();

                            alert(response);
                        }
                        else if(response == 'Data gagal ditambahkan. Silakan mencoba kembali.') {
                            alert(response);
                        }
                    },
                    error   : function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
            else {
                if(nama.length <= 0) {
                    jQuery('#nama').addClass('is-invalid');
                }
                else {
                    jQuery('#nama').removeClass('is-invalid');
                }

                if(alamat.length <= 0) {
                    jQuery('#alamat').addClass('is-invalid');
                }
                else {
                    jQuery('#alamat').removeClass('is-invalid');
                }

                if(telepon.length <= 0) {
                    jQuery('#telepon').addClass('is-invalid');
                }
                else {
                    jQuery('#telepon').removeClass('is-invalid');
                }

                alert('Silakan periksa kembali data Anda.');
            }
        }

        function editSupplier(kode) {
            jQuery.ajax({
                type    : 'post',
                url     : '<?=base_url('superadmin/ambilSupplier');?>',
                dataType: 'json',
                data    : { kode : kode },
                success : function(data) {
                    jQuery('#editNama').val(data.nama_supplier);
                    jQuery('#kode').val(data.kode_supplier);
                    jQuery('#editAlamat').val(data.alamat_supplier);
                    jQuery('#editTelepon').val(data.telepon_supplier);
                    jQuery('#modalEdit').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function simpanEdit() {
            var kode = jQuery('#kode').val().trim();
            var nama = jQuery('#editNama').val().trim();
            var alamat = jQuery('#editAlamat').val().trim();
            var telepon = jQuery('#editTelepon').val().trim();

            if(nama.length > 0 && alamat.length > 0 && telepon.length > 0) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/editSupplier');?>',
                    data    : {
                        kode    : kode,
                        nama    : nama,
                        alamat  : alamat,
                        telepon : telepon
                    },
                    success : function(response) {
                        if(response == 'Data berhasil diubah.') {
                            reloadTable();

                            jQuery('#editNama').removeClass('is-invalid');
                            jQuery('#editAlamat').removeClass('is-invalid');
                            jQuery('#editTelepon').removeClass('is-invalid');

                            jQuery('#kode').val('');
                            jQuery('#editNama').val('');
                            jQuery('#editAlamat').val('');
                            jQuery('#editTelepon').val('');

                            jQuery('#modalEdit').modal('hide');

                            alert(response);
                        }
                        else if(response == 'Data gagal diubah. Silakan mencoba kembali.') {
                            alert(response);
                        }
                    },
                    error : function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
            else {
                if(nama.length <= 0) {
                    jQuery('#editNama').addClass('is-invalid');
                }
                else {
                    jQuery('#editNama').removeClass('is-invalid');
                }

                if(alamat.length <= 0) {
                    jQuery('#editAlamat').addClass('is-invalid');
                }
                else {
                    jQuery('#editAlamat').removeClass('is-invalid');
                }

                if(telepon.length <= 0) {
                    jQuery('#editTelepon').addClass('is-invalid');
                }
                else {
                    jQuery('#editTelepon').removeClass('is-invalid');
                }

                alert('Silakan periksa kembali data Anda.');
            }
        }

        function hapusSupplier(kode, nama) {
            if( confirm('Apakah Anda yakin ingin menghapus data ' + nama + '?') ) {
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/hapusSupplier');?>',
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
                    url     : '<?=base_url('superadmin/daftarSupplier');?>',
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            returnData.push({
                                'nama_supplier'     : datatable.data[i].nama_supplier,
                                'alamat_supplier'   : datatable.data[i].alamat_supplier,
                                'telepon_supplier'  : datatable.data[i].telepon_supplier,
                                'edit'              : '<button onclick=\"editSupplier(\''+datatable.data[i].kode_supplier+'\')\" class="btn btn-warning" style="color:white;">Edit</button>',
                                'hapus'             : '<button onclick=\"hapusSupplier(\''+datatable.data[i].kode_supplier+'\', \''+datatable.data[i].nama_supplier+'\')\" class="btn btn-danger" style="color:white;">Hapus</button>',
                            });
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data  : 'nama_supplier' },
                    { data  : 'alamat_supplier' },
                    { data  : 'telepon_supplier' },
                    { data  : 'edit', orderable : false, searchable : false },
                    { data  : 'hapus', orderable : false, searchable : false },
                ],
                dom : 'Bfrtlip',
                buttons : [
                    {
                        extend      : 'excelHtml5',
                        title       : 'Laporan Daftar Supplier',
                        messageTop  : 'Tanggal : ' + moment().format('D MMMM YYYY'),
                        text        : '<i class="fa fa-fw fa-download"></i> Download Excel',
                        filename    : 'Laporan Daftar Supplier - ' + moment().format('D MMMM YYYY'),
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

    