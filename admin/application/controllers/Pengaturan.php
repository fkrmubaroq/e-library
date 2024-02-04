<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth');
        $this->load->library('Library');
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = $this->grocery_crud;
        $crud->set_theme('flexigrid');
        $crud->set_table('konfigurasi_email');
        $crud->display_as('host', 'HOST SMTP');
        $crud->display_as('smtp_secure', 'SMTP SECURE');
        $crud->display_as('port', 'PORT');

        $crud->columns('host', 'smtp_secure', 'port');
        $crud->order_by('id_konfigurasi', 'desc');

        $crud->set_subject('Konfigurasi');

        $crud->required_fields('host', 'smtp_secure', 'port');
        $crud->unset_read();
        $crud->unset_clone();
        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Pengaturan/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }
}
