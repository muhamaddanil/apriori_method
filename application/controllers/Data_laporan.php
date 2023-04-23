<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data_pemakaian_obat');
        $this->load->model('m_data_obat');
        $this->load->model('m_data_setting');
        $this->load->helper('array');
        $this->load->library("pagination");
        $this->load->library('form_validation');
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
        $data['files'] = $this->m_data_pemakaian_obat->read_laporan();


        $menu['name'] = "Data Laporan";

        $this->load->view('_template/header');
        $this->load->view('_template/sidebar', $menu);
        $this->load->view('data_laporan/data_list', $data);
        $this->load->view('_template/footer');
    }


    public function to_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $tahun = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);


        $data['laporan'] = $this->m_data_pemakaian_obat->read_to_pdf($tahun, $bulan);
        $data['setting'] = $this->m_data_setting->read('');

        // $this->load->view('data_laporan/data_pdf', $data);

        $html = $this->load->view('data_laporan/data_pdf', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Laporan Pemakaian Obat ' . $tahun . '-' . ($bulan + 1), 'D');
    }
}
