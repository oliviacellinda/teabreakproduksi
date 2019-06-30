<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('produk');
    }

    public function login() {
        $username = $this->session->userdata('username');
        if(empty($username)) {
            $this->load->view('login');
        }
        else {
            $status = $this->session->userdata('status');
            if($status == 'superadmin') {
                redirect(base_url('dashboardsuperadmin'));
            }
            elseif($status == 'admin') {
                redirect(base_url('dashboardadmin'));
            }
            elseif($status == 'accounting') {
                redirect(base_url('dashboardaccounting'));
            }
        }
    }

    public function prosesLogin() {
        $username = trim($this->input->post('username'));
        $password = md5($this->input->post('password'));

        $where = array(
            'username_karyawan' => $username,
            'password_karyawan' => $password
        );

        $data = $this->produk->getAllDataWhere('karyawan', $where);

        if($this->produk->countAllDataWhere('karyawan', $where) > 0) {
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('nama', $data[0]->nama_karyawan);

            if($data[0]->status_karyawan == 'superadmin') {
                $this->session->set_userdata('status', 'superadmin');
            }
            elseif($data[0]->status_karyawan == 'admin') {
                $this->session->set_userdata('status', 'admin');
            }
            elseif($data[0]->status_karyawan == 'accounting') {
                $this->session->set_userdata('status', 'accounting');
            }

            echo 'true';
        }
        else {
            echo 'false';
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('status');
        redirect(base_url('login'));
    }

    public function dashboard() {
        $status = $this->session->userdata('status');
        if($status != 'superadmin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('superadmin/navigationbar');
            $this->load->view('superadmin/dashboard');
        }
    }

    public function masterBahanBaku() {
        $status = $this->session->userdata('status');
        if($status != 'superadmin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('superadmin/navigationbar');
            $this->load->view('superadmin/masterbahanbaku');
        }
    }

    public function daftarBahanBaku() {
        $this->load->library('datatables');
        $this->datatables->select('kode_bahan_baku, nama_bahan_baku, harga_beli');
        $this->datatables->from('bahan_baku');
        echo $this->datatables->generate();
    }

    public function tambahBahanBaku() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }
        
        $kode = trim($this->input->post('kode'));
        $nama = trim($this->input->post('nama'));
        $harga = trim($this->input->post('harga'));

        $where = array('kode_bahan_baku' => $kode);
        if( $this->produk->countAllDataWhere('bahan_baku', $where) > 0 ) {
            echo 'Kode sudah ada di dalam database.';
            die();
        }
        
        $data = array(
            'kode_bahan_baku'   => $kode,
            'nama_bahan_baku'   => $nama,
            'harga_beli'        => $harga
        );
        if( $this->produk->insertData('bahan_baku', $data) ) {
            echo 'Data berhasil ditambahkan.';
        }
        else {
            echo 'Data gagal ditambahkan. Silakan mencoba kembali.';
        }
    }

    public function ambilBahanBaku() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = $this->input->post('kode');
        $where = array('kode_bahan_baku' => $kode);
        $data = $this->produk->getAllDataWhere('bahan_baku', $where);
        echo json_encode($data[0]);
    }

    public function editBahanBaku() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = trim($this->input->post('kode'));
        $kodeLama = $this->input->post('kodeLama');
        $nama = trim($this->input->post('nama'));
        $harga = trim($this->input->post('harga'));

        $where = array('kode_bahan_baku' => $kode);
        if( $this->produk->countAllDataWhere('bahan_baku', $where) > 0 && $kode != $kodeLama ) {
            echo 'Kode sudah ada di dalam database.';
            die();
        }

        $where = array('kode_bahan_baku' => $kodeLama);
        $data = array(
            'kode_bahan_baku'   => $kode,
            'nama_bahan_baku'   => $nama,
            'harga_beli'        => $harga
        );
        if( $this->produk->updateData('bahan_baku', $where, $data) ) {
            echo 'Data berhasil diubah.';
        }
        else {
            echo 'Data gagal diubah. Silakan mencoba kembali.';
        }
    }

    public function hapusBahanBaku() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $where = array('kode_bahan_baku' => $this->input->post('kode'));
        $this->produk->deleteData('bahan_baku', $where);
    }

    public function masterBahanJadi() {
        $status = $this->session->userdata('status');
        if($status != 'superadmin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('superadmin/navigationbar');
            $this->load->view('superadmin/masterbahanjadi');
        }
    }

    public function daftarBahanJadi() {
        $this->load->library('datatables');
        $this->datatables->select('kode_bahan_jadi, nama_bahan_jadi, harga_jual');
        $this->datatables->from('bahan_jadi');
        echo $this->datatables->generate();
    }

    public function tambahBahanJadi() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }
        
        $kode = trim($this->input->post('kode'));
        $nama = trim($this->input->post('nama'));
        $harga = trim($this->input->post('harga'));

        $where = array('kode_bahan_jadi' => $kode);
        if( $this->produk->countAllDataWhere('bahan_jadi', $where) > 0 ) {
            echo 'Kode sudah ada di dalam database.';
            die();
        }
        
        $data = array(
            'kode_bahan_jadi'   => $kode,
            'nama_bahan_jadi'   => $nama,
            'harga_jual'        => $harga
        );
        if( $this->produk->insertData('bahan_jadi', $data) ) {
            echo 'Data berhasil ditambahkan.';
        }
        else {
            echo 'Data gagal ditambahkan. Silakan mencoba kembali.';
        }
    }

    public function ambilBahanJadi() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = $this->input->post('kode');
        $where = array('kode_bahan_jadi' => $kode);
        $data = $this->produk->getAllDataWhere('bahan_jadi', $where);
        echo json_encode($data[0]);
    }

    public function editBahanJadi() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = trim($this->input->post('kode'));
        $kodeLama = $this->input->post('kodeLama');
        $nama = trim($this->input->post('nama'));
        $harga = trim($this->input->post('harga'));

        $where = array('kode_bahan_jadi' => $kode);
        if( $this->produk->countAllDataWhere('bahan_jadi', $where) > 0 && $kode != $kodeLama ) {
            echo 'Kode sudah ada di dalam database.';
            die();
        }

        $where = array('kode_bahan_jadi' => $kodeLama);
        $data = array(
            'kode_bahan_jadi'   => $kode,
            'nama_bahan_jadi'   => $nama,
            'harga_jual'        => $harga
        );
        if( $this->produk->updateData('bahan_jadi', $where, $data) ) {
            echo 'Data berhasil diubah.';
        }
        else {
            echo 'Data gagal diubah. Silakan mencoba kembali.';
        }
    }

    public function hapusBahanJadi() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $where = array('kode_bahan_jadi' => $this->input->post('kode'));
        $this->produk->deleteData('bahan_jadi', $where);
    }

    public function masterResep() {
        $status = $this->session->userdata('status');
        if($status != 'superadmin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('superadmin/navigationbar');
            $this->load->view('superadmin/masterresep');
        }
    }

    public function daftarResep() {
        $this->load->library('datatables');
        $this->datatables->select('kode_bahan_jadi, nama_bahan_jadi, harga_jual');
        $this->datatables->from('bahan_jadi');
        echo $this->datatables->generate();
    }

    public function ambilResep() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = $this->input->post('kode');
        $where = array('resep.kode_bahan_jadi' => $kode);
        $data = $this->produk->getRecipe($where);
        echo json_encode($data);
    }

    public function editResep() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = $this->input->post('kode');
        $resep = json_decode($this->input->post('resepString'));

        // Hapus dulu data resep sebelumnya
        $where = array('kode_bahan_jadi' => $kode);
        $this->produk->deleteData('resep', $where);

        for($i=0; $i<count($resep); $i++) {
            $data = array(
                'kode_bahan_jadi'   => $kode,
                'kode_bahan_baku'   => $resep[$i]->kode,
                'jumlah_bahan_baku' => $resep[$i]->jumlah
            );
            $this->produk->insertData('resep', $data);
        }

        echo 'Data berhasil disimpan.';
    }

    public function masterCabang() {
        $status = $this->session->userdata('status');
        if($status != 'superadmin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('superadmin/navigationbar');
            $this->load->view('superadmin/mastercabang');
        }
    }

    public function daftarCabang() {
        $this->load->library('datatables');
        $this->datatables->select('kode_cabang, nama_cabang, alamat_cabang, telepon_cabang');
        $this->datatables->from('cabang');
        echo $this->datatables->generate();
    }

    public function tambahCabang() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }
        
        $nama = trim($this->input->post('nama'));
        $alamat = trim($this->input->post('alamat'));
        $telepon = trim($this->input->post('telepon'));

        
        $data = array(
            'nama_cabang'       => $nama,
            'alamat_cabang'     => $alamat,
            'telepon_cabang'    => $telepon
        );
        if( $this->produk->insertData('cabang', $data) ) {
            echo 'Data berhasil ditambahkan.';
        }
        else {
            echo 'Data gagal ditambahkan. Silakan mencoba kembali.';
        }
    }

    public function ambilCabang() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = $this->input->post('kode');
        $where = array('kode_cabang' => $kode);
        $data = $this->produk->getAllDataWhere('cabang', $where);
        echo json_encode($data[0]);
    }

    public function editCabang() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = trim($this->input->post('kode'));
        $nama = trim($this->input->post('nama'));
        $alamat = trim($this->input->post('alamat'));
        $telepon = trim($this->input->post('telepon'));

        $where = array('kode_cabang' => $kode);
        $data = array(
            'nama_cabang'   => $nama,
            'alamat_cabang' => $alamat,
            'telepon_cabang'=> $telepon
        );
        if( $this->produk->updateData('cabang', $where, $data) ) {
            echo 'Data berhasil diubah.';
        }
        else {
            echo 'Data gagal diubah. Silakan mencoba kembali.';
        }
    }

    public function hapusCabang() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $where = array('kode_cabang' => $this->input->post('kode'));
        $this->produk->deleteData('cabang', $where);
    }

    public function masterSupplier() {
        $status = $this->session->userdata('status');
        if($status != 'superadmin') {
            redirect(base_url('login'));
        }
        else {
            $this->load->view('superadmin/navigationbar');
            $this->load->view('superadmin/mastersupplier');
        }
    }

    public function daftarSupplier() {
        $this->load->library('datatables');
        $this->datatables->select('kode_supplier, nama_supplier, alamat_supplier, telepon_supplier');
        $this->datatables->from('supplier');
        echo $this->datatables->generate();
    }

    public function tambahSupplier() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }
        
        $nama = trim($this->input->post('nama'));
        $alamat = trim($this->input->post('alamat'));
        $telepon = trim($this->input->post('telepon'));

        
        $data = array(
            'nama_supplier'       => $nama,
            'alamat_supplier'     => $alamat,
            'telepon_supplier'    => $telepon
        );
        if( $this->produk->insertData('supplier', $data) ) {
            echo 'Data berhasil ditambahkan.';
        }
        else {
            echo 'Data gagal ditambahkan. Silakan mencoba kembali.';
        }
    }

    public function ambilSupplier() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = $this->input->post('kode');
        $where = array('kode_supplier' => $kode);
        $data = $this->produk->getAllDataWhere('supplier', $where);
        echo json_encode($data[0]);
    }

    public function editSupplier() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $kode = trim($this->input->post('kode'));
        $nama = trim($this->input->post('nama'));
        $alamat = trim($this->input->post('alamat'));
        $telepon = trim($this->input->post('telepon'));

        $where = array('kode_supplier' => $kode);
        $data = array(
            'nama_supplier'   => $nama,
            'alamat_supplier' => $alamat,
            'telepon_supplier'=> $telepon
        );
        if( $this->produk->updateData('supplier', $where, $data) ) {
            echo 'Data berhasil diubah.';
        }
        else {
            echo 'Data gagal diubah. Silakan mencoba kembali.';
        }
    }

    public function hapusSupplier() {
        if( !$this->input->post() ) {
            echo 'Tidak ada input.';
            die();
        }

        $where = array('kode_supplier' => $this->input->post('kode'));
        $this->produk->deleteData('supplier', $where);
    }
}