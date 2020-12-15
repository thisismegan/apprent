<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('customers_model');
        $this->load->library('pagination');
    }


    public function index()
    {
        $this->session->unset_userdata('keyword');

        if (isset($_POST['submit'])) {

            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }


        $data['title'] = 'Data Customers';

        $config['base_url'] = 'http://localhost/rental_ci/admin/customers/index';

        $this->db->like('name', $data['keyword']);
        $this->db->from('user');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);
        $data['page'] = $this->uri->segment(4);
        $data['customer'] = $this->customers_model->getCustomers($config['per_page'], $data['page'], $data['keyword']);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/customer/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect('admin/customers');
    }
}
