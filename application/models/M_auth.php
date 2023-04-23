<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_auth extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validate($username)
    {
        $this->db->select("*");
        $this->db->from('data_pengguna a');
        $this->db->join('data_grup b', 'a.id_grup = b.id_grup');
        $this->db->where('a.username', $username);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    // function __destruct()
    // {
    //     $this->db->close();
    // }
}
