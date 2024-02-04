<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerPosting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'page' => 'Posting/Data',
            'css'  => [
                base_url('assets/plugin/datatables/jquery.dataTables.min.css'),
                base_url('assets/css/GridView.css')
            ],
            'js'   => [
                base_url('assets/plugin/datatables/jquery.dataTables.min.js'),
                base_url('assets/js/Posting.js'),
                ''
            ]
        ];
        $this->load->view('Templates/Templates', $data);
    }

    public function Add()
    {
        $partner = $this->db->get('partner')->result_array();
        $jurusan = $this->db->get('jurusan')->result_array();

        $data = [
            'page'    => 'Posting/Add',
            'partner' => $partner,
            'jurusan' => $jurusan,

            'css'     => [
                'https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css',
                base_url('assets/plugin/LightPick/lightpick.css')
            ],
            'js'      => [
                'https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js',
                'https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js',
                base_url('assets/plugin/LightPick/lightpick.js'),
                base_url('assets/js/AddPosting.js'),
                'https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js',
            ]
        ];
        $this->load->view('Templates/Templates', $data);
    }

    public function GetDataTable()
    {
        try {
            $read = $this->db->select('
                lowongan.id,
                lowongan.id_partner,
                lowongan.judul_lowongan,
                partner.logo,
                lowongan.desc_pekerjaan,
                lowongan.persyaratan,
                lowongan.lokasi,
                lowongan.range_gaji_awal,
                lowongan.range_gaji_akhir,
                lowongan.foto,
                lowongan.tgl_mulai,
                lowongan.tgl_berakhir, 
                lowongan.created_at,
            ')->from('lowongan')
                ->join('partner', 'partner.id = lowongan.id_partner', 'LEFT')
                ->join('jurusan', 'jurusan.id = lowongan.id_jurusan', 'LEFT')
                ->get();
            $count = $read->num_rows();
            $data = [];
            if ($count <= 0)
                throw new Exception("data kosong");

            $data = $read->result_array();

            $x = 0;
            foreach ($data as $list) :
                // $this->library->printr($list, false);
                $data[$x++]['created_at'] = $this->library->TimeToText($list['created_at']);
            endforeach;

            $response = [
                'draw' => 1,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $data
            ];
        } catch (Exception $error) {
            $response = [
                'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ];
        } catch (Exception $error) {
            $response = [
                'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ];
        } finally {
            echo json_encode($response);
        }
    }
}
