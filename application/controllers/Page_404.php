<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page_404 extends CI_Controller
{

    public function index()
    {
        $this->load->view('page_404');
    }
}

/* End of file Page_404.php */
