<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelToken', 'token');
        $this->Auth();
    }

    public function Auth()
    {
        try {
            // session_destroy();
            // ambil token
            $token = $this->token->GetToken();

            // Nama Class controller
            $Router = strtolower($this->router->fetch_class());
            $SubRouter = strtolower($this->router->fetch_method());

            // kalau user belum login
            if ($token == null) {
                // Controller yang boleh diakses sebelum login (lowercase)
                $AllowAksesControllerBefore = ['login'];

                // cek kalau mengakses controller diluar '$AllowAksesControllerBefore'
                if (!in_array($Router, $AllowAksesControllerBefore))
                    redirect('login');
            }

            // kalau user udah login
            else {

                // cari token berdasarkan database
                $ReadToken = $this->db->select('token')
                    ->from('token_login')
                    ->where(['token' => $token])
                    ->get();
                // cek kalo ga ada token / ga ada di database
                if ($ReadToken->num_rows() <= 0)
                    throw new Exception('Invalid Token');


                // Controller yang boleh diakses sesudah login (lowercase)
                $AllowAksesControllerAfter = [
                    'dashboard',
                    'email',
                    'jabatan',
                    'pangkat',
                    'anggota',
                    'login',
                    'pengirim',
                    'pengaturan',
                ];
                if (!in_array($Router, $AllowAksesControllerAfter)) {
                    $this->session->set_flashdata('pesan', "<script>pesan_warning('Anda tidak memiliki izin untuk mengakses halaman ini, silahkan hubungi administrator','Pesan kesalahan')</script>");
                    redirect('dashboard');
                }
                // kalau user akses ke halaman login
                if ($Router == 'login' && $SubRouter == 'index')
                    redirect('dashboard');
            }
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('" . ($Error->getMessage) . "')</script>");
            // echo $Error->getMessage();
            redirect('login');
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Throwable " . ($Error->getMessage) . "')</script>");
            redirect('login');
        }
    }
}
