<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_pemakaian_obat extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read($key, $bulan, $group_by, $order_by)
    {
        $this->db->select('*, (select count(c.id_pemakaian) from data_pemakaian_obat c where a.kode_transaksi = c.kode_transaksi) as jumlah_obat');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');

        if ($key != '') {
            $this->db->where('a.id_obat', $key);
        }
        if ($bulan != '') {
            $this->db->where('bulan', $bulan);
        }
        if ($group_by != '') {
            $this->db->group_by($group_by);
        }
        if ($order_by != '') {
            $this->db->order_by($order_by);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }

    public function read_by_kode($kode)
    {
        $this->db->select('*');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');

        if ($kode != '') {
            $this->db->where($kode);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }

    public function get_pemakaian($id_obat, $bulan, $tahun)
    {
        $this->db->select('a.id_obat, a.bulan, a.pemakaian');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');
        // $this->db->where('a.pemakaian >', '0');


        if ($id_obat != '') {
            $this->db->where('a.id_obat', $id_obat);
        }
        if ($bulan != '') {
            $this->db->where('bulan', $bulan);
        }
        if ($tahun != '') {
            $this->db->where('tahun', $tahun);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }

    public function read_with_obat($tahun)
    {
        $this->db->select('*');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');
        $this->db->group_by('a.id_obat');
        $this->db->order_by('a.id_obat');

        if ($tahun != '') {
            $this->db->where('tahun', $tahun);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return null;
    }
    public function read_tahun()
    {
        $this->db->select('*');
        $this->db->from('data_pemakaian_obat');
        $this->db->group_by('tahun');


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return null;
    }

    public function read_bulan($bln, $group)
    {
        $this->db->select("*, (select GROUP_CONCAT(c.id_obat ORDER BY c.id_obat ASC) from data_pemakaian_obat c where a.kode_transaksi = c.kode_transaksi and c.tanggal like '%$bln%') as obat");
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');
        $this->db->like('a.tanggal', $bln);
        $this->db->group_by($group);


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return null;
    }

    public function read_obat_perbulan($bln)
    {
        $this->db->select("*, (select count(b.id_pemakaian) from data_pemakaian_obat b where a.id_obat = b.id_obat and b.tanggal like '%$bln%') as jlm_item");
        $this->db->from('data_obat a');
        $this->db->having('jlm_item > 0');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return null;
    }

    public function read_laporan()
    {
        $this->db->select('*');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');
        $this->db->group_by('tahun');
        $this->db->group_by('bulan');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }
    public function read_to_pdf($tahun, $bulan)
    {
        $this->db->select('*');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');

        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->order_by('b.nama_obat');


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }

    public function sum_ls($year)
    {
        $query = $this->db->query("SELECT
            (select sum(pemakaian) from data_pemakaian_obat where tahun=" . $year . ") as total_pemakaian
        ");
        $data = $query->result();
        return $data[0]->total_pemakaian;
    }

    public function create($data_obat)
    {
        return $this->db->insert('data_pemakaian_obat', $data_obat);
    }

    public function update($data_obat, $id_obat)
    {
        return  $this->db->update('data_pemakaian_obat', $data_obat, $id_obat);
    }
    public function delete($id_obat)
    {
        return $this->db->delete("data_pemakaian_obat", $id_obat);
    }
    public function count()
    {
        return $this->db->count_all("data_pemakaian_obat");
    }

    public function get($id)
    {
        $this->db->select('*');
        $this->db->from('data_pemakaian_obat a');
        $this->db->join('data_obat b', 'a.id_obat = b.id_obat');
        $this->db->where('a.id_pemakaian', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }
}
