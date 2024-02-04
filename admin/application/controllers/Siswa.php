<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
        $crud->set_table('siswa');

        $crud->display_as('no_induk', 'NISN');
        $crud->display_as('nama_siswa', 'NAMA');
        $crud->display_as('id_jurusan', 'JURUSAN');
        $crud->display_as('alamat', 'ALAMAT');
        $crud->display_as('telp', 'TELP');

        // $crud->display_as('id_jurusan', 'JURUSAN');
        $crud->set_relation('id_jurusan', 'jurusan', 'nama_jurusan');

        $crud->columns('no_induk', 'nama_siswa', 'id_jurusan', 'alamat', 'telp');
        $crud->fields('no_induk', 'nama_siswa', 'id_jurusan', 'alamat', 'telp');

        $crud->required_fields('no_induk', 'nama_siswa', 'id_jurusan');
        $crud->callback_field('alamat', array($this, '_field_alamat'));

        // $crud->set_field_upload('foto', 'assets/uploads/files/anggota');
        $crud->unset_jquery();
        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Siswa/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }

    public function _field_anggota($value, $row)
    {
        return $row->gelar_depan . ' ' . $value . ' ' . $row->gelar_belakang;
    }

    public function _field_alamat()
    {
        return "<textarea name='alamat' class='form-control'></textarea>";
    }
}
