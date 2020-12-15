<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('category_model');
    }

    public function index()
    {
        $data['title'] = 'Admin Category';
        $data['category'] =  $this->category_model->getCategory();

        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/category/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function create()
    {
        $this->form_validation->set_rules('title', 'Nama Kategori', 'trim|required|is_unique[category.title]', [
            'required' => 'Kolom tidak boleh kosong',
            'is_unique' => 'Nama kategori sudah digunakan'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Admin Category';
            $this->load->view('layout/header_admin', $data);
            $this->load->view('pages/admin/category/create', $data);
            $this->load->view('layout/footer_admin');
        } else {
            $data = [
                'title' => $_POST['title']
            ];

            $this->db->insert('category', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect('admin/category');
        }
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Category';
        $this->db->where('id', $id);
        $data['edit'] = $this->category_model->edit();

        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/category/edit', $data);
        $this->load->view('layout/footer_admin');
    }

    public function update()
    {
        if (!$_POST) {
            redirect("admin/category");
        }
        $id = $_POST['id'];

        $this->form_validation->set_rules('title', 'Nama Kategori', 'trim|required|is_unique[category.title]', [
            'required' => 'Kolom tidak boleh kosong',
            'is_unique' => 'Nama kategori sudah digunakan'
        ]);

        if ($this->form_validation->run() == false) {
            $data['edit'] = $this->category_model->edit();
            $data['title'] = 'Admin Category';
            $this->load->view('layout/header_admin', $data);
            $this->load->view("pages/admin/category/edit", $data);
            $this->load->view('layout/footer_admin');
        } else {
            $data = [
                'title' => $_POST['title']
            ];

            $this->db->where('id', $id);
            $this->db->update('category', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data berhasil di Update
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect('admin/category');
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('category');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
        redirect('admin/category');
    }
}
