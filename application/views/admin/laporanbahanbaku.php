        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Laporan Bahan Baku</h1>
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
                                <strong class="card-title">List Bahan Baku</strong>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tanggal" class=" form-control-label">Tanggal</label>
                                            <input type="text" id="tanggal" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <table id="tabelData" class="table table-striped table-bordered" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Kode Bahan Baku</td>
                                            <td>Nama Bahan Baku</td>
                                            <td>Masuk</td>
                                            <td>Keluar</td>
                                            <td>Sisa</td>
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
    <script src=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/src/js/bootstrap-datetimepicker.js")?>></script>

    <script type="text/javascript">
        moment.locale('id');
        var tabel;
        var jumlahData;

        function reloadTable() {
            tabel.api().ajax.reload(null,false);
        }

        jQuery(document).ready(function($) {
            jQuery('#tanggal').datetimepicker({
                format      : 'D MMMM YYYY',
                locale      : 'id',
                defaultDate : moment(),
            });
            
            jQuery('#tanggal').on('dp.change', function() {
                tabel.api().ajax.reload(null,false);
            })

            tabel = jQuery('#tabelData').dataTable({
                processing  : true,
                responsive  : true,
                serverSide  : true,
                ajax : {
                    type    : 'POST',
                    url     : '<?=base_url('admin/laporanStokBahanBaku');?>',
                    data    : function(data) {
                        data.tanggal = moment(jQuery('#tanggal').val(), 'D MMMM YYYY').format('YYYY-MM-DD');
                    },
                    dataSrc : function(datatable) {
                        jumlahData = datatable.data.length;
                        var returnData = new Array();
                        for(var i=0; i<datatable.data.length; i++) {
                            returnData.push({
                                'kode_bahan_baku'   : datatable.data[i].kode_bahan_baku,
                                'nama_bahan_baku'   : datatable.data[i].nama_bahan_baku,
                                'masuk'             : datatable.data[i].masuk,
                                'keluar'            : datatable.data[i].keluar,
                                'sisa'              : datatable.data[i].sisa,
                            })
                        }
                        return returnData;
                    },
                },
                columns : [
                    { data : 'kode_bahan_baku' },
                    { data : 'nama_bahan_baku' },
                    { data : 'masuk' },
                    { data : 'keluar' },
                    { data : 'sisa' },
                ],
                dom : 'Bfrtlip',
                buttons : [
                    {
                        extend      : 'excelHtml5',
                        title       : 'Laporan Stok Bahan Baku',
                        messageTop  : 'Tanggal : ' + moment().format('D MMMM YYYY'),
                        text        : '<i class="fa fa-fw fa-download"></i> Download Excel',
                        filename    : 'Laporan Stok Bahan Baku - ' + moment().format('D MMMM YYYY'),
                        customize   : function ( xlsx ){
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
        
                            // jQuery selector to add a border
                            $('row c[r*="3"]', sheet).attr( 's', '27' );

                            for(var i=0; i<jumlahData; i++) {
                                var row = i+4;
                                $('row c[r*="'+row+'"]', sheet).attr( 's', '25' );
                            }
                        }
                    }
                ]
            }); // End DataTable

                        
        });
    </script>

    