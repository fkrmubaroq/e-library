<?php
class Librari
{
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    public function printr($print, $exit = true)
    {
        echo '<pre>' . print_r($print, true) . '</pre>';
        if ($exit != false)
            exit(1);
    }

    function slug($string)
    {
        $pattern = '/[^a-z]/i';
        return strtolower(preg_replace($pattern, '-', $string));
    }

    function only($ori, $only)
    {
        foreach ($ori as $key => $value) {
            if (!in_array($key, $only))
                unset($ori[$key]);
        }

        return $ori;
    }
    function TanggalToText($Tgl, $Time = true)
    {

        $Explode = explode(' ', $Tgl);
        $ExplodeDate = explode('-', $Explode[0]);
        if ($Time == true) {
            $ExplodeTime = explode(':', $Explode[1]);
            $Jam = $ExplodeTime[0];
            $Menit = $ExplodeTime[1];
        }

        $Year = $ExplodeDate[0];
        $Month = $ExplodeDate[1];
        $Date = $ExplodeDate[2];


        $Month = $this->BulanToText($Month);
        if ($Time == false)
            return "{$Date} {$Month} {$Year}";

        return "{$Date} {$Month} {$Year} jam {$Jam}:{$Menit}";
    }
    function BulanToText($number)
    {
        $tampung = '';
        switch ($number) {
            case 1:
                $tampung = 'Januari';
                break;
            case 2:
                $tampung = 'Februari';
                break;
            case 3:
                $tampung = 'Maret';
                break;
            case 4:
                $tampung = 'April';
                break;
            case 5:
                $tampung = 'Mei';
                break;
            case 6:
                $tampung = 'Juni';
                break;
            case 7:
                $tampung = 'Juli';
                break;
            case 8:
                $tampung = 'Agustus';
                break;
            case 9:
                $tampung = 'September';
                break;
            case 10:
                $tampung = 'Oktober';
                break;
            case 11:
                $tampung = 'November';
                break;
            case 12:
                $tampung = 'Desember   ';
                break;
        }

        return $tampung;
    }

