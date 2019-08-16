
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchases Management
        <small>Add, Edit, Pay</small>
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
                      <th>Amount</th>
                      <th>Farmer Code</th>
                      <th>Farmer Name</th>
                      <th>Date</th>
                      <th>Purchaser</th>
                      <th>Amount Non Paid</th>
                      
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
                      <td><?php echo $record->amount ?></td>
                      <td><?php echo $record->farmer_code ?></td>
                      <td><?php echo $record->surname ?>&nbsp<?php echo $record->first_name ?></td>
                      <td><?php echo $record->added_on ?></td>
                      <td><?php echo $record->purchased_by ?></td>
                      <td><?php echo $record->amount_not_paid ?></td>
                      
                      <td>

                      
                        <form action="<?php echo base_url().'payIcamFarmer/'.$record->purchase_id; ?>" method="post">


                        <?php if($record->payStatus == "partial") { ?> <input type="text" class="form-control required" name="amountToBePaid" placeholder="input amount of money to be paid to farmer" /><br><?php } else {} ?>
                        <?php if($record->payStatus == "paid"){ ?>  <input type="text" class="form-control required" name="amountToBePaid" placeholder="" readonly=""/><br> <?php } else {} ?>
                        <?php if($record->payStatus == "not paid"){ ?> <input type="text" class="form-control required" name="amountToBePaid" placeholder="input amount of money to be paid to farmer" /><br> <?php } else {} ?>
                        
                        <input type="hidden" class="form-control" name="purchaseID" value="<?php echo $record->purchase_id ?>" >
                        <input type="hidden" class="form-control" name="amount_not_paid" value="<?php echo $record->amount_not_paid ?>" >
                        <input type="hidden" class="form-control" name="payCurrentStatus" value="<?php echo $record->payStatus  ?>" >
                        
                        <?php if($record->payStatus == "partial") { ?> <input class="btn btn-sm btn-warning" name="submit" value="Pay" type="submit" ><?php } else {} ?>
                        <?php if($record->payStatus == "paid"){ ?>  <input class="btn btn-sm btn-success" name="submit" value="Fully Paid" type="submit" > <?php } else {} ?>
                        <?php if($record->payStatus == "not paid"){ ?> <input class="btn btn-sm btn-danger" name="submit" value="Pay" type="submit" > <?php } else {} ?>
                        
                        </form>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?> 
                  </table>
				  </div>

                  <div class="row">
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
                                    ?>" readonly="">
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
                                    ?>" readonly="" >
                           </div>
                        </div>
                    </div>


                 
            </div><!-- /.box-body -->
           </div>
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
        </div><!-- /.box -->
       
   
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
