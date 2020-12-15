<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('my_orders_model');
    }

    public function index()
    {
        $data['title'] = 'Orders-Admin ';
        $data['transaksi'] = $this->my_orders_model->getAllOrders();
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/orders/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function detail($invoice)
    {
        $data['title']  = 'Detail Sewa ';
        $data['detail'] = $this->db->get_where('transaksi', ['invoice' => $invoice])->row_array();
        $id = $data['detail']['id'];

        $query = "SELECT detail_transaksi.id_transaksi,detail_transaksi.qty,detail_transaksi.subtotal,  detail_transaksi.tgl_sewa,  detail_transaksi.kode_produk,detail_transaksi.tgl_kembali,detail_transaksi.status_sewa,product.price,product.title,product.image,product.kode_produk
        FROM detail_transaksi
        JOIN product
        ON detail_transaksi.kode_produk = product.kode_produk
        WHERE detail_transaksi.id_transaksi= $id
        ";

        $data['produk'] = $this->db->query($query)->result_array();
        $data['id'] = $this->db->query($query)->row_array();
        $id_transaksi = $data['id']['id_transaksi'];

        $data['bukti'] = $this->db->get_where('confirm_transaksi', ['id_transaksi' => $id_transaksi])->row_array();

        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/orders/detail', $data);
        $this->load->view('layout/footer_admin');
    }

    public function update($invoice)
    {
        $status = $this->input->post('konfirmasi');
        $this->db->where('invoice', $invoice);
        $data = $this->db->get('transaksi')->row_array();
        $conf_transaksi = $this->db->get_where('confirm_transaksi', ['id_transaksi' => $data['id']])->row_array();

        if (!$_POST) {
            redirect(base_url('page_404'));
        }
        if ($invoice && $data['status_pembayaran'] == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Nomor invoice tersebut belum melakukan pembayaran
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect("admin/orders");
        }
        if ($invoice && ($data['id'] == $conf_transaksi['id_transaksi']) && $data['status_pembayaran'] == 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Nomor invoice tersebut Sudah melakukan pembayaran
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect("admin/orders/detail/$invoice");
        }


        $this->db->set('status_pembayaran', $status);
        $this->db->where('invoice', $invoice);
        $this->db->update('transaksi');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil update transaksi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
        redirect("admin/orders/detail/$invoice");
    }
}

/* End of file Orders.php */
