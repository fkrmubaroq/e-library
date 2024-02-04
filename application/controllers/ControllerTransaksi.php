<?php

use phpDocumentor\Reflection\Types\Object_;

defined('BASEPATH') or exit('No direct script access allowed');

class ControllerTransaksi extends CI_Controller
{
    use CheckoutProccess;
    public function Checkout($id = null)
    {
        try {
            // $this->librari->printr($_SESSION);
            if ($id == null)
                throw new Exception('Transaksi tidak ditemukan');

            $id = $this->librari->decode($id);
            if ($this->credential->CekCredential() === false) {
                $this->credential->set_userdata('redirect_checkout', base_url('pinjam'));
                throw new Exception("Anda belum login", 100);
            }

            // cek checkoutnya, ada atau tidak
            if (!isset($_SESSION[sha1('checkout') . '_'])){
                throw new Exception("Transaksi tidak ditemukanxx");
            }

            
            // load library 'qrcode'
            $this->load->library('QrcodeLibrary');
            $ProsesTransaksi =  $_SESSION[sha1('checkout') . '_'];
            $data = [
                'content'  => 'Transaksi/Checkout',
                'qrcode'   => $this->qrcodelibrary->QRCode($ProsesTransaksi['no_transaksi']),
                'no_transaksi'  => $id
            ];

            $data['collections'] = $this->CheckUser($id)->user;
            $data['pinjam'] = (array) $this->CheckUser($id)->pinjam;

            // $this->librari->printr($encode);
            $this->load->view('Template/Template', $data);
        } catch (Exception $error) {
            $redirect = base_url();
            if ($error->getCode() == 100)
                $redirect = base_url('login');

            $this->session->set_flashdata("pesan", "<script>Message('" . ($error->getMessage()) . "')</script>");
            redirect($redirect);
        } catch (Throwable $error) {
            $this->session->set_flashdata("pesan", "<script>Message('" . ($error->getMessage()) . "')</script>");
            redirect(base_url());
        }
    }

    public function Riwayat()
    {
        try {
            if (!$this->credential->CekCredential())
                throw new Exception("Anda belum login, silahkan login terlebih dahulu");

            $user = $this->librari->SessionData();

            if ($user['level'] == 'SISWA') {

                $readTransaksi = $this->db->select(
                    "
                pinjam.*,
                siswa.nama_siswa,
                "
                )->from('pinjam')
                    ->join('siswa', 'siswa.id_user = pinjam.id_user')
                    ->where(['siswa.id_user' => $user['id_user']])
                    ->limit(10)
                    ->get();
            } elseif ($user['level'] == 'GURU') {

                $readTransaksi = $this->db->select(
                    "
                    pinjam.*,
                    guru.nama_guru
                    "
                )->from('pinjam')
                    ->join('guru', 'guru.id_user = pinjam.id_user')
                    ->where(['guru.id_user' => $user['id_user']])
                    ->get();
            }

            $count = $readTransaksi->num_rows();
            if ($count <= 0)
                throw new Exception('transaksi belum tersedia');

            $dataPinjam = $this->DataDetailPinjam($readTransaksi->result_array());

            // load library 'qrcode'
            $this->load->library('QrcodeLibrary');

            $data = [
                'status_code'   => 200,
                'count'         => $count,
                'collections'   => $dataPinjam,
            ];
        } catch (Exception $error) {
            $data = [
                'status_code'   => 400,
                'message'       => $error->getMessage()
            ];
        } finally {
            $data['content'] = 'Transaksi/Riwayat';
            // $this->librari->printr($data);
            $this->load->view('Template/Template', $data);
        }
    }
}


trait CheckoutProccess
{

