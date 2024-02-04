<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserGuru extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = $this->grocery_crud;
        $crud->set_theme('datatables');
        $crud->set_table('user');

        $crud->display_as('username', 'USERNAME');
        $crud->display_as('is_aktif', 'STATUS AKUN');
        $crud->display_as('nisn', 'NO.INDUK');
        $crud->display_as('nama_user', 'NAMA USER');
        $crud->display_as('level', 'UNTUK AKUN');

        $crud->where('level', 'GURU');

        $crud->columns('nisn', 'nama_user', 'username', 'is_aktif');
        $crud->fields('GURU', 'username', 'password', 'is_aktif', 'level');

        $crud->callback_column('nisn', array($this, '_field_nisn'));
        $crud->callback_column('nama_user', array($this, '_field_nama_user'));
        $crud->callback_column('is_aktif', array($this, '_field_is_aktif'));
        $crud->callback_field('level', array($this, '_level_field'));

        $crud->callback_field('is_aktif', array($this, '_field_aktif'));

        $crud->callback_add_field('GURU', array($this, '_add_field_guru'));
        $crud->callback_edit_field('GURU', array($this, '_update_field_guru'));


        $crud->callback_edit_field('password', array($this, 'password_field_update'));
        $crud->callback_edit_field('guru', array($this, 'siswa_field_update'));

        $crud->callback_insert(array($this, '_insert_data'));
        $crud->callback_update(array($this, '_update_data'));
        // $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
        $crud->callback_before_update(array($this, 'edit_encrypt_password_callback'));

        $crud->unset_jquery();
        $crud->unset_read();

        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'User/DataGuru';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }

    public function _insert_data($row)
    {
        // $this->librari->printr($row);
        $idGuru = $row['id_guru'];
        $row['password'] = password_hash($row['password'], PASSWORD_BCRYPT);
        // hapus id_siswa
        unset($row['id_guru']);
        $this->db->insert('user', $row);
        $idUser =  $this->db->insert_id();

        // update guru
        $this->db->where('id', $idGuru);
        return $this->db->update('guru', ['id_user' => $idUser]);
    }

    public function _update_data($row)
    {
        $idUser = $this->uri->segment(4);
        $idGuru = $row['id_guru'];

        // $this->librari->printr($post_array['password']);
        if (empty($row['password'])) {
            $read = $this->db->get_where('user', ['id' => $idUser]);
            if ($read->num_rows() > 0) {
                $source = $read->row();
                $row['password'] = $source->password;
            }
        } else {
            $row['password'] = password_hash($row['password'], PASSWORD_BCRYPT);
        }
        // hapus id_guru
        unset($row['id_guru']);

        $this->db->where('user.id', $idUser);
        $this->db->update('user', $row);

        // kalo id guru ada
        if (!empty($idGuru)) {
            // update guru
            $this->db->where('id', $idGuru);
            return $this->db->update('guru', ['id_user' => $idUser]);
        }
    }
    public function _add_field_guru($value = NULL)
    {
        $read = $this->db->select('id,no_induk,nama_guru')
            ->from('guru')
            ->where('guru.id_user IS NULL', null, false)
            ->get();
        $option_tag = '';
        if ($read->num_rows() > 0) {
            $source = $read->result_array();


            foreach ($source as $key => $option) {
                $attribute  = 'value="' . $option['id'] . '"';
                $option_tag .= "<option $attribute> {$option['no_induk']} - {$option['nama_guru']}</option>";
            }
        }
        return '<select id="field-id_siswa" name="id_guru" class="guru-select2 form-control w-100" style="width:500px">' . $option_tag . '</select>
        <script>
        $(document).ready(function() {
            $(".guru-select2").select2();
        });
        </script>
        ';
    }

    public function _update_field_guru($value, $idUser)
    {
        // $this->librari->printr($idUser);
        $read = $this->db->select('id,no_induk,nama_guru')
            ->from('guru')
            ->where('guru.id_user', $idUser)
            ->get();

        if ($read->num_rows() > 0) {
            $source = $read->row();
            return "{$source->no_induk} - {$source->nama_guru}";
        } else {
            $read = $this->db->select('id,no_induk,nama_guru')
                ->from('guru')
                ->where('guru.id_user IS NULL', null, false)
                ->get();
            $option_tag = '';
            if ($read->num_rows() > 0) {
                $source = $read->result_array();


                foreach ($source as $key => $option) {
                    $attribute  = 'value="' . $option['id'] . '"';
                    $option_tag .= "<option $attribute> {$option['no_induk']} - {$option['nama_guru']}</option>";
                }
            }
            return '<select id="field-id_siswa" name="id_guru" class="guru-select2 form-control w-100" style="width:500px">' . $option_tag . '</select>
        <script>
        $(document).ready(function() {
            $(".guru-select2").select2();
        });
        </script>
        ';
        }
    }

    public function _level_field()
    {
        return "<input type='hidden' name='level' value='GURU'> GURU";
    }
    public function _field_is_aktif($value)
    {
        return $value == '1' ? "<b class='text-success'>AKTIF</b>" : "<b class='text-danger'>NON AKTIF</b>";
    }
    public function _field_nisn($value, $row)
    {
        $id = $row->id;
        $ReadGuru = $this->db->get_where('guru', ['id_user' => $id]);
        $source = $ReadGuru->row();

        return $source->no_induk ?? "<span class='text-muted'>Belum tersedia</span>";
    }

    public function _field_nama_user($value, $row)
    {
        $id = $row->id;
        $ReadGuru = $this->db->get_where('guru', ['id_user' => $id]);
        $source = $ReadGuru->row();

        return $source->nama_guru ?? "<span class='text-muted'>Belum tersedia</span>";
    }

    public function _field_aktif($value = NULL)
    {
        $options = array('1' => 'AKTIF', '2' => 'NON AKTIF');
        $option_tag = '';
        foreach ($options as $key => $option) {
            $attribute  = 'value="' . $key . '"';
            $option_tag .= "<option $attribute>$option</option>";
        }
        return '<select name="is_aktif" class="form-control">' . $option_tag . '</select>';
    }



    function encrypt_password_callback($post_array, $primary_key = null)
    {
        $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
        return $post_array;
    }

    function edit_encrypt_password_callback($post_array, $primary_key = null)
    {

        return $post_array;
    }


    public function password_field($value = NULL)
    {
        return "<input type='password' name='password' class='form-control w-100'>";
    }
    public function siswa_field_update($value)
    {
        $read = $this->db->get_where('siswa', ['id' => $value]);
        if ($read->num_rows() > 0) {
            $source = $read->row();

            return "{$source->no_induk} - {$source->nama_siswa}";
        }
    }
    public function password_field_update($value)
    {
        return "<input type='password' name='password' class='form-control w-100'>
        <i>Kosongkan password jika tidak ingin di ubah</i> <Br/> 
        ";
    }
}
