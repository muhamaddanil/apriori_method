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
        $tahun                                = $this->input->post('tahun');
        $jml_obat                             = $this->input->post('jml_obat');
        $jml_kombinasi                        = $this->input->post('jml_kombinasi');
        // $jml_kombinasi                        = 3;
        $min_support                          = $this->input->post('min_support');
        $minimum_confidence                   = $this->input->post('minimum_confidence');

        // DATA
        $data['input_id_obat']              = $input_id_obat;
        $data['input_tahun']                  = $tahun;
        $data['input_jml_obat']               = $jml_obat;
        $data['input_jml_kombinasi']          = $jml_kombinasi;
        $data['input_min_support']            = $min_support;
        $data['input_minimum_confidence']     = $minimum_confidence;

        // START EXECUTION TIME
        $execution_time = microtime(true);

        $data['data_tahun'] = $this->m_data_pemakaian_obat->read_tahun('');
        $menu['name'] = "Analisis";
        $arr          = $this->m_data_pemakaian_obat->read_with_obat($tahun);



        // JIKA DATA KOSONG
        if (!$arr) {
            // DATA
            $data['data_kosong']              = "Data Kosong";

            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_analisis/data_list', $data);
            $this->load->view('_template/footer');
        } else {
            $data_arr     = [];
            foreach ($arr as $key => $value) {
                // if ($key < $jml_obat)
                $data_arr[] = $value->id_obat;
            }
            $data_obat     = [];
            foreach ($arr as $key => $value) {
                // if ($key < $jml_obat)
                $data_obat[$value->id_obat] = $value;
            }

            $kombinasi = [];

            $loop = 0;

            function buatKombinasi($data_arr, &$kombinasi, $jumlahKombinasi, $input_id_obat, &$loop,  $temp = [])
            {
                // ulang sebanyak jumlah array nya
                for ($index = 0; $index < count($data_arr); $index++) {
                    // for ($index = 0; $index < 3; $index++) {

                    // hitung jumlah total looping
                    $loop++;

                    // buat array untuk kombinasi terbaru untuk setiap elemen
                    $kombinasiBaru = array_merge($temp, array($data_arr[$index]));


                    // jika id obat ada dalam kombinasi
                    if (in_array($input_id_obat, $kombinasiBaru)) {


                        // jika dalam ada data duplicate dalam kombinasiBari, jangan push ke dalam list kombinasi
                        if (count(array_unique($kombinasiBaru)) < count($kombinasiBaru)) {
                        } else {
                            // print_r($kombinasiBaru);
                            if ($jumlahKombinasi == 1) {
                                // urutkan kombinasi dari kecil ke besar
                                // agar -> A,B dan B,A dibaca sama
                                sort($kombinasiBaru);

                                if (!in_array($kombinasiBaru, $kombinasi)) {
                                    // cek kalau kombinasi baru sudah ada dalam kombinasi atau tidak
                                    // jika tidak ada / tidak sama, push ke dalam list kombinasi
                                    array_push($kombinasi, $kombinasiBaru);
                                }
                            } else {
                                // kalau jumlah kombinasi lebih besar dari 1, ulangi dengan membawa
                                // kombinasi yang sudah ada, kombinasi baru yang dibuat dan
                                // data awalnya
                                buatKombinasi($data_arr, $kombinasi, ($jumlahKombinasi - 1), $input_id_obat, $loop, $kombinasiBaru);
                            }
                        }
                    }
                }
            }

            // panggil fungsinya
            $key_index = array_search($input_id_obat, $data_arr);
            [$data_arr[0], $data_arr[$key_index]] = [$data_arr[$key_index], $data_arr[0]];

            // echo '<pre>';
            // echo $input_id_obat;
            // // print_r($arr);
            // print_r($data_arr);
            // die;
            // echo '<pre>';

            $jml_kombinasi = 3;
            for ($i = 0; $i < $jml_kombinasi; $i++) {
                buatKombinasi($data_arr, $kombinasi, $i + 1, $input_id_obat, $loop, array());
            }


            // HITUNG NILAI SUPPORT
            $loop_support = 0;
            foreach ($kombinasi as $key => $value) {
                $support = 0;
                for ($i = 0; $i <= 11; $i++) {
                    $cek = true;
                    foreach ($value as $key2 => $value2) {
                        $loop_support++;
                        $pemakaian = $this->m_data_pemakaian_obat->get_pemakaian($value2, $i, $tahun);
                        $cek_pemakaian = 0;
                        if (isset($pemakaian[0]->pemakaian))
                            $cek_pemakaian = $pemakaian[0]->pemakaian;

                        if ($cek_pemakaian and $cek) {
                        } else {
                            $cek = false;
                        }
                    }
                    if ($cek) {
                        $support++;
                    }
                }
                $kombinasi[$key]['support'] = $support;
                $kombinasi[$key]['jml_kombinasi'] = count($value);
                // echo '<br>';
            }
            // CARI SATU KOMBINASI
            $satu_kombinasi = [];
            $loop_satu_kombinasi = 0;
            foreach ($kombinasi as $key => $value) {
                if (count($value) < 4) {
                    $loop_satu_kombinasi++;
                    $satu_kombinasi[$key] = $value;
                } else
                    break;
            }

            // HAPUS NILAI YANG DIBAWAH MINIMUM SUPPORT
            // $min_support = 60;
            $loop_hapus_minimum_support = 0;
            $kombinasi_dibawah_minimum_support = 0;
            foreach ($kombinasi as $key => $value) {
                $loop_hapus_minimum_support++;
                $support = (int)$value['support'] / 12 * 100;
                $kombinasi[$key]['support_percent'] = $support;
                if ($support <= $min_support) {
                    $kombinasi[$key]['lulus'] = 'false';
                    // unset($kombinasi[$key]);
                    $kombinasi_dibawah_minimum_support++;
                } else {
                    $kombinasi[$key]['lulus'] = 'true';
                }
            }

            // CARI KOMBINASI DI ATAS NILAI CONFIDENCE
            $loop_confidence = 0;
            // $minimum_confidence = 90;
            $kombinasi_confidence = [];
            foreach ($kombinasi as $key => $value) {
                // foreach ($value as $key2 => $value2) {
                $confidence = 0;
                // foreach ($satu_kombinasi as $key3 => $value3) {
                // $loop_confidence++;
                // if ($value[0] == $value3[0]) {
                // echo $value2->support;
                // $confidence = (int)$value['support'] / (int)$value3['support'] * 100;
                $confidence = (int)$value['support'] / (int)$kombinasi[0]['support'] * 100;
                // break;
                // }
                // }
                $kombinasi[$key]['confidence'] = $confidence;
                if ($confidence >= $minimum_confidence) {
                    $kombinasi_confidence[$key] = $value;
                    $kombinasi_confidence[$key]['confidence'] = $confidence;
                }
            }
            // echo '<pre>';
            // echo $kombinasi[0]['support'];
            // print_r($satu_kombinasi);
            // print_r($kombinasi);
            // die;

            $execution_time = number_format(microtime(true) - $execution_time, 10, '.', ',');
            $total_kombinasi = count($kombinasi) + $kombinasi_dibawah_minimum_support;

            /* PRINT */
            // echo "<pre>";
            // echo "<- - - - - - - - DATA INPUT - - - - - - - - -> <br>";
            // echo 'Waktu Eksekusi = ' . $execution_time . 's <br>';
            // echo 'Banyak Data = ' . count($data_arr) . '<br>';
            // echo 'Jumlah Itemset Maksimal = ' . $jml_kombinasi . '<br>';
            // echo 'Minimum Support = ' . $min_support . '<br>';
            // echo 'Nilai Confidence = ' . $minimum_confidence . '<br>';

            // echo "<br><br><- - - - - - - - DATA KOMBINASI - - - - - - - - -> <br>";
            // echo 'Jumlah Semua Kombinasi = ' . $total_kombinasi . '<br>';
            // echo 'Jumlah Kombinasi Diatas Minimum Support = ' . $total_kombinasi - $kombinasi_dibawah_minimum_support . '<br>';
            // echo 'Jumlah Kombinasi Dibawah Minimum Support = ' . $kombinasi_dibawah_minimum_support . '<br>';
            // echo 'Jumlah Kombinasi Diatas Nilai Confidence = ' . count($kombinasi_confidence) . '<br>';
            // echo 'Jumlah Kombinasi Dibawah Nilai Confidence = ' . $total_kombinasi - count($kombinasi_confidence) . '<br>';
            // /* echo 'Loping = ' . number_format($loop, 0, ',', '.') . 'x <br>'; */

            // echo "<br><br><- - - - - - - - LOOPING - - - - - - - - -> <br>";
            // echo 'Loping Cari Kombinasi = ' . number_format($loop, 0, ',', '.') . 'x <br>';
            // echo 'Loping Cari Confidence = ' . number_format($loop_confidence, 0, ',', '.') . 'x <br>';
            // echo 'Loping Cari Satu Kombinasi = ' . number_format($loop_satu_kombinasi, 0, ',', '.') . 'x <br>';
            // echo 'Loping Cari Nilai Support = ' . number_format($loop_support, 0, ',', '.') . 'x <br>';
            // echo 'Loping Hapus Minimum Support = ' . number_format($loop_hapus_minimum_support, 0, ',', '.') . 'x <br>';
            // echo 'TOTAL LOOPING = ' . number_format($loop + $loop_confidence + $loop_hapus_minimum_support + $loop_support + $loop_hapus_minimum_support, 0, ',', '.') . 'x <br>';
            // /* echo "<br><br><- - - - - - - - - - - SATU KOMBINASI - - - - - - - - - -> <br>"; */
            // /* print_r($satu_kombinasi); */
            // echo "<br><br><- - - - - - - - - - - KOMBINASI CONFIDENCE - - - - - - - - - -> <br>";
            // print_r($kombinasi_confidence);
            // echo "<br><br><- - - - - - - - - - - - SEMUA KOMBINASI - - - - - - - - - -> <br>";
            // print_r($kombinasi);
            // echo "</pre>";
            // die;

            // INPUT POST

            // DATA
            $data['total_kombinasi']              = $total_kombinasi;
            $data['count_data']                   = count($data_arr);
            $data['execution_time']               = $execution_time;
            $data['kombinasi_confidence']         = count($kombinasi_confidence);
            $data['kombinasi']                    = $kombinasi;
            $data['data_obat']                    = $data_obat;

            // print_r($kombinasi);
            // die;
            // view
            $this->load->view('_template/header');
            $this->load->view('_template/sidebar', $menu);
            $this->load->view('data_analisis/data_list', $data);
            $this->load->view('_template/footer');
        }
    }
}
