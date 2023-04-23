<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_tentang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');


        // kalau tidak login maka
        if (!($this->session->userdata('id_pengguna'))) {
            // ALERT
            $alert = 'Silahkan Melakukan Login!';
            get_instance()->session->set_flashdata('alert', $alert);
            redirect('auth/login');
        }
    }

    public function index()
    {
        $menu['name'] = "Tentang";
        $this->load->view('_template/header');
        $this->load->view('_template/sidebar', $menu);
        $this->load->view('data_tentang/data_tentang', '');
        $this->load->view('_template/footer');
    }
}
