<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchasers Management
        <small>Add New Schedule</small>
      </h1>
    </section>
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Allocation Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewPurchaserSchedule" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Name (Each user has an account in the system)</label>
                                        <select class="form-control required" id="purchaser_id" name="purchaser_id">
                                            <option value="">Select User</option>
                                            <?php
                                            if(!empty($purchasers))
                                            {
                                                foreach ($purchasers as $r2)
                                                { ?>
                                                    <option value="<?php echo $r2->pa_id ?>"><?php echo $r2->name ?></option>

                                                   <?php if ($r2->name == NULL ){ ?>
                                                        <option value=""> No more un assigned weighing scales</option>
                                                                        <?php  }
                                                }
                                            }  ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Buying station</label>
                                        <select class="form-control required" id="station_id" name="station_id">
                                            <option value="">Select Station</option>
                                            <?php
                                            if(!empty($buyStatn))
                                            {
                                                foreach ($buyStatn as $r2)
                                                {
                                                    ?>
                                                    <option value="<?php echo $r2->bs_id ?>"><?php echo $r2->bs_name ?> -&gt; <?php echo $r2->bs_parish ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="scale">Weighing Scale</label>
                                        <select class="form-control required" id="scale"  name="scale">
                                        <option value="">Select Scale</option>
                                        <?php
                                            if(!empty($scales))
                                            {
                                                foreach ($scales as $r2)
                                                {
                                                    ?>
                                                    <option value="<?php echo $r2->scale_id ?>"><?php echo $r2->scale_number ?> manufactured by -&gt; <?php echo $r2->manufacturer ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="registeredBy" id="registeredBy" value="<?php echo $name ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="official_role" id="official_role">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="telephone" id="telephone">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
        $(document).ready(function(){
        
        $('#purchaser_id').change(function(){
        var purchaserID = $(this).val();
        //alert('onchnage detected');
        $.ajax({
            url:'<?=base_url()?>Allocations/getParticularPurchasersData',
            method: 'post',
            data: {purchaserID: purchaserID},
            dataType: 'json',
            success: function(response){

            var len6 = response.length;
            var y = "No Details Found For This Purchaser"
            
            //alert('ajax call made');            
            //$('#advanceID').empty();
            //$('#currentAdvanceAmount').empty();										  
    
        if(len6 > 0){
            $.each(response,function()
            {
                    document.getElementById("name").value = this.name; 
                    document.getElementById("official_role").value = this.official_role; 
                    document.getElementById("telephone").value = this.telephone;
            });										   
        
            }else{
            alert('y');
            }
            }
        });
        });
        });
</script>

