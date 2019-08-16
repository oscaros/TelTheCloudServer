<style media="screen" type="text/css">
/* css for signature pad */
#btnSaveSign 
{
        color: #fff;
        background: #f99a0b;
        padding: 5px;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        margin-top: 10px;
    }
    #signArea{
        width:304px;
        margin: 50px auto;
    }
    .sign-container {
        width: 60%;
        margin: auto;
    }
    .sign-preview {
        width: 150px;
        height: 50px;
        border: solid 1px #CFCFCF;
        margin: 10px 5px;
    }
    .tag-ingo {
        font-family: cursive;
        font-size: 12px;
        text-align: left;
        font-style: oblique;
    }
/* css for accordion */
.wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> ICAM Farmer Inspection Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">ICAM Farmers' Inspection List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>farmersListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php //echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
			   
                <!-- <div class="container"> -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-file">
                            </span>ORGANIC COCOA FARMER CONTRACT</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name Of Cocoa Farmer</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Cocoa Farmer Code</label>
                                        <input type="text" class="form-control" name="code" placeholder="code" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="village">Village</label>
                                        <input type="text" class="form-control" name="village" placeholder="village" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="village">Total Cocoa Farm Size</label>
                                        <input type="text" class="form-control" name="village" placeholder="village" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="village">Number Of Different Cocoa Farm locations</label>
                                           <select class="form-control required" id="role" name="subcounty">
                                            <option value="">Select</option>                                
                                             <?php for ($i=1; $i<=100; $i++){ ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                              <?php } ?>
                                            </select>
                                    </div>
                                    <h5><b>I, the undersigned, accept to be a member of ICAM CHOCOLATE (U) LIMITED Cocoa organic Project</b></h5>
                                    <p>I promise to follow agricultural principles and to comply with the internal organic standards
                                    I declare these have been explained to me and that I understand them. I will participate in the 
                                    internal Control System (ICS) and fully cooperate with the ICS staff when they are carrying out their ICS functions.</p>
                                    
                                    <p>I will not use any chemical pesticides, herbicides or synthetic fertilizers on any field of organic Cocoa croop and as well as other
                                    crops grown as inter crop or in rotation on these fields. i will avoid where possible the use of any chemical 
                                    substance(s) on any other crop bordering my organic Cocoa crop fields. </p>

                                    <p>I shall endeavour to maintain the following organic principles; </p>
                                    <div class="checkbox checkbox-primary" style="margin-left:20px">
                                     <input type="checkbox" name="princ1" value="yes" />
                                     <label for="princ1">   Use of clean planting material / seeding materials, when available   </label>
                                    </div>

                                    <div class="checkbox checkbox-primary" style="margin-left:20px">
                                     <input type="checkbox" name="princ2" value="yes" />
                                     <label for="princ2">   Maintain and improve soil fertility manure using green vegetation and crop residues </label>
                                    </div>

                                    <div class="checkbox checkbox-primary" style="margin-left:20px">
                                     <input type="checkbox" name="princ2" value="yes" />
                                     <label for="princ2">   Avoid environmental degredation; cutting down trees unnecessarily, burning of crop
                                          remains or any other organi materials; dumping of toxic aterials (such as batteries) or burning of plastics </label>
                                    </div>

                                    <div class="checkbox checkbox-primary" style="margin-left:20px">
                                     <input type="checkbox" name="princ2" value="yes" />
                                     <label for="princ2">  Prevent sol erosion by keeping the soil covered at all times, constructing
                                     contour boders where necessary.
                                    </div>

                                    <p>I shall commit myself to follow the organic management training programme as organised by ICAM CHOCOLATE (U) LTD. </p>
                                    <p>I understand that any violation(s) of the organic principles by even a single cocoa grower 
                                        will laed to the exclusioon of this Cocoa production. if I observe any violations of the organic 
                                        principles, i will report this to the Internal Inspector or another responsible personn of the 
                                        Internal Control System. </p>
                                    <p>I will allow inspections by persons authourised by ICAM CHOCOLATE (U) LTD.
                                    <p><strong>ICAM CHOCOLATE (U) LTD will provide the following support: </strong></p>
                                    <p>ICAM CHOCOLATE (U) LTD will buy the organic Cocoa when it is fresh and of suitable quality </p>
                                    <p>ICAM CHOCOLATE (U) LTD will pay a sustainable price that will atleast cover the costs of the 
                                        organic farming practices, including a  possible organic premium (depending on the market situation). The  
                                        price will be renegotiated on a regular basis and atleast yearly with the Cocoa farmers' association through a transparent 
                                        process. </p>
                                    <p>ICAM CHOCOLATE (U) LTD will provide training and other services to the Cocoa grower through 
                                        the field officers, Internal inspectors and other staff. </p>
                                    <p>ICAM CHOCOLATE (U) LTD will coordinate the entire Internal Control System and organic certification process. </p>
                                    <div class="form-group">
                                        <label for="address">Place / Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="address" required />
                                    </div>

                                    <div class="form-group">
                                    <label for="date">Date</label>
                                    <div class='input-group date' id='datetimepicker1'>                                    
                                        <input type='text' name='date' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
									</div>

                                    <div class="form-group">
                                        <label for="name">Name of Cocoa Farmer</label>
                                        <input type="text" class="form-control" name="name" placeholder="name" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Signature or thumb print of farmer</label>
                                        <div id="signArea" >
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        </div>		
                                            <button id="btnSaveSign">Save Signature</button>		
                                            <div class="sign-container">
                                            <?php
                                            $image_list = glob("./doc_signs/*.png");
                                            foreach($image_list as $image){
                                                //echo $image;
                                            ?>
                                            <img src="<?php echo $image; ?>" class="sign-preview" />
                                            <?php
                                            
                                            }
                                            ?>
                                            </div>
                                    </div>
                                        <script language="javascript">
                                            $(document).ready(function() {
                                                $('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
                                            });
                                            
                                            $("#btnSaveSign").click(function(e){
                                                html2canvas([document.getElementById('sign-pad')], {
                                                    onrendered: function (canvas) {
                                                        var canvas_img_data = canvas.toDataURL('image/png');
                                                        var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                                                        //ajax call to save image inside folder
                                                        $.ajax({
                                                            url: 'save_sign.php',
                                                            data: { img_data:img_data },
                                                            type: 'post',
                                                            dataType: 'json',
                                                            success: function (response) {
                                                            window.location.reload();
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        </script> 
										<p> For ICAM CHOCOLATE (U) LTD.</p>
										<div class="form-group">
                                        <label for="officer_name">Name</label>										                           
                                        <input type='text' name='officer_name' placeholder='Name' class="form-control" />
										</div>
										
										<div class="form-group">
                                        <label for="position">Position</label>										                           
                                        <input type='text' name='position' placeholder='position' class="form-control" />
										</div>
										
										<div class="form-group">
                                        <label for="address">Signature</label>
                                        <div id="signArea" >
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        </div>
										<button id="btnSaveSign">Save Signature</button>		
                                            <div class="sign-container">
                                            <?php
                                            $image_list = glob("./doc_signs/*.png");
                                            foreach($image_list as $image){
                                                //echo $image;
                                            ?>
                                            <img src="<?php echo $image; ?>" class="sign-preview" />
                                            <?php
                                            
                                            }
                                            ?>
                                            </div>
                                        </div>
										
										<p>Witness</p>
										<div class="form-group">
                                        <label for="name">Name</label>
										<input type='text' name='witness_name' placeholder='name' class="form-control" />
										</div>
										
										<div class="form-group">
                                        <label for="address">Signature</label>
                                        <div id="signArea" >
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        </div>
										<button id="btnSaveSign">Save Signature</button>		
                                            <div class="sign-container">
                                            <?php
                                            $image_list = glob("./doc_signs/*.png");
                                            foreach($image_list as $image){
                                                //echo $image;
                                            ?>
                                            <img src="<?php echo $image; ?>" class="sign-preview" />
                                            <?php
                                            
                                            }
                                            ?>
                                            </div>
                                        </div>
										


                             </div>
							</div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th-list">
                            </span>FARMER / COCOA FARM ENTRY OR REGISTRATION FORM</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
							    <p>MEMBERSHIP REGISTRATION FORM</p>
                                <div class="col-md-4">
                                    <div class="form-group">
									<label for="surname">Farmer Surname</label>
                                        <input type="text" class="form-control" placeholder="surname" required />
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
									<label for="fname">Farmer Surname</label>
                                        <input type="text" class="form-control" placeholder="first_name" required />
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
									<label for="telephone">Farmer's Telephone</label>
                                        <input type="text" class="form-control" placeholder="telephone" required />
                                    </div>
                                </div>
                            </div>
							 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
									<label for="address">Farmer's Address / Location</label>
                                        <input type="text" class="form-control" placeholder="address" required />
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
									<label for="farmercode">Farmer's Code</label>
                                        <input type="text" class="form-control" placeholder="farmer code" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <input type="button" value="Add Plot" onClick="addRow('dataTable')" /> 
                                <input type="button" value="Remove Plot" onClick="deleteRow('dataTable')" />      
                                <table id="dataTable" class="form" border="0">
                                    <tbody>
                                        <tr>
                                        <p>
                                        <td style="width:20%">
                                        <input type="checkbox" name="chk[]" checked="checked" />
                                        </td>
                                        <td style="width:20%">
                                        <label>Plot Area Loc</label>
                                        <input type="text" name="BX_NAME[]" width="10px">
                                        </td>
                                        <td>
                                        <label for="BX_age">GPS Ref</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">PlotSize (Ha)</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">Area of Organic cocoa (Ha)</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">Year of Planting</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">Expected Yield (Fresh Kg)</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">Date of last use of Chemicals</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">Intercrops</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                        <td>
                                        <label for="BX_age">Previous crop grown</label>
                                        <input type="text" class="small"  name="BX_age[]">
                                        </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
							
							<div class="row">
							 <div class="col-md-3">
                                    <div class="form-group"> <!--add date (year) picker-->
									<label for="fname">How long hav you practiced organic Cocoa farming?</label>
                                        <input type="text" class="form-control" name="dateOfOrganic" placeholder="year" required />
                                    </div>
                             </div>	
                            
                            <div class="col-md-3">
                                    <div class="form-group"> 
									<label for="convCrops">Which crops do you grow as conventional?</label>
                                        <textarea class="form-control" rows ="3" name="convCrops" ></textarea>
                                    </div>
                             </div>	
                            <div class="col-md-3">
                                    <div class="form-group"> 
									<label for="prevInspection">Have you had any Internal / external inspection before?</label>
                                        <select class="form-control" name="prevInspection" >
										  <option>No</option>
										  <option>Yes</option>
										</select>
                                    </div>
                             </div>	
                            <div class="col-md-3">
                                    <div class="form-group"> 
									<label for="dateOfLastInsp">If yes, when was the last internal inspection?</label>
                                        <input type="text" class="form-control" name="dateOfLastInsp" placeholder="year" />                                   
                                    </div>
                             </div>							 
							</div>
							
							<div class="row">
							 <div class="col-md-4">
                                    <div class="form-group"> <!--add date (year) picker-->
									<label for="fname">If yes, current certification status</label>
                                        <select class="form-control" name="certStatus" >
										  <option>In Conversion</option>
										  <option>Certified</option>										  
										  <option>Warning</option>
										  <option>Suspended</option>
										  <option>Cancelled</option>
										</select>
								    </div>
                             </div>	
							 <div class="col-md-4">
                                    <div class="form-group"> 
									<label for="willingToAbide">Are you willing to abide by the organic standard</label>
                                        <select class="form-control" name="willingToAbideOrganic" >
										  <option>Yes</option>
										  <option>No</option>
										</select>
								    </div>
                             </div>	
							 <div class="col-md-4">
                                    <div class="form-group"> 
									<label for="willingToAbideICS">Are you willing to abide and respect the ICS of ICAM (U)</label>
                                        <select class="form-control" name="willingToAbideICS" >
										  <option>Yes</option>
										  <option>No</option>
										</select>
								    </div>
                             </div>	
							 </div>
							 
							 <div class="row">
							 <div class="col-md-4">
                                    <div class="form-group"> 
									<label for="signInspector">Place sign</label>
									<label for="signInspector">Internal Inspector </label>
                                          <div id="signArea" >
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        </div>
										<button id="btnSaveSign">Save Signature</button>		
                                            <div class="sign-container">
                                            <?php
                                            $image_list = glob("./doc_signs/*.png");
                                            foreach($image_list as $image){
                                                //echo $image;
                                            ?>
                                            <img src="<?php echo $image; ?>" class="sign-preview" />
                                            <?php
                                            
                                            }
                                            ?>
                                            </div>
								    </div>
                             </div>
							 <div class="col-md-4">
							        <label for="nameOfInsp">Inspector's name</label>
									<input type="text" class="form-control" name="nameOfInsp" placeholder="Inspector's name" />                                   
							 </div>
							 <div class="col-md-4">
							        <label for="dateOfSigningInsp">Place date</label>
									<input type="text" class="form-control" name="dateOfSigningInsp" placeholder="Date of signing" />                                   
							 </div>							 
							 </div>
							 
							 <div class="row">
							 <div class="col-md-4">
                                    <div class="form-group"> 
									<label for="signFarmer">Place sign</label>
									<label for="signFarmer">Farmer </label>
                                          <div id="signArea" >
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        </div>
										<button id="btnSaveSign">Save Signature</button>		
                                            <div class="sign-container">
                                            <?php
                                            $image_list = glob("./doc_signs/*.png");
                                            foreach($image_list as $image){
                                                //echo $image;
                                            ?>
                                            <img src="<?php echo $image; ?>" class="sign-preview" />
                                            <?php
                                            
                                            }
                                            ?>
                                            </div>
								    </div>
                             </div>
							 <div class="col-md-4">
							        <label for="nameOfFarmer">Farmer's name</label>
									<input type="text" class="form-control" name="nameOfFarmer" placeholder="Farmer's name" />                                   
							 </div>
							 <div class="col-md-4">
							        <label for="dateOfSigningFarmer">Place date</label>
									<input type="text" class="form-control" name="dateOfSigningFarmer" placeholder="Date of signing" />                                   
							 </div>							 
							 </div>
							 
							 <div class="row">
							 <div class="col-md-4">
                                    <div class="form-group"> 
									<label for="signFarmer">Place sign</label>
									<label for="signFarmer">ICS Coordinator </label>
                                          <div id="signArea" >
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                                        </div>
                                        </div>
										<button id="btnSaveSign">Save Signature</button>		
                                            <div class="sign-container">
                                            <?php
                                            $image_list = glob("./doc_signs/*.png");
                                            foreach($image_list as $image){
                                                //echo $image;
                                            ?>
                                            <img src="<?php echo $image; ?>" class="sign-preview" />
                                            <?php
                                            
                                            }
                                            ?>
                                            </div>
								    </div>
                             </div>
							 <div class="col-md-4">
							        <label for="nameOfCoordinator">ICS Coordinator's name</label>
									<input type="text" class="form-control" name="nameOfCoordinator" placeholder="Coordinator's name" />                                   
							 </div>
							 <div class="col-md-4">
							        <label for="dateOfSigningCoordinator">Place date</label>
									<input type="text" class="form-control" name="dateOfSigningCoordinator" placeholder="Date of signing" />                                   
							 </div>							 
							 </div>
							
                        </div>
                    </div>
                </div><!-- end accordion 2 -->
				
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-th-list">
                            </span>INTERNAL INSPECTION CHECKLIST / FORM</a>
                        </h4>
                    </div>
					<div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
									<label for="stationName">Name of station</label>
                                        <input type="text" class="form-control" name="stationName" placeholder="station name" required />
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group">
									<label for="firstName">First name</label>
                                        <input type="text" class="form-control" name="firstName" placeholder="farmer's first name" required />
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group">
									<label for="firstName">Family name</label>
                                        <input type="text" class="form-control" name="familyName" placeholder="farmer's first name" required />
                                    </div>
                                </div>
								<div class="col-md-3">
                                    <div class="form-group">
									<label for="farmerCode">Farmer code</label>
                                        <input type="text" class="form-control" name="farmerCode" placeholder="farmer's first name" required />
                                    </div>
                                </div>
								
								
                            </div>
						</div>
					</div>
				</div>
				
				
            </div>
        </div>
    </div>
<!-- </div> -->
                              
				
              </div><!-- /.box -->
            </div>
        </div>
	</section>
	</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
<script language="javascript">
    $(function () {
        $('#datetimepicker1').datepicker({
            format: "dd/mm/yyyy",
            language: "en",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
<script language="javascript">
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 5){                            // limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i <colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Plots are 5");
			   
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) {               // limit the user from removing all the fields
				alert("Cannot Remove all the Plots.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}
</script>
    
