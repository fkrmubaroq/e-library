<?php
class Buku extends CI_Model
{

    public function getBuku($where)
    {
        $Read = $this->db->select(
            'buku.*,
             kategori_buku.nama_kategori'
        )
            ->from('buku')
            ->join('kategori_buku', 'kategori_buku.id = buku.id_kategori', 'LEFT')
            ->where($where)
            ->get();
        return $Read;
    }

    public function getRatingBuku($where)
    {
        $read = $this->db->select('rating,count(rating) as people_rating')
            ->from('rating_buku')
            ->where($where)
            ->group_by('rating')
            ->get();

        // ambil total rating berdasarkan buku
        $TotalPeopleRating = $this->db->get_where('rating_buku', $where)->num_rows();

        // hitung jumlah datanya
        $count = $read->num_rows();

        // set default
        $data = [];

        // kalo ada datanya
        if ($count > 0)
            $data = $read->result_array();

        // set max rating
        $maxRating = $TotalPeopleRating * 10;
        $rating = 0;
        foreach ($data as $list) :
            $rating += $list['people_rating'] * $list['rating'];
        endforeach;
        $TotalRating = 0;
        if ($rating > 0)
            $TotalRating = ($rating / $maxRating) * 100;

        return number_format($TotalRating, 1);
    }
}
