<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Welcome to CodeIgniter</title>
</head>
<body>
 
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