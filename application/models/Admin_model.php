<?php
// modelk      
class Admin_model extends CI_Model
{
    public function tampildata($table, $urut_id)
    {
        return $this->db->from($table)
            ->order_by($urut_id, 'DESC')->get('');
    }
    // simpan data
    public function simpandata($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    // hapusdata
    public function hapusdata($table, $id, $primary)
    {
        return $this->db->delete($table, array($primary => $id));
    }
    // formedit
    public function formedit($table, $primary, $id)
    {
        return $this->db->get_where($table, array($primary => $id))->row();
    }
    // edit
    public function editdata($table, $primary, $id, $data)
    {
        return $this->db->where($primary, $id)
            ->update($table, $data);
    }
    public function joinsiswa()
    {
        # pemnagilan data yg di siswa digabung sama tahun pelajaran dan datanya diambil keduanya
        $query = $this->db->select('*')
            ->from('siswa')
            ->join('tahun_pelajaran', 'siswa.id_tahun_pelajaran_siswa=tahun_pelajaran.id_tahun_pelajaran', 'left')
            ->order_by('id_siswa', 'DESC')
            ->get();
        // menghubungkan 2 table
        return $query;
    }
    // combobox
    public function comboxdinamis()
    {
        # code...
        $query = $this->db->get('tahun_pelajaran');
        $tambah[set_value('id_tahun_pelajaran')] = "---isi tahun pelajaran---";
        if ($query->num_rows() > 0) {
            // untuk menampil
            foreach ($query->result() as $row) {
                $tambah[$row->id_tahun_pelajaran] = $row->tahun_pelajaran;
            }
        }
        // 
        return $tambah;
    }
}
