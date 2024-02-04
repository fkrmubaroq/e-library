<?php

/* ======== [ STATUS AUTH ] ========
 * 410 => Error pada code
 * 411 => Belum Login
 * 412 => Level tidak diketahui
 * 413 => Dilarang mengakses halaman
 */
class Auth extends CI_Model
{
    function __construct()
    {
        $this->RolesUserMenu();
    }

    private function RolesUserMenu(){
        try{
            $Level = $this->session->LEVEL;

            // kalo levelnya 'null'
            if($Level == null)
                throw new Exception("Anda Belum Login",411);

            // cek level kalo melebihi aturan
            if($Level <= 0 || $Level > 4 )
                throw new Exception("Unknown Roles User",412);

            // kalo loginnya sebagai staff biasa => 3
            if($Level == 3){
                $this->RoleAkses(            
                    [  // akses yang ga boleh di akses sama user
                        "/office/eletter/admin/surat/masuk",
                        "/office/eletter/admin/surat/keluar"
                    ]);

            }
            
            // kalo loginnya sebagai adminpersuratan => 4
            elseif($Level == 4){
                $this->RoleAkses(            
                    [  // akses yang ga boleh di akses sama Adminpersuratan
                        "/office/eletter/admin/approval",
                    ]);

            }

        }catch(Exception $Error){
            // $this->req->print($Error);
            $StatusCode = $Error->getCode();
            $Redirect = '';
            
            if( $StatusCode == 410 || $StatusCode == 411 || $StatusCode == 412 ) 
                $Redirect = base_url(); // halaman login

            elseif($StatusCode == 413)
                $Redirect = base_url('admin'); // halaman dashboard admin

            // set message
            $this->session->set_flashdata("pesan","<script>toastWarning('" .($Error->getMessage()) ."','Peringatan')</script>");
            redirect($Redirect);

        }catch(Throwable $Error){
            
            $this->session->set_flashdata("pesan","<script>toastWarning('Throwable :". ($Error->getMessage()) ."','Kesalahan')</script>");
            redirect($Redirect);

        }
    }

    private function RoleAkses($DissAllowAccess){
        try{

            // User mengakses page, disimpan di variabel 'PageAccess'
            $PageAccess = $_SERVER['REQUEST_URI'];
 

            // kalo user mengakses page yang dilarang
            if(in_array($PageAccess,$DissAllowAccess))
                throw new Exception("Perlu Akses khusus untuk mengakses halaman ini, silahkan hubungi administrator",413);

            // kalo 'true', user berhak mengakses halaman ini
            return true;

        }catch(Exception $Error){
            throw new Exception($Error->getMessage(),$Error->getCode());
        }catch(Throwable $Error){
            throw new Exception("Throwable : ".$Error->getMessage(),410);
        }
    }

}