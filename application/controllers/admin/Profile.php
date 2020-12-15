<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('profile_model');
    }

    public function index()
    {

        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]', [
            'required' => 'Kolom tidak boleh kosong',
            'min_length' => 'Minimal 5 karakter',
        ]);
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|required|min_length[9]|max_length[15]|numeric', [
            'required' => 'Kolom tidak boleh kosong',
            'min_length' => 'Minimal 9 angka',
            'max_length' => 'Maksimal 15 angka',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required|min_length[10]', [
            'required' => 'Kolom tidak boleh kosong',
            'min_length' => 'Minimal 10 angka',
        ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Edit Profil-Admin';
            $data['profile'] = $this->profile_model->getUser();
            $this->load->view('layout/header_admin', $data);
            $this->load->view('pages/admin/profile/index', $data);
            $this->load->view('layout/footer_admin');
        } else {

            $email = $this->session->userdata('email');
            $image = $_FILES['image']['name'];
            if ($image) {
                $config['upload_path']          = './assets/images/profil/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['encrypt_name']         = true;
                $config['overwrite']            = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old = $this->session->userdata('image');
                    if ($old != 'default.png') {
                        unlink(FCPATH . 'assets/images/profil/' . $old);
                    }
                    $new = $this->upload->data('file_name');
                    $this->db->set('image', $new);
                }
            }
            $data = [
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'updated' => date('Y-m-d')
            ];
            // var_dump($data);
            // die;
            $this->db->set($data);
            $this->db->where('email', $email);
            $this->db->update('user');



            $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Profil berhasil diupdate</h5>
          </div>');

            redirect('admin/dashboard');
        }
    }
}

/* End of file .php */
