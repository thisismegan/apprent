<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{

    public function getAllTransaksi()
    {
        return $this->db->get('transaksi')->result_array();
    }
}
