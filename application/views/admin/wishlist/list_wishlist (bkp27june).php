<section>
<div class="container">
	<div class="row">
    <div class="col-sm-12">
		<div class="col-sm-3">
        <?php $this->load->view('includes/left_menu'); ?>
        </div>
        <?php /*if($upload_error['error']!='') { 
echo "<div class='alert-error'>";
          echo $upload_error['error'];
          echo "</div>"; } */?>
        <div class="col-sm-9">
        	<div class="main-content">
            <div class="col-sm-12">
                <div class="top-form" id="myDiv">
                <div class="pull-right"><a href="#" class="ajax">Edit</a></div>
                	<div class="col-sm-4 main-image text-center">
                            <?php if($userdata[0]['profile_picture']=='')
                            {
                                ?>
                    	<img src="<?php echo base_url()?>images/profile-image-border.png">
                            <?php }else{ ?>
                        <img src="<?php echo base_url()?>uploads/profile_pics/<?php echo $userdata[0]['profile_picture'];?>" height="100" width="100">
                            <?php } ?>
                        <br>
                        <h4><a href="" id="upload_link">Update Profile Image</a></h4>
                        <input type="file" id="upload" name="profile_picture" accept='image/*' value="<?php echo set_value('profile_picture'); ?>">
                        <input type="hidden" name="hid_image" value="<?php echo $userdata[0]['profile_picture']; ?>">
                    </div>	
                    
                    <div class="col-sm-8">
                    	<div class="product-form">
                        <div class="col-sm-6">
                        	<div class="form-group">
                        		 <span><strong style="font-size:18px;"><?php echo $userdata[0]['first_name']; ?></strong></span>   
                            </div>   
                            <div class="form-group">
                            	  <span><strong style="font-size:18px;"><?php echo $userdata[0]['last_name']; ?></strong></span>   
                            </div>
                            <div class="form-group">
                            	<span><?php echo $userdata[0]['location']; ?> </span> 
                            </div>
                            <div class="form-group">
                            	<span><?php  echo date('m-d-Y', strtotime($userdata[0]['created_on']));?></span>   
                            </div>                         
                        </div>
                        
                        <div class="col-sm-6">
                        	<div class="form-group">
                            	 <span><?php echo $userdata[0]['email']; ?></span> 
                            </div>   
                            <!--<div class="form-group">
                            	 <label>Password</label>
                        		 <input type="password" name="password" id="password" class="form-control"  placeholder="">   
                            </div>-->
                            <div class="form-group">
<span style="color:#4b156d;"><?php if($userdata[0]['status']==0) { echo "Active";} 
?></span>
<span style="color:#FF0000;"><?php if($userdata[0]['status']==1) { echo "Inactive";}?></span>
                            </div>
                                                    
                        </div>
                        
                        
                                    <?php
          if(validation_errors()!="") 
          {
            echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo validation_errors();
            echo '</div>';             
          }
     
      ?>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            </div>
            
            <div class="col-sm-12">
                <div class="data-table table-responsive">
            	              <div id="basicWizard" class="basic-wizard" style="border:4px; height:1400px;">
                
                <ul class="nav nav-pills nav-justified">
                  <li><a href="#tab1" data-toggle="tab" id="thcolor"> Product Wishlist</a></li>
                  <li><a href="#tab2" data-toggle="tab" id="giftdetails">Gift Details</a></li>
                  <li><a href="#tab3" data-toggle="tab" id="messagemgt">Message Management</a></li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane" id="tab1">
                    <form class="form">
                       <div class="form-group">
                          
                  wishlist1
               <br>
               wishlist2
                        
                        </div> 
                    </form>
                  </div>
                  <div class="tab-pane" id="tab2"><!--tab2-->
                    <form class="form">
                        
                        
                        
                        <ul class="nav nav-pills nav-justified">
                 
                  <li><a href="#giftsent" data-toggle="tab" id="giftsent">Gift Send </a></li>
                  <li><a href="#giftreceived" data-toggle="tab" id="giftreceived" >Gift Received </a></li>
                </ul> 
                       <div class="tab-pane" id="giftsent">
                          
                          
                           <div class="row"id="gifts">
                          
                         <div data-toggle="collapse" data-target="#demo"><span class="glyphicon                                 glyphicon-minus-sign"></span><img 

