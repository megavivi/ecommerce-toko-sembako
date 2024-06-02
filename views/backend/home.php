<style>
            .highcharts-figure,
            .highcharts-data-table table {
                min-width: 310px;
                max-width: 1000px;
                margin: 1em auto;
            }

            #container {
                height: 400px;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }

            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }

            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }

            .highcharts-data-table td,
            .highcharts-data-table th,
            .highcharts-data-table caption {
                padding: 0.5em;
            }

            .highcharts-data-table thead tr,
            .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }

            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }
        </style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PRODUCT</span>
                    <span class="info-box-number"><?=money(count($total_product));?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">CATEGORY</span>
                    <span class="info-box-number"><?=money(count($total_product_category));?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number"><?=money(count($total_order));?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Members</span>
                    <span class="info-box-number"><?=money(count($total_member));?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Grafik Laporan
            </h3>
        
        </div><!-- /.card-header -->
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="container"></div>
                
            </figure>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
    
    </section>
</div>


<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Grafik Laporan Produk
            </h3>
        
        </div><!-- /.card-header -->
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="containerproduk"></div>
                
            </figure>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
    
    </section>
</div>

<!--Add the sidebar's background. This div must be placed
	immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- modal info -->
<div class="modal fade" id="modal_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                <h4>Selamat Datang</h4>
                <p>Anda telah berhasil login dengan hak akses <b><?=$this->session->userdata('access');?></b></p>
            </div>
            <!-- <div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  

  Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Penjualan',
        align: 'left'
    },
    subtitle: {
        text:
            'Tahun 2024',
        align: 'left'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nop','Des'],
        crosshair: true,
        accessibility: {
            description: 'Periode'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Penjualan'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name : 'Jumlah',
            data : <?=$jsonpenjualan;?>
        }
    ]
});

Highcharts.chart('containerproduk', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Grafik Penjualan Produk'
    },
    tooltip: {
        valueSuffix: '%'
    },
    subtitle: {
        text:
        'Tahun <?=date('Y');?>'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.y}',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    series: [
        {
            name: 'Jumlah',
            colorByPoint: true,
            data: <?=$jsonproduk;?>
        }
    ]
});

</script>
<script>
$(document).ready(function() {
    $('#modal_info').modal('show', {
        backdrop: 'static'
    });
});
</script>
