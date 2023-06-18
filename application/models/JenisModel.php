<?php
defined('BASEPATH') or exit('No direct script access allowes');

class JenisModel extends CI_Model
{

    private $tabel = "jenis_beasiswa";
    public function get_jenis()
    {
        return $this->db->get($this->tabel)->result();
        //baris 10 ini tujuannya untuk mengambil data dari tabel jenis_beasiswa. selain dengan fungsi get,
        //kita juga bisa menggunakan $this->db->query('select * from jenis_beasiswa')->result();
    }
}
