<?php
/* ==================== [ MODE Templating] ====================
 * Auto  : Keyword pada template, yang awalan formatnya ${{<Keyword>}}
 * Input : Keyword ini untuk menampilkan inputan 
 *         sesuai dengan keyword pada template yang diminta 
 *         formatnya Input->${Keyword}
 *                   Select->$(Keyword)
 *                   Textarea->${Keyword}
 *                   Get->${Keyword}
 */

class TemplatingDisposisi
{
    public $TextTemplate;
    public $FiturInput = [];
    public function __construct()
    {
        $this->CI = &get_instance();
    }


    public function AutoRun($data = null)
    {

        $this->TemplatingAutoKeyword($data);
        return $this;
    }


    public function AutoRunSecondary($data = null)
    {
        $this->TemplatingAutoFillKeyword($data);
        return $this;
    }

    // {{ }}
    private function AllowAutoKeyword()
    {


        return [
            'Lembar Disposisi Now',
            'Date Now',
            'Satker Now',
            'Name Now',
            'Pangkat Now',
            'NIP Now',
            'Naskah Now',
            'Tanggal Masuk Disposisi',
            'Catatan Disposisi Balasan'

        ];
    }

    private function AllowLinkKeyword()
    {


        return [
            'Naskah',
            'Naskah Stack',
            'Catatan Counter',
        ];
    }

    // {{{ }}}
    private function AllowAutoFillInputKeyword()
    {

        return [
            'Nomor Surat',
            'Perihal',

        ];
    }
    // Nama_input->{keyword}
    private function AllowInputKeyword()
    {
        return [
            'Input',
            'Get',
            'List', // Select
            'Textarea',
            'MultipleList',
        ];
    }

    private function AllowBalasanKeyword()
    {
        return [
            'Input',
            'Get',
            'List', // Select
            'Textarea',
            'MultipleList',
            'Link'
        ];
    }
    // =============================== [ CONCAT & GETLIST ] ===============================
    private function ConcatAllowInputKeyword()
    {
        $tampung = '';
        $length = count($this->AllowInputKeyword()) - 1;
        $x = 0;
        foreach ($this->AllowInputKeyword() as $list) :
            if ($x == $length)
                $tampung .= $list . '->';
            else
                $tampung .= $list . '->|';
            $x++;
        endforeach;

        return $tampung;
    }

    private function ConcatAllowAutoFillInputKeyword()
    {
        $tampung = '';
        $length = count($this->AllowInputKeyword()) - 1;
        $x = 0;
        foreach ($this->AllowInputKeyword() as $list) :
            if ($x == $length)
                $tampung .= $list . '->';
            else
                $tampung .= $list . '->|';
            $x++;
        endforeach;

        return $tampung;
    }

    private function ConcatAllowBalasanKeyword()
    {
        $tampung = '';
        $length = count($this->AllowBalasanKeyword()) - 1;
        $x = 0;
        foreach ($this->AllowBalasanKeyword() as $list) :
            if ($x == $length)
                $tampung .= $list . '->';
            else
                $tampung .= $list . '->|';
            $x++;
        endforeach;

        return $tampung;
    }


    private function GetListAutoKeyword()
    {
        $Pattern = "/\\$\{\{[a-zA-Z0-9\s-]*\}\}/i";
        if (preg_match_all($Pattern, $this->TextTemplate, $Matches))
            return $Matches[0];

        return [];
    }

    private function GetListLinkKeyword()
    {
        $Pattern = "/Link->\\$\{[a-zA-Z0-9\s-]*\}/i";
        if (preg_match_all($Pattern, $this->TextTemplate, $Matches))
            return $Matches[0];

        return [];
    }

    private function GetListLinkBalasanKeyword()
    {
        $Pattern = "/Link->\\$\[[a-zA-Z0-9\s-]*\]/i";
        if (preg_match_all($Pattern, $this->TextTemplate, $Matches))
            return $Matches[0];

        return [];
    }
    private function GetListAutoFillInputKeyword()
    {
        $InputPattern = $this->ConcatAllowAutoFillInputKeyword();

        $Pattern = "/({$InputPattern})\\$\{\{\{[a-zA-Z\s0-9]*\}\}\}/";

        if (preg_match_all($Pattern, $this->TextTemplate, $Matches))
            return $Matches[0];

        return [];
    }

    private function GetListInputKeyword()
    {

        $InputPattern = $this->ConcatAllowInputKeyword();
        // pola regex
        $pattern = "/({$InputPattern})\\$\{[a-zA-Z\s0-9]*\}/";
        if (preg_match_all($pattern, $this->TextTemplate, $Hasil))
            return $Hasil[0];

        return [];
    }

    private function GetListBalasanKeyword()
    {

        $InputPattern = $this->ConcatAllowBalasanKeyword();
        // pola regex
        $pattern = "/({$InputPattern})\\$\[[a-zA-Z\s0-9]*\]/";
        if (preg_match_all($pattern, $this->TextTemplate, $Hasil))
            return $Hasil[0];

        return [];
    }

    // =============================== [ REQUEST API ] ===============================

    private function RequestAutoKeyword($Keyword, $input = null)
    {
        try {
            $Text = NULL;
            // cari keyword
            switch ($Keyword) {
                    // SECTION
                case 'Lembar Disposisi Now':
                    if (!isset($input['templating']))
                        return NULL;

                    $input = $input['templating'];
                    // kalo nomor_takah tidak lengkap, maka jangan return apapun
                    if (empty($input['pokok_persoalan']) or  empty($input['anak_persoalan']) or empty($input['cucu_persoalan']))
                        return NULL;

                    $request = $this->CI->api->get(
                        'surat_masuk',
                        "id_pokok_persoalan={$input['pokok_persoalan']}&id_anak_persoalan={$input['anak_persoalan']}&id_cucu_persoalan={$input['cucu_persoalan']}"
                    );
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Lembar Disposisi Now)');

                    // isi variabel Text
                    $Text = ($request->count_filtered + 1);

                    break;

                    // SECTION
                case 'Date Now':
                    // isi variabel Text
                    $Text = $this->CI->librari->DateNow(date('Y-m-d'));

                    break;

                    // SECTION
                case 'Satker Now':
                    // request credential, untuk ambil 'nama_satker'
                    $request = $this->CI->credential->CekCredential();

                    // isi variabel Text
                    $Text = $request->nama_satker;

                    break;

                    // SECTION
                case 'Name Now':
                    // request credential, untuk ambil 'nama_user'
                    $request = $this->CI->credential->CekCredential();

                    // isi variabel Text
                    $Text = $request->nama_anggota;

                    break;

                    // SECTION
                case 'Pangkat Now':
                    // request credential, untuk ambil 'nama_pangkat'
                    $request = $this->CI->credential->CekCredential();

                    // isi variabel Text
                    $Text = $request->nama_pangkat;

                    break;


                    // SECTION
                case ($Keyword == 'NIP Now' || $Keyword == 'NRP Now'):
                    // request credential, untuk ambil 'nama_pangkat'
                    $request = $this->CI->credential->CekCredential();
                    // isi variabel Text
                    $Text = $request->nrp;
                    break;

                    // SECTION
                case 'Naskah Now':

                    // isi variabel Text
                    $Text = 'N-1';

                    break;

                case 'Tanggal Masuk Disposisi':
                    // cek kalo param 'input' tidak kosong
                    if ($input == null)
                        throw new Exception("perlu parameter pendukung");

                    // cek kalo datanya ada, tapi merupakan string atau angka minus (signed)
                    if (isset($input['id_surat_masuk']) && $input['id_surat_masuk'] <= 0)
                        throw new Exception("param 'id_surat_masuk_secondary' tidak kompatibel");

                    $IdSuratMasukSecondary = $input['id_surat_masuk'];

                    // request surat_masuk_secondary
                    $request = $this->CI->api->get('surat_masuk_secondary/get', "id={$IdSuratMasukSecondary}");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Surat Masuk Secondary tanggal)');

                    // cek jumlah data
                    if ($request->count_filtered <= 0)
                        throw new Exception('surat masuk tidak ditemukan (secondary tanggal)');

                    // shorthand 
                    $source = $request->data[0];

                    // isi variabel Text
                    $Text = $source->tanggal_surat;

                    break;

                case 'Catatan Disposisi Balasan':
                    // $this->CI->librari->printr($input);

                    // cek kalo param 'input' tidak kosong
                    if ($input == null)
                        throw new Exception("perlu parameter pendukung");

                    // cek kalo datanya ada, tapi merupakan string atau angka minus (signed)
                    if (isset($input['id_surat_masuk']) && $input['id_surat_masuk'] <= 0)
                        throw new Exception("param 'id_surat_masuk_secondary' tidak kompatibel");

                    $IdSuratMasukSecondary = $input['id_surat_masuk'];

                    // request surat_masuk_secondary
                    $request = $this->CI->api->get('surat_masuk', "id={$IdSuratMasukSecondary}");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Surat Masuk Secondary)');

