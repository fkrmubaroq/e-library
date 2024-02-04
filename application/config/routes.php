<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'ControllerDashboard/index';
$route['dashboard'] = 'ControllerDashboard/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['buku/rating/(:any)'] = 'ControllerBuku/RatingBuku/$1';
$route['baca/(:any)'] = 'ControllerBuku/BacaBuku/$1';
$route['preview/(:any)'] = 'ControllerBuku/PreviewBuku/$1';

$route['buku/(:any)'] = 'ControllerBuku/Detail/$1';
$route['buku/(:any)/pinjam'] = 'ControllerBuku/PinjamBuku/$1';
$route['pinjam'] = 'ControllerBuku/ListPinjam';
$route['pinjam/remove/(:any)'] = 'ControllerBuku/RemoveBuku/$1';
$route['checkout_proses'] = 'ControllerTransaksi/CheckoutProccess';
$route['checkout/(:any)'] = 'ControllerTransaksi/Checkout/$1';

$route['login'] = 'Login/index';
$route['logout'] = 'Login/Logout';
$route['login/store'] = 'Login/Store';

$route['riwayat'] = 'ControllerTransaksi/Riwayat';
$route['profil'] = 'ControllerDashboard/profil';
