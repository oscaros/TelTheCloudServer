<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Advance Profile
        <small>Edit, Delete</small>
      </h1>
    </section>
<section class="content">
 <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-11 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-0 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
            <?php
           //echo '<pre>'; print_r($organicData); echo '</pre>'; 
                    if(!empty($advanceInfo))
                    {//
                        foreach($advanceInfo as $record)
                        {
                    ?>
              <h3 class="panel-title"><?php echo $record->surname ?>&nbsp<?php echo $record->first_name ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="advance Pic" src="
                <?php 
                if($record->picture == NULL){ ?>
                   <?php echo base_url();?>assets/images/userprofiles/male1avatar.gif
               <?php } else { ?>
                   <?php echo base_url();?>assets/images/userprofiles/<?php echo $record-> picture ?>
                <?php } ?>" class="img-circle img-responsive"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Farmer Code:</td>
                        <td><?php echo $record->farmer_code ?></td>
                      </tr>
                      <tr>
                        <td>Farmer's Name:</td>
                        <td><?php echo $record->surname ?>&nbsp<?php echo $record->first_name ?></td>
                      </tr>
                      <tr>
                        <td>Total Farm Size</td>
                        <td><?php echo $record->total_farm_size ?>&nbsp; Hectares</td>
                      </tr>
                   
                     
                        <tr>
                        <td>Number Of Plots</td>
                        <td><?php echo $record->no_of_plots ?></td>
                        </tr>
                        <tr>
                        <td>Telephone</td>
                        <td><?php echo $record->telephone ?></td>
                        </tr>
                        <tr>
                        <td>Next Of Kin's Name</td>
                        <td><?php echo $record->next_of_kin1 ?></a></td>
                        </tr>
                        <tr>
                        <td>Next Of Kin's Phone Number</td>
                        <td><?php echo $record->next_of_kin1_phone ?></td>                           
                        </tr>  
                        <tr><td></td></tr>
                        <tr>
                        <td>Farmer's Subcounty</td>
                        <td><?php echo $record->subcounty ?></td>
                        </tr>
                        <tr>
                        <td>Farmer's Parish</td>
                        <td><?php echo $record->parish ?></td>
                        </tr>
                        <tr>
                        <td>Farmer's Village</td>
                        <td><?php echo $record->village ?></td>
                        </tr>
                        <tr>
                        <td>Amount Of Cash Advanced</td>
                        <td><?php echo number_format($record->amount);  ?>&nbsp;UGX</td>
                        </tr>
                        <tr>
                        <td>Amount Of Money Unpaid</td>
                        <td><?php echo number_format($record->current_advance_amount);  ?>&nbsp;UGX</td>
                        </tr>
                        <tr>
                        <td>Farmer Was Advanced By</td>
                        <td><?php echo $record->advanced_by ?></td>
                        </tr>
                        <tr>
                        <td>Advance Was Recorded On</td>
                        <td><?php echo $record->date_added ?></td>
                        </tr>
                        <tr>
                        <td>Farmer Was Advanced On</td>
                        <td><?php echo $record->date_advanced ?></td>
                        </tr>

                    </tbody>
                  </table>
                  
                </div>
				    
                <?php
                        }
                    }
                    ?>
              </div>
             
            </div>
                <div class="panel-footer">
                    <a data-original-title="Send advance Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                    <span class="pull-right">
                        <a href="<?php echo base_url().'editOldadvances/'.$record->advance_id; ?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                    </span>
                </div>            
          </div>
        </div>
      </div>

   
		<div class="row">
		 <div class="col-lg-11 col-xs-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				  <h5>Purchases Made To Reconcile The Advance</h5>          
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
           
						  /* ['Jan',  7.0, -0.2],  
						  ['Feb',  6.9, 0.8],
						  ['Mar',  9.5,  5.7],
						  ['Apr',  14.5, 11.3],
						  ['May',  18.2, 17.0],
						  ['Jun',  21.5, 22.0] */
            <?php 
            
                foreach($organicData as $r){
                echo "['".$r->short_form."', $r->organic,".$r->other."],";  
                }
            ?> 
              
             
						]);
						
						// Set chart options
						var options = {
						  chart: {
							  title: 'Monthly Sales Trend of <?php echo $record->first_name ?> ',
							  subtitle: 'Source: Icam Purchases Department'
						  },   
						  hAxis: {
							  title: 'Month',         
						  },
						  vAxis: {
							  title: 'Temperature',        
						  }, 
						  
						  'height':400,
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

    <?php
       /*  foreach($organicData as $r){
        //echo "['".$r->short_form."', $r->organic,".$r->other."],";  
        var_dump("['".$r->short_form."', $r->organic,".$r->other."],");
        }  */
    ?> 
 </section>
</div>