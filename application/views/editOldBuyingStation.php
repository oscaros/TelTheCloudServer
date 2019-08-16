<?php

$stationId = '';
$bs_name = '';
$bs_subcounty = '';
$bs_parish = '';
$addedby = '';

if(!empty($stationInfo))
{
    foreach ($stationInfo as $uf)
    {
        $stationId = $uf->bs_id;
        $bs_name = $uf->bs_name;
        $bs_subcounty = $uf->subcounty_name;
        $bs_parish = $uf->bs_parish;
        $addedby = $uf->bs_createdby; 
        $subcountyId = $uf->subcounty_id; 
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Buying Station Management
        <small>Add / Edit Station</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->    
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Buying Station Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editStation" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Buying Station Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Full Name" name="bs_name" value="<?php echo $bs_name; ?>" maxlength="50">
                                        <input type="hidden" value="<?php echo $stationId; ?>" name="stationId" id="userId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Subcounty where station is found</label>
                                        <select class="form-control" id="role" name="subcounty">
                                            <?php
                                             if(!empty($stationInfo))
                                            {
                                                foreach ($stationInfo as $rl)
                                                { 
                                                    ?>
                                                    <option value="<?php echo $rl->subcounty_id; ?>"><?php echo $rl->subcounty_name ?></option>
                                                    
                                                    <?php
                                                 }
                                            } 
                                            ?>
                                            <option value=" "></option>
                                            <?php
                                             if(!empty($subcounties))
                                            {
                                                foreach ($subcounties as $r2)
                                                {
                                                    ?>
                                             <option value="<?php echo $r2->subcounty_id ?>"><?php echo $r2->subcounty_name ?></option>
                                            <?php
                                                 }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                
                            </div>                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Parish where station is found</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="bs_parish" value="<?php echo $bs_parish; ?>" maxlength="30">
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

<script src="<?php echo base_url(); ?>assets/js/editBuyingStation.js" type="text/javascript"></script>