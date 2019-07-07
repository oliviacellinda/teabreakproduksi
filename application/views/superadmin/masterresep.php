        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Master Data Resep</h1>
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
                                <strong class="card-title">Data Resep</strong>
                            </div>
                            <div class="card-body">
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Nama Resep</td>
                                            <td>Harga Jual</td>
                                            <td>Edit</td>
                                            <!-- <td>Delete</td> -->
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
                    <h4 class="modal-title">Edit Bahan Resep</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="d-none">
                        <span id="kodeBahanJadi"></span>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-btn"><button onclick="daftarBahanBaku()" class="btn btn-success">Tambah Bahan Baku</button></div>
                            </div> 
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <table id="tabelResep" class="table table-striped table-bordered text-center" style="width: 100%;" width="100%">
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

    <script type="text/javascript">
        moment.locale('id');
        var tabel;
        var jumlahData;
        var resep = new Array();

        function reloadTable() {
            tabel.api().ajax.reload(null,false);
        }

        function editResep(kode) {
            resep = new Array();
            jQuery('#kodeBahanJadi').text(kode);
            jQuery('#tabelResep tbody').remove();
            
            jQuery.ajax({
                type    : 'post',
                url     : '<?=base_url('superadmin/ambilResep');?>',
                dataType: 'json',
                data    : { kode : kode },
                success : function(data) {
                    if(data == '') {
                        var tabelResep = '<tbody>'+
                            '<tr>'+
                                '<td colspan="3" class="text-center">Tidak ada data.</td>'+
                            '</tr>'+
                        '<tbody>';
                        jQuery('#tabelResep').append(tabelResep);
                    }
                    else {
                        var tabelResep = '<tbody>';
                        for(var i=0; i<data.length; i++) {
                            tabelResep += '<tr data-kode="'+data[i].kode_bahan_baku+'">'+
                                '<td>'+data[i].nama_bahan_baku+'</td>'+
                                '<td><input type="text" class="form-control numeric" value="'+data[i].jumlah_bahan_baku+'" style="width: 130px"></td>'+
                                '<td><button onclick="hapusBahanBaku(\''+data[i].kode_bahan_baku+'\')" class="btn btn-danger" style="color:white;">Delete</button></td>'+
                            '</tr>';
                            var row = {
                                kode    : data[i].kode_bahan_baku,
                                nama    : data[i].nama_bahan_baku,
                                jumlah  : data[i].jumlah_bahan_baku,
                            };
                            resep.push(row);
                        }
                        tabelResep += '</tbody>';
                        jQuery('#tabelResep').append(tabelResep);
                    }
                    jQuery('#modalEdit').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
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
                        var cek = resep.find(arr => arr.kode === datatable.data[i].kode_bahan_baku);
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
            resep.push(row);

            jQuery(button).attr('disabled', true);
        }

        function refreshResep() {
            jQuery('#tabelResep tbody').remove();
            var tabelResep = '<tbody>';
            for(var i=0; i<resep.length; i++) {
                tabelResep += '<tr data-kode="'+resep[i].kode+'">'+
                    '<td>'+resep[i].nama+'</td>'+
                    '<td><input type="text" class="form-control numeric" value="'+resep[i].jumlah+'" style="width: 130px"></td>'+
                    '<td><button onclick="hapusBahanBaku(\''+resep[i].kode+'\')" class="btn btn-danger" style="color:white;">Delete</button></td>'+
                '</tr>';
            }
            tabelResep += '</tbody>';
            jQuery('#tabelResep').append(tabelResep);
        }

        function simpanEdit() {
            var flag = false;
            for(var i=0; i<resep.length; i++) {
                if(resep[i].jumlah == 0) {
                    flag = true;
                    break;
                }
            }

            if(resep.length == 0) {
                alert('Data tidak ada!');
            }
            else if(flag) {
                alert('Periksa kembali data Anda');
            }
            else {
                var resepString = JSON.stringify(resep);
                var kode = jQuery('#kodeBahanJadi').text();
                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('superadmin/editResep');?>',
                    data    : { 
                        kode        : kode,
                        resepString : resepString 
                    },
                    success : function(data) {
                        if(data == 'Data tidak ada!') {
                            alert(data);
                        }
                        else if(data == 'Kode bahan jadi tidak ditemukan') {
                            alert(data);
                        }
                        else if(data == 'Data berhasil disimpan') {
                            jQuery('#modalEdit').modal('hide');
                            reloadTable();
                            alert(data);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        }

        function hapusBahanBaku(kode) {
            var index;
            for(var i=0; i<resep.length; i++) {
                if(resep[i].kode == kode) index = i;
            }
            resep.splice(index, 1);
            refreshResep();
        }

        jQuery(document).ready(function($) {
            tabel = jQuery('#tabelData').dataTable({
                oLanguage : { sProcessing : "Loading..." },
                responsive : true,
                serverSide : true,
                ajax : {
                    type    : 'POST',
                    url     : '<?=base_url('superadmin/daftarResep');?>',
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            returnData.push({
                                'nama_bahan_jadi'   : datatable.data[i].nama_bahan_jadi,
                                'harga_jual'        : datatable.data[i].harga_jual,
                                'edit'              : '<button onclick=\"editResep(\''+datatable.data[i].kode_bahan_jadi+'\')\" class="btn btn-warning" style="color:white;">Edit</button>',
                                // 'hapus'             : '<button onclick=\"hapusResep(\''+datatable.data[i].kode_bahan_jadi+'\')\" class="btn btn-danger" style="color:white;">Hapus</button>',
                            });
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data  : 'nama_bahan_jadi' },
                    { data  : 'harga_jual' },
                    { data  : 'edit', orderable : false, searchable : false },
                    // { data  : 'hapus', orderable : false, searchable : false },
                ],
                columnDefs : [
                    { targets : 1, render : $.fn.dataTable.render.number('.', ',', 2, 'Rp ') },
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
                refreshResep();
                jQuery('#modalEdit').modal('show');
            });

            jQuery(document).on('input', 'input', function() {
                if(this.value == '' || parseInt(this.value) == 0) {
                    jQuery(this).addClass('is-invalid');
                }
                else {
                    jQuery(this).removeClass('is-invalid');
                }

                var jumlah = (this.value == '') ? 0 : parseInt(this.value);
                var kode = jQuery(this).closest('tr').data('kode');
                var index;
                for(var i=0; i<resep.length; i++) {
                    if(resep[i].kode == kode) index = i;
                }
                resep[index].jumlah = jumlah;
            });

            
        });
    </script>

    