<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $crud->set_table('kategori_buku');
        $crud->display_as('nama_kategori', 'NAMA KATEGORI');

        // $crud->display_as('id_jurusan', 'JURUSAN');
        $crud->columns('nama_kategori');
        $crud->unset_read();
        $crud->unset_clone();

        $crud->required_fields('nama_kategori');
        $crud->unset_jquery();

        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Kategori/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }
}
