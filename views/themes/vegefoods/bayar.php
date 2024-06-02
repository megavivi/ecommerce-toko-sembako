<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $this->config->item('client_key'); ?>"></script>
<script>
        function pay() {
            fetch('<?php echo site_url("welcome/process_payment"); ?>')
                .then(response => response.json())
                .then(data => {
                    snap.pay(data, {
                        onSuccess: function(result) {
                            console.log('Payment successful!', result);
                            window.location.href = "<?php echo site_url('welcome/finish'); ?>";
                        },
                        onPending: function(result) {
                            console.log('Payment pending.', result);
                        },
                        onError: function(result) {
                            console.log('Payment error!', result);
                        }
                    });
                });
        }
    </script>
<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Pembayaran Tagihan</span>
                </p>
                <h1 class="mb-0 bread">Detail Pembayaran Tagihan</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="bg-white p-3 mb-4" style="overflow:scroll; height:300px;width:100%;color:black;">
            Bill To / Ditagihkan Kepada :
            
        </div>
        <div class="row block-9">
           
            <?php 
			foreach(bayar(user()['idusers']) as $b): 
			?>
            <div class="col-md-6 d-flex mb-3" id="form-addbayar">
                <form action="<?=base_url('user/addKonfirmasi');?>" method="post" class="bg-white p-5 contact-form"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode</label><br>
                        <b><?=$b->code;?></b>
                    </div>
                    <div class="form-group">
                        <label>Tgl. Transaksi</label><br>
                        <b><?=$b->tanggal;?> WIB</b>
                    </div>
                    <div class="form-group">
                        <label>Jumlah pembayaran</label><br>
                        <input type="hidden" class="form-control" name="idbayar" value="<?=$b->idpembayaran;?>">
                        <b>Rp <?=number_format($b->total_harga);?></b>
                    </div>
                    <div class="form-group">
                        <label>Status</label><br>
                        <?php
                        if($b->status == "pending"){
                            echo '<span class="badge badge-danger">BELUM DIBAYAR</span>';
                        } else{
                            echo '<span class="badge badge-success">LUNAS</span>';
                        }
                        ?>
                    </div>
                    <?php
                        if($b->status == "verified"){
                    ?>
                    <div class="form-group">
                        <label>No. Resi</label><br>
                        <b><?php echo $b->no_resi;?></b>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Bayar</label><br>
                        <b><?php echo $b->tglbayar;?></b>
                    </div>
                    
                    <?php
                        } else {
                            echo '<hr><a href="'.site_url('bayar/'.$b->order_id).'" id="bayar" class="btn btn-success mt-2">Bayar Tagihan</button>';
                        }
                    ?>
                    
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>