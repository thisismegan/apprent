<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') !== 'member') {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Profile';
        $data['profil'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('pages/member/profile/index', $data);
        $this->load->view('layout/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Profile';
        $data['edit'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('pages/member/profile/edit', $data);
        $this->load->view('layout/footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]', [
            'required' => 'Kolom %s tidak boleh kosong',
            'min_length' => '%s Minimal 5 karakter'
        ]);
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|required|min_length[9]|max_length[15]|numeric', [
            'required' => 'Kolom %s tidak boleh kosong',
            'min_length' => 'Nomor %s Minimal 9 angka',
            'max_length' => 'Nomor %s Maksimal 15 angka',
            'numeric'   => 'Kolom %s hanya boleh berisi angka'
        ]);
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required|min_length[9]', [
            'required' => 'Kolom %s tidak boleh kosong',
            'min_length' => '%s Minimal 9 angka',
        ]);

        if ($this->form_validation->run() == false) {
            $id = $_POST['id'];
            $this->edit($id);
        } else {
            $email = $this->input->post('email');
            $data = [
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address')
            ];

            $this->db->set($data);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil berhasi di update!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('member/profile');
        }
    }

    public function update_pic()
    {
        $id = $this->input->post('id');
        $image = $_FILES['image']['name'];

        if (!$image) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tidak ada file yang diupload
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('member/profile');
        }

        if ($image) {
            $config['upload_path']          = './assets/images/profil/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $config['encrypt_name']         = true;
            $config['overwrite']            = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old = $this->input->post('old_image');
                if ($old != 'default.png') {
                    unlink(FCPATH . 'assets/images/profil/' . $old);
                }
                $new = $this->upload->data('file_name');
                $this->db->set('image', $new);
                $this->db->where('id', $id);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Foto Profil berhasi di update!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect('member/profile');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Ukuran foto tidak boleh lebih dari 2Mb!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect('member/profile');
            }
        }
    }

    public function change_password()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Ubah Password';

        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Kolom %s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('new_password', 'Password baru', 'trim|required|min_length[8]', [
            'required' => 'Kolom %s tidak boleh kosong',
            'min_length' => '%s minimal 8 karakter'
        ]);
        $this->form_validation->set_rules('conf_newpassword', 'Konfirmasi Password', 'trim|required|matches[new_password]', [
            'required' => 'Kolom %s tidak boleh kosong',
            'matches' => '%s tidak sama dengan password baru'
        ]);
        if ($this->form_validation->run() == false) {


            $this->load->view('layout/header', $data);
            $this->load->view('pages/member/profile/change_password', $data);
            $this->load->view('layout/footer');
        } else {
            $pass_lama = $this->input->post('password');
            $pass_baru = $this->input->post('new_password');
            if (!password_verify($pass_lama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password yang anda masukkan tidak sama dengan password saat ini
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect('member/profile/change_password');
            } else {
                if ($pass_baru == $pass_lama) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password baru tidak boleh sama dengan password lama
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect('member/profile/change_password');
                } else {
                    $password_hash = password_hash($pass_baru, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $data['user']['email']);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil di diganti
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect('member/profile/change_password');
                }
            }
        }
    }
}
