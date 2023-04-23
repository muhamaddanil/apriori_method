<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_analisis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_data_obat');
        $this->load->model('m_data_pemakaian_obat');
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
        $data['data_tahun'] = $this->m_data_pemakaian_obat->read_tahun('');
        $data['data_obat'] = $this->m_data_obat->read('', '', '');
        $menu['name'] = "Analisis";

        $this->load->view('_template/header');
        $this->load->view('_template/sidebar', $menu);
        $this->load->view('data_analisis/data_list', $data);
        $this->load->view('_template/footer');
    }

    public function method()
    {
        // POST
        $input_id_obat                            = $this->input->post('input_id_obat');
        $tgl_mulai                                = $this->input->post('tgl_mulai');
        $tgl_selesai                                = $this->input->post('tgl_selesai');
        $jml_obat                             = $this->input->post('jml_obat');
        $jml_kombinasi                        = $this->input->post('jml_kombinasi');
        // $jml_kombinasi                        = 3;
        $min_support                          = $this->input->post('min_support');
        $minimum_confidence                   = $this->input->post('minimum_confidence');

        // DATA
        $data['input_id_obat']              = $input_id_obat;
        $data['input_tgl_mulai']                  = $tgl_mulai;
        $data['input_tgl_selesai']                  = $tgl_selesai;
        $data['input_jml_obat']               = $jml_obat;
        $data['input_jml_kombinasi']          = $jml_kombinasi;
        $data['input_min_support']            = $min_support;
        $data['input_minimum_confidence']     = $minimum_confidence;
        $data['data_obat'] = $this->m_data_obat->read('', '', '');

        // START EXECUTION TIME
        $execution_time = microtime(true);

        // $data['data_tahun'] = $this->m_data_pemakaian_obat->read_bulan($tahun);
        $menu['name'] = "Analisis";
        $arr          = $this->m_data_pemakaian_obat->read_obat_perbulan($tgl_mulai, $tgl_selesai);
        $transaksi          = $this->m_data_pemakaian_obat->read_bulan($tgl_mulai, $tgl_selesai, 'a.kode_transaksi');

        // echo '<pre>';
        // print_r($arr);
        // echo '</pre>';
        // die;

        // JIKA DATA KOSONG
        if (!$arr) {
            // DATA
            $data['data_kosong']              = "Data Kosong";

            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_analisis/data_list', $data);
            $this->load->view('_template/footer');
        } else {
            $kombinasi = [];

            $jml_transaksi = !empty($transaksi) ? count($transaksi) : 0;
            $data_arr     = [];
            for ($i = 0; $i < $jml_kombinasi; $i++) {
                if ($i == 0) {
                    foreach ($arr as $key => $value) {
                        $support = $value->jlm_item / $jml_transaksi * 100;
                        if ($support > $min_support) {
                            // if ($value->id_obat == $input_id_obat) {
                            //     $kombinasi[$i][] = (object) array(
                            //         'id_obat' => $value->id_obat,
                            //         'jlm_item' => $value->jlm_item,
                            //         'support' => $support,
                            //         'confidence' => 100,
                            //         'input_id_obat' => $input_id_obat,
                            //     );
                            // }
                            $kombinasi[$i][] = (object) array(
                                'id_obat' => $value->id_obat,
                                'jlm_item' => $value->jlm_item,
                                'support' => $support,
                                'confidence' => 100,
                                // 'input_id_obat' => $input_id_obat,
                            );
                        }
                    }
                    array_multisort(array_column((array)$kombinasi[$i], 'support'), SORT_DESC, $kombinasi[$i]);
                }
                if ($i > 0) {

                    $item_set_2 = [];

                    foreach ($kombinasi[$i - 1] as $key => $value) {

                        // if ($input_id_obat != $value->id_obat) {

                        $_jml_item = 0;
                        if ($i > 1) {
                            $arr_exp_kombinasi = '';
                            foreach ($kombinasi[$i - 1] as $key => $value2) {
                                $arr_exp_kombinasi .= $value2->id_obat . ',';
                            }
                            $arr_exp_kombinasi_exp = array_unique(explode(',', $arr_exp_kombinasi));

                            // echo '<pre>';
                            // print_r($arr_exp_kombinasi_exp);
                            // echo '</pre>';
                            // die;
                            foreach ($arr_exp_kombinasi_exp as $value2) {
                                if (!empty($value2)) {
                                    $exp_kombinasi = explode(',', $value->id_obat);
                                    // for ($k = 0; $k < count($exp_kombinasi); $k++) {
                                    if (array_search($value2, $exp_kombinasi) == false) {
                                        $id_obat_ = $value->id_obat . ',' . $value2;


                                        $id_obat_ = explode(',', $id_obat_);
                                        sort($id_obat_);
                                        $id_obat_ = implode(',', $id_obat_);

                                        foreach ($transaksi as $tra => $trans_value) {
                                            $exp_arr = explode(',', $trans_value->obat);
                                            $id_obat__ = explode(',', $id_obat_);
                                            $jml_ = 0;
                                            for ($l = 0; $l < count($id_obat__); $l++) {
                                                if (array_search($id_obat__[$l], $exp_arr) !== false) {
                                                    $jml_++;
                                                    $exp_arr = array_diff($exp_arr, [$id_obat__[$l]]);
                                                }
                                            }
                                            if (count($id_obat__) == $jml_) {
                                                $_jml_item++;
                                                // break;
                                            }
                                        }
                                        if ($_jml_item > 0)
                                            break;
                                    }
                                }
                            }
                        } else {
                            $id_obat_ = $value->id_obat . ',' . $input_id_obat;

                            $id_obat_ = explode(',', $id_obat_);
                            sort($id_obat_);
                            $id_obat_ = implode(',', $id_obat_);

                            foreach ($transaksi as $tra => $trans_value) {
                                $exp_arr = explode(',', $trans_value->obat);
                                $id_obat__ = explode(',', $id_obat_);
                                $jml_ = 0;
                                for ($l = 0; $l < count($id_obat__); $l++) {
                                    if (array_search($id_obat__[$l], $exp_arr) !== false) {
                                        $jml_++;
                                        $exp_arr = array_diff($exp_arr, [$id_obat__[$l]]);
                                    }
                                }
                                if (count($id_obat__) == $jml_)
                                    $_jml_item++;
                            }
                        }
                        // }


                        $support = $_jml_item / $jml_transaksi * 100;
                        $confidence = $_jml_item / $value->jlm_item * 100;
                        if (!in_array($id_obat_, array_column((array)$item_set_2, 'id_obat'))) {
                            if ($i < $jml_kombinasi - 1) {
                                if ($support > $min_support) {
                                    $item_set_2[] = (object)array(
                                        'id_obat' => $id_obat_,
                                        'jlm_item' => $_jml_item,
                                        'support' => $support,
                                        'confidence' => $confidence,
                                    );
                                }
                            } else {
                                $item_set_2[] = (object)array(
                                    'id_obat' => $id_obat_,
                                    'jlm_item' => $_jml_item,
                                    'support' => $support,
                                    'confidence' => $confidence,
                                );
                            }
                        }
                    }
                    array_multisort(array_column((array)$item_set_2, 'support'), SORT_DESC, $item_set_2);
                    $kombinasi[$i] = $item_set_2;
                }
            }

            // 2 Item Set

            // $data['total_kombinasi']              = $total_kombinasi;
            $data['count_data']                   = count($data_arr);
            $data['execution_time']               = $execution_time;
            // $data['kombinasi_confidence']         = count($kombinasi_confidence);
            $data['kombinasi']                    = $kombinasi;

            // echo '<pre>';
            // print_r($transaksi);
            // echo '</pre>';

            // echo '<pre>';
            // print_r($kombinasi);
            // echo '</pre>';
            // die;
            // view
            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_analisis/data_list', $data);
            $this->load->view('_template/footer');
        }
    }
}