                    // cek jumlah data
                    if ($request->count_filtered <= 0)
                        throw new Exception('surat masuk tidak ditemukan (secondary)');

                    // shorthand 
                    $source = $request->data[0];

                    // ambil 'data_template_disposisi' , dan decode json
                    $DataTemplate = json_decode($source->data_template_disposisi_primary);

                    // isi variabel Text
                    $Text = "";

                    // cek data pada data template disposisi dengan keyword 'catatan_disposisi_balasan'
                    if (isset($DataTemplate->catatan_disposisi_balasan))
                        $Text = $DataTemplate->catatan_disposisi_balasan;

                    break;
            }

            // return dd

            return $Text;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Throwable($error->getMessage());
        }
    }


    private function RequestAutoFillKeyword($Keyword, $input = null)
    {
        try {
            $Text = NULL;
            // cari keyword
            switch ($Keyword) {

                case 'Nomor Surat':
                    // cek kalo param 'input' tidak kosong
                    if ($input == null)
                        throw new Exception("perlu parameter pendukung");

                    // cek kalo datanya ada, tapi merupakan string atau angka minus (signed)
                    if (isset($input->id) && $input->id <= 0)
                        throw new Exception("param 'id_surat_masuk_secondary' tidak kompatibel (nomor surat)");

                    $IdSuratMasukSecondary = $input->id;

                    // request surat_masuk_secondary
                    $request = $this->CI->api->get('surat_masuk_secondary/get', "id={$IdSuratMasukSecondary}");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Surat Masuk Secondary nomor surat)');

                    // cek jumlah data
                    if ($request->count_filtered <= 0)
                        throw new Exception('surat masuk tidak ditemukan (secondary nomor surat)');

                    // shorthand 
                    $source = $request->data[0];

                    // isi variabel Text
                    $Text = $source->nomor_surat;

                    break;
            }

            // return dd

            return $Text;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage() . ' line : ' . $error->getLine());
        }
    }


    // request | fungsi ini untuk tipe inputan nya 'Get'
    private function RequestApiGet($RequestName = null, $data = null)
    {
        try {
            if ($RequestName == null)
                throw new Exception('request kosong (GET)');

            // set default var 'Text'
            $Text = '';

            // cari request
            switch ($RequestName) {

                    // kalo pokok persolan
                case 'Pokok Persoalan':

                    // cek datanya, kalo kosong
                    if ($data == null) return false;

                    $id = $data;
                    if (is_array($data))
                        $id = $data['id'];

                    // request credential, untuk ambil 'nama_pangkat'
                    $request = $this->CI->api->get('pokok', "id={$id}");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Pokok Persoalan)');

                    // cek ketersediaan datanya
                    if ($request->count_filtered <= 0)
                        throw new Exception('Pokok persoalan tidak ditemukan (Pokok Persoalan)');

                    // isi variabel Text
                    $Text = $request->data[0]->kode_pokok_persoalan;
                    break;

                    // kalo anak persolan
                case 'Anak Persoalan':

                    // cek datanya, kalo kosong
                    if ($data == null) return false;

                    $id = $data;
                    if (is_array($data))
                        $id = $data['id'];

                    // request credential, untuk ambil 'nama_pangkat'
                    $request = $this->CI->api->get('pokok_anak', "id={$id}");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Anak Persoalan)');

                    // cek ketersediaan datanya
                    if ($request->count_filtered <= 0)
                        throw new Exception('Anak persoalan tidak ditemukan (Anak Persoalan)');

                    // isi variabel Text
                    $Text = $request->data[0]->kode_anak_persoalan;
                    break;

                    // kalo cucu persolan
                case 'Cucu Persoalan':

                    // cek datanya, kalo kosong
                    if ($data == null) return false;

                    $id = $data;
                    if (is_array($data))
                        $id = $data['id'];

                    // request credential, untuk ambil 'nama_pangkat'
                    $request = $this->CI->api->get('pokok_anak_cucu', "id={$id}");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Cucu Persoalan)');

                    // cek ketersediaan datanya
                    if ($request->count_filtered <= 0)
                        throw new Exception('Cucu persoalan tidak ditemukan (Cucu Persoalan)');

                    // isi variabel Text
                    $Text = $request->data[0]->kode_cucu_persoalan;
                    break;
            }

            return $Text;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage() . ' - ' . $error->getLine());
        }
    }


    // fungsi ini untuk tipe inputan nya 'List'
    private function RequestApiList($RequestName = null, $data = null)
    {
        try {
            if ($RequestName == null)
                throw new Exception('request kosong (GET)');

            // set default var 'Text'
            $Text = '';

            // cari request
            switch ($RequestName) {

                    // kalo 'Kepada Yth'
                case 'Kepada Yth':

                    // cek datanya, kalo kosong
                    if ($data == null)
                        throw new Exception('data list kosong');


                    $id = $data;
                    if (is_array($data))
                        $id = $data['id'];

                    // request api list data komandan & wadan
                    $request = $this->CI->api->get('satker', "id_anggota={$id}&level_satker=komandan_wadan&allow_gelar=yes");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (List Kepada Yth)');

                    // cek ketersediaan datanya
                    if ($request->count_filtered <= 0)
                        throw new Exception('data tidak ditemukan (List Kepada Yth)');

                    // shorthand untuk pemanggilan data request
                    $source = $request->data[0];

                    // ambil level_satker
                    $LevelSatker = $source->level_satker;

                    // isi variabel Text
                    if ($LevelSatker == '1')
                        $Text = "Satker {$source->nama_satker}";
                    elseif ($LevelSatker == '2')
                        $Text = 'Komandan';
                    elseif ($LevelSatker == '3')
                        $Text = 'Wakil Komandan';

                    break;
            }

            return $Text;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage() . ' - ' . $error->getLine());
        }
    }

    private function RequestApiMultipleList($RequestName, $data)
    {
        try {
            if ($RequestName == null)
                throw new Exception('request kosong MULTIPLE (GET)');

            // set default var 'Text'
            $Text = '';
            // cari request
            switch ($RequestName) {

                    // kalo 'Kepada Yth'
                case 'Kepada Yth Balasan':
                    // cek datanya, kalo kosong
                    if ($data == null)
                        throw new Exception('data multiple list kosong');

                    // cek datanya 'kepada_yth'
                    if (!isset($data['kepada_yth_balasan']))
                        throw new Exception("param 'kepada_yth_balasan' tidak tersedia");

                    // decode data 
                    $DecodeData = json_decode($data['kepada_yth_balasan'], true);

                    $TampungData = '';
                    $x = 1;
                    foreach ($DecodeData as $list) :
                        // request api list data komandan & wadan
                        $request = $this->CI->api->get('satker', "id_anggota={$list}&level_satker=biasa&allow_gelar=yes");

                        // cek request
                        if ($request->status_code != 200)
                            throw new Exception($request->message . ' (Multiple List Kepada Yth)');

                        // cek ketersediaan datanya
                        if ($request->count_filtered <= 0)
                            throw new Exception('data tidak ditemukan (Multiple List Kepada Yth)');

                        $source = $request->data[0];

                        // $this->CI->librari->printr($request);
                        // masukin hasil request nya ke variabel
                        $TampungData .= "<ul style='list-style:none; margin:0; padding:0; margin-bottom:4px'>";
                        // $TampungData .= "<li class='fweight-700'>{$source->ketua_satker}</li>";
                        $TampungData .= "<li>{$source->nama_satker}</li>";
                        $TampungData .= "</ul>";
                    endforeach;


                    // return 
                    $Text = $TampungData;

                    break;

                case 'Diteruskan Kepada Yth Secondary':
                    // cek datanya, kalo kosong
                    if ($data == null)
                        throw new Exception('data multiple list kosong');

                    // decode data 
                    $DecodeData = json_decode($data, true);

                    $TampungData = '';
                    $x = 1;
                    foreach ($DecodeData as $list) :
                        // echo $list;
                        $IdSatker = $this->CI->credential->userdata('id_satker');

                        // request api list data komandan & wadan
                        $request = $this->CI->api->get('sub_satker', "id_anggota={$list}&id_satker={$IdSatker}");
                        // $this->CI->librari->printr($request, false);
                        // cek request
                        if ($request->status_code != 200)
                            throw new Exception($request->message . ' (Multiple List Kepada Yth)');

                        // cek ketersediaan datanya
                        if ($request->count_filtered <= 0)
                            throw new Exception('data tidak ditemukan (Multiple List Kepada Yth)');

                        $source = $request->data[0];

                        // $this->CI->librari->printr($request);
                        // masukin hasil request nya ke variabel
                        $TampungData .= "<ul style='list-style:none; margin:0; padding:0; margin-bottom:4px'>";
                        // $TampungData .= "<li class='fweight-700'>{$source->ketua_satker}</li>";
                        $TampungData .= "<li>{$source->nama_sub_satker} <span style='font-family: DejaVu Sans; font-size: 12px;'>&#x2714;</span></li>";
                        $TampungData .= "</ul>";
                    endforeach;


                    // return 
                    $Text = $TampungData;
                    break;
            }
            return $Text;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage() . ' - ' . $error->getLine());
        }
    }

    private function RequestLinkList($keyword, $link, $data = null)
    {
        try {
            // echo $keyword;
            $Text = '';
            switch ($keyword) {
                case $keyword == 'Naskah' || $keyword == 'Naskah Stack':
                    // cek param 'data' nya
                    if ($data == null)
                        throw new Exception("param 'data' tidak ada (Naskah)");

                    // cek param 'data' nya
                    if (!is_array($data))
                        throw new Exception("param 'data' tidak didukung (Naskah)");

                    // cek kalo ada data 'poko_persoalan', 'anak_persoalan', 'cucu_persoalan'
                    if (!empty($data['pokok_persoalan']) and !empty($data['anak_persoalan']) and !empty($data['cucu_persoalan'])) {

                        // $this->CI->librari->printr($data, false);
                        // parameter untuk request
                        $param = [
                            'id_pokok_persoalan' => $data['pokok_persoalan'],
                            'id_anak_persoalan'  => $data['anak_persoalan'],
                            'id_cucu_persoalan'  => $data['cucu_persoalan'],
                            'id_template_disposisi' => $data['id_template_disposisi']

                        ];

                        // request 'catatan_counter'
                        $request = $this->CI->api->get('surat_masuk/naskah_counter', $this->CI->librari->ArrayToGet($param));

                        // cek request
                        if ($request->status_code != 200)
                            throw new Exception($request->message);

                        // default naskah
                        $Naskah = 1;

                        // cek datanya terpenuhi
                        if (count($request->data) > 0)
                            $Naskah = $request->data[0]->naskah_counter + 1;


                        // kalo keywordnya 'Naskah'
                        if ($keyword == 'Naskah') {
                            foreach ($link as $key => $value) :
                                $Margin = 25;
                                if (strlen($value) > 100)
                                    $Margin = 25 * ceil((strlen($value) / 100));

                                $Text .= "<li style='list-style:none; margin-bottom:" . ($Margin) . "px'>N-{$Naskah}</li>";
                                $Naskah++;
                            endforeach;
                        } elseif ($keyword == 'Naskah Stack') {
                            $counter = 1;
                            foreach ($link as $key => $value) :
                                if ($counter == count($link) - 1)
                                    $Text .= "N-{$Naskah} ";
                                elseif ($counter != count($link))
                                    $Text .= "N-{$Naskah}, ";
                                else
                                    $Text .= "dan N-{$Naskah}";

                                $counter++;
                                $Naskah++;
                            endforeach;
                        }
                    }
                    break;

                case 'Catatan Counter':
                    // cek param 'data' nya
                    if ($data == null)
                        throw new Exception("param 'data' tidak ada (Naskah)");

                    // cek param 'data' nya
                    if (!is_array($data))
                        throw new Exception("param 'data' tidak didukung (Naskah)");

                    // cek kalo ada data 'poko_persoalan', 'anak_persoalan', 'cucu_persoalan'
                    if (empty($data['pokok_persoalan']) || empty($data['anak_persoalan']) || empty($data['cucu_persoalan']))
                        throw new Exception('takah tidak lengkap, silahkan isi takah dengan benar (Catatan Counter)');

                    // parameter untuk request
                    $param = [
                        'id_pokok_persoalan' => $data['pokok_persoalan'],
                        'id_anak_persoalan'  => $data['anak_persoalan'],
                        'id_cucu_persoalan'  => $data['cucu_persoalan'],
                        'id_template_disposisi' => $data['id_template_disposisi']
                    ];

                    // request 'catatan_counter'
                    $request = $this->CI->api->get('surat_masuk/catatan_counter', $this->CI->librari->ArrayToGet($param));

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message);

                    // cek datanya
                    if (count($request->data) > 0) {
                        // shorthand request
                        $source = $request->data[0];

                        $Text .= "C-" . ($source->catatan_counter + 1);
                    }
                    break;
            }

            return $Text;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage() . ' - ' . $error->getLine());
        }
    }

    // keyword untuk mode auto
    private function TemplatingAutoKeyword($input = null)
    {
        try {
            // $this->CI->librari->printr($input);
            // pola regex untuk menghilangkan karakter '$', '{{' dan '}}'
            $pattern = "/\\$\{\{|\}\}/";

            // set default fitur to NULL
            $fitur = NULL;

            // ambil display data
            $display = $this->TextTemplate;

            // untuk mode 'Auto'
            foreach ($this->GetListAutoKeyword() as $list) :

                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $keyword = trim(preg_replace($pattern, '', $list));

                // kalo keywordnya tersedia di AllowAutoKeyword(), maka jalankan request api
                if (in_array($keyword, $this->AllowAutoKeyword())) {
                    $fitur = $this->RequestAutoKeyword($keyword, $input);

                    // pattern
                    $PatternTemplate = "/\\$\{\{{$keyword}*\}\}/";
                    $display = preg_replace($PatternTemplate, $fitur, $display);
                }
            endforeach;

            $this->TextTemplate = $display;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
    }

    // keyword untuk mode auto
    private function TemplatingAutoFillKeyword($input = null)
    {
        try {
            $InputPattern = $this->ConcatAllowInputKeyword();

            // pola regex untuk menghilangkan karakter '$', '{{' dan '}}'
            $pattern = "/({$InputPattern})\\$\{\{\{|\}\}\}/";

            // set default fitur to NULL
            $fitur = NULL;

            // ambil display data
            $display = $this->TextTemplate;

            // untuk mode 'Auto'
            foreach ($this->GetListAutoFillInputKeyword() as $list) :

                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $keyword = trim(preg_replace($pattern, '', $list));

                // kalo keywordnya tersedia di AllowAutoKeyword(), maka jalankan request api
                if (in_array($keyword, $this->AllowAutoFillInputKeyword())) {
                    $fitur = $this->RequestAutoFillKeyword($keyword, $input);

                    // pattern
                    $PatternTemplate = "/({$InputPattern})\\$\{\{\{{$keyword}*\}\}\}/";
                    $display = preg_replace($PatternTemplate, $fitur, $display);
                }
            endforeach;

            $this->TextTemplate = $display;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage() . ' line : ' . $error->getLine();
        }
    }
    // tampil inputan yang diberi nama_input->{{{keyword}}}
    public function TemplatingAutoFillInputKeyword($data, $mode = 'primary')
    {
        try {


            // pola regex unuk menghilangkan '$','{','}'
            $pattern = "/\\$\{\{\{|\}\}\}/";

            // set default 'FiturInput'
            $FiturInput = [];

            // untuk mode 'Auto'
            foreach ($this->GetListAutoFillInputKeyword() as $list) :

                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $KeywordInput = trim(preg_replace($pattern, '', $list));

                // pecah menjadi 2 bagian, dengan pemisah '->'
                // yang pertama 'tipe inputan'
                // kedua 'nama inputan'
                $ExplodeKeyword = explode('->', $KeywordInput);

                // set default ke NULL 
                $TipeInputan = NULL;
                $NamaInputan = NULL;

                // cek keyword nya kalo ada, maka dimasukan ke variabel
                if (is_array($ExplodeKeyword) and count($ExplodeKeyword) > 0) {
                    $TipeInputan = $ExplodeKeyword[0];
                    $NamaInputan = $ExplodeKeyword[1];
                }


                // kalo keywordnya tersedia di AllowInputKeyword(),
                // maka jalankan request api
                if (in_array($TipeInputan, $this->AllowInputKeyword())) {
                    $InformationInput = [
                        'type'  => $TipeInputan,
                        'name'  => $NamaInputan
                    ];

                    // kalo tipenya Input,Textarea
                    if ($InformationInput['type'] == 'Textarea' || $InformationInput['type'] == 'Input') {

                        $FiturInput[] = $this->DisplayInputAutoFill([
                            'mode'          => $mode,
                            'information'   => $InformationInput,
                            'data_support'  => $data
                        ]);
                    }
                }
            endforeach;

            $this->FiturInput = $FiturInput;
            return $this;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
    }

    public function TemplatingInputKeyword()
    {
        try {


            // pola regex unuk menghilangkan '$','{','}'
            $pattern = "/\\$\{|\}/";

            // set default 'FiturInput'
            $FiturInput = $this->FiturInput;

            // untuk mode 'Auto'
            foreach ($this->GetListInputKeyword() as $list) :

                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $KeywordInput = trim(preg_replace($pattern, '', $list));

                // pecah menjadi 2 bagian, dengan pemisah '->'
                // yang pertama 'tipe inputan'
                // kedua 'nama inputan'
                $ExplodeKeyword = explode('->', $KeywordInput);

                // set default ke NULL 
                $TipeInputan = NULL;
                $NamaInputan = NULL;

                // cek keyword nya kalo ada, maka dimasukan ke variabel
                if (is_array($ExplodeKeyword) and count($ExplodeKeyword) > 0) {
                    $TipeInputan = $ExplodeKeyword[0];
                    $NamaInputan = $ExplodeKeyword[1];
                }


                // kalo keywordnya tersedia di AllowInputKeyword(),
                // maka jalankan request api
                if (in_array($TipeInputan, $this->AllowInputKeyword())) {
                    $InformationInput = [
                        'type'  => $TipeInputan,
                        'name'  => $NamaInputan
                    ];

                    // kalo tipenya Input,Textarea
                    if ($InformationInput['type'] == 'Textarea' || $InformationInput['type'] == 'Input') {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->DisplayInput($InformationInput) != false)
                            $FiturInput[] = $this->DisplayInput($InformationInput);
                    }

                    // kalo input tipenya List
                    if ($InformationInput['type'] == 'List') {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->DisplayInputList($InformationInput) != false)
                            $FiturInput[] = $this->DisplayInputList($InformationInput);
                    }
                    if ($InformationInput['type'] == 'MultipleList') {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->DisplayInputMultiple($InformationInput) != false)
                            $FiturInput[] = $this->DisplayInputMultiple($InformationInput);
                    }
                }
            endforeach;

            return $FiturInput;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
    }

    // surat masuk untuk modae (primary)
    private function TemplatingInputBalasanKeyword_Primary()
    {
        try {
            // pola regex untuk menghilangkan '$','{','}'
            $pattern = "/\\$\[|\]/";

            // set default 'FiturInput'
            $FiturInput = [];
            $x = 0;

            // untuk mode 'Auto'
            foreach ($this->GetListBalasanKeyword() as $list) :
                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $KeywordInput = trim(preg_replace($pattern, '', $list));

                // pecah menjadi 2 bagian, dengan pemisah '->'
                // yang pertama 'tipe inputan'
                // kedua 'nama inputan'
                $ExplodeKeyword = explode('->', $KeywordInput);

                // set default ke NULL 
                $TipeInputan = NULL;
                $NamaInputan = NULL;

                // cek keyword nya kalo ada, maka dimasukan ke variabel
                if (is_array($ExplodeKeyword) and count($ExplodeKeyword) > 0) {
                    $TipeInputan = $ExplodeKeyword[0];
                    $NamaInputan = $ExplodeKeyword[1];
                }


                // kalo keywordnya tersedia di AllowBalasanKeyword(),
                // maka jalankan request api
                if (in_array($TipeInputan, $this->AllowBalasanKeyword())) {
                    $InformationInput = [
                        'type'  => $TipeInputan,
                        'name'  => $NamaInputan
                    ];

                    // kalo tipenya Input,Textarea
                    if ($InformationInput['type'] == 'Textarea' || $InformationInput['type'] == 'Input') {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->DisplayInput($InformationInput) != false)
                            $FiturInput[] = $this->DisplayInput($InformationInput);
                    }

                    // kalo input tipenya List
                    if ($InformationInput['type'] == 'List') {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->DisplayInputList($InformationInput) != false)
                            $FiturInput[] = $this->DisplayInputList($InformationInput);
                    }

                    // kalo input tipenya MultipleList
                    if ($InformationInput['type'] == 'MultipleList') {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->DisplayInputMultiple($InformationInput) != false)
                            $FiturInput[] = $this->DisplayInputMultiple($InformationInput);
                    }
                }
            endforeach;

            // return fitur
            return $FiturInput;
        } catch (Throwable $error) {
            throw  new Exception($error->getMessage());
        }
    }

    // keyword untuk mode input
    public function TemplatingInputBalasanKeyword($mode = 'primary', $DataSurat = null)
    {
        try {
            if ($mode != 'primary' && $mode != 'secondary')
                throw new Exception('mode tidak dikenal');

            if ($mode == 'primary')
                return $this->TemplatingInputBalasanKeyword_Primary();
            // elseif ($mode == 'secondary')
            //     return $this->TemplatingInputBalasanKeyword_Secondary();
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
    }

    // untuk mendapatkan data yang awalan nya '${{' '}}'
    public function GetDataTemplateAuto($input = null)
    {
        try {
            if ($input == null)
                throw new Exception('param template tidak tersedia');


            if (!isset($input['id_template_disposisi']))
                throw new Exception("param 'id_template_disposisi' tidak ditemukan (Get template auto)");

            $request = $this->CI->api->get('template_disposisi', "id={$input['id_template_disposisi']}");
            // $this->CI->librari->printr($request);
            // cek request
            if ($request->status_code != 200)
                throw new Exception($request->message);

            // cek ketersediaan data
            if ($request->count_filtered <= 0)
                throw new Exception('Template disposisi tidak ditemukan');

            // shorthand 
            $source = $request->data;

            // get nama file
            $FileTemplate = $source[0]->template_file;

            // masukan isi template ke variabel 
            $this->TextTemplate =  file_get_contents(base_url("api/public/uploads/disposisi/") . $FileTemplate);

            // pola regex untuk menghilangkan karakter '$', '{{' dan '}}'
            $pattern = "/\\$\{\{|\}\}/";

            // set default GetDataTemplate
            $GetDataTemplate = [];
            // untuk mode 'Auto'
            foreach ($this->GetListAutoKeyword() as $list) :

                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $keyword = trim(preg_replace($pattern, '', $list));

                // kalo keywordnya tersedia di AllowAutoKeyword(), maka jalankan request api
                if (in_array($keyword, $this->AllowAutoKeyword())) {
                    $fitur = $this->RequestAutoKeyword($keyword, $input);

                    $ReplaceKeyword = str_replace(' ', '_', $keyword);

                    $GetDataTemplate[$ReplaceKeyword] = $fitur;
                }
            endforeach;

            return $GetDataTemplate;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    // untuk mendapatkan data yang awalan nya 'Link->${' '}'
    public function GetDataTemplateLink($IdTemplateDisposisi, $input)
    {
        try {
            // $this->CI->librari->printr($input);
            if ($IdTemplateDisposisi == null)
                throw new Exception('param template tidak tersedia');
            if ($input == null)
                throw new Exception('inputan tidak tersedia');

            $request = $this->CI->api->get('template_disposisi', "id={$IdTemplateDisposisi}");

            // cek request
            if ($request->status_code != 200)
                throw new Exception($request->message);

            // cek ketersediaan data
            if ($request->count_filtered <= 0)
                throw new Exception('Template disposisi tidak ditemukan');

            // shorthand 
            $source = $request->data;

            // get nama file
            $FileTemplate = $source[0]->template_file;

            // masukan isi template ke variabel 
            $this->TextTemplate =  file_get_contents(base_url("api/public/uploads/disposisi/") . $FileTemplate);

            // pola regex untuk menghilangkan karakter '$', '{{' dan '}}'
            $pattern = "/Link->\\$\{|\}/";

            // set default GetDataTemplate
            $GetDataTemplate = [];

            // untuk mode 'Auto'
            foreach ($this->GetListLinkKeyword() as $list) :
                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $keyword = trim(preg_replace($pattern, '', $list));

                // kalo keywordnya tersedia di AllowLinkKeyword(), maka jalankan request api
                if (in_array($keyword, $this->AllowLinkKeyword())) {

                    if ($keyword == 'Naskah' || $keyword == 'Naskah Stack' || $keyword == 'Catatan Counter') {

                        $link = $this->CI->librari->ContainsArrayKey($input, 'catatan_disposisi');
                        if ($link == null)
                            $link = $this->CI->librari->ContainsArrayKey($input, 'catatan_disposisi_balasan');

                        // $this->CI->librari->printr($link);
                        $fitur = $this->RequestLinkList($keyword, $link, $input);
                    }


                    $ReplaceKeyword = str_replace(' ', '_', $keyword);

                    $GetDataTemplate[$ReplaceKeyword] = $fitur;
                }
            endforeach;
            return $GetDataTemplate;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    // untuk mendapat data template yang awal dan akhir ${{keyword}}
    public function GetDataTemplateAutoAfter($DataTemplate = null)
    {
        try {
            if ($DataTemplate == null)
                throw new Exception('param template tidak tersedia');

            if (!is_array($DataTemplate))
                throw new Exception('param tidak diketahui');

            $display = $this->TextTemplate;
            foreach ($DataTemplate as $key => $list) :
                // timpa karatker '_' jadi spasi
                $ReplaceKeyword = str_replace('_', ' ', $key);

                // pattern
                $pattern = "/\\$\{\{{$ReplaceKeyword}*\}\}/";
                $display = preg_replace($pattern, $list, $display);

            // timpa nama template yang sesuai, dengan isi template data
            endforeach;

            $this->TextTemplate = $display;
            return $this;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    // untuk mendapat data template yang awal dan akhir $[keyword]
    public function GetDataTemplateBalasan($DataTemplate = null)
    {
        try {
            if ($DataTemplate == null)
                throw new Exception('param template tidak tersedia');

            if (!is_array($DataTemplate))
                throw new Exception('param tidak diketahui');

            $TipeInput = $this->ConcatAllowBalasanKeyword();

            $display = $this->TextTemplate;
            foreach ($this->GetListBalasanKeyword() as $key => $list) :
                // remove pattern
                $RemovePattern = "/($TipeInput)\\$\[|\]/";

                // ambil nama keyword , dan di remove sesuai pattern
                $keyword = trim(preg_replace($RemovePattern, '', $list));

                // pattern
                $display = $this->RequestGetBalasan($keyword, $list, $DataTemplate);

                // update
                $this->TextTemplate = $display;

            endforeach;

            return $this;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    private function RequestGetBalasan($keyword, $KeywordFull, $data)
    {
        try {
            // $this->CI->librari->printr($data, false);
            $display = $this->TextTemplate;
            switch ($keyword) {
                case 'Catatan Disposisi Balasan':

                    // timpa keyword yang mengandung spasi menjadi '_'
                    $keyword = strtolower(str_replace(' ', '_', $keyword));

                    if (!isset($data[$keyword])) return $display;

                    // text yang mau di replace di template
                    $ReplaceText = $data[$keyword];

                    // update template
                    $display = str_replace($KeywordFull, $ReplaceText, $this->TextTemplate);

                    foreach ($this->GetListLinkBalasanKeyword() as $list) :
                        // remove pattern
                        $RemovePattern = "/Link->\\$\[|\]/";

                        // hapus pattern yang mengandung Link->[]
                        $GetKeyword = trim(preg_replace($RemovePattern, '', $list));

                        // timpa keyword yang mengandung spasi menjadi '_'
                        $keyword = str_replace(' ', '_', $GetKeyword) . '_balasan';

                        // update template
                        $display = str_replace($list, $data[$keyword], $display);

                    endforeach;

                    break;
                case 'Kepada Yth Balasan':
                    // timpa keyword yang mengandung spasi menjadi '_'
                    $keyword = strtolower(str_replace(' ', '_', $keyword));
                    if (!isset($data[$keyword])) return $display;
                    // text yang mau di replace di template
                    $ReplaceText = $data[$keyword];

                    // decode 
                    $DecodeData = json_decode($ReplaceText, true);
                    // tampung data
                    $tampung = '';
                    foreach ($DecodeData as $list) :
                        // request 
                        $request = $this->CI->api->get('satker', "id={$list}");

                        // $this->CI->librari->printr($request);
                        // cek request
                        if ($request->status_code != 200)
                            throw new Exception($request->message);

                        // cek ketersediaan data
                        if ($request->count_filtered <= 0)
                            throw new Exception("satker yang dituju, tidak ditemukan (Kepada Yth Balasan)");

                        $source = $request->data[0];

                        $tampung .= "<li style='list-style:none;'>{$source->nama_satker}</li>";
                    endforeach;
                    $display = str_replace($KeywordFull, $tampung, $display);
                    break;
            }
            return $display;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage());
        }
    }

    // untuk mendapat data template yang awal dan akhir Link->${keyword}
    public function GetDataTemplateLinkAfter($DataTemplate = null)
    {
        try {
            if ($DataTemplate == null)
                throw new Exception('param template tidak tersedia');

            if (!is_array($DataTemplate))
                throw new Exception('param tidak diketahui');

            $display = $this->TextTemplate;
            foreach ($DataTemplate as $key => $list) :
                // timpa karatker '_' jadi spasi
                $ReplaceKeyword = str_replace('_', ' ', $key);

                // pattern
                $pattern = "/Link->\\$\{{$ReplaceKeyword}*\}/";
                $display = preg_replace($pattern, $list, $display);

            // timpa nama template yang sesuai, dengan isi template data
            endforeach;

            $this->TextTemplate = $display;
            return $this;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    // untuk tipe inputan selain 'Input','Textarea'
    private function DisplayInput($data)
    {
        // cek array / bukan
        if (!is_array($data)) return false;

        // cek jumlah datanya
        if (count($data) <= 0) return false;

        // cek ada ga nama array assosiatif nya
        if (!isset($data['type']) && !isset($data['name'])) return false;

        // set nama inputan menjadi huruf kecil & tiap spasi diganti jadi '_'
        $name = str_replace(' ', '_', strtolower($data['name']));
        // echo '<pre>' . print_r($data, true) . '</pre>';

        // khusus nama catatan yang mengandung 'secondary', maka dihilangkan
        $RemoveString = str_replace("Secondary", "", $data['name']);

        // set default false
        $display = false;

        // set default null
        $input = NULL;

        // set labell
        $label = "<label class='fweight-600 text-muted padding-bottom-2'>{$RemoveString}</label>";

        // kalo ada inputan tambahan
        $AddInput = NULL;

        // kalo lulus validasi lakukan pengkondisian tipe input
        switch ($data['type']) {
            case 'Input':
                $input = "<input type='text' name='templating[{$name}]' placeholder='{$RemoveString}' class='form-control'>";
                break;
            case 'Textarea':
                // khusus untuk catatan disposisi
                if ($data['name'] == 'Catatan Disposisi')

                    $AddInput = "<div class='d-flex justify-content-end margin-top-2'>
                                    <span>
                                        <button data-remove='yes' type='button' class='btn btn-light d-flex align-items-center '>
                                            <span class='material-icons icon-secondary'>
                                                close
                                            </span>
                                            Hapus
                                        </button>
                                    </span>
                                    <span data-option='add'>                                
                                        <button data-add='yes' data-keyword='Catatan Disposisi' type='button' class='btn btn-secondary d-flex align-items-center  '>
                                            <span class='material-icons-outlined icon-secondary'>
                                                add_box
                                            </span>
                                            &nbsp; Catatan
                                        </button>
                                    </span>
                                </div>";

                $input = "<textarea name='templating[{$name}]' data-keyword='{$data['name']}' class='form-control' placeholder='{$RemoveString}'></textarea>";
                break;
            case 'List':
                $input = "<select name='templating[{$name}]' class='form-control' placeholder='{$RemoveString}'></select>";
                break;
        }

        // cek kalo tidak kosong/ null
        if ($input != NULL)
            $display = "<div class='padding-bottom-4' data-keyword='{$name}' >{$label} {$input} {$AddInput}</div>";

        // return datanya
        return $display;
    }


    // untuk tipe inputan selain 'Input','Textarea' mode autofill
    private function DisplayInputAutoFill($data)
    {
        // $this->CI->librari->printr($data, false);
        // cek array / bukan
        if (!is_array($data))
            throw new Exception('param bukan array (autofill)');

        // cek jumlah datanya
        if (count($data) <= 0)
            throw new Exception('data tidak tersedia (autofill)');

        $InformationInput = $data['information'];

        // cek ada ga nama array assosiatif nya
        if (!isset($InformationInput['type']) || !isset($InformationInput['name']))
            throw new Exception('informasi inputan tidak diketahui (autofill)');

        // cek ada ga nama array assosiatif nya 'data_support'
        if (!isset($data['data_support']))
            throw new Exception('data support tidak ditemukan support(autofill)');

        // data support
        $DataSupport = $data['data_support'];

        // set nama inputan menjadi huruf kecil & tiap spasi diganti jadi '_'
        $name = str_replace(' ', '_', strtolower($InformationInput['name']));
        // echo '<pre>' . print_r($data, true) . '</pre>';

        // set default false
        $display = false;

        // set default null
        $input = NULL;

        // khusus nama catatan yang mengandung 'secondary', maka dihilangkan
        $RemoveString = str_replace("Secondary", "", $InformationInput['name']);

        // set labell
        $label = "<label class='fweight-600 text-muted padding-bottom-2'>{$RemoveString}</label>";

        // kalo ada inputan tambahan
        $AddInput = NULL;

        // $this->CI->librari->printr($data, false);

        // kalo lulus validasi lakukan pengkondisian tipe input
        switch ($InformationInput['type']) {
            case 'Input':
                // khusus untuk catatan disposisi
                if ($InformationInput['name'] == 'Nomor Surat') {

                    // kalo mode secondary
                    if ($data['mode'] == 'secondary') {

                        //cek ada ga idnya
                        if (!isset($DataSupport->id))
                            throw new Exception("param 'id_surat_masuk_secondary' tidak ditemukan");

                        // request credential, untuk ambil 'nama_pangkat'
                        $request = $this->CI->api->get('surat_masuk_secondary/get', "id={$DataSupport->id}");

                        // $this->CI->librari->printr($request, false);

                        // cek request
                        if ($request->status_code != 200)
                            throw new Exception($request->message . ' (surat masuk secondary)');

                        // cek ketersediaan datanya
                        if ($request->count_filtered <= 0)
                            throw new Exception('surat tidak ditemukan (surat masuk secondary)');

                        // shorthand 'secondary_surat_masuk'
                        $source = $request->data[0];

                        $input = "<input type='text' name='templating[{$name}]' value='{$source->nomor_surat}' placeholder='{$RemoveString}' class='form-control'>";
                    }
                } elseif ($InformationInput['name'] == 'Perihal') {
                    // kalo mode secondary
                    if ($data['mode'] == 'secondary') {

                        //cek ada ga idnya
                        if (!isset($DataSupport->id))
                            throw new Exception("param 'id_surat_masuk_secondary' tidak ditemukan");

                        // request credential, untuk ambil 'nama_pangkat'
                        $request = $this->CI->api->get('surat_masuk_secondary/get', "id={$DataSupport->id}");

                        // $this->CI->librari->printr($request, false);

                        // cek request
                        if ($request->status_code != 200)
                            throw new Exception($request->message . ' (surat masuk secondary)');

                        // cek ketersediaan datanya
                        if ($request->count_filtered <= 0)
                            throw new Exception('surat tidak ditemukan (surat masuk secondary)');

                        // shorthand 'secondary_surat_masuk'
                        $source = $request->data[0];

                        $input = "<input type='text' name='templating[{$name}]' value='{$source->perihal}' placeholder='{$RemoveString}' class='form-control'>";
                    }
                }
                break;
        }

        // cek kalo tidak kosong/ null
        if ($input != NULL)
            $display = "<div class='padding-bottom-4'>{$label} {$input} {$AddInput}</div>";

        // return datanya
        return $display;
    }

    // Untuk tipe inputan nya 'List'
    private function DisplayInputList($data)
    {
        try {
            // cek array / bukan
            if (!is_array($data)) return false;

            // cek jumlah datanya
            if (count($data) <= 0) return false;

            // cek ada ga nama array assosiatif nya
            if (!isset($data['type']) && !isset($data['name'])) return false;

            // nama inputan asli, sebelum di replace
            $OriName = $data['name'];

            // set nama inputan menjadi huruf kecil & tiap spasi diganti jadi karakter _
            // sesudah direplace
            $name = str_replace(' ', '_', strtolower($data['name']));

            // set default false
            $display = NULL;

            // set default var input
            $input = "<select name='templating[{$name}]' class='form-control' placeholder='{$OriName}'>";

            // set labell
            $label = "<label class='fweight-600 text-muted padding-bottom-2'>{$OriName}</label>";

            // kalo lulus validasi lakukan pengkondisian request List
            switch ($OriName) {
                case 'Kepada Yth':
                    // option pertama
                    $input .= "<option value=''>- Ditujukan kepada Yth -</option>";
                    // request api list data komandan & wadan
                    $request = $this->CI->api->get('satker', "level_satker=komandan_wadan&allow_gelar=yes");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message . ' (Kepada Yth)');

                    // cek request
                    if ($request->count_filtered <= 0)
                        throw new Exception('List tidak ditemukan (Kepada Yth)');

                    // set default 
                    $LevelSatker = '';

                    foreach ($request->data as $list) :
                        // untuk wakil komandan
                        $LevelSatker = 'Wakil Komandan';
                        if ($list->level_satker == '2')
                            $LevelSatker = 'KOMANDAN';

                        // $input .= "<option value='{$list->id_anggota}'>{$list->gelar_depan} {$list->ketua_satker} {$list->gelar_belakang} - {$LevelSatker}</option>";
                        $input .= "<option value='{$list->id_anggota}'>{$LevelSatker}</option>";

                    endforeach;
                    break;
            }

            // tag penutup select
            $input .= '</select>';

            // cek kalo tidak kosong/ null
            if ($input != NULL)
                $display = "<div class='padding-bottom-4'>{$label} {$input}</div>";

            // return datanya
            return $display;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage());
        }
    }


    // Untuk tipe inputan nya 'List'
    private function DisplayInputMultiple($data)
    {
        try {
            // cek array / bukan
            if (!is_array($data)) return false;

            // cek jumlah datanya
            if (count($data) <= 0) return false;

            // cek ada ga nama array assosiatif nya
            if (!isset($data['type']) && !isset($data['name'])) return false;

            // nama inputan asli, sebelum di replace
            $OriName = $data['name'];

            // set nama inputan menjadi huruf kecil & tiap spasi diganti jadi karakter _
            // sesudah direplace
            $name = str_replace(' ', '_', strtolower($data['name']));

            // khusus nama catatan yang mengandung 'secondary', maka dihilangkan
            $RemoveString = str_replace("Secondary", "", $data['name']);


            // set default false
            $display = NULL;

            // set labell
            $label = "<label class='text-muted fweight-600 padding-bottom-2'>{$RemoveString}</label>";

            $DataKeyword = str_replace(' ', '_', $OriName);
            $input = NULL;

            // kalo lulus validasi lakukan pengkondisian request List
            switch ($OriName) {
                case 'Kepada Yth Balasan':
                    $input = "<select data-mode='tagify' name='__temp' data-keyword='{$DataKeyword}' class='form-control' multiple='multiple'></select>";
                    $input .= "<input type='hidden' name='templating[{$name}]' data-keyword='{$DataKeyword}_input'>";
                    break;
                case 'Diteruskan Kepada Yth Secondary':
                    $input = "<select data-mode='tagify' name='__temp' data-keyword='{$DataKeyword}' class='form-control' multiple='multiple'></select>";
                    $input .= "<input type='hidden' name='templating[{$name}]' data-keyword='{$DataKeyword}_input'>";
                    break;
            }

            // cek kalo tidak kosong/ null
            if ($input != NULL)
                $display = "<div class='padding-bottom-4'>{$label} {$input}</div>";

            // return datanya
            return $display;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function RemoveKeywordInput()
    {
        $InputPattern = $this->ConcatAllowInputKeyword();
        // pola regex
        $pattern = "/({$InputPattern})\\$\{[a-zA-Z0-9\s]*\}/";

        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;
        return $this;
    }

    public function RemoveKeywordAutoFillInput()
    {
        $InputPattern = $this->ConcatAllowInputKeyword();
        // pola regex
        $pattern = "/({$InputPattern})\\$\{\{\{[a-zA-Z0-9\s]*\}\}\}/";

        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;
        return $this;
    }
    public function RemoveKeywordLink()
    {
        $InputPattern = $this->ConcatAllowInputKeyword();
        // pola regex
        $pattern = "/(Link)->\\$\{[a-zA-Z0-9\s]*\}/";

        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;
        return $this;
    }
    public function RemoveKeywordBalasan()
    {
        $InputPattern = $this->ConcatAllowBalasanKeyword();
        // pola regex
        $pattern = "/({$InputPattern})\\$\[[a-zA-Z0-9\s]*\]/";

        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;

        return $this;
    }

    public function RemoveKeywordBalasanAuto()
    {

        // pola regex
        $pattern = "/\\$\[\[[a-zA-Z0-9\s]*\]\]/";
        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;

        return $this;
    }
    public function DisplayTemplate()
    {
        echo $this->TextTemplate;
    }

    public function GetTemplate()
    {
        return $this->TextTemplate;
    }

    // setiap inputan berubah, fungsi tempating ini akan terus di jalankan
    public function EveryChangeInput($data = null)
    {
        try {
            // $this->CI->librari->printr($data);
            // cek kalo datanya null
            if ($data == null) return false;

            // cek kalo datanya bukan array
            if (!is_array($data)) return false;

            // set default display 
            $display = $this->TextTemplate;

            // pola regex untuk menghilangkan '$','{','}'
            $pattern = "/\\$\{|\}/";
            $x = 0;
            // lakukan perulangan pada var 'data'
            foreach ($this->GetListInputKeyword() as $list) :
                // ambil keyword, dan dihilangkan '${' dan  '}'
                $KeywordTemplate = trim(preg_replace($pattern, '', $list));

                // pisah jadi 2 bagian, 
                // pertama tipe input
                // kedua nama inputan
                $ExplodeKeyword = explode('->', $KeywordTemplate);

                // masukan ke var
                $TipeInput = $ExplodeKeyword[0];
                $NamaInput = $ExplodeKeyword[1];

                // echo $NamaInput . ' - ';
                // keyword pada keyword template ditimpa, yang asalnya ' ' jadi '_'
                // dan semua hutuf nya kecil
                $ReplaceKeyword = strtolower(str_replace(' ', '_', $NamaInput));

                // cek kesesuaian inputan pada dengan 'template keyword'
                if (isset($data[$ReplaceKeyword]) && !empty($data[$ReplaceKeyword])) {
                    // pattern untuk get
                    $PatternKeyword = "/({$TipeInput}->)\\$\{{$NamaInput}\}/";

                    // kalo tipe inputannya 'Get'
                    if ($TipeInput == 'Get')
                        $display = preg_replace($PatternKeyword, $this->RequestApiGet($NamaInput, $data[$ReplaceKeyword]), $display);

                    // kalo tipe inputannya 'Textarea' || 'Input' || 'List
                    elseif ($TipeInput == 'Textarea' || $TipeInput == 'Input') {
                        $ReplaceText = $data[$ReplaceKeyword];

                        // kalo tipenya textarea
                        if ($TipeInput == 'Textarea') {
                            // kalo nama nama inputannya 'Catatan Disposisi'
                            if ($NamaInput == 'Catatan Disposisi') {

                                // kalo masuk ke kondisi ini, Var 'ReplaceText' di set ulang
                                $ReplaceText = '';

                                // untuk data yang multiple insert
                                $MultipleInsert = $this->CI->librari->ContainsArrayKey($data, $ReplaceKeyword, ['catatan_disposisi_balasan']);

                                // pola untuk link keyword "Link->${keyword}"
                                $PatternLink = "/Link->\\$\{[a-zA-Z0-9\s]*\}/";

                                // kalo ada tipe nya 'Link', Ex : Link->${nama_keyword}
                                if (preg_match_all($PatternLink, $display, $Hasil)) {
                                    // $this->CI->librari->printr($Hasil, false);
                                    // pola regex untuk menghilangkan '$','{','}', 'Link->'
                                    $RemovePattern = "/Link->\\$\{|\}/";

                                    foreach ($Hasil[0] as $link) :
                                        // ambil nama keyword, dan di remove
                                        $KeywordLink = trim(preg_replace($RemovePattern, '', $link));

                                        // pola untuk link keyword "Link->${keyword}"
                                        $PatternLink = "/Link->\\$\{{$KeywordLink}*\}/";

                                        $display = preg_replace($PatternLink, $this->RequestLinkList($KeywordLink, $MultipleInsert, $data), $display);

                                    endforeach;
                                }


                                // untuk replace catatan_disposisi
                                foreach ($MultipleInsert as $key => $value) :
                                    $ReplaceText .= "<li style='list-style:none; margin-bottom:25px'>{$value}</li>";
                                endforeach;

                                // timpa template dengan text 'ReplaceTect'
                                $display = preg_replace($PatternKeyword, $ReplaceText, $display);

                                // lanjut ke looping berikutnya
                                continue;
                            }
                        }
                        $display = preg_replace($PatternKeyword, $ReplaceText, $display);
                    }

                    // kalo tipe input 'MultipleList' 
                    elseif ($TipeInput == 'MultipleList' && !empty($data[$ReplaceKeyword])) {
                        // echo $NamaInput . ' - ' . $data[$ReplaceKeyword];
                        // echo $data[$ReplaceKeyword];
                        $display = preg_replace($PatternKeyword, $this->RequestApiMultipleList($NamaInput, $data[$ReplaceKeyword]), $display);
                    }
                    // kalo tipe inputannya 'List'
                    elseif ($TipeInput == 'List') {

                        $display = preg_replace($PatternKeyword, $this->RequestApiList($NamaInput, $data[$ReplaceKeyword]), $display);
                    }
                }

            // $this->CI->librari->printr($ReplaceKeyword, false);

            endforeach;
            $this->TextTemplate = $display;

            return $this;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
        // echo '<pre>' . print_r($this->GetListInputKeyword(), true) . '</pre>';
    }

    // setiap inputan berubah, fungsi tempating ini akan terus di jalankan yang menggunakan nama_input->${{{keyword}}}
    public function EveryChangeInputAutoFill($data = null)
    {
        try {
            // cek kalo datanya null
            if ($data == null) return false;

            // cek kalo datanya bukan array
            if (!is_array($data)) return false;

            // set default display 
            $display = $this->TextTemplate;

            // pola regex untuk menghilangkan '$','{','}'
            $pattern = "/\\$\{\{\{|\}\}\}/";

            // lakukan perulangan pada var 'data'
            foreach ($this->GetListAutoFillInputKeyword() as $list) :
                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $KeywordTemplate = trim(preg_replace($pattern, '', $list));

                // pisah jadi 2 bagian, 
                // pertama tipe input
                // kedua nama inputan
                $ExplodeKeyword = explode('->', $KeywordTemplate);

                // masukan ke var
                $TipeInput = $ExplodeKeyword[0];
                $NamaInput = $ExplodeKeyword[1];

                // keyword pada keyword template ditimpa, yang asalnya ' ' jadi '_'
                // dan semua hutuf nya kecil
                $ReplaceKeyword = strtolower(str_replace(' ', '_', $NamaInput));
                // cek kesesuaian inputan pada dengan 'template keyword'
                if (isset($data[$ReplaceKeyword]) && !empty($data[$ReplaceKeyword])) {
                    // pattern untuk get
                    $PatternKeyword = "/({$TipeInput}->)\\$\{\{\{{$NamaInput}\}\}\}/";


                    // kalo tipe inputannya 'Textarea' || 'Input' || 'List
                    if ($TipeInput == 'Textarea' || $TipeInput == 'Input') {
                        $ReplaceText = $data[$ReplaceKeyword];
                        $display = preg_replace($PatternKeyword, $ReplaceText, $display);
                    }
                }

            // $this->CI->librari->printr($ReplaceKeyword, false);

            endforeach;
            $this->TextTemplate = $display;

            return $this;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
        // echo '<pre>' . print_r($this->GetListInputKeyword(), true) . '</pre>';
    }

    // setiap inputan berubah, fungsi tempating ini akan terus di jalankan
    public function EveryChangeBalasan($data = null)
    {
        try {
            // $this->CI->librari->printr($data);
            // cek kalo datanya null
            if ($data == null) return false;

            // cek kalo datanya bukan array
            if (!is_array($data)) return false;

            // set default display 
            $display = $this->TextTemplate;

            // pola regex untuk menghilangkan '$','[',']'
            $pattern = "/\\$\[|\]/";

            // $this->CI->librari->printr($this->GetListBalasanKeyword(), false);
            // lakukan perulangan pada var 'data'
            foreach ($this->GetListBalasanKeyword() as $list) :
                // ambil keyword, dan dihilangkan '${{' dan  '}}'
                $KeywordTemplate = trim(preg_replace($pattern, '', $list));
                // echo $KeywordTemplate;
                // pisah jadi 2 bagian, 
                // pertama tipe input
                // kedua nama inputan
                $ExplodeKeyword = explode('->', $KeywordTemplate);

                // masukan ke var
                $TipeInput = $ExplodeKeyword[0];
                $NamaKeyword = $ExplodeKeyword[1];

                // keyword pada keyword template ditimpa, yang asalnya ' ' jadi '_'
                // dan semua hutuf nya kecil
                $ReplaceKeyword = strtolower(str_replace(' ', '_', $NamaKeyword));


                // cek kesesuaian inputan pada dengan 'template keyword'
                if (isset($data[$ReplaceKeyword]) && !empty($data[$ReplaceKeyword])) {
                    // pattern untuk get
                    $PatternKeyword = "/({$TipeInput}->)\\$\[{$NamaKeyword}\]/";

                    // kalo tipe inputannya 'Get'
                    if ($TipeInput == 'Get')
                        $display = preg_replace($PatternKeyword, $this->RequestApiGet($NamaKeyword, $data[$ReplaceKeyword]), $display);

                    // kalo tipe inputannya 'Textarea' || 'Input' || 'List
                    elseif ($TipeInput == 'Textarea' || $TipeInput == 'Input') {

                        $ReplaceText = $data[$ReplaceKeyword];
                        // kalo tipenya textarea
                        if ($TipeInput == 'Textarea') {
                            // kalo nama nama inputannya 'Catatan Disposisi'
                            if ($NamaKeyword == 'Catatan Disposisi Balasan') {
                                // kalo masuk ke kondisi ini, Var 'ReplaceText' di set ulang
                                $ReplaceText = '';

                                // untuk data yang multiple insert
                                $MultipleInsert = $this->CI->librari->ContainsArrayKey($data, $ReplaceKeyword);

                                // pola untuk link keyword "Link->${keyword}"
                                $PatternLink = "/Link->\\$\[[a-zA-Z0-9\s]*\]/";

                                // kalo ada tipe nya 'Link', Ex : Link->${nama_keyword}
                                if (preg_match_all($PatternLink, $display, $Hasil)) {
                                    // $this->CI->librari->printr($Hasil, false);
                                    // pola regex untuk menghilangkan '$','[',']', 'Link->'
                                    $RemovePattern = "/Link->\\$\[|\]/";

                                    foreach ($Hasil[0] as $link) :
                                        // ambil nama keyword, dan di remove
                                        $KeywordLink = trim(preg_replace($RemovePattern, '', $link));

                                        // pola untuk link keyword "Link->$[keyword]"
                                        $PatternLink = "/Link->\\$\[{$KeywordLink}*\]/";

                                        $display = preg_replace($PatternLink, $this->RequestLinkList($KeywordLink, $MultipleInsert, $data), $display);

                                    endforeach;
                                }


                                // untuk replace catatan_disposisi
                                foreach ($MultipleInsert as $key => $value) :
                                    $ReplaceText .= "<li style='list-style:none; margin-bottom:25px'>{$value}</li>";
                                endforeach;

                                // timpa template dengan text 'ReplaceTect'
                                $display = preg_replace($PatternKeyword, $ReplaceText, $display);

                                // lanjut ke looping berikutnya
                                continue;
                            }
                        }

                        $display = preg_replace($PatternKeyword, $data[$ReplaceKeyword], $display);
                    }
                    // kalo tipe inputannya 'List'
                    elseif ($TipeInput == 'List') {

                        $display = preg_replace($PatternKeyword, $this->RequestApiList($NamaKeyword, $data[$ReplaceKeyword]), $display);
                    } elseif ($TipeInput == 'MultipleList') {

                        $display = preg_replace($PatternKeyword, $this->RequestApiMultipleList($NamaKeyword, $data), $display);
                    }
                }

            endforeach;
            $this->TextTemplate = $display;

            return $this;
        } catch (Exception $error) {
            echo $error->getMessage();
        } catch (Throwable $error) {
            echo $error->getMessage();
        }
        // echo '<pre>' . print_r($this->GetListInputKeyword(), true) . '</pre>';
    }
}
