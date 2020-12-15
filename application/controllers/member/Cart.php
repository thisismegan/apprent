<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
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
    $this->load->model('cart_model');
  }

  public function index()
  {

    $data['title'] = 'Daftar Keranjang Sewa ';
    $data['cart']  = $this->cart_model->getCart();

    $this->load->view('layout/header', $data);
    $this->load->view('pages/member/cart/index', $data);
    $this->load->view('layout/footer');
  }

  public function create()
  {

    $id_user = $this->session->userdata('id');
    $kode_produk = $this->input->post('kode_produk');
    $this->db->where('id_user', $id_user)->where('kode_produk', $kode_produk);
    $cart = $this->db->get('cart')->row_array();
    // var_dump($cart);
    // die;

    if ($cart) {
      $data = [
        'qty' => $cart['qty'] + $this->input->post('qty'),
        'subtotal' => $cart['subtotal'] + $this->input->post('price')
      ];

      $this->db->where('id', $cart['id']);
      $this->db->update('cart', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        <strong>Produk Berhasil diupdate ke keranjang</strong> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect(base_url('product'));
    }

    $price = $this->input->post('price');
    $qty = $this->input->post('qty');
    $id = $this->session->userdata('id');
    $subTotal = $qty * $price;

    $data = [
      'id_user'       => $id,
      'kode_produk'   => $this->input->post('kode_produk'),
      'qty'           => $qty,
      'subtotal'      => $subTotal,
      'tgl_sewa'      => date('Y-m-d'),
      'tgl_kembali'   => date("Y-m-d", strtotime("+1 days", time()))
    ];
    $this->db->insert('cart', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        <strong>Produk Berhasil ditambahkan ke keranjang</strong> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect(base_url('product'));
  }

  public function update()
  {

    $now =  strtotime("-1 days", time());
    $tgl_sewa = strtotime($this->input->post('tgl_sewa'));
    $tgl_kembali = strtotime($this->input->post('tgl_kembali'));

    $tgl1 = $tgl_sewa + (60 * 60 * 24);

    if ($tgl_sewa < $now) {

      $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
      <strong>Tanggal Sewa tidak boleh kurang dari tanggal hari ini</strong> .
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>');
      redirect(base_url('member/cart'));
    }
    if ($tgl_kembali < $tgl1) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
      <strong>Tanggal Kembali tidak boleh Sama dengan Tanggal Sewa / Kurang dari tanggal sewa</strong> .
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>');
      redirect(base_url('member/cart'));
    }

    if ($tgl_kembali < $tgl_sewa) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
      <strong>Tanggal Kembali tidak boleh kurang dari tanggal sewa</strong> .
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>');
      redirect(base_url('member/cart'));
    }

    $selisih = abs($tgl_kembali - $tgl_sewa) / (60 * 60 * 24);

    $price = $this->input->post('price');
    $id = $this->input->post('id');
    $qty = $this->input->post('qty');
    $subTotal = $price * $qty * $selisih;

    $data = [
      'qty' => $qty,
      'subtotal' => $subTotal,
      'tgl_sewa' => $_POST['tgl_sewa'],
      'tgl_kembali' => $_POST['tgl_kembali']
    ];

    // var_dump($data);
    // die;
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('cart');

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        <strong>Total Produk Berhasil diupdate ke keranjang</strong> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('member/cart');
  }

  public function checkout()
  {
    if ($this->cart_model->getCart() == null) {
      $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        <strong>Keranjang sewa masih kosong, silahkan sewa barang terlebih dahulu</strong> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('member/cart');
    }
    $this->form_validation->set_rules('name', 'Nama', 'trim|required', [
      'required' => 'Kolom tidak boleh kosong'
    ]);
    $this->form_validation->set_rules('address', 'Alamat Domisili', 'trim|required|min_length[8]', [
      'required' => 'Kolom tidak boleh kosong',
      'min_length' => 'Minimal 8 karakter'
    ]);
    $this->form_validation->set_rules('telephone', 'Telepon', 'trim|required|min_length[8]|max_length[15]|numeric', [
      'required' => 'Kolomm tidak boleh kosong',
      'numeric'  => 'Kolom hanya boleh diiisi angka',
      'min_length' => 'Minimal 8 angka',
      'max_length' => 'Maksimal 15 angka'
    ]);

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Halaman Checkout ';
      $data['cart']  = $this->cart_model->getCart();

      $this->load->view('layout/header', $data);
      $this->load->view('pages/member/cart/checkout', $data);
      $this->load->view('layout/footer');
    } else {

      $total = $this->db->select_sum('subtotal')
        ->where('id_user', $this->session->userdata('id'))
        ->get('cart')
        ->row()
        ->subtotal;

      $user_id = $this->session->userdata('id');


      $invoice = 'INV' . $user_id . date('YmdHis');

      $data = [
        'id_user' => $user_id,
        'tgl_transaksi' => date('Y-m-d'),
        'address' => $this->input->post('address'),
        'invoice' => $invoice,
        'name'    => $this->input->post('name'),
        'phone'   => $this->input->post('telephone'),
        'total'   => $total,
        'status_pembayaran' => 0
      ];

      if ($this->db->insert('transaksi', $data)) {

        $cart = $this->db->get_where('cart', ['id_user' => $user_id])->result_array();

        $detail = "SELECT * FROM `transaksi` ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($detail)->row_array();

        foreach ($cart as $row) {
          $row['id_transaksi'] = $query['id'];
          unset($row['id'], $row['id_user']);
          $this->db->insert('detail_transaksi', $row);
        }

        $this->db->delete('cart', ['id_user' => $user_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
          <strong>Transaksi berhasil dibuat, Silahkan lakukan pembayaran</strong> .
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>');

        redirect('member/cart/checkout_success');
      };
    }
  }
  public function checkout_success()
  {
    $user_id = $this->session->userdata('id');
    $transaksi = "SELECT * FROM `transaksi` WHERE id_user=$user_id ORDER BY id DESC LIMIT 1";
    $data['transaksi'] = $this->db->query($transaksi)->row_array();

    $data['title'] = 'Halaman Pembayaran ';
    $this->load->view('layout/header', $data);
    $this->load->view('pages/member/cart/checkout_success', $data);
    $this->load->view('layout/footer');
  }
  public function delete()
  {
    $id = $this->input->post('id');

    $this->db->where('id', $id);
    $this->db->delete('cart');

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        <strong>Produk dalam keranjang berhasil dihapus</strong> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('member/cart');
  }
}
