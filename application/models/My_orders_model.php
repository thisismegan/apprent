<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_orders_model extends CI_Model
{

    public function getOrders()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('transaksi', ['id_user' => $this->session->userdata('id')])->result_array();
    }

    public function getAllOrders()
    {
        return $this->db->get('transaksi')->result_array();
    }
}
