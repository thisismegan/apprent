<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers_model extends CI_Model
{

    public function getCustomers($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('name', $keyword);
        }
        $this->db->limit($limit, $start);

        $customers = $this->db->get('user')->result_array();


        return $customers;
    }
}
