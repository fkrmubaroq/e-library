<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
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
        $crud->set_table('pinjam');
        $crud->display_as('no_transaksi', 'NO.PINJAM');
        $crud->display_as('id_user', 'NAMA USER');
        $crud->display_as('total_pinjam_buku', 'TOTAL');
        $crud->display_as('tgl_transaksi', 'TGL PINJAM');
        $crud->display_as('status', 'STATUS PINJAM');

        $crud->fields('no_transaksi', 'id_user', 'total_pinjam_buku', 'tgl_transaksi', 'status');
        $crud->columns('no_transaksi', 'no_induk', 'nama_user', 'total_pinjam_buku', 'tgl_transaksi', 'status');

        $crud->unset_clone();
        $crud->unset_read();
        $crud->unset_jquery();

        $crud->add_action('Detail Pinjam', '', 'pinjam/detail', 'ui-icon-arrowreturn-1-e');

        $crud->callback_column('no_induk', array($this, '_field_noinduk'));
        $crud->callback_column('nama_user', array($this, '_field_nama_user'));
        $crud->callback_column('total_pinjam_buku', array($this, '_field_total_pinjam'));
        $crud->callback_column('status', array($this, '_field_status'));

        $crud->required_fields('no_transaksi', 'id_user', 'total_pinjam_buku', 'tgl_transaksi', 'status');
        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Pinjam/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }


    public function BatalPinjam($id)
    {
        try {
            @$decode = $this->secure->decode($id);
            $noTransaksi = $decode[0];
            $idPinjam = $decode[1];

            $cekTransaksi = $this->db->get_where('pinjam', ['no_transaksi' => $noTransaksi]);

            // cek validitas peminjaman
            if ($cekTransaksi->num_rows() <= 0)
                throw new Exception("Transaksi Peminjaman tidak ditemukan");

            // kalo ada, maka update pinjam rubah status nya jadi acc
            $this->db->where(['no_transaksi' => $noTransaksi]);
            $this->db->update('pinjam', ['status' => '1']);


            $this->session->set_flashdata('pesan', "Snackbar.show({pos: 'top-center' actionText: 'OKE', text: 'Peminjaman telah di BATALKAN'});");
        } catch (Exception $error) {
            $this->session->set_flashdata('pesan', "Snackbar.show({pos: 'top-center' actionText: 'OKE', text: '" . $error->getMessage() . "'});");
        } catch (Throwable $error) {
            $this->session->set_flashdata('pesan', "Snackbar.show({pos: 'top-center' actionText: 'OKE', text: '" . $error->getMessage() . "'});");
        } finally {
            redirect("pinjam/detail/{$idPinjam}");
        }
    }
    public function AccPinjam($noTransaksi, $idPinjam)
    {
        try {

            $cekTransaksi = $this->db->get_where('pinjam', ['no_transaksi' => $noTransaksi]);

            // cek validitas peminjaman
            if ($cekTransaksi->num_rows() <= 0)
                throw new Exception("Transaksi Peminjaman tidak ditemukan");

            // kalo ada, maka update pinjam rubah status nya jadi acc
            $this->db->where(['no_transaksi' => $noTransaksi]);
            $this->db->update('pinjam', ['status' => '2']);


            $this->session->set_flashdata('pesan', "Snackbar.show({pos: 'top-center' actionText: 'OKE', text: 'Peminjaman telah di ACC'});");
        } catch (Exception $error) {
            $this->session->set_flashdata('pesan', "Snackbar.show({pos: 'top-center' actionText: 'OKE', text: '" . $error->getMessage() . "'});");
        } catch (Throwable $error) {
            $this->session->set_flashdata('pesan', "Snackbar.show({pos: 'top-center' actionText: 'OKE', text: '" . $error->getMessage() . "'});");
        } finally {
            redirect("pinjam/detail/{$idPinjam}");
        }
    }
    public function DetailPinjam($id)
    {
        try {
            $this->load->library('QrcodeLibrary');

            $InformasiUser = $this->db->select("user.id as id_user,user.level,pinjam.*")
                ->from('pinjam')
                ->join('user', 'user.id = pinjam.id_user', 'LEFT')
                ->where('pinjam.id', $id)
                ->get();
            $tampung = [];
            $data['transaksi'] = $InformasiUser->row();
            foreach ($InformasiUser->result_array() as $list) :
                if ($list['level'] == 'SISWA') {

                    $getSiswa = $this->db->select('siswa.nama_siswa as nama_user, siswa.*')
                        ->from('siswa')
                        ->where(['id_user' => $list['id_user']])
                        ->get();
                    if ($getSiswa->num_rows() > 0)
                        $tampung = $getSiswa->result_array();
                }

                // kalo guru
                elseif ($list['level'] == 'GURU') {

                    $getGuru = $this->db->select('guru.nama_guru as nama_user, guru.*')
                        ->from('guru')
                        ->where(['id_user' => $list['id_user']])
                        ->get();
                    if ($getGuru->num_rows() > 0)
                        $tampung = $getGuru->result_array();
                }

            endforeach;

            $DetailPinjam = $this->db->from('detail_pinjam')
                ->join('buku', 'buku.id = detail_pinjam.id_buku', 'LEFT')
                ->join('pinjam', 'pinjam.id = detail_pinjam.id_pinjam', 'LEFT')
                ->where(['id_pinjam' => $id])
                ->get();

            if ($DetailPinjam->num_rows() <= 0)
                throw new Exception("Detail pinjam tidak ditemukan");

            $data['user'] = count($tampung) > 0  ? $tampung[0] : [];
            $data['collections'] = $DetailPinjam->result_array();
            $data['count'] = $DetailPinjam->num_rows();
            $data['page'] = 'Pinjam/Detail';
            // $this->librari->printr($data);
            $this->load->view("Templates/Templates", $data);
        } catch (Exception $error) {
            redirect("");
        }
    }

    public function _field_total_pinjam($value)
    {
        return "{$value} buku";
    }

    public function _field_status($value)
    {
        $status = "Tidak diketahui";
        if ($value == '1')
            $status = "<i class='fas fa-sync-alt'></i> PROSES";
        elseif ($value == '2')
            $status = "<span class='text-success'><i class='fas fa-check-circle'></i> ACC</span>";

        return "<div class='text-center'>{$status}</div>";
    }

    public function _field_noinduk($value, $row)
    {

        // ambil user 
        $cekLevelUser = $this->db->get_where('user', ['id' => $row->id_user]);
        if ($cekLevelUser->num_rows() <= 0)
            return "<b class='text-danger'>Peminjam tidak diketahui</b>";

        $source = $cekLevelUser->row();
        $level = $source->level;

        // cek apakah siswa / guru / lain
        if ($level == 'SISWA') {
            $getUser = $this->db->get_where('siswa', ['id_user' => $row->id_user]);
            if ($getUser->num_rows() <= 0)
                return "<b class='text-danger'>Peminjam tidak diketahui</b>";

            $sourceInduk = $getUser->row();

            // return nomor_induk
            return $sourceInduk->no_induk;
        }
        // kalo usernya guru
        elseif ($level == 'GURU') {
            $getUser = $this->db->get_where('guru', ['id_user' => $row->id_user]);
            if ($getUser->num_rows() <= 0)
                return "<b class='text-danger'>Peminjam tidak diketahui</b>";

            $sourceInduk = $getUser->row();

            // return nomor_induk
            return $sourceInduk->no_induk;
        } elseif ($level == 'DLL') {

            // return tamu
            return "TAMU";
        }

        return "<b class='text-danger'>Peminjam tidak diketahui</b>";
    }

    public function _field_nama_user($value, $row)
    {
        // ambil user 
        $cekLevelUser = $this->db->get_where('user', ['id' => $row->id_user]);
        if ($cekLevelUser->num_rows() <= 0)
            return "<b class='text-danger'>Peminjam tidak diketahui</b>";

        $source = $cekLevelUser->row();
        $level = $source->level;

        // cek apakah siswa / guru / lain
        if ($level == 'SISWA') {
            $getUser = $this->db->get_where('siswa', ['id_user' => $row->id_user]);
            if ($getUser->num_rows() <= 0)
                return "<b class='text-danger'>Peminjam tidak diketahui</b>";

            $sourceInduk = $getUser->row();

            // return nomor_induk
            return $sourceInduk->nama_siswa;
        }
        // kalo usernya guru
        elseif ($level == 'GURU') {
            $getUser = $this->db->get_where('guru', ['id_user' => $row->id_user]);
            if ($getUser->num_rows() <= 0)
                return "<b class='text-danger'>Peminjam tidak diketahui</b>";

            $sourceInduk = $getUser->row();

            // return nomor_induk
            return $sourceInduk->nama_guru;
        } elseif ($level == 'DLL') {

            // return tamu
            return $source->username;
        }

        return "<b class='text-danger'>Peminjam tidak diketahui</b>";
    }
}
