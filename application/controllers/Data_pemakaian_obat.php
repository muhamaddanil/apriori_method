<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pemakaian_obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data_pemakaian_obat');
        $this->load->model('m_data_obat');
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
        if ($this->session->userdata('id_grup') != 1) {
            // ALERT
            $alert = "<script type='text/javascript'>alert('Anda Tidak Punya Akses Ke Halaman Ini!');</script>";
            get_instance()->session->set_flashdata('alert', $alert);
            redirect('home_page');
        }
    }

    public function index()
    {
        $data['files'] = $this->m_data_pemakaian_obat->read('', '', 'a.kode_transaksi', '');


        $menu['name'] = "Data Pemakaian Obat";

        $this->load->view('_template/header');
        $this->load->view('_template/sidebar', $menu);
        $this->load->view('data_pemakaian_obat/data_list', $data);
        $this->load->view('_template/footer');
    }

    public function create()
    {
        if (!empty($this->input->post('id_obat'))) {
            // $this->form_validation->set_rules('id_obat', 'id_obat', 'trim|required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
            $this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
            $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
            $this->form_validation->set_rules('kode_transaksi', 'kode_transaksi', 'trim|required');
        }

        if ($this->form_validation->run() == true) {

            if (!empty($this->input->post('id_obat'))) {
                for ($i = 0; $i < count($this->input->post('id_obat')); $i++) {
                    $data["id_obat"] = $this->input->post('id_obat')[$i];
                    $data["tanggal"] = $this->input->post('tanggal');
                    $data["bulan"] = $this->input->post('bulan');
                    $data["tahun"] = $this->input->post('tahun');
                    $data["kode_transaksi"] = $this->input->post('kode_transaksi');
                    $data["pemakaian"] = 1;

                    $this->m_data_pemakaian_obat->create($data);
                }
            }

            $alert = '<div class="card p-3 bg-success text-white">Berhasil menambah data pemakaian obat </div>';
            get_instance()->session->set_flashdata('alert', $alert);

            redirect(site_url('data_pemakaian_obat'));
            return;
        } else {
            $menu['name'] = "Data Pemakaian Obat";
            $data['obat'] = $this->m_data_obat->read('');
            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_pemakaian_obat/data_create', $data);
            $this->load->view('_template/footer');
        }
    }

    public function edit($data_id = null)
    {
        if (!empty($this->input->post('id_obat'))) {
            // $this->form_validation->set_rules('id_obat', 'id_obat', 'trim|required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
            $this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
            $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
            $this->form_validation->set_rules('kode_transaksi', 'kode_transaksi', 'trim|required');
        }

        if ($this->form_validation->run() == true) {

            if (!empty($this->input->post('id_obat'))) {
                $this->m_data_pemakaian_obat->delete(array('kode_transaksi' => $this->input->post('kode_transaksi')));
                for ($i = 0; $i < count($this->input->post('id_obat')); $i++) {
                    $data["id_obat"] = $this->input->post('id_obat')[$i];
                    $data["tanggal"] = $this->input->post('tanggal');
                    $data["bulan"] = $this->input->post('bulan');
                    $data["tahun"] = $this->input->post('tahun');
                    $data["kode_transaksi"] = $this->input->post('kode_transaksi');
                    $data["pemakaian"] = 1;
                    $this->m_data_pemakaian_obat->create($data);
                }
            }

            $alert = '<div class="card p-3 bg-warning text-white">Berhasil mengubah data pemakaian obat </div>';
            get_instance()->session->set_flashdata('alert', $alert);

            redirect(site_url('data_pemakaian_obat'));
            return;
        } else {
            $data['files'] = $this->m_data_pemakaian_obat->read_by_kode("a.kode_transaksi = '$data_id'");
            // print_r($data_id);
            // die;
            $menu['name'] = "Data Pemakaian Obat";
            $data['obat'] = $this->m_data_obat->read('');
            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_pemakaian_obat/data_edit', $data);
            $this->load->view('_template/footer');
        }
    }


    public function delete($data_id = null)
    {
        if ($data_id == null) redirect(site_url('data_pemakaian_obat'));

        $id['kode_transaksi'] = $data_id;
        if ($this->m_data_pemakaian_obat->delete($id)) {

            $alert = '<div class="card p-3 bg-danger text-white">Berhasil menghapus data pemakaian obat </div>';
            get_instance()->session->set_flashdata('alert', $alert);

            redirect(site_url('data_pemakaian_obat'));
            return;
        }
    }
}