    private function DataDetailPinjam($dataPinjam)
    {

        $x = 0;
        foreach ($dataPinjam as $list) :
            $DetailPinjam = $this->db->select('
                               detail_pinjam.id,
                               detail_pinjam.id_pinjam,
                               detail_pinjam.id_buku,
                               buku.nama_buku,
                               buku.penulis,
                               buku.cover,
                               buku.slug_nama_buku,
                               buku.file,
                               buku.file_trial,
                               detail_pinjam.tgl_berakhir')
                ->from('detail_pinjam')
                ->join('buku', 'buku.id = detail_pinjam.id_buku', 'LEFT')
                ->where(['detail_pinjam.id_pinjam' => $list['id']])
                ->get();
            $source = $DetailPinjam->result_array();
            $dataPinjam[$x++]['detail_pinjam'] = (array) $source;
        endforeach;

        return $dataPinjam;
    }
    private function ListBukuPinjam($IdPinjam)
    {
        try {
            $ReadTransaksi = $this->db->select(
                '
                buku.nama_buku,
                buku.slug_nama_buku,
                detail_pinjam.*
                '
            )->from('detail_pinjam')
                ->join('buku', 'buku.id = detail_pinjam.id_buku', 'LEFT')
                ->where(['detail_pinjam.id_pinjam' => $IdPinjam])
                ->get();

            // cek buku pinjamnya
            if ($ReadTransaksi->num_rows() <= 0)
                throw new Exception("Buku yang dipinjam tidak ditemukan");

            return $ReadTransaksi->result_array();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
    private function CheckUser($NoTransaksi)
    {
        try {
            // $this->librari->printr($NoTransaksi);

            $level = $this->credential->userdata('LEVEL');
            $data['user'] = [];
            $data['pinjam'] = [];
            $data['count'] = 0;
            if ($level == 'SISWA') {
                $ReadTransaksi = $this->db->select(
                    '
                    pinjam.id as id_pinjam,
                    user.username,
                    siswa.nama_siswa as nama_user,
                    siswa.no_induk,
                    pinjam.no_transaksi,
                    pinjam.total_pinjam_buku,
                    pinjam.tgl_transaksi,
                    pinjam.status                
                '
                )->from('user')
                    ->join('siswa', 'siswa.id_user = user.id', 'LEFT')
                    ->join('pinjam', 'pinjam.id_user = user.id', 'LEFT')
                    ->where('no_transaksi', $NoTransaksi)
                    ->get();

                // $this->librari->printr($ReadTransaksi);
                $data['count'] = $ReadTransaksi->num_rows();
                if ($data['count'] <= 0)
                    throw new Exception("Transaksi tidak ditemukan");

                $data['user'] = $ReadTransaksi->row();
            }
            // kalo GURU
            elseif ($level == 'GURU') {
                $ReadTransaksi = $this->db->select(
                    '
                    pinjam.id as id_pinjam,
                    user.username,
                    guru.nama_guru as nama_user,
                    guru.no_induk,
                    pinjam.no_transaksi,
                    pinjam.total_pinjam_buku,
                    pinjam.tgl_transaksi,
                    pinjam.status                
                '
                )->from('user')
                    ->join('guru', 'guru.id_user = user.id', 'LEFT')
                    ->join('pinjam', 'pinjam.id_user = user.id', 'LEFT')
                    ->where('no_transaksi', $NoTransaksi)
                    ->get();

                $data['count'] = $ReadTransaksi->num_rows();
                if ($data['count'] <= 0)
                    throw new Exception("Transaksi tidak ditemukan");

                $data['user'] = $ReadTransaksi->row();
            }

            // ambil data buku yang dipinjam
            $data['pinjam'] = $this->ListBukuPinjam($data['user']->id_pinjam);
            // $this->librari->printr($data);
            // $this->librari->printr($data);
            return (object) $data;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
    public function CheckoutProccess()
    {
        try {
            // cek kalo belum login
            if ($this->credential->CekCredential() === false) {
                $this->credential->set_userdata('redirect_checkout', base_url('pinjam'));
                throw new Exception("Anda belum login", 100);
            }

            $NoTransaksi = "TR-" .date('dy1') . mt_rand(100, 999);
            $AllowDataPinjam = [
                'id_user'           => $this->credential->userdata('id_user'),
                'no_transaksi'      => $NoTransaksi,
                'total_pinjam_buku' => count($_SESSION['items']),
                'tgl_transaksi'     => date('Y-m-d H:i:s'),
                'status'            => 1

            ];

            // insert transaksi pinjam
            if (!$this->db->insert('pinjam', $AllowDataPinjam))
                throw new Exception("Transaksi gagal dilakukan, silahkan coba beberapa saat lagi");

            // ambil id_pinjam  
            $IdPinjam = $this->db->insert_id();


            $AllowDataDetailPinjam = [];

            // tanggal sekarang
            $now = date('Y-m-d');

            foreach ($_SESSION['items'] as $list) :
                $WaktuPinjam = $list['waktu_pinjam'];

                // insert detail_transaksi
                $AllowDataDetailPinjam[] = [
                    'id_pinjam'      => $IdPinjam,
                    'id_buku'        => $list['id'],
                    'tgl_berakhir'   => date('Y-m-d', strtotime("{$now} + {$WaktuPinjam} days"))
                ];

            endforeach;

            // insert transaksi pinjam
            if (!$this->db->insert_batch('detail_pinjam', $AllowDataDetailPinjam))
                throw new Exception("Transaksi gagal dilakukan, silahkan coba beberapa saat lagi (Detail)");

            // masukan id_pinjam
            $AllowDataPinjam['id_pinjam'] = $IdPinjam;

            // unset keranjang
            unset($_SESSION['items']);

            // masukan ke session
            $_SESSION[sha1('checkout') . '_'] = $AllowDataPinjam;
            $encode = $this->librari->encode($NoTransaksi);
            redirect('checkout/' . $encode);
        } catch (Exception $error) {
            $redirect = base_url();
            if ($error->getCode() == 100)
                $redirect = base_url('login');

            $this->session->set_flashdata("pesan", "<script>Message('" . ($error->getMessage()) . "')</script>");
            redirect($redirect);
        } catch (Throwable $error) {
            $this->session->set_flashdata("pesan", "<script>Message('" . ($error->getMessage()) . "')</script>");
            redirect(base_url());
        }
    }
}
