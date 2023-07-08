<?php

class BeasiswaModel extends CI_Model
{
    private $tabel = "beasiswa";

    public function get_beasiswa()
    {
        $q = "select beasiswa.*, jenis_beasiswa.nama_jenis, jenis_beasiswa.keterangan from beasiswa
        inner join jenis_beasiswa on beasiswa.jenis_id = jenis_beasiswa.id";
        return $this->db->query($q)->result();
        //join versi CI
        //$this->db->select("beasiswa.*, jenis_beasiswa.nama_jenis, jenis_beasiswa.keterangan");
        //$this->db->from("beasiswa");
        //$this->db->join("jenis_beasiswa", "beasiswa.jenis_id = jenis_beasiswa.id", "inner");
        //return $this->db->get()->result();
    }


    public function insert_beasiswa()
    {
        $data = [
            'nama_beasiswa' => $this->input->post('nama_beasiswa'),
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'jenis_id' => $this->input->post('jenis_id'),
        ];
        //nama_beasiswa sebelah kiri, sesuaikan dengan nama kolom di tabel
        //nama_beasiswa sebelah kanan, seasuailan dengan name di form yaitu(beasiswa_create.php baris 29)
        $this->db->insert($this->tabel, $data);
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data beasiswa berhasil ditambahkan");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data beasiswa gagal ditambahkan");
            $this->session->set_flashdata('status', false);
        }
    }

    //function dengan 1 parameter. $id nilainya dikirimkan oleh controller
    public function get_beasiswa_byid($id)
    {
        return $this->db->get_where($this->tabel, ['id' => $id])->row();
        //select * from beasiswa where id = 1
        /*
            get where hampir sama seperti get, bedanya ada tambahan klause where untuk menampilkan data berdasarkan kriteria tertentu. 
            'id'=>$id artinya data yang diambil adalah data beasiswa_beasiswa dengan nilai id = $id.
            row() digunakan untuk mengambil satu baris data , beda dengan result() yang mengambil semua data
        */
    }

    public function update_beasiswa()
    {
        $data = [
            'nama_beasiswa' => $this->input->post('nama_beasiswa'),
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'jenis_id' => $this->input->post('jenis_id'),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update($this->tabel, $data);
        /* proses update hampir sama seperti insert, bedanya, ada tambahan where(baris 43)
        untuk menentukan data mana yang akan diperbaharui */
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data beasiswa berhasil diubah");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data beasiswa gagal diubah");
            $this->session->set_flashdata('status', false);
        }
    }

    public function delete_beasiswa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tabel);
        //sebelum dilakukan hapus, tambahkan where dulu untuk menentukan data mana yang dihapus
        //untuk proses hapus gunakan fungsi delete(namatabel)
        if ($this->db->affected_rows() > 0) { //cek proses perubahan data pada tabel, apabila lebih dari 0 maka berhasil
            $this->session->set_flashdata('pesan', "Data beasiswa berhasil dihapus");
            $this->session->set_flashdata('status', true);
        } else {
            $this->session->set_flashdata('pesan', "Data beasiswa gagal dihapus");
            $this->session->set_flashdata('status', false);
        }
    }
}
