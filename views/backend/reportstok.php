<!-- Content Header -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
    <ol class="breadcrumb">
        
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <a href="<?=site_url('reportstok/export/cetak');?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i> CETAK</a>&nbsp;
            <a href="<?=site_url('reportstok/export/excel');?>" class="btn btn-info btn-sm"><i class="fa fa-file-excel-o"></i> EXPORT EXCEL</a>&nbsp;
            <a href="<?=site_url('reportstok/export/pdf');?>" class="btn btn-info btn-sm"><i class="fa fa-file-pdf-o"></i> EXPORT PDF</a>&nbsp;            
        </div>
        <div class="box-body table-responsive">
        <table class="table table-bordered table-condensed" >
        
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Satuan</th>
                <th>Stok Awal</th>
                <th>Jml Jual</th>
                <th>Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            if(!empty($query)):
                foreach($query as $row){
                    $sisa = $row->stokawal - $row->stokjual;
                ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=strtoupper($row->product_name);?></td>
                        <td><?=$row->satuan;?></td>
                        <td align="right"><?=$row->stokawal;?></td>
                        <td align="right"><?=number_format($row->stokjual);?></td>
                        <td align="right"><?=number_format($sisa);?></td>
                    </tr>
                <?php
                    $total += $sisa;
                    }
                else:
                    echo '<tr><td colspan="6">Data tidak tersedia</td></tr>';
                endif;       
                ?>
        </tbody>
    </table>
        </div>
    </div>
</section>