<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waktu extends CI_Controller
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
        $crud->set_table('waktu_pinjam');
        $crud->display_as('hari', 'WAKTU PINJAM');

        // $crud->display_as('id_jurusan', 'JURUSAN');
        $crud->columns('hari', 'status');
        $crud->callback_add_field('hari', array($this, 'hari_field'));
        $crud->callback_column('hari', array($this, 'hari_column'));
        $crud->callback_column('status', array($this, 'status_column'));

        $crud->unset_read();
        $crud->unset_clone();
        $crud->unset_jquery();


        $crud->required_fields('hari');
        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'WaktuPinjam/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }

    public function hari_field($value = NULL)
    {
        return "
        <div class='d-flex'>
            <input type='text' name='hari' class='form-control w-100' placeholder='Waktu Pinjam'> 
            <div class='ml-4 w-100 mt-3 text-muted'>Hari</div>
        </div>";
    }

    public function status_column($value)
    {
        return ($value == '1' ? "SISWA" : "GURU");
    }

    public function hari_column($value)
    {
        return $value . ' Hari';
    }
}
