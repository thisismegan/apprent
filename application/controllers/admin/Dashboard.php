<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('dashboard_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['chart'] = $this->dashboard_model->chart();
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/index', $data);
        $this->load->view('layout/footer_admin', $data);
    }
}
