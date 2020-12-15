<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('product_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data['title'] = 'Admin Product';


        $config['base_url'] = 'http://localhost/rental_ci/admin/product/index';
        $config['total_rows'] = $this->db->get('product')->num_rows();
        $config['per_page'] = 6;

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['product'] = $this->product_model->getProduct($config['per_page'], $data['page']);
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/product/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function search()
    {
        $data['title'] = 'Data Product';

        $config['base_url'] = 'http://localhost/rental_ci/admin/product/index';
        $config['total_rows'] = $this->db->get_where('product')->num_rows();
        $config['per_page'] = 6;

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['product'] = $this->product_model->search($config['per_page'], $data['page']);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/product/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function create()
    {
        $this->form_validation->set_rules('title', 'Judul', 'trim|required|min_length[10]|max_length[70]|is_unique[product.title]', [
            'required'      => 'Kolom tidak boleh kosong',
            'min_length'    => 'Minimal 10 karakter',
            'max_length'    => 'Maksimal 70 karakter',
            'is_unique'     => 'Judul produk sudah digunakan, Harap gunakan judul lain'
        ]);
        $this->form_validation->set_rules('price', 'Harga', 'trim|required|numeric', [
            'required'  => 'Kolom tidak boleh kosong',
            'numeric'   => 'Kolom hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required|min_length[10]|max_length[2000]', [
            'required'      => 'Kolom tidak boleh kosong',
            'min_length'    => 'Minimal 10 karakter',
            'max_length'    => 'Maksimal 2000 karakter',
        ]);


        if ($this->form_validation->run() == false) {

            $data['kode'] = $this->product_model->getMax();

            $this->load->model('category_model');
            $data['title'] = 'Tambah Produk';

            $data['kategori'] = $this->category_model->getCategory();

            $this->load->view('layout/header_admin', $data);
            $this->load->view('pages/admin/product/create', $data);
            $this->load->view('layout/footer_admin');
        } else {

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $config['upload_path']          = './assets/images/product';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size']             = 2048;
                $config['overwrite']            = true;
                $config['encrypt_name']          = true;

                $this->load->library('upload', $config);
            }
            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');

                $description = $_POST['description'];
                $pecah = explode("\r\n\r\n", $description);

                $text = "";

                for ($i = 0; $i <= count($pecah) - 1; $i++) {
                    $part = str_replace($pecah[$i], "<p>" . $pecah[$i] . "</p>", $pecah[$i]);
                    $text .= $part;
                    // var_dump($text);
                    // die;
                }

                $data = [
                    'kode_produk'   => $_POST['kode_produk'],
                    'id_category'   => $_POST['kategori'],
                    'title'         => $_POST['title'],
                    'description'   => $text,
                    'price'         => $_POST['price'],
                    'is_available'  => $_POST['status'],
                    'created'       => date('Y-m-d H:i:s'),
                    'image'         => $new_image
                ];

                $this->db->insert('product', $data);
            } else {
                echo $this->upload->display_errors();
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect('admin/product');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Produk';
        $data['kategori'] = $this->db->get('category')->result_array();
        $data['edit'] = $this->product_model->edit($id);
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/product/edit', $data);
        $this->load->view('layout/footer_admin');
    }

    public function update()
    {
        $this->form_validation->set_rules('title', 'Judul', 'trim|required|min_length[10]|max_length[70]', [
            'required'      => 'Kolom tidak boleh kosong',
            'min_length'    => 'Minimal 10 karakter',
            'max_length'    => 'Maksimal 70 karakter',
        ]);
        $this->form_validation->set_rules('price', 'Harga', 'trim|required|numeric', [
            'required'  => 'Kolom tidak boleh kosong',
            'numeric'   => 'Kolom hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|required|min_length[10]|max_length[2000]', [
            'required'      => 'Kolom tidak boleh kosong',
            'min_length'    => 'Minimal 10 karakter',
            'max_length'    => 'Maksimal 2000 karakter',
        ]);


        if ($this->form_validation->run() == false) {
            $id = $_POST['id'];
            $this->edit($id);
        } else {
            $id = $this->input->post('id');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/images/product';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $data['edit'] = $this->db->get_where('product', ['kode_produk' => $this->input->post('id')])->row_array();
                    $old_image = $data['edit']['image'];
                    if ($old_image) {
                        unlink(FCPATH . 'assets/images/product/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = [
                'id_category'   => $_POST['kategori'],
                'title'         => $_POST['title'],
                'description'   => $_POST['description'],
                'price'         => $_POST['price'],
                'is_available'  => $_POST['status'],
                'updated'       => date('Y-m-d H:i:s')
            ];
            $this->db->where('kode_produk', $id);
            $this->db->update('product', $data);

            $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Data berhasil update</h5>
      </div>');
            redirect('admin/product');
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        $data['delete'] = $this->db->get_where('product', ['kode_produk' => $id])->row_array();
        $image = $data['delete']['image'];
        unlink(FCPATH . 'assets/images/product/' . $image);

        $this->db->where('kode_produk', $id);
        $this->db->delete('product');


        $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Data berhasil Dihapus</h5>
      </div>');
        redirect('admin/product');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Produk';
        $data['detail'] = $this->product_model->edit($id);
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/product/detail', $data);
        $this->load->view('layout/footer_admin');
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect('admin/product');
    }
}
