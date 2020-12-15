<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    public function getUser()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        return $user;
    }
}

/* End of file Profile_model.php */
