<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'page' => 'Dashboard',
        ];

        $labels = $this->db->select('jurusan.nama_jurusan')
            ->from('jurusan')
            ->get();
        $sourceLabels = $labels->result_array();
        $data['labels'] = [];
        if ($labels->num_rows() > 0) {
            $arrColumn = array_column($sourceLabels, 'nama_jurusan');
            $data['labels'] = "'" . implode("','", $arrColumn) . "'";
        }
        // $this->librari->printr($data);
        $this->load->view('Templates/Templates', $data);
    }
}
