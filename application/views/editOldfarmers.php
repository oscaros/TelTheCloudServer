<?php

$farmerId = '';
$first_name = '';
$surname = '';
$parish = '';
$subcounty = '';
$village = '';
$xcord = '';
$ycord = '';
$mapped_by = '';
$addedby = '';
$tel = '';
$farm_size = '';
$plots = '';
$Nok = '';
$NokPhone = '';

if(!empty($farmerInfo))
{
    foreach ($farmerInfo as $uf)
    {
        $farmerId = $uf->farmer_id;
        $farmerCode = $uf->farmer_code;
        $first_name = $uf->first_name;
        $surname = $uf->surname;
        $parish = $uf->parish;
        $subcounty = $uf->subcounty;
        $village = $uf->village;
        $xcord = $uf->coordinates_x;
        $ycord = $uf->coordinates_y;
        $mapped_by = $uf->mapped_by;
        $addedby = $uf->added_by;
        $tel = $uf->telephone;
        $farm_size = $uf->total_farm_size;
        $plots = $uf->no_of_plots;
        $Nok = $uf->next_of_kin1;
        $NokPhone = $uf->next_of_kin1_phone;
    }
}
?>
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
                    <form role="form" id="addUser" action="<?php echo base_url() ?>editFarmer" enctype="multipart/form-data" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">                                
                                    <div class="form-group">
                                     <fieldset class="the-fieldset">
                                       <legend class="the-legend">Basic farmer info</legend>
                                        <label for="fname">Asssign a unique farmer code to farmer</label>
                                        <input type="text" class="form-control required" id="fname" name="farmerCode" value="<?php  echo $farmerCode?>" maxlength="128">
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
                                            <option value="<?php  echo $subcounty?>"><?php  echo $subcounty?></option>  
                                            <option value="">.....................</option>
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
                                        <input type="text" class="form-control required" id="password"  name="parish" value="<?php  echo $parish?>" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cpassword">Village where farmer is found</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="village" value="<?php  echo $village?>" maxlength="30">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">X - Coordinates</label>
                                        <input type="text" class="form-control required" id="password"  name="xcoordinates" value="<?php  echo $xcord?>" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cpassword">Y - Coordinates</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="ycoordinates" value="<?php  echo $ycord?>" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Farmer was Mapped By</label>
                                        <input type="text" class="form-control required" id="password"  name="mappedby" value="<?php  echo $mapped_by?>" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cpassword">Added By</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="addedby" value="<?php echo $addedby; ?>" maxlength="30">
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
                                        <input type="text" class="form-control required" id="password"  name="fname" value="<?php  echo $first_name?>" maxlength="30">
                                    </div>
                                   </fieldset>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">                                   
                                        <label for="cpassword">Last Name</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="lname" value="<?php  echo $surname?>" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Telephone</label>
                                        <input type="text" class="form-control required" id="password"  name="telephone" value="<?php  echo $tel?>" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">                                   
                                        <label for="cpassword">Total farm size</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="totalsize" value="<?php  echo $farm_size?>" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Number of plots</label>
                                        <input type="text" class="form-control required" id="password"  name="numberplots" value="<?php  echo $plots?>" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">                                   
                                        <label for="cpassword">Farmer's Next of Kin</label>
                                        <input type="text" class="form-control required equalTo" id="cpassword" name="nextofkin" value="<?php  echo $Nok?>" maxlength="30">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="password">Next of Kin's Phone Number</label>
                                        <input type="text" class="form-control required" id="password"  name="nextofkinphone" value="<?php  echo $NokPhone?>" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="password"> </label>
                                        <input type="hidden" class="form-control required" id="password"  name="farmerId" value="<?php echo $farmerId?>" maxlength="30">
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