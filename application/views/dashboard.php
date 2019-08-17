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
            <div class="col-lg-6 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3> <?php foreach ($totalContacts as $x1) {echo number_format((float)$x1 -> contacts, 0, '.', ''); } ?></h3>
                  <p>Total Contacts Saved</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url(); ?>purchaseListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php foreach ($total_users as $x2) {echo number_format((float)$x2 -> users, 0, '.', ''); } ?></h3>
                  <!-- <sup style="font-size: 20px">%</sup> -->
                  <p>Total Users Registered</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url(); ?>farmers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          
          </div>
   
     
     <!-- This is  graph space-->
              <div class="row">
                  <div class="col-lg-6 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h5>Top 10 Users</h5>
                          </div>
                          <?php //var_dump($getTop10users); ?>
                          <div class="panel-body">
                              <div id = "container"></div>

                              <script language = "JavaScript">
                                    function drawChart() {
                                        // Define the chart to be drawn.
                                        var data = google.visualization.arrayToDataTable([
                                          ['Name', 'Contacts'],

                                           <?php            
                                              foreach($getTop10users as $r){
                                              
                                               echo "['".$r->name."', $r->total_saved],";  
                                              }
                                          ?> 
          
                                        ]);

                                        var options = {title: 'Contacts saved per user', height: 300}; 

                                        // Instantiate and draw the chart.
                                        var chart = new google.visualization.BarChart(document.getElementById('container'));
                                        chart.draw(data, options);
                                    }
                                    google.charts.setOnLoadCallback(drawChart);
                              </script>
                          </div>
                      </div>
                  </div>
                  
                </div>
              
              <!-- mmmmm -->            
        </section>
     


</div>