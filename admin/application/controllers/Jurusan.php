<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
        $crud->set_table('jurusan');
        $crud->display_as('nama_jurusan', 'NAMA JURUSAN');

        // $crud->display_as('id_jurusan', 'JURUSAN');
        $crud->columns('nama_jurusan');
        $crud->unset_read();
        $crud->unset_clone();
        $crud->unset_jquery();


        $crud->required_fields('nama_jurusan');
        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Jurusan/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }
}
