<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchasers Management
        <small>Add Purchaser</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Purchasers Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewCocoaPurchaser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchasername">Name (Each user has an account in the system)</label>
                                        <select class="form-control required" id="purchasername" name="purchasername">
                                            <option value="">Select User</option>
                                            <?php
                                            if(!empty($users))
                                            {
                                                foreach ($users as $r2)
                                                {
                                                    ?>
                                                    <option value="<?php echo $r2->userId ?>"><?php echo $r2->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Designation</label>
                                        <input type="text" class="form-control" id="role"  name="role" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tel">Telephone</label>
                                        <input type="text" class="form-control required" id="tel"  name="tel">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required" id="email" name="email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="currentUser">Added By</label>
                                        <input type="type" class="form-control" id="currentUser" name="currentUser" value="<?php echo $name ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="name" name="name"  readonly="">
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
        
        $('#purchasername').change(function(){
        var userID = $(this).val();
        //alert('onchnage detected');
        $.ajax({
            url:'<?=base_url()?>Allocations/getParticularUsersData',
            method: 'post',
            data: {userID: userID},
            dataType: 'json',
            success: function(response){

            var len5 = response.length;
            var y = "No Details Found For This Farmer"
            
            //alert('ajax call made');            
            //$('#advanceID').empty();
            //$('#currentAdvanceAmount').empty();										  
    
        if(len5 > 0){
            $.each(response,function()
            {
                    document.getElementById("role").value = this.role; 
                    document.getElementById("tel").value = this.mobile; 
                    document.getElementById("email").value = this.email; 
                    document.getElementById("name").value = this.name; 
                    //alert('resp');
            });										   
        
            }else{
            alert('y');
            }
            }
        });
        });
        });
</script>