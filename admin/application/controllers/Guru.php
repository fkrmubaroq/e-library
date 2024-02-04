<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
        $crud->set_table('guru');

        $crud->display_as('no_induk', 'NO.INDUK');
        $crud->display_as('nama_guru', 'NAMA');
        $crud->display_as('alamat', 'ALAMAT');
        $crud->display_as('telp', 'TELP');


        $crud->columns('no_induk', 'nama_guru', 'alamat', 'telp');
        $crud->fields('no_induk', 'nama_guru', 'gelar_belakang', 'gelar_depan', 'alamat', 'telp');
        $crud->required_fields('no_induk', 'nama_guru');
        $crud->callback_column('nama_guru', array($this, "_field_nama_guru"));
        $crud->callback_field('alamat', array($this, "_field_alamat"));

        // $crud->set_field_upload('foto', 'assets/uploads/files/anggota');
        $crud->unset_jquery();
        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Guru/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }

    public function _field_nama_guru($value, $row)
    {
        return $row->gelar_depan . ' ' . $value . ' ' . $row->gelar_belakang;
    }

    public function _field_alamat()
    {
        return  "<textarea placeholder='Alamat' name='alamat'></textarea>";
    }
}
