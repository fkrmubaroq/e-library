<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthPage extends CI_Model
{
    public function __construct()
    {
        $this->run();
    }

    private function run()
    {
        try {

            if ($this->credential->has_userdata('access_token') == null)
                throw new Exception('anda belum login');

            $this->credential->CekCredential();
        } catch (Exception $error) {
            $this->session->set_flashdata('pesan', "<script>WarningMessage('Pesan','" . ($error->getMessage()) . "')</script>");
            redirect('login');
        }
    }
}