    public function getIpAddress()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'IP tidak dikenali';
        return $ipaddress;
    }

    public function ArrayToGet($array)
    {
        if (!is_array($array)) return false;

        // set var tampung
        $tampung = '';
        // convert array to object
        $counter = 0;
        foreach ($array as $key => $list) :

            if (strlen($list) > 0) {
                if ($counter == count($array) - 1)
                    $tampung .= "{$key}=$list";
                else
                    $tampung .= "{$key}=$list&";

                $counter++;
            }
        endforeach;

        return $tampung;
    }

    function TimeToText($Time)
    {

        $Explode = explode(' ', $Time);
        $ExplodeDate = explode('-', $Explode[0]);
        $ExplodeTime = explode(':', $Explode[1]);

        $Year = $ExplodeDate[0];
        $Month = $ExplodeDate[1];
        $Date = $ExplodeDate[2];

        $Now = date('Y-m-d');
        $DateTime = "{$Year}-{$Month}-{$Date}";

        $JamNow = date('H');
        $MenitNow = date('i');

        $Jam = $ExplodeTime[0];
        $Menit = $ExplodeTime[1];
        $Detik = $ExplodeTime[2];

        // kalau sekarang
        if ($DateTime == $Now) {
            $MenitReal =  abs($this->timeDiff("{$Jam}:{$Menit}", "{$JamNow}:{$MenitNow}")) / 60;
            $Tanggal = intval($MenitReal) . " Menit lalu";
            if ($MenitReal > 60) {
                $MenitReal =  abs($this->timeDiff("{$Jam}:{$Menit}", "{$JamNow}:{$MenitNow}")) / 60 / 60;
                $Tanggal = intval($MenitReal) . ' Jam lalu';
            } elseif ($MenitReal <= 0)
                $Tanggal = 'Baru saja';
        }
        // kalau taun ini
        elseif (date('Y') == $Year) {
            $Tanggal = $Date . " " . $this->BulanToText($Month);
            $date1 = "2007-03-24";
            $date2 = "2009-06-26";

            $diff = abs(strtotime($DateTime) - strtotime($Now));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            // 1 - 7
            if ($days <= 30)
                $Tanggal = $days . " Hari lalu";
            // if(intval(date('d'))   )
        } elseif (date('Y') != $Year)
            $Tanggal = $Date . " " . $this->BulanToText($Month) . $Year;
        return $Tanggal;
    }

    function timeDiff($firstTime, $lastTime)
    {
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);
        $timeDiff = $lastTime - $firstTime;
        return $timeDiff;
    }
    function PostFile($FullPath, $type, $FileName)
    {
        // if (function_exists('curl_file_create')) { // php 5.5+
        //     $cFile = curl_file_create($FullPath, $type, $FileName);
        // } else { // 
        //     $cFile = '@' . realpath($FullPath);
        // }

        return curl_file_create($FullPath, $type, $FileName);
    }

    public function DownloadFile($url)
    {
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $r = curl_exec($ch);
        curl_close($ch);
        header('Expires: 0'); // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        header('Cache-Control: private', false);
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="' . basename($url) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($r)); // provide file size
        header('Connection: close');
        echo $r;
    }


    function LimitWords($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public function AccessPage($Access, $ClassName)
    {
        $Class = $this->CI->router->fetch_class();
        $Method = $this->CI->router->fetch_method();

        $AccessPage = $Class . '/' . $Method;
        if ($Access != $AccessPage)
            return false;

        return $ClassName;
    }

    public function PageNow()
    {
        return $_SERVER['REQUEST_URI'];
    }
    function DateNow($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function SessionData()
    {
        $Level = $this->CI->credential->userdata('level');
        $NamaUser = $this->CI->credential->userdata('nama_anggota');
        $Email = $this->CI->credential->userdata('email');

        $Position = 'Staff';
        if ($Level == 1)
            $Position = 'Super Admin';
        elseif ($Level == 2)
            $Position = 'Kepala Satker';
        elseif ($Level == 100)
            $Position = 'Admin Surat Masuk';
        elseif ($Level == 101)
            $Position = 'Admin Surat Keluar';
        elseif ($Level == 'KOMANDAN')
            $Position = 'KOMANDAN SESKO TNI';
        elseif ($Level == 'WADAN')
            $Position = 'Wakil Komandan SESKO TNI';

        return [
            'level' => $Level,
            'nama_user' => $NamaUser,
            'email'     => $Email,
            'position'  => $Position
        ];
    }

    function GetPosition($level)
    {
        $position = '';
        if ($level == 1)
            $position = 'Super Admin';
        elseif ($level == 2)
            $position = 'Kepala Satker';
        elseif ($level == 100)
            $position = 'Admin Surat Masuk';
        elseif ($level == 101)
            $position = 'Admin Surat Keluar';
        elseif ($level == 'KOMANDAN')
            $position = 'KOMANDAN SESKO TNI';
        elseif ($level == 'WADAN')
            $position = 'Wakil Komandan SESKO TNI';

        return $position;
    }

    // filter array key
    public function ContainsArrayKey($arr, $contains, $except = null)
    {
        if (!is_array($arr))
            return false;
        $tampung = null;

        foreach ($arr as $key => $value) :
            if (strpos($key, $contains) !== false) {
                $tampung[$key] = $arr[$key];
            }

        endforeach;
        // cek kalo except tidak null
        if ($except != null) {
            // cek kalo bukan array
            if (!is_array($except)) return false;

            foreach ($except as $key => $list) :
                unset($tampung[$list]);
            endforeach;
        }

        return $tampung;
    }

    public function FilterArrayKey($array, $keyC, $contains)
    {
        if (!is_array($array))
            return false;

        $tampung = null;
        $counter = 0;
        $index = 0;
        foreach ($array as $key => $value) :
            if (isset($value[$keyC]) and $value[$keyC] == $contains)
                $tampung[$counter++] = $array[$index];

            $index++;
        endforeach;

        return $tampung;
    }

    public function AddPrefixArrayKeys($array, $prefix)
    {
        if (!is_array($array)) return false;
        $tampung = null;
        foreach ($array as $key => $list) :
            $tampung["{$key}{$prefix}"] = $list;
        endforeach;

        return $tampung;
    }
    public function ObjectToArray($object)
    {
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        if (is_array($object)) {
            return array_map(array($this, 'objectToArray'), $object);
        } else {
            return $object;
        }
    }

    public function ArrayGrouping($array, $key)
    {
        $result = [];
        foreach ($array as $element) {
            $result[$element[$key]][] = $element;
        }

        return $result;
    }
}
