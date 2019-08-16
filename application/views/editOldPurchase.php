<?php
$purchase_id = "";
$qtyOrg = '';  
$qtyOther = '';
$unitcost ='';
$amount = '';
$buyingstation = '';
$farmerCode = '';
$moisture = '';
$type = '';
$purchaser = '';
$month = '';
$unit = "";

$date = date_parse($month);
$monthid = $date['month'];

if(!empty($purchaseInfo))
{
    foreach ($purchaseInfo as $uf)
    {
        $purchase_id = $uf->purchase_id;
        $qtyOrg = $uf->qty_organic; 
        $qtyOther = $uf->qty_other; 
        $unitcost =$uf->unit_cost;
        $amount = $uf->amount;
        $buyingstation = $uf->bs_id;
        $farmerCode = $uf->bs_id;
        $moisture = $uf->moisture;
        $type = $uf->bs_id;
        $purchaser = $uf->bs_id;
        $month = $uf->bs_id;
        $unit =$uf->bs_id;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchases Management
        <small>Add / Edit Station</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->    
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Purchases Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editPurchase" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="qty">Quantity bought</label>
                                        <input type="text" class="form-control" id="Quantity" placeholder="Quantity" name="qty" 
                                        value="<?php 
                                        if($qtyOrg != 0){
                                            echo $qtyOrg;
                                        } 
                                        if($qtyOther !=0){
                                            echo $qtyOther;
                                        }
                                        ?>" maxlength="50">
                                        <input type="hidden" value="<?php echo $purchase_id; ?>" name="purchaseId" id="userId" />    
                                    </div>
								</div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unitcost">Unit Cost</label>
                                        <input type="text" class="form-control" id="unitCost" placeholder="Unit Cost" name="unitcost" value="<?php echo $unitcost; ?>" maxlength="50">                                       
                                    </div>
                                </div> 

                                 <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">Amount of Money Spent</label>
                                        <input type="text" class="form-control" id="amount" placeholder="Total amount" name="amount" value="<?php echo $amount; ?>" maxlength="50">                                          
                                    </div>
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">Moisture</label>
                                        <select name="moisture" id="type" class="form-control">
                                                <option value="<?php echo $moisture; ?>"><?php echo $moisture; ?></option>
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                        </select>
                                     </div>
                                </div>
                           </div>							
                           <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">Type of Cocoa</label>
                                        <select name="type" id="type" class="form-control">
                                        <?php
                                             if(!empty($otherinfo))
                                            {
                                                foreach ($otherinfo as $rl)
                                                { 
                                                    ?>
                                                    <option value="<?php echo $rl->type; ?>" <?php if($rl->type == $type) {echo "selected=selected";} ?>><?php echo $rl->type ?></option>
                                                     <?php
                                                 }
                                            } 
                                            ?>
                                                <option value=""></option>
                                                <option value="organic">Organic</option>
                                                <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">Farmer Code</label>
                                        <select name="farmercode" id="type" class="form-control">
                                        <?php
                                             if(!empty($otherinfo))
                                            {
                                                foreach ($otherinfo as $rl)
                                                { 
                                                    ?>
                                                    <option value="<?php echo $rl->farmer_id; ?>" <?php if($rl->farmer_code == $farmerCode) {echo "selected=selected";} ?>><?php echo $rl->farmer_code ?></option>
                                                     <?php
                                                 }
                                            } 
                                            ?>
                                            <option value=" "></option>
                                            <?php
                                             if(!empty($farmerCodes))
                                            {
                                                foreach ($farmerCodes as $r2)
                                                {
                                                    ?>
                                             <option value="<?php echo $r2->farmer_id ?>"><?php echo $r2->farmer_code ?></option>
                                            <?php
                                                 }
                                            } 
                                            ?>
                                        </select>
                                         </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">Buying Station</label>
                                        <select name="buyingStation" id="type" class="form-control">
                                        <?php
                                             if(!empty($otherinfo))
                                            {
                                                foreach ($otherinfo as $rl)
                                                { 
                                                    ?>
                                                    <option value="<?php echo $rl->bs_id; ?>" <?php if($rl->bs_name == $buyingstation) {echo "selected=selected";} ?>><?php echo $rl->bs_name ?></option>
                                                     <?php
                                                 }
                                            } 
                                            ?>
                                            <option value=" "></option>
                                            <?php
                                             if(!empty($buyingstn))
                                            {
                                                foreach ($buyingstn as $r2)
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">Purchaser</label>
                                        <select name="buyer" id="type" class="form-control">
                                        <?php
                                             if(!empty($otherinfo))
                                            {
                                                foreach ($otherinfo as $rl)
                                                { 
                                                    ?>
                                                    <option value="<?php echo $rl->pa_id; ?>" <?php if($rl->name == $name) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                                    <?php
                                                 }
                                            } 
                                            ?>
                                            <option value=" "></option>
                                            <?php
                                             if(!empty($purchasors))
                                            {
                                                foreach ($purchasors as $r2)
                                                {
                                                    ?>
                                             <option value="<?php echo $r2->pa_id ?>"><?php echo $r2->name ?></option>
                                            <?php
                                                 }
                                            } 
                                            ?> 
                                        </select>
                                </div>
                                  
                            </div>
						</div>						
							
                       <?php //echo '<pre>'; print_r($otherinfo); echo '</pre>'; ?>

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
<script>
$(document).ready(function(){
    $('#Quantity').keyup(calculate);
    $('#unitCost').keyup(calculate);
});
function calculate(e)
{
    $('#amount').val($('#Quantity').val() * $('#unitCost').val());
}
</script>