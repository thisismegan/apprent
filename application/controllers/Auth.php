<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect(base_url());
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Kolom Email Tidak boleh kosong',
            'valid_email' => 'Alamat email tidak valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Kolom Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('layout/header', $data);
            $this->load->view('pages/login');
        } else {

            $this->_login();
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect(base_url());
        }
        $this->form_validation->set_rules('name', 'Nama', 'trim|required', [
            'required' => 'Kolom tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', [
            'required' => 'Kolom tidak boleh kosong',
            'is_unique' => 'Email sudah digunakan',
            'valid_email' => 'Alamat Email tidak sesuai'
        ]);
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|required|min_length[6]|numeric', [
            'required' => 'Kolom tidak boleh kosong',
            'min_length' => 'Minimal 6 angka',
            'numeric'  => 'Kolom harus berupa angka'
        ]);
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required', [
            'required' => 'Kolom tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|matches[conf_password]', [
            'required' => 'Kolom tidak boleh kosong',
            'min_length' => 'Minimal 8 Karakter',
            'matches'  => 'Password tidak sesuai dengan konfirmasi password'
        ]);
        $this->form_validation->set_rules('conf_password', 'Konfirmasi Password', 'required|matches[password]', [
            'required' => 'Kolom tidak boleh kosong',
            'matches' => 'Konfirmasi password tidak sama'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('layout/header', $data);
            $this->load->view('pages/registration');
        } else {

            $data = [
                'name' => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'address'   => $this->input->post('address'),
                'phone'  => $this->input->post('phone'),
                'role'         => 'member',
                'is_active'    => 0,
                'image'        => 'default.png',
                'created'      => time()
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email'),
                'token' => $token,
                'created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>Selamat Datang Akun anda Sudah dibuat!</strong> Silahkan aktivasi akun anda sebelum login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect('auth');
        }
    }

    private function _login()
    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cus = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($cus) {
            if ($cus['is_active'] == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                Silahkan aktivasi akun anda terlebih dahulu pada link yang dikirim ke email
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect('auth');
            } else {

                if (password_verify($password, $cus['password'])) {
                    $data = [
                        'email' => $cus['email'],
                        'role' => $cus['role'],
                        'name' => $cus['name'],
                        'id'   => $cus['id'],
                        'image' => $cus['image']
                    ];

                    if ($cus['role'] == 'member') {
                        $this->session->set_userdata($data);
                        redirect(base_url());
                    } else {
                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat Datang!</strong> di Halaman Admin Rental CI.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>');
                        redirect('admin/dashboard');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    Maaf password yang anda masukkan salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect(base_url('auth'));
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    Email belum terdaftar, silahkan melakukan registrasi terlebih dahulu di Menu Register
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect(base_url('auth'));
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Kolom %s tidak boleh kosong',
            'valid_email' => '%s tidak valid'
        ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Lupa Password ';
            $this->load->view('layout/header', $data);
            $this->load->view('forgot_password');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if ($user) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'created' => time()
                ];
                $this->db->insert('user_token', $user_token);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                <strong>Email yang anda masukkan belum terdaftar</strong> .
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect('auth/forgot_password');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        <strong>Anda Telah Logout</strong> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect(base_url());
    }

    private function _sendEmail($token, $type)
    {

        $config = [
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_user'     => 'wardaddy0101@gmail.com',
            'smtp_pass'     => 'Noobmaster69',
            'smtp_port'     => 465,
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'newline'       => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('wardaddy0101@gmail.com', 'APP RENT');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {

            $this->email->subject('Aktivasi akun');
            $this->email->message('Silahkan aktivasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Aktivasi</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['created'] < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                    Akun anda sudah aktif silahkan login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect(base_url());
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    <strong>Token expired</strong> .
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                <strong>Token invalid</strong> .
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
            <strong>Aktivasi akun gagal!, email tidak terdaftar</strong> .
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect(base_url());
        }
    }
}
