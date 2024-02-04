<?php

class ModelPosting extends CI_Model
{
    public $table = "lowongan";
    public $column_order = array(null); //field yang ada di table 
    public $column_search = array(null); //field yang diizin untuk pencarian 
    public $order = array('id' => 'desc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('p.id_jabatan, p.nama_jabatan');
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    function cekPerubahan()
    {
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get($id)
    {
        return $this->db->get_where($this->table1, array('sha1(id_jabatan)' => $id))->row();
    }

    function insert($data)
    {
        $this->db->insert($this->table1, $data);
        return $this->cekPerubahan();
    }

    function update($data, $where)
    {
        $this->db->where($where);
        $this->db->update($this->table1, $data);
        return $this->cekPerubahan();
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table1);
        return $this->cekPerubahan();
    }

    public function OptionalField()
    {
        try {
            $input = $this->library;
            $data = [
                'nik'            => $input->XssClean('nik'),
                'nama_panggilan' => $input->XssClean('panggilan'),
                'alamat'         => $input->XssClean('alamat'),
                'kecamatan'      => $input->XssClean('kecamatan'),
                'desa'           => $input->XssClean('kelurahan'),
                'kode_pos'       => $input->XssClean('kodepos'),
                'tempat_lahir'   => $input->XssClean('tempat_lahir'),
                'tanggal_lahir'  => $input->XssClean('tanggal_lahir'),
                'suku'           => $input->XssClean('suku'),
                'agama'          => $input->XssClean('agama'),
                'nama_ibu'       => $input->XssClean('nmibu'),
                'gelar_depan'    => $input->XssClean('gelardepan'),
                'gelar_belakang' => $input->XssClean('gelarbelakang'),
                'email'          => $input->XssClean('email'),
                'jenis_identitas' => $input->XssClean('jenis_identitas'),
                'no_identitas'   => $input->XssClean('nomor_identitas'),
                'npwp'           => $input->XssClean('npwp'),
                'banyak_jam'     => $input->XssClean('banyakjam'),
                'karpeg'         => $input->XssClean('karpeg'),
            ];
            if (!empty($data['nik'])) {
                if (!is_numeric($data['nik']))
                    throw new Exception("Field <b>NIK</b> Harus angka");
            }
            $message = [
                'status' => 200,
                'message' => 'ok',
                'data' => $data
            ];
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 200,
                'message' => 'ok',
                'data' => $data
            ];
        } finally {
            return $message;
        }
    }
    public function RequiredField()
    {
        try {
            $input = $this->input->post();
            $data = [
                'nip' => $input['nip'],
                'nama' => $input['nama'],
                'bagian' => $input['bagian'],
                'jk' => $input['jk'],
            ];

            foreach ($data as $key => $list) :
                if (empty($list))
                    throw new Exception("field <b>{$key}</b> Tidak boleh kosong");
            endforeach;

            if (!is_numeric($data['nip']))
                throw new Exception("field <b>NIP</b> harus angka");

            $message = [
                'status' => 200,
                'message' => 'ok',
                'data'   => $data
            ];
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 400,
                'message' => 'Throwable ' . $Error->getMessage(),
            ];
        } finally {
            return $message;
        }
    }
}
