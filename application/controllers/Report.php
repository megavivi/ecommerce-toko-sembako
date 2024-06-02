<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model(['Report_m'=>'reportmodel']);
	}


    public function index(){
        $bulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember'];
        
        $data = [
            'title'=>'Laporan Penjualan',
            'content'=>'backend/reportpendapatan',
            'bulan'=>$bulan
        ];

		$this->load->view('backend/index', $data);
    }


    public function proses(){
        $param = $this->input->post('param');
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $tahunall = $this->input->post('tahunall');
        $formatlap = $this->input->post('format');

        $query = $this->reportmodel->get_penjualan($param, $dari,$sampai, $bulan,$tahun,$tahunall);
        $arrbulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'Nopember','12'=>'Desember'];

        $data = [
            'title'=>'Laporan Penjualan',
            'query'=>$query,
            'bulan'=>$bulan,
            'param'=>$param,
            'dari'=>$dari,
            'sampai'=>$sampai,
            'bulan'=>$bulan,
            'tahun'=>$tahun,
            'tahunall'=>$tahunall,
            'arrbulan'=>$arrbulan
        ];

        if($formatlap == "cetak"){
            $content = 'backend/reportpendapatan_cetak';
            $this->load->view($content, $data);
        } elseif($formatlap == "excel"){
            $content = 'backend/reportpendapatan_excel';
            $this->load->view($content, $data);
        } else {
          
            $path = '/tmp/mpdf'; 
            $content = 'backend/reportpendapatan_pdf';
            $mpdf = new \Mpdf\Mpdf();
            $html = $this->load->view($content,$data,true);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }

    }

 //end of class
}   