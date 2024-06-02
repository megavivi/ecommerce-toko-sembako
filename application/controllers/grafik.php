<div class="col-md-6">
                    <div class="row" style="margin-right: 2px; margin-left: 2px">
                    <?php 
                   $data_transaksi = $this->db->query("SELECT COUNT(id_pesan) AS jumlah, DATE_FORMAT(tgl_pesan,'%M %Y') AS pesan_bulan FROM pesanan GROUP BY DATE_FORMAT(tgl_pesan,'%M %Y')")->result();
                    foreach ($data_transaksi as $pesan => $p_barang) {
                       $data_pesan[]=['label'=>$pesan->pesan_bulan, 'y'=>$pesan->jumlah];
                    }

                    ?>

                   
                    <body>
                        <div id="data_pemesanan" style="height: 370px; width: 100%;"></div>
                        <script src="<?php echo base_url('assets/canvasjs/js/canvasjs.min.js') ?>"></script>

                    </body>
                </div>
                </div>

          
                <script type="text/javascript">
                        window.onload = function (){
                    
                            var chart1 = new CanvasJS.Chart("data_pesanan",{
                                theme: "light1",
                                animationEnabled: true,
                                title:{
                                    text: "Jumlah Pemesan"

                                },
                                axisY:[{
                               title: "Jumlah Pemesan",       
                              }],
                              axisX:[{
                               title: "Bulan-Tahun",       
                              }],
                                data: [
                                {
                                    type: "column",
                                    dataPoints: 
                                   
                                   <?=json_encode($data_pesan,JSON_NUMERIC_CHECK);?>
                                    
                                }
                                ]
                            });
                            chart1.render();
                        }
                    </script>