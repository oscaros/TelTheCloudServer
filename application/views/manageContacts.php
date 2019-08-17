<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Cloud Contacts Management
        <small>Edit, Delete</small>
      </h1>
    </section>
          <?php /*var_dump($contactRecords);*/ ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Contacts List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>contactListing" method="POST" id="searchList">
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
                      <th>Contact Id</th>
                      <th>Contact Name</th>
                      <th>Phone Number</th>
                      <th>Phone Type</th>
                      <th>Saved By</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($contactRecords))
                    {
                        foreach($contactRecords as $record)
                        {
                    ?>
                    <tr>

                      <td><?php echo $record->id ?></td>
                      <td><?php echo $record->contact_name ?></td>
                      <td><?php echo $record->phone_number ?></td>
                      <td><?php echo $record->phone_type ?></td>
                      <td><?php echo $record->name ?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php /*echo base_url().'editOldBuyingStation/'.$record->bs_id;*/ ?>"><i class="fa fa-pencil"></i></a>

                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php /*echo $record->bs_id;*/ ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php /*echo $this->pagination->create_links();*/ ?>
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
            jQuery("#searchList").attr("action", baseURL + "stationListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
