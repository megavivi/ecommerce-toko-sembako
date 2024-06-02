<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=LaporanPendapatan.xls");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=settings('company_profile','company_name');?> | <?=settings('company_profile','tagline');?></title>
    <meta name="keywords" content="<?=settings('general','meta_keywords');?>" />
    <meta name="description" content="<?=settings('general','meta_description');?>" />
    <link rel="icon" href="<?=base_url('uploads/'. settings('general','favicon'));?>">
    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/front-end/img/<?= settings('general','favicon'); ?>" rel="icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?= base_url('assets/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
   
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <table width="100%" cellpadding="4">
        <tr>
            
            <td width="55%">
                <h4><?=settings('company_profile','company_name');?></h4>
                <small>Alamat : <?=settings('company_profile','street_address');?> <?=settings('company_profile','village');?> <?=settings('company_profile','district');?><br>
                Telepon : <?=settings('company_profile','phone');?></small>
            </td>
        </tr>
    </table>
    <hr>
    <center><b>LAPORAN PENJUALAN<br>
    PERIODE : 
        <?php
        if($param == "harian"){
            echo date('d/m/Y',strtotime($dari)).' s.d '.date('d/m/Y',strtotime($sampai));
        } elseif($param == "bulanan"){
            echo $arrbulan[$bulan].' '.$tahun;
        } else {
            echo $tahunall;
        }
        ?></b>
    </center>

    <br><br>
    <table class="table table-bordered table-condensed" style="border-collapse:collapse;" width="100%" cellpadding="4" cellspacing="0" border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>No. Resi</th>
                <th>Pelanggan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            if(!empty($query)):
                foreach($query as $row){
                ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$row->code;?></td>
                        <td><?=date('d-m-Y',strtotime($row->tgl_jual));?></td>
                        <td><?=$row->no_resi;?></td>
                        <td><?=$row->nama;?></td>
                        <td align="right"><?=number_format($row->total_harga);?></td>
                    </tr>
                <?php
                    $total += $row->total_harga;
                    }
                else:
                    echo '<tr><td colspan="6">Data tidak tersedia</td></tr>';
                endif;       
                ?>
        </tbody>
        <tfoot>
            <tr class="active">
                <th colspan="5">Total Penjualan</th>
                <th align="right"><?=number_format($total);?></th>
            </tr>
        </tfoot>
    </table>
</body>


</html>
