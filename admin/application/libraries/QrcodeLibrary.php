<?php

include "phpqrcode/qrlib.php";

class QrcodeLibrary
{
    public function QRCode($data)
    {

        //ambil logo
        $logopath = base_url("assets/img/logo.png");


        // ambil file qrcode
        $QR =  imagecreatefrompng("https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={$data}&chld=Q|1");

        // memulai menggambar logo dalam file qrcode
        $logo = imagecreatefromstring(file_get_contents($logopath));

        imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
        imagealphablending($logo, false);
        imagesavealpha($logo, true);

        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width / 6;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;

        imagecopyresampled($QR, $logo, $QR_width / 2.4, $QR_height / 2.4, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        // nama file random
        $path = 'temp/' . sha1(time()) . '_qrwithlogo.png';

        // Simpan kode QR lagi, dengan logo di atasnya
        imagepng($QR, $path);

        // simpan image ke base64
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = "data:image/{$type};base64," . base64_encode($data);

        // kalo ada filenya, maka hapus
        if (file_exists($path))
            unlink($path);

        return $base64;
    }
}
