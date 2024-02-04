<?php
class ModelLogin extends CI_Model
{
    public function cekLogin($data)
    {
        try {
            $cek = $this->db->select('
                user.username,
                user.password,
                user.id,
                user.is_aktif,
                user.level')
                ->from('user')
                ->where([
                    'username' => $data['username'],
                    'is_aktif' => '1'
                ])->get();
            if ($cek->num_rows() <= 0)
                throw new Exception("Username tidak terdaftar");

            $source = $cek->row();
            // $this->librari->printr($source); 
            // masukan username & level
            $data['id'] = $source->id;
            $data['username'] = $source->username;
            $data['level'] = $source->level;

            // cek keaktifan akun
            if ($source->is_aktif != '1')
                throw new Exception("Akun anda telah di non aktifkan, silahkan hubungi administrator");

            //cek password
            if (!password_verify($data['password'], $source->password))
                throw new Exception("Password salah, silahkan coba lagi");

            // cek level kalo siswa, guru , dll 
            if ($source->level == 'SISWA') {
                $ReadSiswa = $this->db->get_where('siswa', ['id_user' => $source->id]);
                if ($ReadSiswa->num_rows() <= 0)
                    throw new Exception("akun belum terdaftar");

                $source = $ReadSiswa->row();
                $data['nama_user'] = $source->nama_siswa;
            }
            // kalo guru
            elseif ($source->level == 'GURU') {
                $ReadGuru = $this->db->get_where('guru', ['id_user' => $source->id])->row();
                $data['nama_user'] = $ReadGuru->nama_guru;
            }

            // set Level
            return $data;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
