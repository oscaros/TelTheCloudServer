<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchases Management
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
                        <h3 class="box-title">Enter Purchase Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewCocoaPurchase" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="isadvance">To Cover Farmer's Advance?</label>
                                        <select class="form-control required" id="isadvance" name="isadvance">
										    <option value="">Select Option</option>
											<option value="0">No i need cash</option>
                                            <option value="1">Yes let it pay for my advance</option>
                                        </select>
                                     </div>                                    
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="buyingStation">Buying Station</label>
                                        <select class="form-control required" id="buying_st" name="buyingStation">
                                            <option value="">Select Station</option>
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
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="farmerCode">Farmer Code</label>
                                        <select class="form-control required" id="code" name="farmerCode">
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
										 url:'<?=base_url()?>Purchases/farmerCodes',
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
												$("#code").append('<option value=' + this.farmer_id + '>' + this.farmer_code + '</option>');
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
                                  <label for="famerNameIfNotRegistered"> Farmer's name if farmer has no code</label>
                                  <input class = "form-control" type="text" name="famerNameIfNotRegistered" id="famerNameIfNotRegistered" readonly=""></input>
                                </div>
							  </div>
							  <div class="col-md-4">
                               	<div class="form-group">
                                  <label for="target"> Farmer's Annual Cocoa Supply Target (Kg)</label>
                                  <input class = "form-control" type="text" name="target" id="target" readonly=""></input>
                                </div>
							  </div>
						      <div class="col-md-4">
                               	<div class="form-group">
                                  <label for="excess"> Current balance On Supply Target (Kg)</label>
                                  <input class = "form-control" type="text" name="excess" id="excess" readonly=""></input>
                                </div>
							  </div>
                            </div>
							
							<div class="row"> 
							  <div class="col-md-4">
								<div class="form-group">
									<label for="type">Type of Cocoa</label>	
									<select name="type" class="form-control required"/>
										<option value="organic">Organic</option>
										<option value="other">Other</option>
									</select>
								</div>
                              </div> 
							  <div class="col-md-4">                                
								<div class="form-group">
									<label for="purchaser">Purchaser</label>
									<select id="buyers" name="buyer" class="form-control required"/>
									  <?php
										if(!empty($buyer))
										{
											foreach ($buyer as $r3)
											{
												?>
												<option value="<?php echo $r3->pa_id ?>"><?php echo $r3->name ?> </option>
												<?php
											}
										}
										?>
									</select>
								</div>                                    
                              </div>
							  <div class="col-md-4">
								<div class="form-group">
									<label for="mobile">SubCounty</label>
									<select name="subcounty" id="subcounty" class="form-control">
									<!-- A -->
									</select>
                                        					
									  <!-- Script -->
									  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
									  <script type='text/javascript'>
									  $(document).ready(function(){
									 
									   $('#buying_st').change(function(){
										var buyingStationID2 = $(this).val();
										$.ajax({
										 url:'<?=base_url()?>Purchases/getSubcounty',
										 method: 'post',
										 data: {buyingStationID2: buyingStationID2},
										 dataType: 'json',
										 success: function(response){
										  var len2 = response.length;  
									
                                      
									  if(len2 > 0){
										   $.each(response,function()
										   {
												$("#subcounty").append('<option value=' + this.subcounty_id + '>' + this.subcounty_name + '</option>');
											});										   
									 
										   }else{
										  }
									     }
									   });
									  });
									 });
									 </script>
                                </div>
                              </div>	
						    </div>
							
							
							
							<!-- insert here header -->
							<div class="row">
							    <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="Quantity">Quantity</label>
                                        <input type="text" class="form-control required" id="Quantity" name="Quantity" placeholder="kilos of cocoa" maxlength="128">
                                    </div>                                    
                                </div>
								<div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="unitCost">Unit Cost (UGX)</label>
                                        <input type="text" class="form-control required" id="unitCost" name="unitCost" placeholder="current price per kilo" maxlength="128">
                                    </div>                                    
                                </div>
								<div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="amount">Amount (UGX)</label>
                                        <input type="text" class="form-control required" id="amount" name="amount" maxlength="128"  readonly>
                                    </div>                                    
                                </div> 
							</div>
							<div class="row">
							    <div class="col-md-4">
                                    <div class="form-group">
                                       <label for=""> Allocate Seal Tag </label>
                                       <input class = "form-control" type="text" name="tags" id="tags" ></input>
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="moisture">Moisture Level (Select If It Applies)</label>	
										<select name="moisture" class="form-control required"/>
											<option value="N/A">Not Applicable</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
                                            <option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
                                            <option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
                                            <option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
										</select>
								    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
										<label for=""> Farmer's Supply Balance After Purchase (Kg)</label>
										<input class = "form-control" type="text" name="new_excess" id="new_excess" readonly=""></input>
									</div>
                                </div>
                               <!-- Script -->
                               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
									  <script type='text/javascript'>
									  $(document).ready(function(){
									 
									   $('#code').change(function(){
										var farmerID2 = $(this).val();
										$.ajax({
										 url:'<?=base_url()?>Purchases/getSupplyTarget',
										 method: 'post',
										 data: {farmerID2: farmerID2},
										 dataType: 'json',
										 success: function(response){
										  var len4 = response.length;  
									
									  if(len4 > 0){
										   $.each(response,function()
										   {												 
                                                document.getElementById("target").value = this.excess_delivery_target; 
                                                document.getElementById("excess").value = this.excess_delivery_balance; 
											});										   
									 
										   }else{
                                           /*  $("#advanceID").append('<option value=' '> + 'No record of advance found' + </option>');
										  */ }
									     }
									   });
									  });
									 });
							    </script>
							</div>
							
							<div class="row">
							   <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="advanceID">Which advance is Farmer serving?</label>
                                       <select name="advanceID" id="advanceID" class="form-control">
                                       </select>
                                       <!-- Script -->
									  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
									  <script type='text/javascript'>
									  $(document).ready(function(){
									 
									   $('#code').change(function(){
										var farmerID = $(this).val();
										$.ajax({
										 url:'<?=base_url()?>Purchases/getAdvanceID',
										 method: 'post',
										 data: {farmerID: farmerID},
										 dataType: 'json',
										 success: function(response){
										  var len3 = response.length;  
									
									  if(len3 > 0){
										   $.each(response,function()
										   {
												$("#advanceID").append('<option value=' + this.advance_id + '>' + this.amount + ' On ' + this.date_advanced + ' - by ' + this.advanced_by + '</option>');
                                                
                                                document.getElementById("currentAdvanceAmount").value = this.current_advance_amount; 
											});										   
									 
										   }else{
                                           /*  $("#advanceID").append('<option value=' '> + 'No record of advance found' + </option>');
										  */ }
									     }
									   });
									  });
									 });
									</script>
                                   </div>
                                </div>
                               <div class="col-md-4">
                                    <div class="form-group">
                                       <label for="currentAdvanceAmount"> Outstanding Balance </label>
                                       <input class = "form-control" type="text" name="currentAdvanceAmount" id="currentAdvanceAmount" ></input>
                                    </div>
                               </div>
							   <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="purchaseMonth">Month of Purchase</label>
                                        <select class="form-control required" id="month" name="month">
										    <option value="">Select Month</option>
											<option value="January">January</option>
											<option value="February">February</option>
											<option value="March">March</option>
											<option value="April">April</option>
											<option value="May">May</option>
											<option value="June">June</option>
											<option value="July">July</option>
											<option value="August">August</option>
											<option value="September">September</option>
											<option value="October">October</option>
											<option value="November">November</option>
											<option value="December">December</option>
										</select>
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
$(document).ready(function(){
    $('#Quantity').keyup(calculate);
    $('#unitCost').keyup(calculate);

});

function calculate(e)
{
    $('#amount').val($('#Quantity').val() * $('#unitCost').val());

    //add commas
    var y = $('#unitCost').val();
    var x = $('#amount').val();
        $('#amount').val(addCommas(x));
        $('#unitCost').val(addCommas(y));
}


//function for adding commas
function addCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

//function for adding commas
function addCommas(y) {
    var parts = y.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>

<script>
function addCommasToCurrentBalance(){
var z = $('#currentAdvanceAmount').val();    
$('#currentAdvanceAmount').val(addCommas(z));

    var parts = z.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>


<!--script to subtract from excess deliver -->
<script>
$(document).ready(function(){
    $('#Quantity').change(calculate1);

});

function calculate1(e)
{
    $('#new_excess').val($('#excess').val() - $('#Quantity').val());

}
</script>