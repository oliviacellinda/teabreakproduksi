<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('produk');
    }

    public function dashboard() {
        $status = $this->session->userdata('status');
        if($status != 'admin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('admin/navigationbar');
            $this->load->view('admin/dashboard');
        }
    }

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
        $this->datatables->select('no_surat_jalan, tanggal_surat_jalan');
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

        if($jenisAksi == 'tambah') {
            $where = array('no_surat_jalan' => $nomor);
            if( $this->produk->countAllDataWhere('laporan_pembelian_bahan_baku', $where) > 0 ) {
                echo 'Nomor sudah ada di dalam database.';
                die();
            }

            $data = array(
                'no_surat_jalan'        => $nomor,
                'tanggal_surat_jalan'   => date('Y-m-d H:i:s'),
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
        $this->produk->deleteData('laporan_pembelian_bahan_baku', $where);
    }
}