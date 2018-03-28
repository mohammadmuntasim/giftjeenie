<section>
<div class="container minus-margin">
  <div class="row">
    <div class="col-sm-12">
    <div class="col-sm-3">
 <?php $this->load->view('includes/left_menu'); ?>
        </div>
        
        <div class="col-sm-9">
          <div class="main-content">
            <div class="col-sm-12" id="myDiv">

            <span class="pull-right edit-button"><a href="#" class="ajax">Edit</a></span>
              <div class="top-form" >
                  <div class="col-sm-3  text-center mar-top-20">
                      <img src="<?php echo base_url(); ?>images/profile-image-border.png">
                       
                    </div>  

                    <div class="col-sm-9">
                      <div class="product-form">
                          <div class="col-sm-6">
                             <h4><strong><?php echo $userdata->first_name; ?>&nbsp;<?php echo $userdata->last_name; ?></strong></h4>
                               <p><?php echo $userdata->location; ?>, Ontario</p>
                               <p><?php  echo date('m-d-Y', strtotime($userdata->created_on));?></p>              
                            </div>
                        
                            <div class="col-sm-6 mar-top-10">
                                
                              <p>Status: <span style="color:#4b156d;"><?php if($userdata->status==0) { echo "Active";} 
?></span>
<span style="color:#FF0000;"><?php if($userdata->status==1) { echo "Inactive";}?></span></p>
                            </div>
            </div>
                    </div>
                   <div class="clearfix"></div>
                </div>

                 <div class="container-fluid" style="background-color:#f4f4f4; padding:10px;">
                  <div class="container">
                  <div class="col-sm-10 col-sm-offset-2 email-pass">
                              <ul>
                              <li>Email: <?php  echo $userdata->email; ?></li>
                              <li>Password: **********</li>
                              </ul>
                  </div>
                  </div>
                 </div>
            </div>
            


            </div>

            
<div class="clearfix"></div>


            <div class="bottom-main-content">
            <div class="col-sm-12">

                    <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
          <li><a href="#home3" data-toggle="tab"><strong>Product Wishlist</strong></a></li>
          <li class="active"><a href="#profile3" data-toggle="tab"><strong>Gift Details</strong></a></li>
          <li><a href="#about3" data-toggle="tab"><strong>Message Management</strong></a></li>
          
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane" id="home3">
           <?php 

