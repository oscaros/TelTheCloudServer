<style>

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    margin: auto; 
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* The Modal (background) */
.modal2 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    margin: auto; 
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 30%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* 2nd Modal Content */
.modal-content2 {
    position: relative;
    background-color: #fafafe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 30%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

/* The Close 2 Button */
.close2 {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.close2:hover,
.close2:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-header2 {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}
.modal-body2 {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchases Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewPurchase"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Purchases List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>purchaseListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Quantity</th>
                      <th>Unit Cost</th>
                      <th>Amount</th>
                      <th>Type</th>
                      <th>Farmer Code</th>
                      <th>Farmer Name</th>
                      <th>Buying Station</th>
                      <th>Purchased By</th>
                      <th>Date</th>
                      <th class="text-center">Actions</th>
                    </tr>
                     <?php
                    if(!empty($purchaseRecords))
                    {
                        foreach($purchaseRecords as $record)
                        { 
                    ?>
                    <tr>
                      <td><?php echo $record->purchase_id ?></td>
                      <td><?php 
                      if( $record->qty_organic != 0){
                      echo $record->qty_organic;
                        }
                      if( $record->qty_other != 0){
                            echo $record->qty_other;
                        }                      
                      ?>
                      </td>
                      <td><?php echo $record->unit_cost ?></td>
                      <td><?php echo $record->amount ?></td>
                      <td><?php echo $record->type ?></td>
                      <td><?php echo $record->farmer_code ?></td>
                      <td><?php echo $record->surname ?>&nbsp<?php echo $record->first_name ?></td>
                      <td><?php echo $record->bs_name ?></td>
                      <td><?php echo $record->purchased_by ?></td>
                      <td><?php echo $record->added_on ?></td>
                      <td class="text-center">

                      <?php if($record->payStatus == "partial") { ?>  <a class="btn btn-sm btn-warning" id="xx" href="<?php echo base_url().'payFarmer' ?>"><i class="fa fa-money"></i></a> <?php } else {} ?>
                      <?php if($record->payStatus == "paid"){ ?>  <a class="btn btn-sm btn-success" href="#"><i class="fa fa-money"></i></a> <?php } else {} ?>
                      <?php if($record->payStatus == "not paid"){ ?> <a class="btn btn-sm btn-danger" id="xx" href="<?php echo base_url().'payFarmer' ?>"><i class="fa fa-money"></i></a> <?php } else {} ?>
                       <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOldPurchase/'.$record->purchase_id; ?>"><i class="fa fa-pencil"></i></a>
                       <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->purchase_id; ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?> 
                  </table>

                  <div row="class">
                      <div class="col-md-3">
                          <div class="form-group">
                             <label for="totalQty">Total Quantity (Kg)</label>
                                <input class="form-control" type="text" id="totalQty" value="
                                    <?php 
                                    if(!empty($purchaseRecords))
                                    {
                                        $sum =0;
                                        foreach($purchaseRecords as $record)
                                        { 
                                            $sum = $sum + (($record->qty_organic)+($record->qty_other));      
                                        }
                                        echo $sum;
                                    }
                                    ?>
                                " readonly="">
                           </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                             <label for="totalQty">Total Amount (Ugx)</label>
                                <input class="form-control" type="text" id="totalQty" value="
                                    <?php 
                                    if(!empty($purchaseRecords))
                                    {
                                        $sum =0;
                                        foreach($purchaseRecords as $record)
                                        { 
                                            $sum = $sum + ($record->amount);      
                                        }
                                        echo $sum;
                                        //echo number_format((float)$sum, 0, '.', '');
                                    }
                                    ?>
                                " readonly="">
                           </div>
                        </div>
                        <!--first modal popup-->
                        <div class="col-md-3">
                            <!-- The Modal -->
                          <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close">&times;</span>
                                       <h4>Pay Farmer | Not Paid Initially</h4>
                                </div>
                                <div class="modal-body">
                                  <form action="<?php echo base_url().'payFarmer/'.$record->purchase_id; ?>" method="post">
                                    <div class="form-group">
                                        <p> Amount not paid <?php 
                                       /*  $x = $record->amount_not_paid;
                                        echo number_format((float)$x, 0, '.', ''); */ ?> Ugx</p>
                                        <input type="text" class="form-control required" name="amountToBePaid" placeholder="input amount of money to be paid to farmer" /> 
                                        <input type="hidden" class="form-control" name="purchaseID" value="<?php echo $record->purchase_id ?>" >
                                        <input type="hidden" class="form-control" name="amount_not_paid" value="<?php echo $record->amount_not_paid ?>" >
                                        <input type="hidden" class="form-control" name="payCurrentStatus" value="<?php echo $record->payStatus  ?>" >
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        <input type="reset" class="btn btn-default" value="Reset" />
                                    </div>
                                  </form>
                            </div>
                          </div>
                        </div>
                        <!--second modal popup-->
                        <div class="col-md-3">
                            <!-- The Modal -->
                          <div id="myModal2" class="modal2">
                            <!-- Modal content -->
                            <div class="modal-content2">
                                <div class="modal-header2">
                                    <span class="close2">&times;</span>
                                       <h4>Pay Farmer | Isn't Fully Paid</h4>
                                </div>
                                <div class="modal-body2">
                                  <form action="<?php echo base_url().'payFarmer/'.$record->purchase_id; ?>" method="post">
                                    <div class="form-group">
                                    <p> Amount not paid <?php 
                                      /*   $x = $record->amount_not_paid;
                                        echo number_format((float)$x, 0, '.', ''); */ ?> Ugx</p>
                                        <input type="text" class="form-control required" name="amountToBePaid" placeholder="input amount of money to be paid to farmer" /> 
                                        <input type="hidden" class="form-control" name="purchaseID" value="<?php echo $record->purchase_id ?>" >
                                        <input type="hidden" class="form-control" name="amount_not_paid" value="<?php echo $record->amount_not_paid ?>" >
                                        <input type="hidden" class="form-control" name="payCurrentStatus" value="<?php echo $record->payStatus  ?>" >
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        <input type="reset" class="btn btn-default" value="Reset" />
                                    </div>
                                  </form>
                            </div>
                          </div>
                        </div>


                  </div>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "purchaseListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

<!--script to add modal popup-->
<script>
$(document).ready(function(){ 
  $(document).on('click', 'a', function() {
    this.id
   // alert(this.id)
/*    var element = document.getElementsByClassName("btn-sm btn-danger")[0].id;

if (element === "myBtn") {
   alert("Working"); 
} */
// Get the modal
var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn = document.getElementById(this.id);
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
});
});
</script>

<!--script to add modal popup2-->
<script>
$(document).ready(function(){ 
    $(document).on('click', 'a', function() {
        this.id
    //alert(this.id)
// Get the modal
var modal2 = document.getElementById('myModal2');
// Get the button that opens the modal
var btn2 = document.getElementById(this.id);
// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];
// When the user clicks the button, open the modal 
btn2.onclick = function() {
    modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
});
 });
});
</script>
