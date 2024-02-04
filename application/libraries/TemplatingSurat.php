<?php
class TemplatingSurat
{
    use AllowInput, RequestInput;

    public $TextTemplate;
    public $FiturInput;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function RemoveKeywordSET()
    {

        // pola regex
        $pattern = "/SET->\\$\{[a-zA-Z0-9\s]*\}/";

        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '___________', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;
        return $this;
    }

    public function RemoveKeywordLink()
    {

        // pola regex
        $pattern = "/Link->\\$\{[a-zA-Z0-9\s]*\}/";

        // hilangkan keyword
        $DisplayRemove = trim(preg_replace($pattern, '', $this->TextTemplate));

        // masukan ke property
        $this->TextTemplate = $DisplayRemove;
        return $this;
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

    public function DisplayAllInput($data = null)
    {
        try {

            // $this->CI->librari->printr($data);
            // pola regex unuk menghilangkan '$','{','}'
            $pattern = "/\\$\{|\}/";

            // set default 'FiturInput'
            $FiturInput = $this->FiturInput;

            // untuk mode 'Auto'
            foreach ($this->GetListAllInputKeyword() as $list) :

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
                    if (in_array($InformationInput['type'], $this->AllowInputKeyword())) {
                        // masukan ke array, kalo datanya tidak false
                        if ($this->RequestInput($InformationInput, $data) != false)
                            $FiturInput[] = $this->RequestInput($InformationInput, $data);
                    }
                }
            endforeach;

            return $FiturInput;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        } catch (Throwable $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function DisplayTemplate()
    {
        echo $this->TextTemplate;
    }
}



trait RequestInput
{

    public function TextareaEditorToolbar()
    {
        return "
        {   
            language: 'id',
            uiColor: '#FFFFFF',
            tabSpaces: 5,
            toolbar: [
                { name: 'clipboard', items: ['Undo', 'Redo'] },
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'align', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            ]
        }";
    }

    public function Lampiran()
    {
        return "
            <div class='row'>
            <div class='col'>
                <input id='file-upload' multiple type='file' name='ori_file[]' />

                <label for='file-upload' id='file-drag' data-class='uploader-label'>
                    <img id='file-image' src='#' alt='Preview' class='hidden' width='70' height='70'>
                    <div id='start'>
                        <span class='material-icons-outlined text-muted' style='font-size:40px'>
                            cloud_upload
                        </span>
                        <div class='text-size-2 '>Drag file anda disini <br />
                            <span class='font-italic'>ekstensi file yang didukung <code>.pdf</code>
                        </div>
                        <div id='notimage' class='hidden text-danger fweight-600'>Format tidak didukung</div>


                    </div>
                    <div id='messages'></div>

                    <div id='response' class='hidden'>
                        <progress class='progress' id='file-progress' value='0'>
                            <span>0</span>%
                        </progress>
                    </div>

                </label>
                <div class='mt-2 font-italic fweight-400'>Maksimal ukuran file <b>3 MB</b></div>

            </div>
        </div>

        <script>ekUpload();</script>
        ";
    }

    // untuk tipe inputan selain 'Input','Textarea'
    private function RequestInput($InformationInput, $data)
    {
        // cek array / bukan
        if (!is_array($InformationInput)) return false;

        // cek jumlah datanya
        if (count($InformationInput) <= 0) return false;

        // cek ada ga nama array assosiatif nya
        if (!isset($InformationInput['type']) && !isset($InformationInput['name'])) return false;

        // set nama inputan menjadi huruf kecil & tiap spasi diganti jadi '_'
        $name = str_replace(' ', '_', strtolower($InformationInput['name']));
        // echo '<pre>' . print_r($data, true) . '</pre>';


        // set default false
        $display = false;

        // set default null
        $input = NULL;

        // set labell
        $label = "<label class='fweight-600 text-muted padding-bottom-2'>{$InformationInput['name']}</label>";

        // kalo ada inputan tambahan
        $AddInput = NULL;

        // kalo lulus validasi lakukan pengkondisian tipe input
        switch ($InformationInput['type']) {
            case 'Input':
                $input = "<input type='text' name='templating[{$name}]' data-keyword='{$name}' placeholder='{$InformationInput['name']}' class='form-control'>";
                if ($InformationInput['name'] == 'Tembusan') {
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
                                        <button data-add='yes' data-keyword='tembusan' type='button' class='btn btn-secondary d-flex align-items-center  '>
                                            <span class='material-icons-outlined icon-secondary'>
                                                add_box
                                            </span>
                                            &nbsp; Tembusan
                                        </button>
                                    </span>
                                </div>";
                }
                break;
            case 'Textarea':
                $input = "<textarea name='templating[{$name}]' placeholder='{$InformationInput['name']}' class='form-control'></textarea>";
                // kalo keyword 'dasar surat'
                if ($InformationInput['name'] == 'Dasar Surat') {
                    // cek param 'data'
                    if ($data == null)
                        throw new Exception("data surat tidak ditemukan (DasarSurat)");


                    // cek dasar surat
                    if (!isset($data['dasar_surat']))
                        throw new Exception("dasar surat tidak ditemukan (DasarSurat)");

                    // cek apakah array atau bukan
                    if (!is_array($data['dasar_surat']))
                        throw new Exception('dasar surat tidak didukung (DasarSurat)');

                    // set default input
                    $input = "";

                    $x = 1;
                    // masukan dasar surat berdasarkan pilihan yang dipilih
                    foreach ($data['dasar_surat'] as $list) :
                        // $request = $this->
                        $input .= "<div class='margin-top-2'><textarea name='templating[dasar_surat]' placeholder='Dasar surat ({$x})' class='form-control {$name}'></textarea></div>";
                        // increment    
                        $x++;
                    endforeach;
                }
                break;

            case 'TextareaEditor':

                // $request = $this->
                $input .= "<div class='margin-top-2'><textarea name='keperluan' placeholder='Keperluan' class='form-control '></textarea></div>";
                $input .= "<script>CKEDITOR.replace('keperluan'," . $this->TextareaEditorToolbar() . ");</script>";

                break;

            case 'List':
                if ($InformationInput['name'] == 'Penandatangan') {
                    $request = $this->CI->api->get('satker', "level_satker=high_satker");

                    // cek request
                    if ($request->status_code != 200)
                        throw new Exception($request->message);

                    // cek ketersediaan data
                    if ($request->count_filtered <= 0)
                        throw new Exception("penandatangan tidak tersedia");

                    // shorthand
                    $source = $request->data;
                    // $this->CI->librari->printr($request);

                    // definisi select
                    $input = "<select class='form-control'>";

                    // masukan opsi opsi 
                    foreach ($source as $list) :
                        $input .= "<option value='{$list->id}'>{$list->nama_satker}</option>";
                    endforeach;

                    //tutuo tag
                    $input .= "</select>";
                }
                break;

            case 'File':
                if ($InformationInput['name'] == 'Lampiran') {
                    $input = $this->Lampiran();
                }
                break;
        }

        // cek kalo tidak kosong/ null
        if ($input != NULL)
            $display = "<div class='padding-bottom-2' data-keyword='{$name}' >{$label} {$input} {$AddInput}</div>";

        // return datanya
        return $display;
    }
}


trait AllowInput
{
    private function AllowInputKeyword()
    {
        return [
            'Input',
            'Get',
            'List', // Select
            'Textarea',
            'MultipleList',
            'TextareaEditor',
            'File'
        ];
    }

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

    private function GetListAllInputKeyword()
    {

        $InputPattern = $this->ConcatAllowInputKeyword();
        // pola regex
        $pattern = "/({$InputPattern})\\$\{[a-zA-Z\s0-9]*\}/";
        if (preg_match_all($pattern, $this->TextTemplate, $Hasil))
            return $Hasil[0];

        return [];
    }
}
