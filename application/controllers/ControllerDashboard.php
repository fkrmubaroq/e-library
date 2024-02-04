<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ControllerDashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // $this->librari->printr($_SESSION);
        $data = [
            'title' => 'Dashboard',
            'content' => 'Dashboard',
            'css'     => ['https://unpkg.com/aos@2.3.1/dist/aos.css'],
            'js'      => [
                'https://unpkg.com/aos@2.3.1/dist/aos.js',
                'https://cdn.jsdelivr.net/npm/chart.js',
                    base_url('assets/js/Dashboard.js'),

            ]
        ];
        $ReadBuku = $this->db->get_where('buku');
        $data['count'] = $ReadBuku->num_rows();
        $data['collections'] = [];
        if ($data['count'] > 0) {
            // load model buku
            $this->load->model('Buku', 'buku');
            $x = 0;
            $DataBuku = $ReadBuku->result_array();
            foreach ($DataBuku as $list) :
                $DataBuku[$x++]['rating'] = $this->buku->getRatingBuku([
                    'id_buku' => $list['id']
                ]);
            endforeach;
            $data['collections'] = $DataBuku;
        }
        // $this->librari->printr($data);
        $this->load->view('Template/Template', $data);
    }

    public function profil()
    {
        try {
            $user = $this->librari->SessionData();
            // $this->librari->printr($user);
            $level = $user['level'];
            if ($level == 'GURU')
                $profil = $this->db->select('guru.*, guru.nama_guru as nama_user, user.username, is_aktif')
                    ->from('guru')
                    ->join('user', 'user.id = guru.id_user', 'LEFT')
                    ->where([
                        'guru.id_user' => $user['id_user'],
                        'user.level'   => $level
                    ])
                    ->get();

            // cek ketersediaan user
            if ($profil->num_rows() <= 0)
                throw new Exception("User tidak ditemukan");

            $data = [
                'status_code'  => 200,
                'collection'   => $profil->row(),
            ];
        } catch (Exception $error) {
            $data = [
                'status_code'  => 400,
                'message'      => $error->getMessage()
            ];
        } catch (Throwable $error) {
            $data = [
                'status_code'  => 400,
                'message'      => $error->getMessage()
            ];
        } finally {
            $data['content'] = 'Profil';
            // $this->librari->printr($data);
            $this->load->view("Template/Template", $data);
        }
    }
}
