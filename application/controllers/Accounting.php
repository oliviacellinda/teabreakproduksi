<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('produk');
    }

    public function dashboard() {
        $status = $this->session->userdata('status');
        if($status != 'accounting') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('accounting/navigationbar');
            $this->load->view('accounting/dashboard');
        }
    }

    public function notapembelian() {
        $status = $this->session->userdata('status');
        if($status != 'accounting') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('accounting/navigationbar');
            $this->load->view('accounting/notapembelian');
        }
    }

    public function daftarNotaPembelian() {
        $this->load->library('datatables');
        $this->datatables->select('no_surat_jalan, no_nota, tanggal_nota');
        $this->datatables->from('laporan_pembelian_bahan_baku');
        echo $this->datatables->generate();
    }

    public function ambilNotaPembelian() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $nomor = $this->input->post('nomor');
        $select = 'laporan_pembelian_bahan_baku.*, detail_pembelian_bahan_baku.*';
        $on = 'laporan_pembelian_bahan_baku.no_surat_jalan = detail_pembelian_bahan_baku.no_surat_jalan';
        $where = array('laporan_pembelian_bahan_baku.no_surat_jalan' => $nomor);
        $data = $this->produk->getAllDataJoinWhere($select, 'laporan_pembelian_bahan_baku', 'detail_pembelian_bahan_baku', $on, $where);
        echo json_encode($data);
    }

    public function editNotaPembelian() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $noNota = trim($this->input->post('noNota'));
        $noLama = trim($this->input->post('nomorLama'));
        $tglNota = trim($this->input->post('tglNota'));
        $noSurat = trim($this->input->post('noSurat'));
        $daftar = json_decode($this->input->post('daftar'));
        
        if($daftar == '' || count($daftar) == 0) {
            echo 'Data tidak ada!';
            die();
        }

        $where = array('no_nota' => $noNota);
        if( $noNota != $noLama && $this->produk->countAllDataWhere('laporan_pembelian_bahan_baku', $where) > 0 ) {
            echo 'Nomor nota sudah ada di dalam database';
            die();
        }

        // $where = array('no_surat_jalan' => $noSurat);
        // $laporan = $this->produk->getAllDataWhere('laporan_pembelian_bahan_baku', $where);
        // if( strtotime($laporan[0]->tanggal_surat_jalan) > strtotime($tglNota) ) {
        //     echo 'Tanggal nota tidak dapat dipasang sebelum tanggal surat jalan';
        //     die();
        // }
        
        for($i=0; $i<count($daftar); $i++) {
            $where = array(
                'no_surat_jalan'    => $noSurat,
                'kode_bahan_baku'   => $daftar[$i]->kode,
            );
            $data = array('harga_beli' => $daftar[$i]->harga);
            $this->produk->updateData('detail_pembelian_bahan_baku', $where, $data);
        }

        $where = array('no_surat_jalan' => $noSurat);
        $laporan = $this->produk->getAllDataWhere('detail_pembelian_bahan_baku', $where);
        $total = 0;
        for($i=0; $i<count($laporan); $i++) {
            $jumlah = $laporan[$i]->jumlah;
            $harga = $laporan[$i]->harga_beli;
            $total += ($jumlah * $harga);
            $where = array(
                'no_surat_jalan'    => $laporan[$i]->no_surat_jalan,
                'kode_bahan_baku'   => $laporan[$i]->kode_bahan_baku,
            );
            $data = array('total_harga' => $jumlah * $harga);
            $this->produk->updateData('detail_pembelian_bahan_baku', $where, $data);
        }

        $where = array('no_surat_jalan' => $noSurat);
        $data = array(
            'no_nota'           => $noNota,
            'tanggal_nota'      => $tglNota,
            'total_pembelian'   => $total
        );
        $this->produk->updateData('laporan_pembelian_bahan_baku', $where, $data);

        echo 'Data berhasil disimpan';
    }
}