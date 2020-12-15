<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public function getProduct($limit, $start = null)
    {

        $query = "SELECT product.kode_produk as product_id,product.id_category,product.title as product_title ,product.price,product.image,product.description,product.is_available,category.id,category.title
        FROM product
        JOIN category
        ON product.id_category = category.id
        ORDER BY kode_produk DESC
        LIMIT $start, $limit
        ";
        $product = $this->db->query($query)->result_array();


        return $product;
    }

    public function edit($id)
    {
        $query = "SELECT product.kode_produk as product_id ,product.id_category,product.title as product_title ,product.price,product.image,product.description,product.is_available,category.id,category.title
        FROM product
        JOIN category
        ON product.id_category = category.id
        WHERE kode_produk= '$id'
        ";

        $edit = $this->db->query($query)->row_array();

        return $edit;
    }

    public function search($limit, $start)
    {
        if (!$_POST) {

            redirect('admin/product');
        }
        if (isset($_POST['status'])) {
            if ($_POST['status'] == 'all') {

                $this->session->set_userdata('keyword', $this->input->post('keyword'));

                $keyword = $this->session->userdata('keyword');
                $this->db->like('title', $keyword);
                $query = "SELECT product.kode_produk as product_id,product.id_category,product.title as product_title ,product.price,product.image,product.description,product.is_available,category.id,category.title
                FROM product
                JOIN category
                ON product.id_category = category.id
                WHERE product.title LIKE '%$keyword%'
                LIMIT $start, $limit
                ";

                $product = $this->db->query($query)->result_array();

                return $product;
            }

            $this->session->set_userdata('status', $this->input->post('status'));
            $this->session->set_userdata('keyword', $this->input->post('keyword'));

            $status = $this->session->userdata('status');
            $keyword = $this->session->userdata('keyword');

            $query = "SELECT product.kode_produk as product_id,product.id_category,product.title as product_title ,product.price,product.image,  product.description,product.is_available,category.id,category.title
                FROM product
                JOIN category
                ON product.id_category = category.id
                WHERE is_available = $status AND product.title LIKE '%$keyword%' 
                LIMIT $start, $limit
                ";


            $product = $this->db->query($query)->result_array();


            return $product;
        }
    }

    public function getMax()
    {
        $query = "SELECT max(kode_produk) as kodeTerbesar FROM product";

        return $this->db->query($query)->row_array();
    }
}
