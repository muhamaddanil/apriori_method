<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_pengguna extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function create($data_pengguna)
    {
        return $this->db->insert('data_pengguna', $data_pengguna);
    }
    public function read($key)
    {
        $this->db->select('*');
        $this->db->from('data_pengguna a');
        $this->db->join('data_grup b', 'a.id_grup = b.id_grup');


        if ($key != '') {
            $this->db->where('id_pengguna', $key);
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
    public function update($data_pengguna, $id_pengguna)
    {
        return  $this->db->update('data_pengguna', $data_pengguna, $id_pengguna);
    }
    public function delete($id_pengguna)
    {
        return $this->db->delete("data_pengguna", $id_pengguna);
    }
    public function count()
    {
        return $this->db->count_all("data_pengguna");
    }
}
