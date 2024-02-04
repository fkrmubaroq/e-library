<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
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
        $crud->set_table('buku');
        $crud->display_as('cover', 'COVER');
        $crud->display_as('nama_buku', 'NAMA BUKU');
        $crud->display_as('stok', 'STOK');
        $crud->display_as('id_kategori', 'KATEGORI');
        $crud->display_as('file', 'EBOOK');
        $crud->display_as('file_trial', 'EBOOK TRIAL');
        $crud->display_as('penulis', 'PENULIS');
        $crud->display_as('bahasa', 'BAHASA');
        $crud->display_as('tahun', 'TAHUN');

        $crud->set_relation('id_kategori', 'kategori_buku', 'nama_kategori');

        $crud->fields('nama_buku', 'deskripsi', 'stok', 'id_kategori', 'file', 'file_trial', 'cover', 'penulis', 'bahasa', 'tahun');
        $crud->columns('cover', 'penulis', 'nama_buku', 'tahun', 'id_kategori',  'stok', 'file', 'file_trial');

        $crud->callback_insert(array($this, 'insert_buku_callback'));
        $crud->callback_update(array($this, 'update_buku_callback'));

        $crud->unset_clone();
        $crud->unset_jquery();

        $crud->required_fields('nama_buku', 'deskripsi', 'deskripsi', 'id_kategori', 'cover', 'file');
        $crud->set_field_upload('file', 'assets/uploads/files/buku');
        $crud->set_field_upload('file_trial', 'assets/uploads/files/buku');

        $crud->set_field_upload('cover', 'assets/uploads/files/buku/cover');

        $output = $crud->render();
        $data['crud'] = $output;
        $data['page'] = 'Buku/Data';
        // $this->library->printr($data);
        $this->load->view('Templates/Templates', $data);
    }

    public function insert_buku_callback($post_array)
    {
        $post_array['slug_nama_buku'] = $this->librari->slug($post_array['nama_buku']);
        $dataModified = $this->librari->only($post_array, [
            'nama_buku',
            'deskripsi',
            'stok',
            'file',
            'cover',
            'id_kategori',
            'slug_nama_buku',
            'file_trial'

        ]);
        return $this->db->insert('buku', $dataModified);
    }

    public function update_buku_callback($post_array, $primary_key)
    {
        $post_array['slug_nama_buku'] = $this->librari->slug($post_array['nama_buku']);
        $dataModified = $this->librari->only($post_array, [
            'nama_buku',
            'deskripsi',
            'stok',
            'file',
            'cover',
            'id_kategori',
            'slug_nama_buku',
            'file_trial'
        ]);
        return $this->db->update('buku', $dataModified, array('id' => $primary_key));
    }
}
