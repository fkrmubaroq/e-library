<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        // session_destroy();
        $this->librari->printr($_SESSION);
        $data = [
            'title'     => 'Dashboard',
            'content'   => 'Dashboard'
        ];
        $this->load->view('Template/Template', $data);
    }
}
