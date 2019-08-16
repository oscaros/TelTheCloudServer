<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Farmers Cash Advance Management
        <small>Add / Edit Purchase</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->              
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Advance Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewCocoaAdvance" method="post" role="form">
                        <div class="box-body">
							<div class="row"> 
									<div class="col-md-6">
										<div class="form-group">
											<label for="buyingStation">Buying station / Parish</label>
											<select class="form-control required" id="buying_st" name="buyingStation">
												<option value="">Select station</option>
												<?php
												if(!empty($buyStatn))
												{
													foreach ($buyStatn as $r2)
													{
														?>
														<option value="<?php echo $r2->bs_id ?>"><?php echo $r2->bs_name ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="farmerCode">Farmer's Code and Name</label>
											<select class="form-control required" id="code" name="farmerID">
												<option value="">Select Code</option>                                           
											</select>
										</div>
										
										  <!-- Script -->
										  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
										  <script type='text/javascript'>
										  $(document).ready(function(){
										 
										   $('#buying_st').change(function(){
											var buyingStationID = $(this).val();
											$.ajax({
											 url:'<?=base_url()?>Advances/farmerCodes',
											 method: 'post',
											 data: {buyingStationID: buyingStationID},
											 dataType: 'json',
											 success: function(response){
											  var len = response.length;  
											  
											//this clears the select box
											/* $('#code')
												.find('option')
												.remove()
												.end()
											; */
										  
										  if(len > 0){
											   // Read values
											   //var email = response[0].email;
											   //$('#semail').text(email);
											   
											   $.each(response,function()
											   {
													$("#code").append('<option value=' + this.farmer_id + '>' + this.farmer_code + '&nbsp; - &nbsp;'+ this.surname + '&nbsp;' + this.first_name+ '</option>');
												});										   
										 
											  }else{
											   //$('#semail').text('');
											  }
										 
											 }
										   });
										  });
										 });
										 </script>
									</div>
								</div>
						
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="amount">Amount Advanced</label>
                                        <input type="text" class="form-control required" id="amount" name="amount" placeholder="Amount of cash advanced" maxlength="128">
                                    </div>                                    
                                </div>

                                	    <!-- Include Bootstrap Datepicker -->
                                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
                                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

                                <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
                                
								<div class="col-md-4">                                
                                    <div class="form-group">
                                    <label for="date">Date advanced</label>
                                        <div class="input-group input-append date" id="datePicker">
                                        <input type="text" class="form-control required" id="date" name="date" >
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>                                    
                                </div> 
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                    <label for="date">Advanced By</label>
                                        <input type="text" class="form-control required"  name="advancer" value="<?php echo $name; ?>" >
                                  </div>                                    
                                </div> 
                                
                            </div>
							
							
                            
							
							
							
                           
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addBuyingStation.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });
});
</script>
