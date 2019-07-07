<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('produk');
    }

    public function test() {
        echo date('Y-m-d', strtotime('-1 days'));
    }

    public function dashboard() {
        $status = $this->session->userdata('status');
        if($status != 'admin') {
            redirect(base_url('login'));
        }
        else {
            // Auto insert data stok baru di tanggal baru
            $where = array('tanggal_laporan' => date('Y-m-d'));
            $countToday = $this->produk->countAllDataWhere('laporan_stok_bahan_baku', $where);
            if($countToday == 0) {
                $daftarBahanBaku = $this->produk->getAllData('bahan_baku');
                $daftarBahanJadi = $this->produk->getAllData('bahan_jadi');

                if(count($daftarBahanBaku) != 0) {
                    for($i=0; $i<count($daftarBahanBaku); $i++) {
                        $where = array('kode_bahan_baku' => $daftarBahanBaku[$i]->kode_bahan_baku);
                        $lastDate = $this->produk->selectDataWhere('laporan_stok_bahan_baku', 'MAX(tanggal_laporan) AS tanggal_laporan', $where);
                        
                        if($lastDate[0]->tanggal_laporan == '') {
                            $today = array(
                                'tanggal_laporan'   => date('Y-m-d'),
                                'kode_bahan_baku'   => $daftarBahanBaku[$i]->kode_bahan_baku,
                                'nama_bahan_baku'   => $daftarBahanBaku[$i]->nama_bahan_baku,
                                'masuk'             => 0,
                                'keluar'            => 0,
                                'sisa'              => 0
                            );
                            $this->produk->insertData('laporan_stok_bahan_baku', $today);
                        }
                        else {
                            $where = array(
                                'tanggal_laporan' => $lastDate[0]->tanggal_laporan,
                                'kode_bahan_baku' => $daftarBahanBaku[$i]->kode_bahan_baku
                            );
                            $stokLastDate = $this->produk->getAllDataWhere('laporan_stok_bahan_baku', $where);
                            $today = array(
                                'tanggal_laporan'   => date('Y-m-d'),
                                'kode_bahan_baku'   => $daftarBahanBaku[$i]->kode_bahan_baku,
                                'nama_bahan_baku'   => $daftarBahanBaku[$i]->nama_bahan_baku,
                                'masuk'             => 0,
                                'keluar'            => 0,
                                'sisa'              => $stokLastDate[0]->sisa
                            );
                            $this->produk->insertData('laporan_stok_bahan_baku', $today);
                        }
                    }
                }

                if(count($daftarBahanJadi) != 0) {
                    for($i=0; $i<count($daftarBahanJadi); $i++) {
                        $where = array('kode_bahan_jadi' => $daftarBahanJadi[$i]->kode_bahan_jadi);
                        $lastDate = $this->produk->selectDataWhere('laporan_stok_bahan_jadi', 'MAX(tanggal_laporan) AS tanggal_laporan', $where);
                        
                        if($lastDate[0]->tanggal_laporan == '') {
                            $today = array(
                                'tanggal_laporan'   => date('Y-m-d'),
                                'kode_bahan_jadi'   => $daftarBahanJadi[$i]->kode_bahan_jadi,
                                'nama_bahan_jadi'   => $daftarBahanJadi[$i]->nama_bahan_jadi,
                                'masuk'             => 0,
                                'keluar'            => 0,
                                'sisa'              => 0
                            );
                            $this->produk->insertData('laporan_stok_bahan_jadi', $today);
                        }
                        else {
                            $where = array(
                                'tanggal_laporan' => $lastDate[0]->tanggal_laporan,
                                'kode_bahan_jadi' => $daftarBahanJadi[$i]->kode_bahan_jadi
                            );
                            $stokLastDate = $this->produk->getAllDataWhere('laporan_stok_bahan_jadi', $where);
                            $today = array(
                                'tanggal_laporan'   => date('Y-m-d'),
                                'kode_bahan_jadi'   => $daftarBahanJadi[$i]->kode_bahan_jadi,
                                'nama_bahan_jadi'   => $daftarBahanJadi[$i]->nama_bahan_jadi,
                                'masuk'             => 0,
                                'keluar'            => 0,
                                'sisa'              => $stokLastDate[0]->sisa
                            );
                            $this->produk->insertData('laporan_stok_bahan_jadi', $today);
                        }
                    }
                }
            }

            // Ubah flag edit admin jika sudah melewati tanggal hari ini
            $where = array('tanggal_surat_jalan <' => 'CURRENT_DATE()');
            $laporanPembelian = $this->produk->getAllDataWhere('laporan_pembelian_bahan_baku', $where, false);
            $laporanPenjualan = $this->produk->getAllDataWhere('laporan_penjualan_bahan_jadi', $where, false);
            if(count($laporanPembelian) != 0) {
                for($i=0; $i<count($laporanPembelian); $i++) {
                    $data = array('flag_edit_admin' => 0);
                    $where = array('no_surat_jalan' => $laporanPembelian[$i]->no_surat_jalan);
                    $this->produk->updateData('laporan_pembelian_bahan_baku', $where, $data);
                }
            }
            if(count($laporanPenjualan) != 0) {
                for($i=0; $i<count($laporanPenjualan); $i++) {
                    $data = array('flag_edit_admin' => 0);
                    $where = array('no_surat_jalan' => $laporanPenjualan[$i]->no_surat_jalan);
                    $this->produk->updateData('laporan_penjualan_bahan_jadi', $where, $data);
                }
            }

            $this->load->view('admin/navigationbar');
            $this->load->view('admin/dashboard');
        }
    }


    // BAHAN BAKU MASUK

    public function bahanBakuMasuk() {
        $status = $this->session->userdata('status');
        if($status != 'admin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('admin/navigationbar');
            $this->load->view('admin/bahanbakumasuk');
        }
    }

    public function daftarBahanBakuMasuk() {
        $this->load->library('datatables');
        $this->datatables->select('no_surat_jalan, tanggal_surat_jalan, flag_edit_admin');
        $this->datatables->from('laporan_pembelian_bahan_baku');
        echo $this->datatables->generate();
    }

    public function ambilBahanBakuMasuk() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $nomor = $this->input->post('nomor');
        $select = 'laporan_pembelian_bahan_baku.no_surat_jalan, laporan_pembelian_bahan_baku.tanggal_surat_jalan, detail_pembelian_bahan_baku.*';
        $on = 'laporan_pembelian_bahan_baku.no_surat_jalan = detail_pembelian_bahan_baku.no_surat_jalan';
        $where = array('laporan_pembelian_bahan_baku.no_surat_jalan' => $nomor);
        $data = $this->produk->getAllDataJoinWhere($select, 'laporan_pembelian_bahan_baku', 'detail_pembelian_bahan_baku', $on, $where);
        echo json_encode($data);
    }

    public function simpanBahanBakuMasuk() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }
        
        $nomor = trim($this->input->post('nomor'));
        $daftarBahan = json_decode($this->input->post('daftarString'));
        $jenisAksi = trim($this->input->post('jenisAksi'));
        
        if($daftarBahan == '' || count($daftarBahan) == 0) {
            echo 'Data tidak ada!';
            die();
        }

        if($jenisAksi == 'tambah') {
            $where = array('no_surat_jalan' => $nomor);
            if( $this->produk->countAllDataWhere('laporan_pembelian_bahan_baku', $where) > 0 ) {
                echo 'Nomor sudah ada di dalam database';
                die();
            }

            $data = array(
                'no_surat_jalan'        => $nomor,
                'tanggal_surat_jalan'   => date('Y-m-d'),
                'flag_edit_admin'       => 1
            );
            $this->produk->insertData('laporan_pembelian_bahan_baku', $data);

            for($i=0; $i<count($daftarBahan); $i++) {
                $detail = array(
                    'no_surat_jalan'    => $nomor,
                    'kode_bahan_baku'   => $daftarBahan[$i]->kode,
                    'nama_bahan_baku'   => $daftarBahan[$i]->nama,
                    'jumlah'            => $daftarBahan[$i]->jumlah,
                );
                $this->produk->insertData('detail_pembelian_bahan_baku', $detail);

                $where = array(
                    'tanggal_laporan'   => date('Y-m-d'),
                    'kode_bahan_baku'   => $daftarBahan[$i]->kode,
                );
                $stok = array(
                    'masuk' => 'masuk + ' . $daftarBahan[$i]->jumlah,
                    'sisa'  => 'sisa + ' . $daftarBahan[$i]->jumlah,
                );
                $this->produk->updateData('laporan_stok_bahan_baku', $where, $stok, false);
            }

            echo 'Data berhasil disimpan';
        }
        elseif($jenisAksi == 'edit') {
            $where = array('no_surat_jalan' => $nomor);
            $this->produk->deleteData('detail_pembelian_bahan_baku', $where);

            for($i=0; $i<count($daftarBahan); $i++) {
                $detail = array(
                    'no_surat_jalan'    => $nomor,
                    'kode_bahan_baku'   => $daftarBahan[$i]->kode,
                    'nama_bahan_baku'   => $daftarBahan[$i]->nama,
                    'jumlah'            => $daftarBahan[$i]->jumlah,
                );
                $this->produk->insertData('detail_pembelian_bahan_baku', $detail);

                $where = array(
                    'tanggal_laporan'   => date('Y-m-d'),
                    'kode_bahan_baku'   => $daftarBahan[$i]->kode,
                );
                $stokToday = $this->produk->getAllDataWhere('laporan_stok_bahan_baku', $where);
                $stok = array(
                    'masuk' => 'masuk + ' . ($daftarBahan[$i]->jumlah - $stokToday[0]->masuk),
                    'sisa'  => 'sisa + ' . ($daftarBahan[$i]->jumlah - $stokToday[0]->sisa),
                );
                $this->produk->updateData('laporan_stok_bahan_baku', $where, $stok, false);
            }

            echo 'Data berhasil disimpan';          
        }
        else {
            echo 'Aksi tidak dikenali';
        }        
    }

    public function hapusBahanBakuMasuk() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $nomor = trim($this->input->post('nomor'));

        $where = array('no_surat_jalan' => $nomor);
        $detailLaporan = $this->produk->getAllDataWhere('detail_pembelian_bahan_baku', $where);
        for($i=0; $i<count($detailLaporan); $i++) {
            
        }

        $this->produk->deleteData('laporan_pembelian_bahan_baku', $where);
    }


    // SISTEM PRODUKSI

    public function sistemproduksi() {
        $status = $this->session->userdata('status');
        if($status != 'admin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('admin/navigationbar');
            $this->load->view('admin/sistemproduksi');
        }
    }

    public function daftarproduksi() {
        $this->load->library('datatable');
        $this->datatable->select('kode_produksi, tanggal_produksi');
        $this->datatable->from('produksi');
        echo $this->datatables->generate();
    }

    public function ambilProduksi() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = trim($this->input->post('kode'));

        $where = array('kode_produksi' => $kode);
        $data['produksi'] = $this->produk->getAllDataWhere('produksi', $where);

        if($data['produksi'] != '') {
            $where = array('kode_bahan_jadi' => $data['produksi'][0]['kode_bahan_jadi']);
            $data['resep'] = $this->produk->getRecipe($where);
        }

        echo json_encode($data);
    }
}