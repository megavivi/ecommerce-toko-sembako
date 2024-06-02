<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_m');
		
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = 'backend/home';
		$data['total_product'] = $this->db->get('product')->result();
		$data['total_order'] = $this->db->get('pesanan')->result();
		$data['total_member'] = $this->db->get_where('users',['user_type'=>'customer'])->result();
		$data['total_product_category'] = $this->db->get('product_category')->result();
		$data['alltransaction'] = $this->User_m->allTransaction();
		$data['jsonproduk'] = $this->json_produk();
		$data['jsonpenjualan'] = $this->json_penjualan();
		$this->load->view('backend/index', $data);
		//$this->load->grafik('backend/product', $data);
	}


	public function json_penjualan()
	{
		$tahun = date('Y');
		$json = [];
		for($i=1;$i<=12; $i++){
			$query = $this->get_total_jual($i, $tahun);
			
			$json[] = $query;
		}

		return json_encode($json);
	}


	public function get_total_jual($bln, $thn){
		$query = $this->db->select('SUM(total_harga) as total')
		->where('MONTH(FROM_UNIXTIME(datetime))',$bln)->where('YEAR(FROM_UNIXTIME(datetime))',$thn)
		->get('pesanan')
		->row();

		if(!empty($query)){
			$total = intval($query->total);
		} else {
			$total = intval(0);
		}

		return $total;
	}


	public function json_produk()
	{
		$query = $this->db->select(['COUNT(detail_order.iddetail_order) as total','product.product_name'])
		->join('product','product.idproduct = detail_order.product_id','INNER')
		->group_by('product.idproduct')
		->get('detail_order')->result();

		$json = array();
		if(!empty($query)){
			foreach($query as $row){
				$json[] = ['name'=>$row->product_name,'y'=>intval($row->total)];
			}
		} else{
			$json[] = ['name'=>'','y'=>''];
		}

		return json_encode($json);
	}

	public function konvert(){
		$datetimeStr = date('Y-m-d');
		$datetime = strtotime($datetimeStr);

		//Displays 1610482500

		echo $datetime;
	}

}

/* End of file Dashboard.php */