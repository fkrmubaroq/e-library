<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // session_destroy();
        // $this->library->printr($_SESSION);
        $this->load->model('ModelLogin', 'login');
    }

    public function index()
    {
        $data['content'] = 'Login';
        $data['js'] = [base_url('assets/js/Login.js')];
        $this->load->view('Template/Template', $data);
    }



    private function Pengunjung()
    {
        $user = $this->librari->SessionData();
        $hariIni = date('Y-m-d');

        $cekKunjung = $this->db->get_where('pengunjung', [
            'id_user'       => $user['id_user'],
            'tgl_kunjung'   => $hariIni,
        ]);

        // $this->librari->printr($cekKunjung->num_rows());
        // cek kalo belum berkunjung hari ini
        if ($cekKunjung->num_rows() > 0) {
            $this->db->insert('pengunjung', [
                'id_user' => $user['id_user'],
                'ip'      => $this->librari->getIpAddress(),
            ]);
        }
    }

    public function Store()
    {
        try {

            // set data 
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
            ];
            // $this->librari->printr($data);
            // kalau username kosong
            if (empty($data['username']))
                throw new Exception('Kolom username tidak boleh kosong');

            // kalau password kosong
            if (empty($data['password']))
                throw new Exception('Kolom password tidak boleh kosong');

            // Cek login 
            $CekLogin = $this->login->cekLogin($data);

            // $this->librari->printr($CekLogin);
            // set userdata
            $this->credential->set_userdata('id_user', $CekLogin['id']);
            $this->credential->set_userdata('nama_user', $CekLogin['nama_user']);
            $this->credential->set_userdata('LEVEL', $CekLogin['level']);
            // defaultnya
            $redirect = base_url('dashboard');

            // cek kalo pas lagi checkout, tapi malah suruh login, maka sesudah beres login pindah ke checkout lagi
            if ($this->credential->userdata('redirect_checkout') != null) {

                $redirect = $this->credential->userdata('redirect_checkout');
                $this->credential->unset_userdata('redirect_checkout');
            }

            $response = [
                'status_code' => 200,
                'message'     => 'ok',
                'action'      => $redirect
            ];

            // set pengunjung
            $this->Pengunjung();
        } catch (Exception $error) {
            $response = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } catch (Throwable $error) {
            $response = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } finally {
            $response['token'] = $this->security->get_csrf_hash();
            echo json_encode($response);
        }
    }

    public function Logout()
    {
        session_destroy();
        redirect('login');
    }
}
