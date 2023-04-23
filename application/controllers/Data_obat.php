<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data_obat');
        $this->load->helper('array');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('session');


        // kalau tidak login maka
        $this->load->library('session');
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
        $data['files'] = $this->m_data_obat->read('');

        $menu['name'] = "Data Obat";
        $this->load->view('_template/header');
        $this->load->view('_template/sidebar', $menu);
        $this->load->view('data_obat/data_list', $data);
        $this->load->view('_template/footer');
    }

    public function create()
    {
        if (!empty($this->input->post('nama_obat'))) {
            $this->form_validation->set_rules('nama_obat', 'nama_obat', 'trim|required');
            $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
        }

        if ($this->form_validation->run() == true) {
            $data["nama_obat"] = $this->input->post('nama_obat');
            $data["satuan"] = $this->input->post('satuan');

            if ($this->m_data_obat->create($data)) {

                redirect(site_url('data_obat'));
                return;
            }
        } else {
            $menu['name'] = "Data Obat";
            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_obat/data_create');
            $this->load->view('_template/footer');
        }
    }

    public function edit($data_id = null)
    {
        if (!empty($this->input->post('nama_obat'))) {
            $this->form_validation->set_rules('nama_obat', 'nama_obat', 'trim|required');
            $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
        }

        if ($this->form_validation->run() == true) {
            $data["nama_obat"] = $this->input->post('nama_obat');
            $data["satuan"] = $this->input->post('satuan');

            $id_obat['id_obat'] = $this->input->post('id_obat');

            if ($this->m_data_obat->update($data, $id_obat)) {

                $alert = '<div class="card p-3 bg-success text-white">Berhasil mengubah data obat ' . $data["nama_obat"] . '</div>';
                get_instance()->session->set_flashdata('alert', $alert);

                redirect(site_url('data_obat'));
                return;
            }
        } else {
            $data['files'] = $this->m_data_obat->read($data_id);
            $menu['name'] = "Data Obat";
            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_obat/data_edit', $data);
            $this->load->view('_template/footer');
        }
    }


    public function delete($id_obat = null)
    {
        if ($id_obat == null) redirect(site_url('data_obat'));

        $id['id_obat'] = $id_obat;
        if ($this->m_data_obat->delete($id)) {
            redirect(site_url('data_obat'));
            return;
        }
    }

    public function to_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('data_obat/data_pdf', [], true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
