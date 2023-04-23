<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Home_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data_obat');
        $this->load->model('m_data_pemakaian_obat');
        $this->load->model('m_data_pengguna');
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
        $menu['name'] = "Beranda";
        $menu['jumlah_obat'] = $this->m_data_obat->count();
        $menu['jumlah_pengguna'] = $this->m_data_pengguna->count();

        $this->load->view('_template/header');
        $this->load->view('_template/sidebar', $menu);
        $this->load->view('_template/content');
        $this->load->view('_template/footer');
    }

    function import_obat()
    {
        $char = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AB', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
            'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
        ];

        if ($_FILES['guest_import_file']['name'] != "") {
            $path = $_FILES["guest_import_file"]["tmp_name"];

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    $data['nama_obat']             = $row[$char[0]];
                    $data['satuan']          = $row[$char[1]];
                    $this->m_data_obat->create($data);
                }
                $numrow++;
            }
            // LOG
            $message    = $this->session->userdata('user_name') . " menambah data tamu";

            // ALERT
            $alertStatus  = "success";
            $alertMessage = "Berhasil menambah data tamu";
            redirect('data_obat');
        } else {
            // ALERT
            $alertStatus  = "failed";
            $alertMessage = "Gagal menambah data tamu";
            redirect('data_obat');
        }
    }

    function import_penggunaan_obat()
    {
        $char = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AB', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
            'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
        ];

        if ($_FILES['guest_import_file']['name'] != "") {
            $path = $_FILES["guest_import_file"]["tmp_name"];

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    $check = $this->m_data_obat->check_obat_by_nama($row[$char[3]]);
                    if (!empty($check)) {
                        $data['id_obat']             = $check[0]->id_obat;
                        $data['bulan']             = $row[$char[1]];
                        $data['tahun']          = $row[$char[2]];
                        $data['tanggal']          = $row[$char[2]] . '-' . $row[$char[1]] . '-' . $row[$char[0]];
                        $data['kode_transaksi']             = $row[$char[4]];
                        $data['pemakaian']             = 1;
                        $this->m_data_pemakaian_obat->create($data);
                    }
                }
                $numrow++;
            }
            // LOG
            $message    = $this->session->userdata('user_name') . " menambah data tamu";

            // ALERT
            $alertStatus  = "success";
            $alertMessage = "Berhasil menambah data tamu";
            redirect('data_pemakaian_obat');
        } else {
            // ALERT
            $alertStatus  = "failed";
            $alertMessage = "Gagal menambah data tamu";
            redirect('data_pemakaian_obat');
        }
    }
}
