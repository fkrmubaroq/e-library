<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // session_destroy();
        // $this->library->printr($_SESSION);
        // $this->load->model('Auth');
    }

    public function index()
    {

        $this->load->view('Login');
    }

    public function Action()
    {
        try {
            // set data 
            $data = [
                'username' => $this->library->XssClean('username'),
                'password' => $this->input->post('password'),
            ];

            // kalau username kosong
            if (empty($data['username']))
                throw new Exception('Kolom username tidak boleh kosong');

            // kalau password kosong
            if (empty($data['password']))
                throw new Exception('Kolom password tidak boleh kosong');

            // Cek login 
            $CekLogin = $this->login->CekLogin($data);

            // kalo username/password salah
            if ($CekLogin['status'] != 200)
                throw new Exception($CekLogin['message']);

            // kalau lulus validasi set token & insert ke tabel token login
            $RandomToken = sha1('login' . ceil(time() / rand(1, 999)));
            $this->session->set_userdata(sha1('token-login') . '_token', $RandomToken);

            // insert token login
            $this->db->insert('token_login', [
                'id_admin' => $CekLogin['data']['id_admin'],
                'token'    => $RandomToken,
            ]);


            // set message flashdata
            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Selamat datang " . $CekLogin['data']['username'] . "')</script>");
            redirect('dashboard');
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('" . ($Error->getmessage()) . "')</script>");
            // echo $Error->getMessage();
            redirect('login');
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Throwable " . ($Error->getmessage()) . "')</script>");
            // redirect('login');
        }
    }

    public function Logout()
    {
        session_destroy();
        redirect('login');
    }
}
