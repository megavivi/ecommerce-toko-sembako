<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
loadcategories();
loadtags();

function loadcategories() {
    $.ajax({
        type: 'POST',
        url: '<?= site_url()."posts/categories/load" ?>',
        dataType: 'json',
        success: function(data) {
            var row = '';
            for (var i = 0; i < data.length; i++) {
                row += '<option value="' + data[i].idcategories + '">' + data[i].category_name +
                    '</option>';
            }
            $('#post_categories').html(row);
        }
    })
}

function loadtags() {
    $.ajax({
        type: 'POST',
        url: '<?= site_url()."posts/tags/load" ?>',
        dataType: 'json',
        success: function(data) {
            var row = '';
            for (var i = 0; i < data.length; i++) {
                row += '<option value="' + data[i].idtags + '">' + data[i].tag_name +
                    '</option>';
            }
            $('#post_tag').html(row);
        }
    })
}

function add_category() {
    var category_name = $("[name='category_name']").val();
    $.ajax({
        type: 'POST',
        data: {
            category_name: category_name
        },
        url: '<?= site_url()."posts/categories/addcategories" ?>',
        success: function() {
            $("#modal_add_categories").modal('hide');
            loadcategories();
        }
    })
}

function add_tag() {
    var tag_name = $("[name='tag_name']").val();
    $.ajax({
        type: 'POST',
        data: {
            tag_name: tag_name
        },
        url: '<?= site_url()."posts/tags/addtag" ?>',
        success: function() {
            $("#modal_add_tags").modal('hide');
            loadtags();
        }
    })
}
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <!-- <div class="row"> -->
    <form action="<?=base_url('product/createProduct');?>" method="post" enctype="multipart/form-data">
        <div class="box">
            <div class="box-body pad">
                <div class="col-md-6">
    <!-- Box Add Post -->
         <div class="form-group">
         <?php if (isset($edata['idproduct'])): ?>
        <input type="hidden" class="form-control" name="idproduct" value="<?=$edata['idproduct'];?>">
        <input type="hidden" name="old_image" value="<?=$edata['product_image'];?>">
         <?php endif;?>
        <label>Nama <span style="color:red;">*</span></label>
         <input type="text" class="form-control" placeholder="nama produk" name="product_name" value="<?php echo !empty($edata['product_name']) ? $edata['product_name'] : '';?>">
        </div>
                <div class="col-md-6">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Kategori </label>
                        <select name="category_id" class="form-control select2">
                            <?php foreach(produk_kategori() as $pk):?>
                            <?php if(isset($edata)):?>
                            <?php if($edata['category_id']==$pk['idcategory']):?>
                            <option value="<?=$pk['idcategory'];?>" selected><?=$pk['category_name'];?></option>
                            <?php else: ?>
                            <option value="<?=$pk['idcategory'];?>"><?=$pk['category_name'];?></option>
                            <?php endif;?>
                            <?php endif;?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Satuan <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" placeholder="kg" name="satuan" value="<?php echo !empty($edata['satuan']) ? $edata['satuan'] : '';?>" >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Harga Jual <span style="color:red;">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                Rp.
                            </div>
                            <input type="text" class="form-control harga" placeholder="Harga Jual" name="harga_jual" value="<?php echo !empty($edata['harga_jual']) ? $edata['harga_jual'] : '';?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Harga Diskon</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                Rp.
                            </div>
                            <input type="text" class="form-control harga" placeholder="Harga Diskon" name="diskon" 
                            value="<?php echo !empty($edata['diskon']) ? $edata['diskon'] : '';?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Berat <span style="color:red;">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control harga" placeholder="Berat Produk" name="berat"
                            value="<?php echo !empty($edata['berat']) ? $edata['berat'] : '';?>">
                            <div class="input-group-addon">
                                gram
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Stok <span style="color:red;">*</span></label>
                        <input type="text" class="form-control harga" placeholder="Stok Produk" name="stok" value="<?php echo !empty($edata['stok']) ? $edata['stok'] : '';?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keterangan <span style="color:red;">*</span></label>
                        <textarea id="editor1" name="keterangan" rows="10"
                            cols="80"><?php echo !empty($edata['keterangan']) ? $edata['keterangan'] : '';?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- Box Add Post -->
                    <div class="form-group">
                        <label>Pilih Gambar Cover</label>
                        <input type="file" class="form-control" name="image"
                            >
                        <span>File format : <b><?=settings('general','file_allowed_types');?></b></span><br>
                        <?php
                        if(!empty($edata['product_image'])){
                            echo '<img src="'.base_url('uploads/products/').$edata['product_image'].'" class="img-thumbnail img-responsive img-fluid" width="150">';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <a href="<?=base_url('product');?>" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-success btn-flat pull-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- </div> -->
</section>
<!-- Modal add categories -->
<div class="modal fade" id="modal_add_categories">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Categories</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm btn-flat"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat" onclick="add_category()">Add
                        Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal add tags -->
<div class="modal fade" id="modal_add_tags">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Tags</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tag Name</label>
                        <input type="text" class="form-control" name="tag_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm btn-flat"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat" onclick="add_tag()">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>