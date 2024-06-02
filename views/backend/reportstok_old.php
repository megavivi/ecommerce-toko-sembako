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
        <div class="box-body table-responsive">
            <?=form_open('reportstok/proses');?>
               <table class="table table-bordered">
                    

                    <tr>
                        <th colspan="2"><?=form_radio(['name'=>'param','value'=>'bulanan','required'=>'required'])?>  Bulanan</th>
                        
                    </tr>

                    <tr>
                        <td width="15%">Bulan</td>
                        <td width="45%">
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">---Pilih Bulan---</option>
                                <?php
                                    foreach($bulan as $key=>$value){
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        
                    </tr>
                    <tr>
                        <td width="15%">Tahun</td>
                        <td>
                        <select name="tahun" id="tahun" class="form-control">
                                <option value="">---Pilih tahun---</option>
                                <?php
                                    for($i=2023; $i<=date('Y') + 3; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        
                    </tr>

                    <tr>
                        <th colspan="2"><?=form_radio(['name'=>'param','value'=>'tahunan','required'=>'required'])?>  Tahunan</th>
                        
                    </tr>
                    <tr>
                        <td width="15%">Tahun</td>
                        <td>
                        <select name="tahunall" id="tahunall" class="form-control">
                                <option value="">---Pilih tahun---</option>
                                <?php
                                    for($i=2023; $i<=date('Y') + 3; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        
                    </tr>

                    <tr>
                        <td width="15%"><b>Format Laporan</b></td>
                        <td width="45%">
                            <select name="format" id="format" class="form-control" required>
                                <option value="">---Pilih Format---</option>
                                <option value="cetak">CETAK</option>
                                <option value="excel">EXPORT EXCEL</option>
                                <option value="pdf">EXPORT PDF</option>
                                
                            </select>
                        </td>
                        
                    </tr>

                    
               </table>
               <div class="alert alert-light">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Tampilkan
                </button>
               </div>
            <?=form_close();?>
        </div>
    </div>
</section>