<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Member';
        $data['user']  = $this->Dashboard_model->getUser();

        $this->load->view('layout/header', $data);
        $this->load->view('pages/member/index');
        $this->load->view('layout/footer');
    }
}

/* End of file Dashboard.php */
