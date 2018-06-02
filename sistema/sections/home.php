    <!-- Main content -->
<section class="content container-fluid">
      
<?php

$query = "SELECT COUNT(*) AS total_general,(SELECT COUNT(*) AS total FROM cap_objects WHERE status = 1) AS available,(SELECT COUNT(*) AS total FROM cap_objects WHERE status = 2) AS delivered,(SELECT COUNT(*) AS total FROM cap_objects WHERE status = 3) AS donate,(SELECT COUNT(*) AS total FROM cap_objects WHERE status = 4) AS available_donate FROM cap_objects";
$total_statistic = conecta()->prepare($query);
$total_statistic->execute(array(date('Y-m-d')));
$total_statistic = $total_statistic->fetch();

$percent_available          = number_format(($total_statistic['available'] * 100) / $total_statistic['total_general'],0);
$percent_delivered          = number_format(($total_statistic['delivered'] * 100) / $total_statistic['total_general'],0);
$percent_donate             = number_format(($total_statistic['donate'] * 100) / $total_statistic['total_general'],0);
$percent_available_donate   = number_format(($total_statistic['available_donate'] * 100) / $total_statistic['total_general'],0);

$query = "SELECT COUNT(*),(SELECT COUNT(*) FROM cap_objects WHERE date_format(DATE(entry_date),'%w')= 1) AS seg,(SELECT COUNT(*) FROM cap_objects WHERE date_format(DATE(entry_date),'%w')= 2) AS ter,(SELECT COUNT(*) FROM cap_objects WHERE date_format(DATE(entry_date),'%w')= 3) AS qua,(SELECT COUNT(*) FROM cap_objects WHERE date_format(DATE(entry_date),'%w')= 4) AS quin,(SELECT COUNT(*) FROM cap_objects WHERE date_format(DATE(entry_date),'%w')= 5) AS sex,(SELECT COUNT(*) FROM cap_objects WHERE date_format(DATE(entry_date),'%w')= 6) AS sab FROM cap_objects";
$days_week = conecta()->prepare($query);
$days_week->execute();
$days_week = $days_week->fetch();


?>    
    <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title">Controle de achados e perdidos</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">               
                  
      <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Achados por dia da semana</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px; width: 700px;" width="700" height="180"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Objetos registados <?php echo $total_statistic['total_general'];?></strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Disponível para devolução</span>
                    <span class="progress-number"><b><?php echo $total_statistic['available'];?></b> | <?php echo $percent_available;?>%</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $percent_available;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Entregues</span>
                    <span class="progress-number"><b><?php echo $total_statistic['delivered'];?></b> | <?php echo $percent_delivered ;?>%</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: <?php echo $percent_delivered;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Doados</span>
                    <span class="progress-number"><b><?php echo $total_statistic['donate'];?></b> | <?php echo $percent_donate;?>%</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-primary" style="width: <?php echo $percent_donate;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Disponível para doação</span>
                    <span class="progress-number"><b><?php echo $total_statistic['available_donate'];?></b> | <?php echo number_format($percent_available_donate,0);?>%</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $percent_available_donate;?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
         
     </div>
                
     </div> 
      
      
      
      
      
      


    </section>
    
    
    
    <script>
    
$(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  // -----------------------
  // - MONTHLY SALES CHART -
  // -----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
  // This will get the first returned node in the jQuery collection.
  var salesChart       = new Chart(salesChartCanvas);

  var salesChartData = {
    labels  : ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    datasets: [
      {
        label               : 'Digital Goods',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [<?php echo $days_week['seg'];?>, <?php echo $days_week['ter'];?>, <?php echo $days_week['qua'];?>, <?php echo $days_week['quin'];?>, <?php echo $days_week['sex'];?>, <?php echo $days_week['sab'];?>]
      }
    ]
  };

  var salesChartOptions = {
    // Boolean - If we should show the scale at all
    showScale               : true,
    // Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    // String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    // Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    // Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    // Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    // Boolean - Whether the line is curved between points
    bezierCurve             : true,
    // Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    // Boolean - Whether to show a dot for each point
    pointDot                : false,
    // Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    // Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    // Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    // Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    // Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    // String - A legend template
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  // ---------------------------
  // - END MONTHLY SALES CHART -
  // 
  // ---------------------------
  });
    
    </script>
    
<!-- script type="text/javascript" src="js/dashboard.js"></script -->
    

