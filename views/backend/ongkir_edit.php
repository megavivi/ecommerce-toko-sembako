<script>


$(function() {
   
    $('#delete_permanen_all').click(function() {
        $('#modal_delete').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#deleted').click(function() {
            var delete_check = $('.check:checked');
            if (delete_check.length > 0) {
                var delete_value = [];
                $(delete_check).each(function() {
                    delete_value.push($(this).val());
                });

                $.ajax({
                    type: 'post',
                    url: '<?=base_url();?>plugin/deleteOngkir',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>plugin/ongkir";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Delete Permanentelly !");
            }
        })
    });
    // $('#restore_all').click(function() {
    //     var restore_check = $('.check:checked');
    //     if (restore_check.length > 0) {
    //         var restore_value = [];
    //         $(restore_check).each(function() {
    //             restore_value.push($(this).val());
    //         });
    //         $.ajax({
    //             url: '<?=site_url();?>product/restore',
    //             method: 'produk',
    //             data: {
    //                 id: restore_value
    //             },
    //             success: function() {
    //                 toastr.success("Restored Successfully");
    //                 setTimeout(() => {
    //                     window.location =
    //                         "<?=site_url();?>product?s=draft";
    //                 }, 2500);
    //             }
    //         })
    //     } else {
    //         toastr.warning("Please Select Data To Restore !");
    //     }
    // });
    // $('.check').on('click', function() {
    //     var html =
    //         '<a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Delete Permanentelly" id="delete_all"><i class="fa fa-trash"></i></a>';
    //     if (this.checked) {
    //         $('.breadcrumb').html(html);
    //     } else {
    //         window.location = "<?=site_url();?>product?s=publish";
    //     }
    // });
})
$(function() {
    $.ajaxSetup({
        type: "POST",
        url: "<?= base_url('wilayah/ambilData') ?>",
        cache: false,
    });
    //Asal
    $("#provasal").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kabasal").html(respond);
                }
            })
        }
    });
    //Tujuan
    $("#provtujuan").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kabtujuan").html(respond);
                }
            })
        }
    });
    //Layanan
    $("#kurir").change(function() {
        var value = $(this).val();
        if (value != '') {
            $.ajax({
                data: {
                    modul: 'layanan',
                    id: value
                },
                success: function(respond) {
                    $("#layanan").html(respond);
                }
            })
        }
    });
    $("#kec").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kelurahan',
                    id: value
                },
                success: function(respond) {
                    $("#kel").html(respond);
                }
            })
        }
    });
})
</script>
<!-- Content Header -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
    <ol class="breadcrumb">
        
        <a href="<?=base_url('plugin/ongkir');?>" class="btn btn-sm btn-danger btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"></i> Batalkan</a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <form action="<?=site_url('plugin/updateongkir/'.$o->idongkir);?>" method="post">
   

        <div class="row">
            <div class="col-md-6" style="background-color:#778899;">
                <div class="form-group">
                    <label>Provinsi Asal <span class="text-red">*</span></label>
                    <select name="provasal" class="form-control select2" id="provasal" style="width:100%"
                        required>
                        <option value="0">-- Pilih Provinsi --</option>
                        <?php 
                        $qprov = $this->db->get_where('kabupaten',['id_kab'=>$o->asal])->row();
                        foreach($provinsi as $p): ?>
                        <option value="<?= $p['id_prov']; ?>" <?php echo $p['id_prov'] == $qprov->id_prov ? 'selected="selected"' : '';?>><?= $p['nama']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="help-block" style="color:red;"><?= form_error('prov'); ?></span>
                </div>
                <div class="form-group">
                    <label>Kota/Kabupaten Asal <span class="text-red">*</span></label>
                    <select name="kabasal" class="form-control select2" id="kabasal" style="width:100%"
                        required>
                        
                        <?php
                            $qkota = $this->db->get_where('kabupaten',['id_prov'=>$qprov->id_prov])->result();
                            foreach($qkota as $qk){
                                if($qk->id_kab == $o->asal){
                                    $seltujuan = 'selected="selected"';
                                    } else {
                                        $seltujuan = '';
                                    }

                                    echo '<option value="'.$qk->id_kab.'" '.$seltujuan.'>'.$qk->nama.'</option>';
                            }
                        ?>
                    </select>
                    <span class="help-block" style="color:red;"><?= form_error('kab'); ?></span>
                </div>
                <div class="form-group">
                    <label>Kode Pos Asal</label>
                    <input type="text" class="form-control" name="kode_pos_asal"
                        placeholder="Kode Pos Asal" value="<?=$o->kode_pos_asal?>">
                </div>
            </div>
            <div class="col-md-6" style="background-color:#2E8B57;">
                <div class="form-group">
                    <label>Provinsi Tujuan <span class="text-red">*</span></label>
                    <select name="provtujuan" class="form-control select2" id="provtujuan"
                        style="width:100%" required>
                        
                        <?php  $qprovtujuan = $this->db->get_where('kabupaten',['id_kab'=>$o->tujuan])->row();
                        foreach($provinsi as $p): ?>
                        <option value="<?= $p['id_prov']; ?>" <?php echo $p['id_prov'] == $qprovtujuan->id_prov ? 'selected="selected"' : '';?>><?= $p['nama']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="help-block" style="color:red;"><?= form_error('prov'); ?></span>
                </div>
                <div class="form-group">
                    <label>Kota/Kabupaten Tujuan <span class="text-red">*</span></label>
                    <select name="kabtujuan" class="form-control select2" id="kabtujuan" style="width:100%"
                        required>
                        
                        <?php
                            $qkota = $this->db->get_where('kabupaten',['id_prov'=>$qprovtujuan->id_prov])->result();
                            foreach($qkota as $qk){
                                if($qk->id_kab == $o->tujuan){
                                    $seltujuan = 'selected="selected"';
                                } else {
                                    $seltujuan = '';
                                }

                                echo '<option value="'.$qk->id_kab.'" '.$seltujuan.'>'.$qk->nama.'</option>';
                            }
                        ?>
                    </select>
                    <span class="help-block" style="color:red;"><?= form_error('kab'); ?></span>
                </div>
                <div class="form-group">
                    <label>Kode Pos Tujuan</label>
                    <input type="text" class="form-control" name="kode_pos_tujuan"
                        placeholder="Kode Pos Tujuan" value="<?=$o->kode_pos_tujuan?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kurir <span class="text-red">*</span></label>
                    <select name="kurir" class="form-control select2" id="kurir" style="width:100%"
                        required>
                        <option value="0">-- Pilih Kurir --</option>
                        <?php foreach($datakurir as $k): 
                            if($k['kode'] == $o->kurir){
                                $sel = 'selected="selected"';
                            } else {
                                $sel = '';
                            }
                            ?>
                        <option value="<?= $k['kode']; ?>" <?=$sel?>><?= $k['kode'].' - '.$k['nama']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="help-block" style="color:red;"><?= form_error('kurir'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Layanan <span class="text-red">*</span></label>
                    <select name="layanan" class="form-control select2" id="layanan" style="width:100%"
                        required>
                        
                        <?php
                        $qlayanan = $this->db->get_where('kurir',['kode'=>$o->kurir])->result();
                        foreach($qlayanan as $ql){
                            if($qlayanan->layanan == $o->layanan){
                                $selql = 'selected="selected"';
                            } else {
                                $selql = '';
                            }
                            echo '<option value="'.$ql->layanan.'"'.$selql.'>'.$ql->layanan.'</option>';
                        }
                        ?>
                    </select>
                    <span class="help-block" style="color:red;"><?= form_error('layanan'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <label>Biaya <span class="text-red">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control harga" name="biaya" placeholder="Biaya per Kilo"
                        required  value="<?=$o->biaya;?>">
                    <span class="input-group-addon">/ Kg</span>
                </div>
            </div>
            <div class="col-md-6">
                <label>Estimasi <span class="text-red">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" name="estimasi" placeholder="ex: 4-5" required  value="<?=$o->estimasi;?>">
                    <span class="input-group-addon">Hari</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <br>
                    <label>Catatan</label>
                    <textarea class="form-control" name="catatan" cols="30" rows="5"
                        placeholder="Catatan"><?=$o->catatan;?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
             <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Update</button>
            </div>
        </div>

    </form>
    
</section>