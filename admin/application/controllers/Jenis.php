<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
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
        $crud->set_table('jenis_surat');
        $crud->display_as('kode_jenis', 'KODE');
        $crud->display_as('nama_jenis', 'NAMA JENIS');

        $crud->columns('kode_jenis', 'nama_jenis');

        $crud->order_by('nama_jenis', 'asc');
        $crud->unset_fields('created_at', 'updated_at');

        $crud->unset_read();
        $crud->unset_clone();
        $crud->unset_jquery();

        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'JenisSurat/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }
}
