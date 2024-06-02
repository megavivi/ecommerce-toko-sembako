<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_m extends CI_Model {

    public function get_penjualan($param, $dari, $sampai, $bulan, $tahun, $tahunall){
        if($param == "harian"){
            $this->db->select([
                'pesanan.code',
                'FROM_UNIXTIME(pesanan.datetime) as tgl_jual',
                'pesanan.no_resi',
                'pesanan.total_harga',
                'users.user_fullname as nama'
            ]);
            $this->db->join('users','users.idusers = pesanan.user_id','LEFT');
            $this->db->where('DATE(FROM_UNIXTIME(datetime)) >=',$dari);
            $this->db->where('DATE(FROM_UNIXTIME(datetime)) <=',$sampai);
            $this->db->order_by('idorder','ASC');
            $query = $this->db->get('pesanan')->result();
            
        } elseif($param == "bulanan") {
            $this->db->select([
                'pesanan.code',
                'FROM_UNIXTIME(pesanan.datetime) as tgl_jual',
                'pesanan.no_resi',
                'pesanan.total_harga',
                'users.user_fullname as nama'
            ]);
            $this->db->join('users','users.idusers = pesanan.user_id','LEFT');
            $this->db->where('MONTH(FROM_UNIXTIME(datetime))',intval($bulan));
            $this->db->where('YEAR(FROM_UNIXTIME(datetime))',intval($tahun));
            $this->db->order_by('idorder','ASC');
            $query = $this->db->get('pesanan')->result();
        } else{
            $this->db->select([
                'pesanan.code',
                'FROM_UNIXTIME(pesanan.datetime) as tgl_jual',
                'pesanan.no_resi',
                'pesanan.total_harga',
                'users.user_fullname as nama'
            ]);
            $this->db->join('users','users.idusers = pesanan.user_id','LEFT');
            $this->db->where('YEAR(FROM_UNIXTIME(datetime))',intval($tahunall));
            $this->db->order_by('idorder','ASC');
            $query = $this->db->get('pesanan')->result();
        }

        return $query;
    }



    public function get_stok($param, $dari, $sampai, $bulan, $tahun, $tahunall){

        $this->db->select([
            'product.product_name',
            'product.satuan',
            'product.stok as stokawal',
            'SUM(detail_order.qty) as stokjual'
        ]);
        $this->db->join('detail_order','detail_order.product_id = product.idproduct','INNER');

        if($param == "harian"){
            $this->db->where('DATE(FROM_UNIXTIME(detail_order.create_at)) >=',$dari);
            $this->db->where('DATE(FROM_UNIXTIME(detail_order.create_at)) <=',$sampai);
        } elseif($param == "bulanan"){
            $this->db->where('MONTH(FROM_UNIXTIME(detail_order.create_at))',intval($bulan));
            $this->db->where('YEAR(FROM_UNIXTIME(detail_order.create_at))',intval($tahun));
        } else {
            $this->db->where('YEAR(FROM_UNIXTIME(detail_order.create_at))',intval($tahunall));
        }

        $this->db->group_by('detail_order.product_id');
        $query = $this->db->get('product')->result();
        return $query;
    }


    public function get_stok_all(){

        $this->db->select([
            'product.product_name',
            'product.satuan',
            'product.stok as stokawal',
            'SUM(detail_order.qty) as stokjual'
        ]);
        $this->db->join('detail_order','detail_order.product_id = product.idproduct','LEFT');

        $this->db->group_by('product.idproduct');
        $query = $this->db->get('product')->result();
        return $query;
    }

}