<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    function getUser()
    {

        $getUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        return $getUser;
    }

    public function chart()
    {
        $query = "SELECT product.kode_produk,product.title,product.id_category,
                        category.id,category.title as category_title,
                        detail_transaksi.id_transaksi,detail_transaksi.kode_produk,detail_transaksi.qty
                 FROM product
                 JOIN category ON product.id_category = category.id
                 JOIN detail_transaksi ON product.kode_produk = detail_transaksi.kode_produk
                 WHERE product.kode_produk = detail_transaksi.kode_produk
                 ";

        $chart = $this->db->query($query)->result_array();
        return $chart;
    }
}
