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
}