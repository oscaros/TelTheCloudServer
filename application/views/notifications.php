<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Notifications
        <small>Send Notifications</small>
      </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewStation"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Notifications</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php //echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
		<div class="row">
		  <div class="col-xs-8">
		    <div id="relay_api"></div>
        <script type="text/javascript">
                /*

        Magezi Relay WebApi - 2011-05-30
        Copyright (c) 2011 Magezi Solutions Ltd
        All rights reserved.
        
        */
        var style = document.createElement('style');
        style.type = 'text/css';
        style.innerHTML = '.relay_class {border:1px solid #d2d6de;padding:4px;font-family:verdana;font-size:13px;}';
        document.getElementsByTagName('head')[0].appendChild(style);
        var area = document.getElementById('relay_api');
        if (area) {
            area.style.width = '200px;';
            /* area.style.border = '1px solid #000'; */
            area.style.padding = '1px';
            area.style.textAlign = 'center';
            area.innerHTML = "<form method=post name='relay_sms_fom'><table style='width:100%; font-family:verdana; font-size:11px;'> <tr><td><div id='relay_sms_response'>&nbsp;</div></td></tr><tr><td><input class='form-control' value='2567' style='width:96%;' type=text title='Telephone Number' name=relay_tel class='relay_class' maxlength=12 /></td></tr> <tr><td><input class='form-control' value='Sender' onblur=\"gone(this,'Sender')\" title='Sender' onfocus=\"here(this,'Sender')\" maxlength=10 style='width:96%;' type=text name=relay_sender class='relay_class' /></td></tr> <tr><td><textarea class='form-control' name=relay_msg style='overflow:hidden; width:96%;' rows=8 onblur=\"gone(this,'Your message here')\" onfocus=\"here(this,'Your message here')\" onkeydown=\"textCounter(this, 'relay_char_counter');\" onkeyup=\"textCounter(this, 'relay_char_counter');\" title='Your message here' >Your message here</textarea> </td></tr><tr><td>Characters:<strong><span id='relay_char_counter'>0</span></strong></td></tr><tr><td align=center><input class='btn btn-primary' type=button name=relay_btn value='Send SMS' class='relay_class btn' onclick='relay_send();' /></td></tr></table></form>";
        }
        var gone = function(n, val) {
            if (n.value == '') n.value = val;
        };
        var here = function(n, val) {
            if (n.value == val) n.value = '';
        };
        var textCounter = function(field, div) {
            var space = document.getElementById(div);
            if (field.value.length > 143) field.value = field.value.substring(0, 143);
            space.innerHTML = field.value.length;
        };
        var relay_send = function() {
            var fom = document.relay_sms_fom;
            var reply = document.getElementById('relay_sms_response');
            var rqst = httpr;
            if (fom.relay_tel.value.length < 12) {
                reply.innerHTML = '<font color=red>Invalid phone number</font>';
                fom.relay_tel.focus();
            } else if (isNaN(fom.relay_tel.value)) {
                reply.innerHTML = '<font color=red>Only figures</font>';
                fom.relay_tel.focus();
            } else if (fom.relay_sender.value == '' || fom.relay_sender.value == 'Sender') {
                reply.innerHTML = '<font color=red>Provide Sender id</font>';
                fom.relay_sender.focus();
            } else if (!fom.relay_msg.value || fom.relay_msg.value == 'Your message here') {
                reply.innerHTML = '<font color=red>Provide your message</font>';
                fom.relay_msg.focus();
            } else {
                var rqst = httpr();
                if (rqst != null) {
                    var timedout = false;
                    rqst.onreadystatechange = function() {
                        if (rqst.readyState == 1) {
                            toolong = window.setTimeout(function() {
                                if (rqst.readyState == 1) {
                                    timedout = true;
                                    rqst.abort();
                                    reply.innerHTML = '<font color=red>Taking too long, send again</font>';
                                    fom.relay_tel.disabled = false;
                                    fom.relay_sender.disabled = false;
                                    fom.relay_msg.disabled = false;
                                    fom.relay_btn.disabled = false;
                                }
                            }, 30000);
                            reply.innerHTML = "<img src='http://relay.magezi.net/sms/imgs/loader.gif' /><font color=blue>Please wait or <font color=red><a style='cursor:pointer;' onclick='abot()'>Cancel</a></font></font>";
                            fom.relay_tel.disabled = true;
                            fom.relay_sender.disabled = true;
                            fom.relay_msg.disabled = true;
                            fom.relay_btn.disabled = true;
                        }
                        if (rqst.readyState == 3 || rqst.readyState == 2) {
                            reply.innerHTML = "<img src='http://relay.magezi.net/sms/imgs/loader.gif' /> <font color=white>Processing...</font>";
                        }
                        if (rqst.readyState == 4 && /^(200|304)$/.test(rqst.status.toString())) {
                            window.clearTimeout(toolong);
                            reply.innerHTML = rqst.responseText;
                            if (rqst.responseText.indexOf('Message sent to') != -1) {
                                document.getElementById('relay_char_counter').innerHTML = '0';
                                fom.relay_msg.value = 'Your message here';
                                fom.relay_tel.value = '2567';
                                fom.relay_sender.value = 'Sender';
                            }
                            fom.relay_tel.disabled = false;
                            fom.relay_sender.disabled = false;
                            fom.relay_msg.disabled = false;
                            fom.relay_btn.disabled = false;
                        }
                    };
                    var ran = Math.random();
                    rqst.open('GET', 'http://localhost:8180/icam4/assets/to_relay_sms.php?msg=' + escape(fom.relay_msg.value) + '&tel=' + fom.relay_tel.value + '&sender=' + fom.relay_sender.value + '&nu=' + ran, true);
                    rqst.send(null);
                }
            }
        };
        var httpr = function() {
            var request = null;
            if (typeof window.XMLHttpRequest != 'undefined') {
                request = new XMLHttpRequest();
            } else if (typeof window.ActiveXObject != 'undefined') {
                try {
                    request = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (err) {
                    request = null;
                }
            }
            if (request == null) request = new XMLHttpRequest();
            return request;
        };
        var abot = function() {
            var f = document.frm_sms;
            rqst.abort();
            f.relay_tel.disabled = false;
            f.relay_msg.disabled = false;
            f.relay_sender.disabled = false;
            f.relay_btn.disabled = false;
            document.getElementById('say').innerHTML = 'SEND SMS';
        };
    </script>
		  </div>
		</div>
    </section>
</div>

