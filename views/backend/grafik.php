<!-- STACKED BAR CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="content">
  <div class="container-fluid">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Grafik Penjualan Bunga</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          <script>
            // Use a more descriptive ID for the canvas
            var ctx = document.getElementById("stackedBarChart").getContext('2d');
            
            // Use let or const for variable declaration
            let myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["Anggrek", "Lili", "Gerbera","Carnation", "Tulip", "Matahari", "Gardenia", "Mawar"],
                datasets: [{
                  label: 'Data Penjualan',
                  data: [
                    <?php
                    $connect = mysqli_connect("localhost", "root", "", "ksucatalog");
                    $Anggrek = mysqli_query($connect, "select * from trift where nama ='Anggrek'");
                    echo mysqli_num_rows($Anggrek);
                    ?>,
                    <?php
                    $Lili = mysqli_query($connect, "select * from trift where nama ='Lili'");
                    echo mysqli_num_rows($Lili);
                    ?>,
                    <?php
                    $Gerbera = mysqli_query($connect, "select * from trift where nama='Gerbera'");
                    echo mysqli_num_rows($Gerbera);
                    ?>,
                    <?php
                    $StoneIsland = mysqli_query($connect, "select * from trift where nama ='Carnation'");
                    echo mysqli_num_rows($StoneIsland);
                    ?>,
                    <?php
                    $CPCompany = mysqli_query($connect, "select * from trift where nama ='Tulip'");
                    echo mysqli_num_rows($CPCompany);
                    ?>,
                    <?php
                    $Matahari = mysqli_query($connect, "select * from trift where nama ='Matahari'");
                    echo mysqli_num_rows($Matahari);
                    ?>,
                    <?php
                    $NewBalance = mysqli_query($connect, "select * from trift where nama ='Gardenia'");
                    echo mysqli_num_rows($NewBalance);
                    ?>,
                    <?php
                    $Mawar = mysqli_query($connect, "select * from trift where nama ='Mawar'");
                    echo mysqli_num_rows($Mawar);
                    ?>,
                    ],
                  backgroundColor: [
                    'rgba(100, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(355, 670, 86)',
                    'rgba(5, 786, 86)',
                    'rgba(555, 886, 86)',
                    'rgba(55, 206, 86)',
                    'rgba(700, 66, 86)',
                    'rgba(987, 6, 86)',
                    'rgba(55, 746, 86)',
                    'rgba(155, 936, 86)',
                    'rgba(275, 26, 86)'
                  ],
                  borderColor: [
                    'rgba(100, 99, 132)',
                    'rgba(54, 162, 235)',
                    'rgba(355, 670, 86)',
                    'rgba(5, 786, 86)',
                    'rgba(555, 886, 86)',
                    'rgba(55, 206, 86)',
                    'rgba(700, 66, 86)',
                    'rgba(987, 6, 86)',
                    'rgba(55, 746, 86)',
                    'rgba(155, 936, 86)',
                    'rgba(275, 26, 86)'
                  ],
                  borderWidth: 1 // Correct the typo in borderWidth
                }]
              }
            });
          </script>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.container-fluid -->
</section>
