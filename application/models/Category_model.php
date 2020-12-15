<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{

    function getCategory()
    {
        $category = $this->db->get('category')->result_array();
        return $category;
    }

    function edit()
    {
        $category = $this->db->get('category')->row_array();
        return $category;
    }
}
