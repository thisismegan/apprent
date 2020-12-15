<?php

defined('BASEPATH') or exit('No direct script access allowed');

class My_orders extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
              <strong>Silahkan login terlebih dahulu</strong> .
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('auth');
        }
        $this->load->model('my_orders_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Sewa ';
        $data['myorders'] = $this->my_orders_model->getOrders();
        $this->load->view('layout/header', $data);
        $this->load->view('pages/member/myorders/index', $data);
        $this->load->view('layout/footer');
    }

    public function detail($invoice)
    {
        $data['title']  = 'Detail Sewa ';
        $data['detail'] = $this->db->get_where('transaksi', ['invoice' => $invoice])->row_array();
        $id = $data['detail']['id'];

        $query = "SELECT detail_transaksi.id_transaksi,detail_transaksi.qty,detail_transaksi.subtotal,  detail_transaksi.tgl_sewa,  detail_transaksi.status_sewa,detail_transaksi.tgl_pengembalian,detail_transaksi.kode_produk,detail_transaksi.tgl_kembali,detail_transaksi.denda,product.price,product.title,product.image,product.kode_produk
        FROM detail_transaksi
        JOIN product
        ON detail_transaksi.kode_produk = product.kode_produk
        WHERE detail_transaksi.id_transaksi= $id
        ";

        $data['produk'] = $this->db->query($query)->result_array();


        $this->load->view('layout/header', $data);
        $this->load->view('pages/member/myorders/detail', $data);
        $this->load->view('layout/footer');
    }

    public function confirm($invoice = null)
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required', [
            'required' => 'Kolom tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|numeric', [
            'required' => 'Kolom tidak boleh kosong',
            'numeric'  => 'Kolom hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('account_number', 'Nomor Rekening', 'trim|required|numeric', [
            'required' => 'Kolom tidak boleh kosong',
            'numeric'  => 'Kolom hanya boleh diisi angka'
        ]);

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Konfirmasi Pembayaran ';
            $data['confirm'] = $this->db->get_where('transaksi', ['invoice' => $invoice])->row_array();

            $this->load->view('layout/header', $data);
            $this->load->view("pages/member/myorders/confirm_orders", $data);
            $this->load->view('layout/footer');
        } else {

            $upload_image = $_FILES['image']['name'];
            if (!$upload_image) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Belum ada bukti Pembayaran yang diupload
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect("member/my_orders/confirm/$invoice");
            }
            if ($upload_image) {
                $config['upload_path'] = './assets/images/bukti';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
            }
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data('file_name');
                $data = [
                    'id_transaksi'      => $this->input->post('id'),
                    'account_name'      => $this->input->post('name'),
                    'account_number'    => $this->input->post('account_number'),
                    'nominal'           => $this->input->post('nominal'),
                    'note'              => $this->input->post('catatan'),
                    'image'             => $image
                ];

                $this->db->insert('confirm_transaksi', $data);
                $this->db->set('status_pembayaran', 1);
                $this->db->where('invoice', $invoice);
                $this->db->update('transaksi');
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Bukti pembayaran berhasil diupload, Silahkan menunggu pengecekan admin
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect("member/my_orders/detail/$invoice");
        }
    }
}
