<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beasiswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('JenisModel', 'BeasiswaModel'));
        $this->load->library('pdf'); //meload file pdf yang ada di folder libraries
        //meload 2 buah model, JenisModel akan digunakan untuk mengambil data jenis beasiswa
    }

    //function cetak, digunakan untuk menjalankan report data beasiswa
    public function cetak()
    {
        $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa();
        $this->load->view('beasiswa/beasiswa_print', $data);
    }

    public function index()
    {
        $data['title'] = "Data Beasiswa | SIMDAWA-APP";
        $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa(); //mengambil data beasiswa dari funtion get_beasiswa
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('beasiswa/beasiswa_read', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        if (isset($_POST['create'])) {
            $this->BeasiswaModel->insert_beasiswa();
            redirect('beasiswa');
        } else {
            $data['title'] = "Tambah Data Beasiswa | SIMDAWA-APP";
            $data['jenis'] = $this->JenisModel->get_jenis(); //mengambil data jenis beasiswa 
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('beasiswa/beasiswa_create');
            $this->load->view('template/footer');
        }
    }

    public function ubah($id)
    {
        if (isset($_POST['update'])) {
            $this->BeasiswaModel->update_beasiswa();
            redirect('beasiswa');
        } else {
            $data['jenis'] = $this->JenisModel->get_jenis();
            $data['title'] = "Perbaharui Data Beasiswa | SIMDAWA-APP";
            $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa_byid($id);
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('beasiswa/beasiswa_update', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapus($id)
    {
        if (isset($id)) {
            $this->BeasiswaModel->delete_beasiswa($id);
            redirect('beasiswa');
        }
    }
}
