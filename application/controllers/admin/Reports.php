<?php
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect(base_url());
        }
        if ($this->session->userdata['role'] != 'admin') {
            redirect(base_url());
        }
        $this->load->model('report_model');
    }

    public function index()
    {

        $data['title'] = 'Reports-Admin ';
        $data['report'] = $this->report_model->allReport();
        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/report/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function sortByDate()
    {
        if (!$_POST) {
            redirect('admin/reports');
        }
        $data['title'] = 'Reports-Admin ';

        $data['report'] = $this->report_model->sortByDate();


        $this->load->view('layout/header_admin', $data);
        $this->load->view('pages/admin/report/index', $data);
        $this->load->view('layout/footer_admin');
    }

    public function export()
    {

        $export = $this->report_model->sortByDate();
        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Invoice')
            ->setCellValue('C1', 'Tanggal Transaksi')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Barang')
            ->setCellValue('F1', 'Tanggal Sewa')
            ->setCellValue('G1', 'Tanggal Kembali')
            ->setCellValue('H1', 'Status Sewa')
            ->setCellValue('I1', 'SubTotal')
            ->setCellValue('J1', 'Denda');

        $kolom = 2;
        $nomor = 1;
        foreach ($export as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $row['invoice'])
                ->setCellValue('C' . $kolom, $row['tgl_transaksi'])
                ->setCellValue('D' . $kolom, $row['name'])
                ->setCellValue('E' . $kolom, $row['title'])
                ->setCellValue('F' . $kolom, $row['tgl_sewa'])
                ->setCellValue('G' . $kolom, $row['tgl_kembali'])
                ->setCellValue('H' . $kolom, $row['status_sewa'] == 1 ? 'Sudah Kembali' : 'Belum Kembali')
                ->setCellValue('I' . $kolom, $row['subtotal'])
                ->setCellValue('J' . $kolom, $row['denda']);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type:application/vnd.ms-excel');
        header('Content-Disposition:attachment:filename="export.xlsx"');
        header('Cache-Control:max-age-0');

        $writer->save('php://output');
    }
}
