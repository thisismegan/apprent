<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } elseif ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('pengembalian_model');
    }

    public function index()
    {
        $data['title'] = 'Pengembalian-Admin';
        $data['produk'] = $this->pengembalian_model->getAllTransaksi();
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/pengembalian/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function search()
    {
        $keyword = trim($this->input->post('keyword'));
        if (!$_POST) {
            redirect('admin/pengembalian');
        }
        if (!$keyword) {
            redirect('admin/pengembalian');
        }
        $data['title'] = 'Pengembalian Barang';

        $this->db->where('invoice', $keyword);
        $data['produk'] = $this->db->get('transaksi')->result_array();
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/pengembalian/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function detail($invoice)
    {
        $data['title'] = 'Detail-Pengembalian';
        $query = "SELECT transaksi.id_user,transaksi.tgl_transaksi,transaksi.invoice,transaksi.name,transaksi.phone, transaksi.total,transaksi.status_pembayaran,
        product.kode_produk,product.title,product.price,product.image,
        detail_transaksi.id_transaksi,detail_transaksi.id,detail_transaksi.kode_produk,detail_transaksi.qty,detail_transaksi.subtotal,detail_transaksi.tgl_sewa,detail_transaksi.tgl_kembali,detail_transaksi.tgl_pengembalian,detail_transaksi.denda,detail_transaksi.status_sewa
        FROM transaksi
        JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN product ON product.kode_produk = detail_transaksi.kode_produk
        WHERE invoice='$invoice'
        ";
        $data['pengembalian'] = $this->db->query($query)->result_array();
        $data['detail']       = $this->db->get_where('transaksi', ['invoice' => $invoice])->row_array();
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/pengembalian/detail', $data);
        $this->load->view('layout/footer_admin');
    }

    public function update($id)
    {
        $invoice = $this->input->post('invoice');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $tgl_kembali = strtotime($this->input->post('tgl_kembali'));
        $tgl_pengembalian = strtotime($this->input->post('tgl_pengembalian'));
        if ($tgl_pengembalian < $tgl_kembali) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
            <strong>Tanggal Pengembalian tidak boleh kurang dari tanggal kembali</strong> .
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect("admin/pengembalian/detail/$invoice");
        }
        $denda = ($tgl_pengembalian - $tgl_kembali) / (60 * 60 * 24);
        $data = [
            'tgl_pengembalian' => $_POST['tgl_pengembalian'],
            'denda'            => $price * $qty * $denda,
            'status_sewa'      => 1
        ];

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('detail_transaksi');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Berhasil Diupdate
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
        redirect("admin/pengembalian/detail/$invoice");
    }
}

/* End of file Pengembalian.php */
