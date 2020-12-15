<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('product_model');
        $this->load->library('pagination');
    }


    public function index()
    {
        $data['title'] = 'Home ';
        $config['base_url'] = 'http://localhost/rental_ci/home/index/';
        $config['total_rows'] = $this->db->get('product')->num_rows();
        $config['per_page'] = 6;

        $config['full_tag_open'] = '<nav>
        <ul class="pagination">';
        $config['full_tag_close'] = '</ul>
        </nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = ' <li class="page-item">';
        $config['first_tag_close'] = ' </li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = ' <li class="page-item">';
        $config['last_tag_close'] = ' </li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = ' <li class="page-item">';
        $config['next_tag_close'] = ' </li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = ' <li class="page-item">';
        $config['prev_tag_close'] = ' </li>';

        $config['cur_tag_open'] = ' <li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = ' <li class="page-item">';
        $config['num_tag_close'] = ' </li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);


        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['product'] = $this->product_model->getProduct($config['per_page'], $data['page']);
        $data['kategori'] = $this->db->get('category')->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('home', $data);
        $this->load->view('layout/footer');
    }

    public function search()
    {
        if (!$_POST) {
            redirect(base_url());
        }
        $keyword = $_POST['keyword'];
        // var_dump($keyword);
        // die;
        $data['title'] = 'Home ';
        $config['base_url'] = 'http://localhost/rental_ci/admin/product/index';
        $config['total_rows'] = $this->db->get('product')->num_rows();
        $config['per_page'] = 2;

        $this->pagination->initialize($config);


        $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $query = "SELECT product.kode_produk as product_id, product.image, product.title as product_title,product.price,product.description,product.is_available, category.id as category_id, category.title
                  FROM product
                  JOIN category
                  ON product.id_category = category.id
                  WHERE product.title LIKE '%$keyword%'";
        $data['product'] = $this->db->query($query)->result_array();
        // var_dump($data['product']);
        // die;
        $data['kategori'] = $this->db->get('category')->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('home', $data);
        $this->load->view('layout/footer');
    }
    public function category($id = null)
    {
        if ($id == null) {
            redirect(base_url());
        }
        $data['title'] = 'Home ';
        $config['base_url'] = 'http://localhost/rental_ci/admin/product/index';
        $config['total_rows'] = $this->db->get('product')->num_rows();
        $config['per_page'] = 8;

        $this->pagination->initialize($config);


        $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $query = "SELECT product.kode_produk as product_id, product.image, product.title as product_title,product.price,product.description,product.is_available, category.id as category_id, category.title
                  FROM product
                  JOIN category
                  ON product.id_category = category.id
                  WHERE category.id=$id";
        $data['product'] = $this->db->query($query)->result_array();
        // var_dump($data['product']);
        // die;
        $data['kategori'] = $this->db->get('category')->result_array();
        $this->load->view('layout/header', $data);
        $this->load->view('home', $data);
        $this->load->view('layout/footer');
    }

    public function detail($id)
    {

        $data['title'] = 'Detail Product';
        $data['detail'] = $this->db->get_where('product', ['kode_produk' => $id])->row_array();

        $this->load->view('layout/header', $data);
        $this->load->view('detail', $data);
        $this->load->view('layout/footer');
    }
}
