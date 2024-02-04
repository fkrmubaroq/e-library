<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserSiswa extends CI_Controller
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

        $crud->where('level', 'SISWA');

        $crud->columns('nisn', 'nama_user', 'username', 'level', 'is_aktif');
        $crud->callback_column('nisn', array($this, '_field_nisn'));
        $crud->callback_column('nama_user', array($this, '_field_nama_user'));
        $crud->callback_column('is_aktif', array($this, '_field_is_aktif'));

        $crud->callback_edit_field('password', array($this, 'password_field_update'));
        $crud->callback_edit_field('id_siswa', array($this, 'siswa_field_update'));

        $crud->callback_before_insert(array($this, 'encrypt_password_callback'));
        $crud->callback_before_update(array($this, 'edit_encrypt_password_callback'));

        $crud->unset_jquery();
        $crud->unset_read();

        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'User/DataSiswa';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }

    public function _field_is_aktif($value)
    {
        return $value == '1' ? "<b class='text-success'>AKTIF</b>" : "<b class='text-danger'>NON AKTIF</b>";
    }
    public function _field_nisn($value, $row)
    {
        $id = $row->id;
        $ReadSiswa = $this->db->get_where('siswa', ['id_user' => $id]);
        $source = $ReadSiswa->row();

        return $source->no_induk ?? "<span class='text-muted'>Belum tersedia</span>";
    }

    public function _field_nama_user($value, $row)
    {
        $id = $row->id;
        $ReadSiswa = $this->db->get_where('siswa', ['id_user' => $id]);
        $source = $ReadSiswa->row();

        return $source->nama_siswa ?? "<span class='text-muted'>Belum tersedia</span>";
    }
    public function custom_status($value)
    {
        $status = "<b class='text-success'>AKTIF</b>";
        if ($value == '2')
            $status = "<b class='text-danger'>NON AKTIF</b>";
        return $status;
    }

    public function field_aktif($value = NULL)
    {
        $options = array('1' => 'AKTIF', '2' => 'NON AKTIF');
        $option_tag = '';
        foreach ($options as $key => $option) {
            $attribute  = 'value="' . $key . '"';
            $option_tag .= "<option $attribute>$option</option>";
        }
        return '<select name="is_aktif">' . $option_tag . '</select>';
    }

    public function field_level($value = NULL)
    {
        $options = array('1' => 'ADMIN', '2' => 'SISWA');
        $option_tag = '';
        foreach ($options as $key => $option) {
            $attribute  = 'value="' . $key . '"';
            $option_tag .= "<option $attribute>$option</option>";
        }
        return '<select name="status">' . $option_tag . '</select>';
    }


    function encrypt_password_callback($post_array, $primary_key = null)
    {
        $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
        return $post_array;
    }

    function edit_encrypt_password_callback($post_array, $primary_key = null)
    {
        // $this->librari->printr($post_array['password']);
        if (empty($post_array['password'])) {
            $read = $this->db->get_where('user', ['id' => $primary_key]);
            if ($read->num_rows() > 0) {
                $source = $read->row();
                $post_array['password'] = $source->password;
            }
        } else {
            $post_array['password'] = password_hash($post_array['password'], PASSWORD_BCRYPT);
        }
        return $post_array;
    }
    public function field_siswa($value = NULL)
    {
        $read = $this->db->select('id,no_induk,nama_siswa')
            ->from('siswa')
            ->where_not_in('id', "SELECT user.id_siswa FROM user", false)
            ->get();
        $option_tag = '';
        if ($read->num_rows() > 0) {
            $source = $read->result_array();
            foreach ($source as $key => $option) {
                $attribute  = 'value="' . $option['id'] . '"';
                $option_tag .= "<option $attribute> {$option['no_induk']} - {$option['nama_siswa']}</option>";
            }
        }
        return '<select id="field-id_siswa" name="id_siswa" class="siswa-select2 form-control w-100" style="width:500px">' . $option_tag . '</select>
        <script>
        $(document).ready(function() {
            $(".siswa-select2").select2();
        });
        </script>
        ';
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