if(@$wishlists->message_code!=115)
{

           foreach ($wishlists as $key => $value) { 
         ?>
            
          
                <button class="wishlist-detail-btn" data-toggle="collapse" data-target="#demo"><img src="<?php echo base_url(); ?>images/bullet.png"><?php if($value->name!='') { echo $value->name; } ?> </button>
                 <?php } ?>
                    <div id="demo" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                        <div class="clearfix"></div>
<?php }else{
    echo "<div class='alert alert-info'>";
  echo "user has not shared any wishlists yet";
  echo "</div>";
  } ?>

               
           
          </div>
          <div class="tab-pane active" id="profile3">

        <div class="gift-details">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#gift-sent" data-toggle="tab"><strong>Gift Sent</strong></a></li>
          <li><a href="#gift-recieved" data-toggle="tab"><strong>Gift Recieved</strong></a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="gift-sent">
            <?php if(!empty($giftsent_to_userid)) {  ?>
<?php foreach ($giftsent_to_userid as $key => $value) {
 ?>

            <button class="wishlist-detail-btn" data-toggle="collapse" data-target="#gift1"><img src="<?php echo base_url(); ?>images/bullet.png"> <img src="<?php echo base_url(); ?>images/image-small.png"> <?php echo ucfirst(@$value->user->first_name); ?>&nbsp;<?php echo ucfirst(@$value->user->last_name); ?></button>
            <?php 
            if(!empty($value->details)) {
                
 ?>

  <div id="gift1" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;"><?php //echo $arrr->product_id->name;
                            ?></td>
                            <td>Available</td>
                            </tr>
                         
                            </tbody>
                        </table>

                    </div>

                     <div class="clearfix"></div>



   <?php } //end if
?>                  
<?php }//end $giftsent_to_userid ?>
<?php } //end if
?>  


            </div>

            <div class="tab-pane" id="gift-recieved">


                <button class="wishlist-detail-btn" data-toggle="collapse" data-target="#gift4"><img src="<?php echo base_url(); ?>images/bullet.png"> <img src="<?php echo base_url(); ?>images/image-small.png"> John Dell </button>
                    <div id="gift4" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>

                    <button class="wishlist-detail-btn" data-toggle="collapse" data-target="#gift5"><img src="<?php echo base_url(); ?>images/bullet.png"> <img src="<?php echo base_url(); ?>images/image-small.png"> Samuel Garg</button>
                    <div id="gift5" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>

                    <button class="wishlist-detail-btn" data-toggle="collapse" data-target="#gift6"><img src="<?php echo base_url(); ?>images/bullet.png"> <img src="<?php echo base_url(); ?>images/image-small.png"> Mark Woods </button>
                    <div id="gift6" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            <tr>
                            <td><img src="<?php echo base_url(); ?>images/placeholder.png"></td>
                            <td style="color:#4b156d !important;">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td>Available</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>



            </div>

            </div>
        </div>

            
          </div>
          <div class="tab-pane" id="about3">
           
             <div class="gift-details">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#msg-sent" data-toggle="tab"><strong>Message Sent</strong></a></li>
          <li><a href="#msg-recieved" data-toggle="tab"><strong>Message Recieved</strong></a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="msg-sent">

            <div class=" table-responsive message-details">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="35%" style="text-align:left !important;">Product Name</th>
                                    <th width="35%" >Message Details</th>
                                    <th width="20%">Delivery Details</th>
                                    <th width="10%" >Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sent_messages as $key => $value) {  ?>
                            <tr>
                            <td style="color:#4b156d !important;" width="35%"><?php echo $value->product->name; ?></td>
                            <td width="35%" style="border:solid 1px #494949; padding:5px 10px;"> </td>
                            <td align="center" width="20%"><!--02-09-2016 <br> 03:22 pm--><?php echo $value->delivery_details; ?></td>
                            <td align="center" width="10%"><a href="#"><img src="<?php echo base_url(); ?>images/delete-icon.png"></a></td>
                            </tr>
                              <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                   

            </div>

            <div class="tab-pane" id="msg-recieved">


               <div class=" table-responsive message-details">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="35%" style="text-align:left !important;">Product Name</th>
                                    <th width="35%" >Message Details</th>
                                    <th width="20%">Delivery Details</th>
                                    <th width="10%" >Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            
                            <td style="color:#4b156d !important;" width="35%">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td width="35%" style="border:solid 1px #494949; padding:5px 10px;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do.</td>
                            <td align="center" width="20%">02-09-2016 <br> 03:22 pm</td>
                            <td align="center" width="10%"><a href="#"><img src="<?php echo base_url(); ?>images/delete-icon.png"></a></td>
                            </tr>

                            <tr>
                            
                            <td style="color:#4b156d !important;" width="35%">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td width="35%" style="border:solid 1px #494949; padding:5px 10px;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do.</td>
                            <td align="center" width="20%">02-09-2016 <br> 03:22 pm</td>
                            <td align="center" width="10%"><a href="#"><img src="<?php echo base_url(); ?>images/delete-icon.png"></a></td>
                            </tr>

                            <tr>
                            
                            <td style="color:#4b156d !important;" width="35%">Mr. B’s Aldo tan suede leather sole Wingtips 
                                9.5 D EUC</td>
                            <td width="35%" style="border:solid 1px #494949; padding:5px 10px;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do.</td>
                            <td align="center" width="20%">02-09-2016 <br> 03:22 pm</td>
                            <td align="center" width="10%"><a href="#"><img src="<?php echo base_url(); ?>images/delete-icon.png"></a></td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
            

            </div>

            </div>
        </div>

          </div>
         
        </div>
        
      </div><!-- col-md-6 -->

            </div>
        </div>
        
        
        
    </div>
    </div>
</div>
</section>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
// Delegate click event
$(document).on('click', 'a.ajax', function(){ 

    var el = $(this);
    var id ='<?php echo $this->uri->segment(3); ?>';
  $.ajax({
  url: '<?php echo site_url('wishlist/edit_user_form'); ?>',
  method: 'post',
  data : 'id='+id,
  async:true,
  success: function (response) {
      $('#myDiv').html(response);
  }
  // other ajax options here if you need them
});

});
</script>
    
