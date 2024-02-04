<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard/index';
$route['anggota'] = 'Anggota/index';

$route['jabatan'] = 'Jabatan/index';
$route['divisi'] = 'Divisi/index';
$route['jenis'] = 'Jenis/index';

$route['pinjam/detail/(:num)'] = 'Pinjam/DetailPinjam/$1';
$route['pinjam/acc/(:any)'] = 'Pinjam/AccPinjam/$1';
$route['pinjam/batalacc/(:any)'] = 'Pinjam/BatalPinjam/$1';

$route['login'] = 'Login/index';
$route['logout'] = 'Login/logout';
