<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php foreach ($totalPurchases as $x1) {echo number_format((float)$x1 -> purchases, 0, '.', ''); }?></h3>
                  <p>Total Purchases</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url(); ?>purchaseListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php foreach ($totalFarmers as $x1) {echo number_format((float)$x1 -> farmers, 0, '.', ''); }?></h3>
                  <!-- <sup style="font-size: 20px">%</sup> -->
                  <p>Total Farmers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>farmers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php foreach ($totalBuyingStations as $x1) {echo $x1 -> buyingStations; }?></h3>
                  <p>Total Buying Stations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
                <a href="<?php echo base_url(); ?>stationListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php foreach ($totalHectare as $x1) { echo number_format((float)$x1 -> totalHectare, 1, '.', ''); }?></h3>
                  <p>Total Hectare</p>
                </div>
                <div class="icon">
                  <i class="ion ion-map"></i>
                </div>
                <a href="<?php echo base_url(); ?>inspectionListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->            
          </div>
   
     
     <!-- This is  graph space-->
              <div class="row">
                  <div class="col-lg-6 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h5>Top Buying stations</h5>
                          </div>
                          <div class="panel-body">
                              <div id = "container"></div>
                              <script language = "JavaScript">
                                    function drawChart() {
                                        // Define the chart to be drawn.
                                        var data = google.visualization.arrayToDataTable([
                                          ['Year', 'Tonnes'],
                                          /* ['Bundiguya',  90],
                                          ['Bunyangule',  100],
                                          ['Bugombwa',  117],
                                          ['Nyahuka',  125],
                                          ['Mantoroba',  153] */

                                           <?php            
                                              foreach($topBuyinStations as $r){
                                              echo "['".$r->bs_name."', (($r->total_organic + $r->total_other)/1000)],";  
                                              }
                                          ?> 
          
                                        ]);

                                        var options = {title: 'Cocoa (in Tonnes)', height: 300}; 

                                        // Instantiate and draw the chart.
                                        var chart = new google.visualization.BarChart(document.getElementById('container'));
                                        chart.draw(data, options);
                                    }
                                    google.charts.setOnLoadCallback(drawChart);
                              </script>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h5>Purchases Per Month</h5>
                          </div>
                          <div id="container1" class="panel-body"></div>
                          <script language = "JavaScript">
                                function drawChart() {
                                    // Define the chart to be drawn.
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string', 'Month');
                                    data.addColumn('number', 'Organic');
                                    data.addColumn('number', 'Other');
                                    data.addRows([
                                     /*  ['Jan',  7.0, -0.2],
                                      ['Feb',  6.9, 0.8],
                                      ['Mar',  9.5,  5.7],
                                      ['Apr',  14.5, 11.3],
                                      ['May',  18.2, 17.0],
                                      ['Jun',  21.5, 22.0],
                                      
                                      ['Jul',  25.2, 24.8],
                                      ['Aug',  26.5, 24.1],
                                      ['Sep',  23.3, 20.1],
                                      ['Oct',  18.3, 14.1],
                                      ['Nov',  13.9,  8.6],
                                      ['Dec',  9.6,  2.5] */

                                      <?php 
                                                  
                                        foreach($purchaseTrend as $r){
                                        echo "['".$r->short_form."', (($r->qty_organic)/1000),".(($r->qty_other)/1000)."],";  
                                        }
                                      ?> 
                                                

                                    ]);
                                    
                                    // Set chart options
                                    var options = {
                                      chart: {
                                          title: 'Annual Purchases Trend',
                                          subtitle: 'Source: Icam Purchases Department'
                                      },   
                                      hAxis: {
                                          title: 'Month',         
                                      },
                                      vAxis: {
                                          title: 'Temperature',        
                                      }, 
                                      
                                      'height':300,
                                      axes: {
                                          x: {
                                            0: {side: 'top'}
                                          }      
                                      }      
                                    };

                                    // Instantiate and draw the chart.
                                    var chart = new google.charts.Line(document.getElementById('container1'));
                                    chart.draw(data, options);
                                }
                                google.charts.setOnLoadCallback(drawChart);
                              </script>                          
                        </div>
                    </div>
                </div>
              
              <!-- mmmmm -->

              <!-- This is a row for top farmers -->
                <div class="row">
                  <div class="col-lg-6 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h5>Top Farming Subcounties</h5>
                          </div>
                          <div class="panel-body">
                              <div id = "container2"></div>
                              <!-- place here dydnamic code displaying data from database -->
                              <script language = "JavaScript">
                                  function drawChart() {
                                      // Define the chart to be drawn.
                                      var data = google.visualization.arrayToDataTable([
                                         ['Subcounty', 'Organic', { role: 'annotation'} ,'Inorganic', { role: 'annotation'}],
                                        /*['Bubandi',  90,'90',      39, '39'],
                                        ['Busaru',  100,'100',      40,'40'],
                                        ['Buganikere',  117,'117',      44,'44'],
                                        ['Tokwe',  125,'125',       48,'48'],
                                        ['Nyahuka TC',  153,'153',    54,'54'] */


                                        

                                        <?php 
                                                  
                                        foreach($topFarmingSubs as $r){
                                        echo "['".$r->subcounty_name."', (($r->qty_organic)/1000),'".(($r->qty_organic)/1000)."',  (($r->qty_other)/1000),'".(($r->qty_other)/1000)."' ],";  
                                        }
                                        ?> 
                                      ]);

                                      var options = {title: 'Cocoa supply (in Tonnes)', height: '300'};  

                                      // Instantiate and draw the chart.
                                      var chart = new google.visualization.ColumnChart(document.getElementById('container2'));
                                      chart.draw(data, options);
                                  }
                                  google.charts.setOnLoadCallback(drawChart);
                                </script>
                          </div>
                      </div>
                  </div>

              <!-- This is a row for top subcounties -->
                
                  <div class="col-lg-6 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h5>Top Subcounties</h5>
                          </div>
                          <div class="panel-body">
                              <div id = "container3"></div>
                              <script language = "JavaScript">
                                    function drawChart() {
                                        // Define the chart to be drawn.
                                        var data = new google.visualization.DataTable();
                                        data.addColumn('string', 'Subcounty');
                                        data.addColumn('number', 'Percentage');
                                        data.addRows([
                                          /* ['Bubandi', 45.0],
                                          ['Nyahuka', 26.8],
                                          ['Kasitu', 12.8],
                                          ['Tokwe', 8.5],
                                          ['Busaru', 6.2],
                                          ['Buganikere', 0.7] */

                                        <?php 
                                                  
                                        foreach($piechartTopSubs as $r){
                                        echo "['".$r->subcounty_name."', ($r->qty_organic + $r->qty_other)/1000],";  
                                        }
                                        ?> 



                                        ]);
                                          
                                        // Set chart options
                                        var options = {
                                          'title':'ICAM Cocoa supply shares, 2018',   
                                          'height':300,
                                          slices: {  
                                              1: {offset: 0.2},
                                              3: {offset: 0.3}                  
                                          }
                                        };

                                        // Instantiate and draw the chart.
                                        var chart = new google.visualization.PieChart(document.getElementById('container3'));
                                        chart.draw(data, options);
                                    }
                                    google.charts.setOnLoadCallback(drawChart);
                                  </script>

                          </div>
                      </div>   
                    </div>  
                 </div>              
        </section>
     


</div>