src="xyz.png">John Dell</img></div>
                               <div id="demo" class="collapse">
                        <div class="table-responsive">
                                    <table class="table mb30">
                                            <thead>
                                            <tr>
                
                <th> </th>
                <th>Product Name </th>
                <th>Product Price</th>
                   <th>Delevery Details</th>
                   
              </tr>
            </thead>
            <tbody>
             
               <tr>
                   <td><img src="xyz.png"></img></td>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC </td>
                <td>$120</td>
                <td>
                 
                 02-29-2016 03-22-pm
                </td>
              </tr>
                         
                <tr>
                   <td><img src="xyz.png"></img></td>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC </td>
                <td>$120</td>
                <td>
                 
                 02-29-2016 03-22-pm
                </td>
              </tr>
               
            
            
            </tbody>
          </table>
          </div><!-- table-responsive -->  
  </div>
                          </div>
                          
                          </div> <!--gift send closed here-->  
                        
                       
                        <div class="tab-pane" id="giftreceived">
                          
                          
                           <div class="row"id="giftr">
                          
                         <div data-toggle="collapse" data-target="#demo2"><span class="glyphicon                                 glyphicon-minus-sign"></span><img 

src="xyz.png">John Dell r</img></div>
                        <div id="demo2" class="collapse">
                        <div class="table-responsive">
                                    <table class="table mb30">
                                            <thead>
                                            <tr>
                
                <th> </th>
                <th>Product Name </th>
                <th>Product Price</th>
                   <th>Delevery Details</th>
                   
              </tr>
            </thead>
            <tbody>
             
               <tr>
                   <td><img src="xyz.png"></img></td>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC </td>
                <td>$120</td>
                <td>
                 
                 02-29-2016 03-22-pm
                </td>
              </tr>
                         
                <tr>
                   <td><img src="xyz.png"></img></td>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC </td>
                <td>$120</td>
                <td>
                 
                 02-29-2016 03-22-pm
                </td>
              </tr>
               
            
            
            </tbody>
          </table>
          </div><!-- table-responsive -->  
  </div>
                          </div>
                          
                          </div> <!--gift received closed here--> 
                  
                    </form>

                     
                        
                        


                  </div>  <!-- tab2 closed-->


                 <div class="tab-pane" id="tab3">
                    <form class="form">
                        
                         <ul class="nav nav-pills nav-justified">
                  <li><a href="#messagesent" data-toggle="tab" id="messagesent"> Message Sent</a></li>
                  <li><a href="#messagereceived" data-toggle="tab" id="messagereceived">Message Received</a></li>
                  
                </ul>
                          
                        
                        <div class="tab-pane" id="messagesent">
                            
                                                <div class="table-responsive" id="messages">
          <table class="table mb30">
            <thead>
              <tr>
                
                <th>product Name </th>
                <th>Message Details </th>
                <th>Delivery Details</th>
                   <th>Delete</th>
                   
              </tr>
            </thead>
            <tbody>
             
               <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
                         <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
               <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
                <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
                <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
            
            
            </tbody>
          </table>
          </div><!-- table-responsive -->     
                            
                            
                            
                            
                        </div><!-- Message Sent  tab Close here -->
                        
                        <div class="tab-pane" id="messagereceived">
                            
                                                <div class="table-responsive" id="messager">
          <table class="table mb30">
            <thead>
              <tr>
                
                <th>product Name RR </th>
                <th>Message Details </th>
                <th>Delivery Details</th>
                   <th>Delete</th>
                   
              </tr>
            </thead>
            <tbody>
             
               <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
                         <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
               <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
                <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
                <tr>
                <td>Mr. B's Aldo tan suede leather sole Wingtips 9.5 D EUC</td>
                <td><textarea class="form-control" rows="5">lorem ipsum dolor sit amet, concectetur adipiscing elit sed do.</textarea> </td>
                <td>02-09-2019 03:22 pm</td>
                <td class="table-action">
                 
                  <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
            
            
            </tbody>
          </table>
          </div><!-- table-responsive -->     
                            
                            
                            
                            
                        </div><!-- Message  Received Close here -->
                      
                    
                        
                     
                      
                  
                  
                </div><!-- tab-content -->
                
                
                
              </div><!-- #basicWizard -->
                              </div>
            </div>
        </div>
        
        
        
    </div>
    </div>
