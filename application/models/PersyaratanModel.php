<?php
defined('BASEPATH') or exit('No direct script access allowes');

class PersyaratanModel extends CI_Model
{
    private $tabel = "persyaratan";

    public function get_persyaratan()
    {
        return $this->db->get($this->tabel)->result();
        //baris 10 ini tujuannya untuk mengambil data dari tabel jenis_beasiswa. selain dengan fungsi get,
        //kita juga bisa menggunakan $this->db->query('select * from jenis_beasiswa')->result();
    }


    public function insert_persyaratan()
    {
        $data = [
            'nama_persyaratan' => $this->input->post('nama_persyaratan'),
            'keterangan' => $this->input->post('keterangan'),
        ];
        //nama_jenis sebelah kiri, sesuaikan dengan nama kolom di tabel
        //nama_jenis sebelah kanan, seasuailan dengan name di form yaitu(jenis_create.php baris 29)
        $this->db->insert($this->tabel, $data);
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data Persyaratan berhasil ditambahkan");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data Persyaratan gagal ditambahkan");
            $this->session->set_flashdata('status', false);
        }
    }

    //function dengan 1 parameter. $id nilainya dikirimkan oleh controller
    public function get_persyaratan_byid($id)
    {
        return $this->db->get_where($this->tabel, ['id' => $id])->row();
        /*
            get where hampir sama seperti get, bedanya ada tambahan klause where untuk menampilkan data berdasarkan kriteria tertentu. 
            'id'=>$id artinya data yang diambil adalah data jenis_beasiswa dengan nilai id = $id.
            row() digunakan untuk mengambil satu baris data , beda dengan result() yang mengambil semua data
        */
    }

    public function update_persyaratan()
    {
        $data = [
            'nama_persyaratan' => $this->input->post('nama_persyaratan'),
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update($this->tabel, $data);
        /* proses update hampir sama seperti insert, bedanya, ada tambahan where(baris 43)
        untuk menentukan data mana yang akan diperbaharui */
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data Persyaratan berhasil diubah");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data Persyaratan gagal diubah");
            $this->session->set_flashdata('status', false);
        }
    }

    public function delete_persyaratan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tabel);
        //sebelum dilakukan hapus, tambahkan where dulu untuk menentukan data mana yang dihapus
        //untuk proses hapus gunakan fungsi delete(namatabel)
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data Persyaratan berhasil dihapus");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data Persyaratan gagal dihapus");
            $this->session->set_flashdata('status', false);
        }
    }
}
