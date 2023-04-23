<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_setting extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read($key)
    {
        $this->db->select('*');
        $this->db->from('data_setting');

        if ($key != '') {
            $this->db->where('id_puskesmas', $key);
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

    public function create($data_setting)
    {
        return $this->db->insert('data_setting', $data_setting);
    }
    public function update($data_setting, $id_setting)
    {
        return  $this->db->update('data_setting', $data_setting, $id_setting);
    }
    public function delete($id_setting)
    {
        return $this->db->delete("data_setting", $id_setting);
    }
    public function count()
    {
        return $this->db->count_all("data_setting");
    }
}
