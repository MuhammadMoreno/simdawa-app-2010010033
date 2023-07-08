<?php
defined('BASEPATH') or exit('No direct script access allowes');

class ProdiModel extends CI_Model
{
    private $tabel = "prodi";

    public function get_prodi()
    {
        return $this->db->get($this->tabel)->result();
        //baris 10 ini tujuannya untuk mengambil data dari tabel jenis_beasiswa. selain dengan fungsi get,
        //kita juga bisa menggunakan $this->db->query('select * from jenis_beasiswa')->result();
    }


    public function insert_prodi()
    {
        $data = [
            'nama_prodi' => $this->input->post('nama_prodi'),
        ];
        //nama_jenis sebelah kiri, sesuaikan dengan nama kolom di tabel
        //nama_jenis sebelah kanan, seasuailan dengan name di form yaitu(jenis_create.php baris 29)
        $this->db->insert($this->tabel, $data);
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data Prodi berhasil ditambahkan");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data Prodi gagal ditambahkan");
            $this->session->set_flashdata('status', false);
        }
    }

    //function dengan 1 parameter. $id nilainya dikirimkan oleh controller
    public function get_prodi_byid($id)
    {
        return $this->db->get_where($this->tabel, ['id' => $id])->row();
        /*
            get where hampir sama seperti get, bedanya ada tambahan klause where untuk menampilkan data berdasarkan kriteria tertentu. 
            'id'=>$id artinya data yang diambil adalah data jenis_beasiswa dengan nilai id = $id.
            row() digunakan untuk mengambil satu baris data , beda dengan result() yang mengambil semua data
        */
    }

    public function update_prodi()
    {
        $data = [
            'nama_prodi' => $this->input->post('nama_prodi'),

        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update($this->tabel, $data);
        /* proses update hampir sama seperti insert, bedanya, ada tambahan where(baris 43)
        untuk menentukan data mana yang akan diperbaharui */
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data Prodi berhasil diubah");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data Prodi gagal diubah");
            $this->session->set_flashdata('status', false);
        }
    }

    public function delete_prodi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tabel);
        //sebelum dilakukan hapus, tambahkan where dulu untuk menentukan data mana yang dihapus
        //untuk proses hapus gunakan fungsi delete(namatabel)
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data Prodi berhasil dihapus");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data Prodi gagal dihapus");
            $this->session->set_flashdata('status', false);
        }
    }
}
