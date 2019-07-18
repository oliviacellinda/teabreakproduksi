        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Nota dan Laporan Pembelian</h1>
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
                                <strong class="card-title">Data Nota Pembelian</strong>
                            </div>
                            <div class="card-body">
                          
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Nomor Surat Jalan</td>
                                            <td>Nomor Nota</td>
                                            <td>Tanggal Nota</td>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="header modal-header">
                    <h4 class="modal-title">Edit Nota Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nomor" class=" form-control-label">Nomor Nota</label>
                                    <input type="text" id="nomor" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nomor" class=" form-control-label">Tanggal Nota</label>
                                    <input type="text" id="tanggal" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p>Nomor Surat Jalan : <span id="noSurat"></span></p>
                            <p>Tanggal Surat Jalan : <span id="tglSurat"></span></p>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <table id="tabelDetailNotaPembelian" class="table table-striped table-bordered text-center" style="width: 100%;" width="100%">
                                <thead>
                                    <tr>
                                        <td width="40%">Nama Bahan Baku</td>
                                        <td width="20%">Jumlah (kg)</td>
                                        <td width="20%">Harga</td>
                                        <td width="20%">Total Harga</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-4 offset-sm-8">
                            <p><strong>Total : <span id="totalNota"></span></strong></p>
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
    <script src=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js")?>></script>
    <script src=<?php echo base_url("assets/js/teabreak.js")?>></script>
    <script src=<?php echo base_url("assets/js/datetime-moment.js")?>></script>
    <script src=<?php echo base_url("assets/js/datetime.js")?>></script>

    <script type="text/javascript">
        moment.locale('id');
        var tabel;
        var jumlahData;
        var daftar;
        var nomorLama;

        function reloadTable() {
            tabel.api().ajax.reload(null,false);
        }

        function editNotaPembelian(nomor) {
            daftar = new Array();
            jQuery('#noSurat').text(nomor);
            jQuery('#tabelDetailNotaPembelian tbody').remove();
            
            jQuery.ajax({
                type    : 'post',
                url     : '<?=base_url('accounting/ambilNotaPembelian');?>',
                dataType: 'json',
                data    : { nomor : nomor },
                success : function(data) {
                    if(data == '') {
                        var tabelDetailNotaPembelian = '<tbody>'+
                            '<tr>'+
                                '<td colspan="4" class="text-center">Tidak ada data.</td>'+
                            '</tr>'+
                        '<tbody>';
                        jQuery('#tabelDetailNotaPembelian').append(tabelDetailNotaPembelian);
                    }
                    else {
                        nomorLama = data[0].no_nota;
                        var tglSurat = moment(data[0].tanggal_surat_jalan).format('D MMMM YYYY');
                        var tglNota = (data[0].tanggal_nota != '0000-00-00') ? moment(data[0].tanggal_nota).format('D MMMM YYYY') : moment().format('D MMMM YYYY');
                        jQuery('#tglSurat').text(tglSurat);
                        jQuery('#nomor').val(data[0].no_nota);
                        jQuery('#tanggal').val(tglNota);
                        jQuery('#totalNota').text('Rp '+parseInt(data[0].total_pembelian).toLocaleString('id')+',00');
                        
                        var tabelDetailNotaPembelian = '<tbody>';
                        for(var i=0; i<data.length; i++) {
                            tabelDetailNotaPembelian += '<tr data-kode="'+data[i].kode_bahan_baku+'">'+
                                '<td>'+data[i].nama_bahan_baku+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td><input type="text" class="form-control numeric" value="'+data[i].harga_beli+'"></td>'+
                                '<td id="totalHarga">Rp '+parseInt(data[i].total_harga).toLocaleString('id')+',00</td>'+
                            '</tr>';
                            var row = {
                                kode    : data[i].kode_bahan_baku,
                                jumlah  : data[i].jumlah,
                                harga   : data[i].harga_beli,
                                total   : data[i].total_harga,
                            };
                            daftar.push(row);
                        }
                        tabelDetailNotaPembelian += '</tbody>';
                        jQuery('#tabelDetailNotaPembelian').append(tabelDetailNotaPembelian);
                    }
                    jQuery('#modalEdit').modal('show');
                },
                error   : function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function simpanEdit() {
            jQuery('.is-invalid').removeClass('is-invalid');

            var flag = false;
            if(jQuery('#nomor').val().trim() == '') {
                jQuery('#nomor').addClass('is-invalid');
                flag = true;
            }
            if(jQuery('#tanggal').val().trim() == '') {
                jQuery('#tanggal').addClass('is-invalid');
                flag = true;
            }
            for(var i=0; i<daftar.length; i++) {
                if(daftar[i].harga == 0) {
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
                var tanggal = jQuery('#tanggal').val().trim().toString();
                var noNota = jQuery('#nomor').val().trim();
                var tglNota = moment(tanggal, 'D MMMM YYYY').format('YYYY-MM-DD');
                var noSurat = jQuery('#noSurat').text().trim();
                var daftarString = JSON.stringify(daftar);

                jQuery.ajax({
                    type    : 'post',
                    url     : '<?=base_url('accounting/editNotaPembelian');?>',
                    data    : {
                        noNota      : noNota,
                        tglNota     : tglNota,
                        noSurat     : noSurat,
                        daftar      : daftarString,
                        nomorLama   : nomorLama
                    },
                    success : function(data) {
                        if(data == 'Data berhasil disimpan') {
                            jQuery('#modalEdit').modal('hide');
                            reloadTable();
                            alert(data);
                        }
                        else if(data == 'Data tidak ada!') {
                            alert(data);
                        }
                        else if(data == 'Nomor nota sudah ada di dalam database') {
                            alert(data);
                            jQuery('#nomor').addClass('is-invalid');
                        }
                        else if(data == 'Tanggal nota tidak dapat dipasang sebelum tanggal surat jalan') {
                            alert(data);
                            jQuery('#tanggal').addClass('is-invalid');
                        }
                        else {
                            alert('Unknown error occured!'); console.log(data);
                        }
                    },
                    error   : function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        }

        jQuery(document).ready(function($) {
            $('#tanggal').datetimepicker({
                format  : 'D MMMM YYYY',
                locale  : 'id'
            });

            $.fn.dataTable.moment('D MMMM YYYY HH:mm', 'id');
            tabel = jQuery('#tabelData').dataTable({
                oLanguage : { sProcessing : "Loading..." },
                responsive : true,
                serverSide : true,
                ajax : {
                    type    : 'POST',
                    url     : '<?=base_url('accounting/daftarNotaPembelian');?>',
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            returnData.push({
                                'no_surat_jalan': datatable.data[i].no_surat_jalan,
                                'no_nota'       : datatable.data[i].no_nota,
                                'tanggal_nota'  : datatable.data[i].tanggal_nota,
                                'edit'          : '<button onclick=\"editNotaPembelian(\''+datatable.data[i].no_surat_jalan+'\')\" class="btn btn-warning" style="color:white;">Edit</button>',
                                'hapus'         : '<button onclick=\"hapusNotaPembelian(\''+datatable.data[i].no_surat_jalan+'\')\" class="btn btn-danger" style="color:white;">Hapus</button>',
                            });
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data  : 'no_surat_jalan' },
                    { data  : 'no_nota' },
                    { data  : 'tanggal_nota' },
                    { data  : 'edit', orderable : false, searchable : false },
                    { data  : 'hapus', orderable : false, searchable : false },
                ],
                columnDefs : [
                    { targets : 2, render : $.fn.dataTable.render.moment('YYYY-MM-DD', 'D MMMM YYYY', 'id') },
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

                var harga = (this.value == '') ? 0 : parseInt(this.value);
                var kode = jQuery(this).closest('tr').data('kode');
                var index;
                for(var i=0; i<daftar.length; i++) {
                    if(daftar[i].kode == kode) index = i;
                }
                daftar[index].harga = harga;
                daftar[index].total = daftar[index].jumlah * daftar[index].harga;
                $(this).closest('tr').find('#totalHarga').text('Rp '+daftar[index].total.toLocaleString('id')+',00')

                var total = 0;
                for(var i=0; i<daftar.length; i++) {
                    total += daftar[i].total;
                }
                $('#totalNota').text('Rp '+total.toLocaleString('id')+',00');
            });
        });
    </script>

    