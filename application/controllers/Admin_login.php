<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_login extends CI_Controller
{
    // mengkoneksikan secara langsung antara model dan controller
    function __construct()
    {

        parent::__construct();
        $this->load->model('login_model');
    }
    // untuk memanggi funcition
    public function index()
    {
        $data['pesan'] = "";
        $this->load->view('login', $data);
        # code...
    }
    public function proses_login()
    {
        # code...  
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        $ceklogin = $this->login_model->akses_login($user, $pass);
        if ($ceklogin) {
            # kalau sukses
            foreach ($ceklogin as $r) {
                $this->session->set_userdata('id_users', $r->id_users);
                $this->session->set_userdata('nama_lengkap', $r->nama_lengkap);
                $this->session->set_userdata('username', $r->username);
                $this->session->set_userdata('password', $r->password);
                $this->session->set_userdata('email', $r->email);
                $this->session->set_userdata('level', $r->level);
                redirect('Admin/index');
            }
        } else {
            # code...
            $data['pesan'] = 'username paswod salah';
            $this->load->view('login', $data);
        }
    }
}
