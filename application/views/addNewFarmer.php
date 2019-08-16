<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Farmers Management
        <small>Add / Edit Farmer</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->  
                                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Farmer's Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewIcamFarmer" enctype="multipart/form-data" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">                                
                                    <div class="form-group">
                                     <fieldset class="the-fieldset">
                                       <legend class="the-legend">Basic farmer info</legend>
                                        <label for="fname">Asssign a unique farmer code to farmer</label>
                                        <input type="text" class="form-control required" id="fname" name="farmerCode" maxlength="128">
                                    </fieldset>
                                    </div>                                    
                                </div>
                                <div class="col-lg-12 col-xs-12">                                
                                    <div class="form-group">
                                     <fieldset class="the-fieldset">
                                        <label for="buyingstn">Asssign a buying station to farmer</label>
                                        <select name="buyingstn" id="type" class="form-control">
                                        <option value="">Select Buying Station</option>
                                        <?php
                                             if(!empty($stations))
                                            {
                                                foreach ($stations as $rl)
                                                { 
                                                    ?>
                                                    <option value="<?php echo $rl->bs_id; ?>" ><?php echo $rl->bs_name ?></option>
                                                     <?php
                                                 }
                                            } 
                                            ?>
                                             
                                        </select>
                                    </fieldset>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                    <fieldset class="the-fieldset">
                                       <legend class="the-legend">Farmer's Geolocation info</legend>
                                        <label for="role">Sub-County where farmer is found</label>
                                        <select class="form-control required" id="role" name="subcounty">
                                            <option value="">Select Sub-county</option>  
                                            <?php
                                            if(!empty($subcounties))
                                            {
                                                foreach ($subcounties as $r2)
                                                {
                                                    ?>
                                                    <option value="<?php echo $r2->subcounty_name ?>"><?php echo $r2->subcounty_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>                                         
                                        </select>
                                    </fieldset>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Parish where farmer is found</label>
                                        <input type="text" class="form-control required" id="password"  name="parish" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cpassword">Village where farmer is found</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="village" value="" maxlength="30">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">X - Coordinates</label>
                                        <input type="text" class="form-control required" id="password"  name="xcoordinates" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cpassword">Y - Coordinates</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="ycoordinates" value="" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Farmer was Mapped By</label>
                                        <input type="text" class="form-control required" id="password"  name="mappedby" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cpassword">Added By</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="addedby" value="<?php echo $name; ?>" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">GPX file url / upload GPX File</label>
                                        <input type="file" class="form-control-file" id="password"  name="gpxfile" maxlength="30">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                    <fieldset class="the-fieldset">
                                       <legend class="the-legend">Farmer's additional info</legend>
                                        <label for="password">First Name</label>
                                        <input type="text" class="form-control required" id="password"  name="fname" maxlength="30">
                                    </div>
                                   </fieldset>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">                                   
                                        <label for="cpassword">Last Name</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="lname" value="" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Telephone</label>
                                        <input type="text" class="form-control required" id="password"  name="telephone" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">                                   
                                        <label for="cpassword">Total farm size</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="totalsize" value="" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Number of plots</label>
                                        <input type="text" class="form-control required" id="password"  name="numberplots" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">                                   
                                        <label for="cpassword">Farmer's Next of Kin</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="nextofkin" value="" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Next of Kin's Phone Number</label>
                                        <input type="text" class="form-control required" id="password"  name="nextofkinphone" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="target"> Farmer's annual Cocoa supply target </label>
                                        <input type="text" class="form-control required" id="target"  name="target" maxlength="30">
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
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