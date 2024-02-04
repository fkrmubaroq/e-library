<?php

defined('BASEPATH') or exit('No direct script access allowed');


class ControllerBuku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku', 'buku');
    }

    public function Detail($slug)
    {
        try {
            // ambil data buku
            $buku = $this->buku->getBuku([
                'slug_nama_buku' => $slug
            ]);

            $this->load->model('ModelWaktuPinjam', 'waktu');

            // httung jumlah buku
            $data['count_buku'] = $buku->num_rows();

            // cek buku
            if ($data['count_buku'] <= 0)
                throw new Exception("Buku tidak ditemukan");

            $user = $this->librari->SessionData();
            $status = $user['level'] == 'GURU' ? '2' : '1';
            $WaktuPinjam = $this->waktu->getWaktuPinjam(['status' => $status]);
            $data['collections_waktupinjam'] = $WaktuPinjam->result_array();

            // shorthand
            $source = $buku->row();

            // get id_buku
            $IdBuku = $source->id;

            // kalo ada bukunya, maka masukan ke collections
            $data['collections_buku'] = $source;

            $rating = $this->buku->getRatingBuku([
                'id_buku' => $IdBuku
            ]);

            $data['rating'] = $rating;
            $data['status_code'] = 200;
        } catch (Exception $error) {
            $data = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } catch (Throwable $error) {
            $data = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } finally {
            $data['content'] = 'Buku/DetailBuku';
            $data['css'] = [
                'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css'
            ];
            $data['js'] = [
                'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js',
                base_url('assets/js/Buku.js')
            ];
            // $this->librari->printr($data);
            $this->load->view('Template/Template', $data);
        }
    }

    public function RatingBuku($id)
    {
        try {
            $input = $this->input->post();

            // get id buku
            $IdBuku = $this->secure->decode($id);
            if (!is_array($IdBuku))
                throw new Exception('Gagal memberi rating');

            $IdBuku = $IdBuku[0];
            // cek apakah sudah pernah memberi rating
            $CekRating = $this->db->get_where('rating_buku', [
                'id_buku' => $IdBuku,
                'id_siswa' => 1
            ]);

            // kalau sudah memberi rating, maka di update rating nya
            if ($CekRating->num_rows() > 0) {
                $this->db->where([
                    'id_buku' => $IdBuku,
                    'id_siswa' => 1
                ]);
                $this->db->update('rating_buku', ['rating' => $input['rating']]);
            }

            // kalo ga ada, maka insert rating
            else {
                $AllowData = [
                    'id_buku'  => $IdBuku,
                    'id_siswa' => 1,
                    'rating'   => $input['rating']
                ];
                $this->db->insert('rating_buku', $AllowData);
            }
            $data = [
                'status_code' => 200,
                'message'     => 'ok'
            ];
        } catch (Exception $error) {
            $data = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } catch (Throwable $error) {
            $data = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } finally {
            $data['token'] = $this->security->get_csrf_hash();
            echo json_encode($data);
        }
    }

    public function BacaBuku($slug)
    {
        try {


            // ambil data buku
            $buku = $this->buku->getBuku([
                'slug_nama_buku' => $slug
            ]);
            // httung jumlah buku
            $data['count_buku'] = $buku->num_rows();

            // cek buku
            if ($data['count_buku'] <= 0)
                throw new Exception("Buku tidak ditemukan");

            // shorthand
            $source = $buku->row();

            $data['access'] = $this->CekAksesPinjam($source, $source->id)['access'];


            // kalo ada bukunya, maka masukan ke collections
            $data['collection_buku'] = $source;
        } catch (Exception $error) {
            $data = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } catch (Throwable $error) {

            $data = [
                'status_code' => 400,
                'message'     => $error->getMessage()
            ];
        } finally {
            $data['content'] = 'Buku/Baca';
            $data['css'] = [
                base_url('assets/plugin/pdfh5/pdfh5.css')
            ];
            $data['js'] = [
                base_url('assets/plugin/pdfh5/pdf.js'),
                base_url('assets/plugin/pdfh5/pdf.worker.js'),
                base_url('assets/plugin/pdfh5/pdfh5.js'),
                base_url('assets/js/BacaBuku.js')
            ];
            // $this->librari->printr($data);
            $this->load->view('Buku/Baca', $data);
        }
    }

    public function ListPinjam()
    {
        // session_destroy();
        // $this->librari->printr($_SESSION["items"]);
        $data = [
            'content' => 'Buku/Keranjang',
        ];
        $this->load->view("Template/Template", $data);
    }

    public function PinjamBuku($slug)
    {
        try {
            $input = $this->input->get();

            if (!isset($input['waktu_pinjam']))
                throw new Exception("Pilih lama pinjam");
            if (count($_SESSION['items']) >= 3) {
                redirect('pinjam');
                exit(1);
            }

            // ambil data buku
            $buku = $this->buku->getBuku([
                'slug_nama_buku' => $slug
            ]);
            // httung jumlah buku
            $data['count_buku'] = $buku->num_rows();

            // cek buku
            if ($data['count_buku'] <= 0)
                throw new Exception("Buku tidak ditemukan");

            // shorthand
            $source = $buku->row();

            // kalo belum masuk ke keranjang
            if (!isset($_SESSION['items'][$source->id])) {
                $_SESSION['items'][$source->id]['id'] = $source->id;
                $_SESSION['items'][$source->id]['nama_buku'] = $source->nama_buku;
                $_SESSION['items'][$source->id]['nama_kategori'] = $source->nama_kategori;
                $_SESSION['items'][$source->id]['slug_nama_buku'] = $source->slug_nama_buku;
                $_SESSION['items'][$source->id]['bahasa'] = $source->bahasa;
                $_SESSION['items'][$source->id]['deskripsi'] = $source->deskripsi;
                $_SESSION['items'][$source->id]['cover'] = $source->cover;
                $_SESSION['items'][$source->id]['waktu_pinjam'] = $input['waktu_pinjam'];
            } else {
                $_SESSION['items'][$source->id]['waktu_pinjam'] = $input['waktu_pinjam'];
            }

            redirect('pinjam');
        } catch (Exception $error) {
            redirect('error');
        }
    }

    public function RemoveBuku($id)
    {
        try {
            if ($id == null)
                throw new Exception("param kosong");

            // kalo iems nya ga ada, maka beri pesan 'tidak ada'
            if (!isset($_SESSION['items'][$id]))
                throw new Exception("Buku tidak ditemukan");

            $namaBuku = $_SESSION['items'][$id]['nama_buku'];
            unset($_SESSION['items'][$id]);

            $this->session->set_flashdata('pesan', "<script>Message('Buku <b>" . ($namaBuku) . "</b> telah dihapus dalam daftar keranjang')</script>");
            redirect('pinjam');
        } catch (Exception $error) {
            $this->session->set_flashdata('pesan', "<script>Message('" . ($error->getMessage()) . "')</script>");
            redirect('pinjam');
        } catch (Throwable $error) {
            $this->session->set_flashdata('pesan', "<script>Message('" . ($error->getMessage()) . "')</script>");
            redirect('pinjam');
        }
    }

    public function PreviewBuku($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
                /* 
                   Up to you which header to send, some prefer 404 even if 
                   the files does exist for security
                */
                echo "AKSES";
                header('HTTP/1.0 403 Forbidden', TRUE, 403);

                /* choose the appropriate page to redirect users */
                die(header('location: /error.php'));
            }
            // get id buku
            $IdBuku = $this->secure->decode($id);
            if (!is_array($IdBuku))
                throw new Exception('Gagal memberi rating');


            $IdBuku = $IdBuku[0];

            $buku = $this->buku->getBuku([
                'buku.id' => $IdBuku
            ]);

            echo $IdBuku;
            $count = $buku->num_rows();

            // cek buku
            if ($count <= 0)
                throw new Exception("Buku tidak ditemukan");

            // ambil data buku
            $data = $buku->row();

            $source = $this->CekAksesPinjam($data, $IdBuku);

            if ($source['file'] == null)
                die("File Tidak ditemukan");
            // $this->librari->printr($data);
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=" . $source['file']);
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile('./admin/assets/uploads/files/buku/' . $source['file']);
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
    }

    private function CekAksesPinjam($data, $IdBuku)
    {
        $access = 'trial';
        // default buku trial
        $file = $data->file_trial;
        if ($this->credential->cekCredential()) {
            $user = $this->librari->SessionData();
            $ReadPinjam = $this->db->from('pinjam')
                ->join('detail_pinjam', 'detail_pinjam.id_pinjam = pinjam.id', 'LEFT')
                ->where([
                    'detail_pinjam.id_buku'         => $IdBuku,
                    'detail_pinjam.tgl_berakhir >=' => date('Y-m-d'),
                    'pinjam.id_user'                => $user['id_user'],
                    'pinjam.status'                 => '2'
                ])
                ->get();

            // kalo bukunya sudah pinjam dan tidak hangus masa pinjamnya
            if ($ReadPinjam->num_rows() > 0) {
                $file = $data->file;
                $access = 'open';
            }
        }

        return [
            'file'      => $file,
            'access'    => $access
        ];
    }
}
