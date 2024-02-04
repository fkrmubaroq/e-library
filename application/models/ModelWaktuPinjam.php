<?php
class ModelWaktuPinjam extends CI_Model
{

    public function getWaktuPinjam($where = [])
    {
        return $this->db->order_by('hari', 'asc')->get_where('waktu_pinjam', $where);
    }
}
