<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{

    public function getCart()
    {
        $id = $this->session->userdata('id');
        $query = "SELECT cart.id, cart.id_user, cart.subtotal,cart.qty, cart.tgl_sewa, cart.tgl_kembali, product.title,product.price,product.image
                  FROM cart
                  JOIN product
                  ON cart.kode_produk = product.kode_produk
                  WHERE cart.id_user = $id";

        $cart = $this->db->query($query)->result_array();

        return $cart;
    }

    public function getUpdate()
    {
        $id = $this->session->userdata('id');
        $id_produk = $this->input->post('kode_produk');
        $cart = $this->db->get_where('cart', ['id_user' => $id], ['kode_produk' => $id_produk])->row_array();
        return $cart;
    }
}