</div>
</section>


<section style="padding:60px;">

</section>
<!--<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function()
{
  $("#submit_form").click(function(){ 
    $.ajax({
    type:"POST",
    url: "<?php echo site_url('user/add_userdata');?>",
    data:$("#addUserForm").serialize(),
    success: function (dataCheck) {
    alert(dataCheck);
$('#userdata').append(dataCheck);

//$("#addUserForm")[0].reset();

}
      });
  });
});

</script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script>
jQuery(document).ready(function(){
    
    
    
    $("#giftdetails").click(function(){
        
       // alert("you r click on giftdetails");
      //  $("#gifts").hide();
        
         $("#gifts").show();
        $("#giftr").hide();
        
       
        
        $("#giftsent").click(function(){
            
            
            $("#gifts").show();
            $("#giftr").hide(); 
            
        })
        
        
        $("#giftreceived").click(function(){
            
            $("#giftr").show(); 
            $("#gifts").hide();
            
        });
        
    });// message send close
    
     $("#messagemgt").click(function(){
        
        
      //  $("#gifts").hide();
        
         $("#messages").show();
        $("#messager").hide();
        
       
        
        $("#messagesent").click(function(){
            
            
            $("#messages").show();
            $("#messager").hide(); 
            
        })
        
        
        $("#messagereceived").click(function(){
            
            $("#messager").show(); 
            $("#messages").hide();
            
        });
        
    });
    
             

  // Basic Wizard
  jQuery('#basicWizard').bootstrapWizard();
  
  // Progress Wizard
  $('#progressWizard').bootstrapWizard({
    'nextSelector': '.next',
    'previousSelector': '.previous',
    onNext: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
    },
    onPrevious: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
    },
    onTabShow: function(tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index+1;
      var $percent = ($current/$total) * 100;
      jQuery('#progressWizard').find('.progress-bar').css('width', $percent+'%');
    }
  });
  
  // Disabled Tab Click Wizard
  jQuery('#disabledTabWizard').bootstrapWizard({
    tabClass: 'nav nav-pills nav-justified nav-disabled-click',
    onTabClick: function(tab, navigation, index) {
      return false;
    }
  });
  
  // With Form Validation Wizard
  var $validator = jQuery("#firstForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
  
  jQuery('#validationWizard').bootstrapWizard({
    tabClass: 'nav nav-pills nav-justified nav-disabled-click',
    onTabClick: function(tab, navigation, index) {
      return false;
    },
    onNext: function(tab, navigation, index) {
      var $valid = jQuery('#firstForm').valid();
      if(!$valid) {
        
        $validator.focusInvalid();
        return false;
      }
    }
  });
    
     jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
  
  
});
</script>

<script type="text/javascript">
// Delegate click event
$(document).on('click', 'a.ajax', function(){

    var el = $(this);
    var id ='<?php echo $this->uri->segment(3); ?>';
  $.ajax({
  url: '<?php echo site_url('wishlist/edit_user_form'); ?>',
  method: 'post',
  data : 'id='+id,
  success: function (response) {
      $('#myDiv').html(response);
  }
  // other ajax options here if you need them
});

});
</script>
    
