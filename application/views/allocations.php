<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Purchase Agents Management
        <small>View, Edit</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewPurchaser"><i class="fa fa-money"></i> Add New Purchaser</a>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewSchedule"><i class="fa fa-plus"></i> Make New Schedule</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Allocation List / Roaster</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>purchaseListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php /* echo $searchText; */ ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
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
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Telephone</th>
                      <th>Assigned To</th>
                      <th>Assigned On</th>
                      <th>Scale No</th>
                      <th>Assigned By</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  <?php
                    if(!empty($allocationRecords))
                    {
                        foreach($allocationRecords as $record)
                        { 
                    ?>
                    <tr>
                      <td><?php echo $record->a_id ?></td>
                      <td><?php echo $record->purchaser_name ?></td>
                      <td><?php echo $record->official_role ?></td>
                      <td><?php echo $record->telephone ?></td>
                      <td><?php echo $record->bs_name ?></td>
                      <td><?php echo $record->assigned_on ?></td>
                      <td><?php echo $record->scale_number ?></td>
                      <td><?php echo $record->assigned_by ?></td>
                      <td class="text-center">

                      <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOldPurchase/'.$record->a_id; ?>"><i class="fa fa-envelope"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?> 
                  </table>
                  
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
