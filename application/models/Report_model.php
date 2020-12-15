<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function allReport()
    {
        $query = "SELECT product.kode_produk,product.title,product.price,transaksi.id_user,transaksi.tgl_transaksi,transaksi.invoice,transaksi.name,transaksi.total,transaksi.status_pembayaran,detail_transaksi.id_transaksi,detail_transaksi.qty,detail_transaksi.subtotal,detail_transaksi.tgl_sewa,detail_transaksi.tgl_kembali,detail_transaksi.tgl_pengembalian,detail_transaksi.denda,detail_transaksi.status_sewa
        FROM transaksi
        JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN product ON product.kode_produk = detail_transaksi.kode_produk
        ORDER BY transaksi.invoice
        ";

        return $this->db->query($query)->result_array();
    }

    public function sortByDate()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $status = $this->input->post('status');

        $query = "SELECT product.kode_produk,product.title,product.price,transaksi.id_user,transaksi.tgl_transaksi,transaksi.invoice,transaksi.name,transaksi.total,transaksi.status_pembayaran,detail_transaksi.id_transaksi,detail_transaksi.qty,detail_transaksi.subtotal,detail_transaksi.tgl_sewa,detail_transaksi.tgl_kembali,detail_transaksi.tgl_pengembalian,detail_transaksi.denda,detail_transaksi.status_sewa
        FROM product
        JOIN detail_transaksi ON product.kode_produk = detail_transaksi.kode_produk
        JOIN transaksi ON transaksi.id = detail_transaksi.id_transaksi
        WHERE transaksi.tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' AND detail_transaksi.status_sewa= $status
        ORDER BY transaksi.invoice 
        
         ";

        return $this->db->query($query)->result_array();
    }
}
