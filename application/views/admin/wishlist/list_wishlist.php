<section>
<div class="container minus-margin">
  <div class="row">
    <div class="col-sm-12">
    <div class="col-sm-3 ">
 <?php $this->load->view('includes/left_menu'); 

 ?>
        </div>
        
        <div class="col-sm-9 ">
          <div class="main-content">
            <div class="col-sm-12" id="myDiv">

            
              <div class="top-form" >
                  <div class="col-sm-3  text-center mar-top-20">
                       <?php if($userdata->profile_picture=='')
                            {
                                ?>
                        <img class="img-responsive" style="margin:auto;" src="<?php echo base_url()?>images/profile-image-border.png" id="imageID"><p>
                        Add Profile Image
                            <?php }else{ ?>
                        <img src="<?php echo $userdata->profile_picture;?>" height="100" width="100" id="imageID" class="img-circle">
                            <?php } ?>
                       
                    </div>  

                    <div class="col-sm-9" style="background-color: rgb(255, 255, 255);">
                      <?php
                      //  var_dump($userdata->first_name);
                      // var_dump($userdata->address->state);
                      ?>
                        <div class="row">
                            <div class="col-sm-5">
                              <h4><strong><?php echo $userdata->first_name; ?>&nbsp;<?php echo $userdata->last_name; ?></strong></h4>
                               <p><?php if(!empty($userdata->address->state)){ echo $userdata->address->state; ?>, Ontario <?php } ?></p>
                               <p><?php  echo date('m-d-Y', strtotime($userdata->created_on));?></p>              
                            </div>
                        
                            <div class="col-sm-5 mar-top-10">
                                
                              <p>Status: 
                                
                                <span style="color:#4b156d;"><?php if($userdata->status==2) { echo "Active";} 
?></span>
                                <span style="color:#FF0000;"><?php if($userdata->status==1) { echo "Inactive";}?></span>

                              </p>
                            
                            </div>

                            <div class="col-sm-2 mar-top-10">
                              
                                <span class="pull-right"><a onclick="useredit()" href="#" class="ajax">Edit</a></span>

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
        <ul class="art nav nav-tabs nav-justified">
          <li class="active"><a href="#home3" data-toggle="tab"><strong>Product Wishlist</strong></a><span class="t" style="display:none">Product Wishlist</span></li>
          <li style="border-left: 2px solid #fff;border-right: 2px solid #fff;"><a href="#profile3" data-toggle="tab"><strong>Gift Details</strong></a><span class="t" style="display:none">Gift Sent</span></li>
          <li><a href="#about3" data-toggle="tab"><strong>Message Management</strong></a><span class="t" style="display:none">Message Sent</span></li>
          
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content" style="padding: 0px; padding-top:15px;">
          <div class="tab-pane active" id="home3">
           <?php 

if( !isset($wishlists->message_code) || $wishlists->message_code!=117)
{

           foreach ($wishlists as $key => $value) { 
         ?>
            
          
                <button class="wishlist-detail-btn menu-toggle123" data-toggle="collapse" data-target="#demo<?php echo $value->id; ?>">
                 <i class="glyphicon glyphicon-large glyphicon-plus-sign" style="padding-right: 15px;"></i>
                <?php if($value->name!='') { echo $value->name; } ?> </button><div class="clearfix"></div>
                 
                    <div id="demo<?php echo $value->id; ?>" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                    <th>Product Price</th>
                                </tr>
                            </thead>

                            <tbody>
							             <?php 
                              
                              if(!empty($value->details)) 
                              { 
                                foreach($value->details as $key=>$value) 
                                { 
                                  if(isset($value->product_id->id)) 
                                  { 
                                      ?>
                                    <tr>
                                      <td>
                                        <?php if($value->product_id->name!="")
                                        { ?>
                                            <img src="<?php echo $value->product_id->images->url; ?>" width="80" height="80" class="img-circle">
                                        <?php 
                                        }
                                        else
                                        {?>
                                              <img src="<?php echo base_url(); ?>images/placeholder.png">
                                              <?php 
                                        } ?>
                                      </td>
                                      <td style="color:#4b156d !important;"><?php echo $value->product_id->name;?></td>
                                      <td><?php echo ($value->grant_status == 12 ) ?  'Available' : 'Granted'; ?></td>
                                        <td><?php echo $value->product_id->currency; ?>  <?php echo $value->product_id->price; ?> </td>
                                    </tr>               
                                    <?php
                                  }
                                } ?>
                                  <?php 
                              }
                               else{ 
                                    ?>
                                      <tr>
                                      <td colspan="3">
                                      <?php 
                                          echo "<div class='alert alert-info'>";
                                        echo "No products found";
                                       echo "</div>";
                                      ?>
                                      </td>
                                      
                                    </tr>          
                                  <?php 
                                 
                                }
                               ?>
                
                            
                            </tbody>
                        </table>
                    </div>
                        <div class="clearfix"></div>
			  <?php } ?>
<?php }else{
    echo "<div class='alert alert-info'>";
  echo "User has not shared any wishlists yet";
  echo "</div>";
  } ?>

               
           
          </div>
          <div class="tab-pane " id="profile3">

        <div class="gift-details">
        <ul class="art2 nav nav-tabs nav-justified">
          <li class="active"><a href="#gift-sent" data-toggle="tab"><strong>Gift Sent</strong></a><span class="t" style="display:none">Gift Sent</span></li>
          <li><a href="#gift-recieved" data-toggle="tab"><strong>Gift Received</strong></a><span class="t" style="display:none">Gift Received</span></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="gift-sent">
            <?php if(!isset($user_info_giftsent->message_code) || $user_info_giftsent->message_code!=121) {   ?>
<?php foreach ($user_info_giftsent as $key => $value) {
 ?>
<?php $gid = $value->gift_id; ?>
            <button class="wishlist-detail-btn menu-toggle123" data-toggle="collapse" data-target="#gift<?php echo $gid; ?>">
            <i class="glyphicon glyphicon-large glyphicon-plus-sign" style="padding-right: 15px;"></i>
<?php if($value->meta->created_by->profile_picture==""){ ?>
            <img src="<?php echo base_url(); ?>images/image-small.png"> 
            <?php }else{ ?>
                <img src="<?php echo $value->meta->created_by->profile_picture ; ?>" class="img-circle" width="80" height="80" > 
                <?php } ?>

            <?php echo ucfirst($value->meta->created_by->first_name); ?>&nbsp;<?php echo ucfirst($value->meta->created_by->last_name); ?></button>
            <?php 
	
            if(!empty($value->product)) { 
               /* foreach ($value->product as $val) {
                    # code...
                    $arr[] = ($val);
        }*/

        //$arr[] =  ($arr);  
    //print_r($arr);die;         
 ?>
<?php //foreach ($arr as   $value) {
    # code...
 ?>
  <div id="gift<?php echo $gid; ?>" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Granted On</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tr>
                            <td>
                            <?php if($value->product->images=="") { ?>
                            <img src="<?php echo base_url(); ?>images/placeholder.png">
<?php } else { ?>
     <img src="<?php echo $value->product->images->url; ?>" class="img-circle" width="80" height="80" >
     <?php } ?>
                            </td>
                            <td style="color:#4b156d !important;"><a href="<?php echo site_url('admin/product/update')."/".$value->product->id; ?>"><?php echo $value->product->name;
                            ?></a></td>
                            <td><?php echo ($value->product->currency == 'USD') ? '$' : 'C$'; echo $value->product->price; ?></td>
                            <td><?php 
                                      $newDate = date("d-m-Y h:i a", strtotime($value->meta->created_on));
                                       echo $newDate; ?></td>
                           
                            </tr>
                         
                            </tbody>
                        </table>

                    </div>

                     <div class="clearfix"></div>
                     <?php //} ?>



   <?php } //end if
?>                  
<?php }//end ?>
<?php } //end if
else
{
     echo "<div class='alert alert-info'>";
  echo " User has not sent any gifts yet";
  echo "</div>";
}
?>  


            </div>
			
			
			<div class="tab-pane" id="gift-recieved">
            <?php if(!isset($user_info_giftreceived->message_code) || $user_info_giftreceived->message_code!=122) {   ?>

<?php foreach ($user_info_giftreceived as $key => $value) {
 ?>
<?php $gid = $value->gift_id; ?>  
            <button class="wishlist-detail-btn  menu-toggle123" data-toggle="collapse" data-target="#gift<?php echo $gid; ?>">
             <i class="glyphicon glyphicon-large glyphicon-plus-sign" style="padding-right: 15px;"></i>
            
<?php if($value->meta->created_by->profile_picture==""){ ?>
            <img src="<?php echo base_url(); ?>images/image-small.png"> 
            <?php }else{ ?>
                <img src="<?php echo $value->meta->created_by->profile_picture ; ?>" class="img-circle" width="80" height="80" > 
                <?php } ?>

            <?php echo ucfirst($value->meta->created_by->first_name); ?>&nbsp;<?php echo ucfirst($value->meta->created_by->last_name); ?></button>
            <?php 
	
            if(!empty($value->product)) { 
                //foreach ($value->product as $val) {
                    # code...
                    //$arr[] = ($val);
      //  }

        //$arr[] =  ($arr);  
             
 ?>
<?php //foreach ($arr as   $value) {
    # code...
 ?>
  <div id="gift<?php echo $gid; ?>" class="collapse table-responsive wishlist-detail-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Granted On</th>
                                </tr>
                            </thead>
                            <tbody>

                            <tr>
                            <td>
                            <?php if($value->product->images=="") 
                            { ?>
                            <img src="<?php echo base_url(); ?>images/placeholder.png">
                            <?php } else { ?>
                                 <img src="<?php echo $value->product->images->url; ?>" class="img-circle" width="80" height="80" >
                                 <?php } ?>
                            </td>
                            <td style="color:#4b156d !important;">
                            <?php if($value->product->id!="") 
                            { ?><a href="<?php echo site_url('admin/product/update')."/".$value->product->id; ?>">
                            <?php } if($value->product->name!="") 
                            { echo $value->product->name;
                            } ?>
                            </a></td>
                            <td><?php if($value->product->price!="") 
                            { echo ($value->product->currency == 'USD') ? '$' : 'C$'; echo $value->product->price; 
                            }?></td>
                            <td><?php 
                                      $newDate = date("d-m-Y h:i a", strtotime($value->meta->created_on));
                                       echo $newDate; ?></td>
                            
                            </tr>
                         
                            </tbody>
                        </table>

                    </div>

                    
                     <?php //} ?>



   <?php } //end if
?>    <div class="clearfix"></div>               
<?php }//end ?>
				
<?php } //end if
else
{
     echo "<div class='alert alert-info'>";
  echo "User has not recieved any gifts yet";
  echo "</div>";
}
?>  


            </div>

			
			
			
			

            </div>
        </div>

            
          </div>
          <div class="tab-pane" id="about3">
           
             <div class="gift-details">
        <ul class="art3 nav nav-tabs nav-justified">
          <li class="active"><a href="#msg-sent" data-toggle="tab"><strong>Message Sent</strong></a><span class="t" style="display:none">Message Sent</span></li>
          <li><a href="#msg-recieved" data-toggle="tab"><strong>Message Received</strong></a><span class="t" style="display:none">Message Received</span></li>
        </ul>

								<!-- Messages -->
								<div class="tab-content">
                                <div id="success_message">
                                 </div>
         						<div class="tab-pane active" id="msg-sent">
         							<div class=" table-responsive message-details">
         								<?php if( isset( $sent_messages ) && (count( $sent_messages )>0)) { ?>
                          
         									<table class="table" id="tblTableList">
                         					<thead>
                         						<tr>
                                    			<th width="35%" style="text-align:left !important;">Product Name</th>
                                    			<th width="35%">Message Details</th>
                                    			<th width="20%">Delivery Date </th>
                                    			<th width="10%">Delete</th>
                                				</tr>
                            				</thead>
                            				<tbody>
                            					<?php  
                                            
                                          foreach( $sent_messages as $index => $sent_message ) { ?>
                            					<?php if( isset( $sent_message->gift_info->gift_message_id ) ) { ?>
                            						<tr id="msg_<?php echo $sent_message->gift_info->gift_message_id[0]->message_id; ?>">
                            							<td style="color:#4b156d !important;" width="35%"><?php if(isset($sent_message->product->name)) echo $sent_message->product->name; ?></td>
                            							<td width="35%" style="border:solid 1px #494949; padding:5px 10px;">
                            							<?php if( $sent_message->gift_info->gift_message_id[0]->message_type == 15 )	{ ?>
                            								<video width="250" height="180" controls>
                            									<source src="<?php echo $sent_message->gift_info->gift_message_id[0]->message_content; ?>" type="video/mp4" controls>
                            								</video> 
																<?php	} else {
																	echo $sent_message->gift_info->gift_message_id[0]->message_content;
																} ?></td>
																<td align="center" width="20%"><!--02-09-2016 <br> 03:22 pm--><?php echo  date('m-d-Y H:i a', strtotime($sent_message->meta->created_on)); ?></td>
																<td align="center" width="10%">

                                    <a href="#" data-toggle="modal" class="open-active2" data-id="<?php echo site_url('admin_wishlist/delete_message'); ?>/<?php echo $sent_message->gift_info->gift_message_id[0]->message_id; ?>/<?php echo $userdata->id; ?>" data-target="#myModal"> <img src="<?php echo base_url(); ?>images/delete-icon.png"></a>

                                </td>
															</tr>
															<?php
                                    						} 
                                    						?>
                              					<?php } ?>
                            					</tbody>
                        					</table>
				 								<?php } else {
				 									echo "<div class='alert alert-info'>";
				 									echo "User has not sent any gifts yet.";
				 									echo "</div>";
				 								} ?>

				 						</div>
				 					</div>
				 					<div class="tab-pane" id="msg-recieved">
				 						<div class=" table-responsive message-details">
         								<?php if( isset( $received_messages )   && (count( $received_messages )>0)) { ?>
         									<table class="table" id="myTable">
                         					<thead>
                         						<tr>
                                    			<th width="35%" style="text-align:left !important;">Product Name</th>
                                    			<th width="35%">Message Details</th>
                                    			<th width="20%">Delivery Date</th>
                                    			<th width="10%">Delete 
                  
                                               </th>
                                				</tr>
                            				</thead>
                            				<tbody>
                            					<?php  
                                           

                                            foreach( $received_messages as $index => $received_message ) { ?>
                            					<?php if( isset( $received_message->gift_info->gift_thankyou_id ) ) { 
                                        ?>
                            						<tr id="msg_<?php echo $received_message->gift_info->gift_thankyou_id[0]->message_id; ?>">
                            							<td style="color:#4b156d !important;" width="35%"><?php if(isset($received_message->product->name)) echo $received_message->product->name; ?></td>
                            							<td width="35%" style="border:solid 1px #494949; padding:5px 10px;">
                            							<?php if( $received_message->gift_info->gift_thankyou_id[0]->message_type == 15 )	{ ?>
                            								<video width="250" height="180" controls>
                            									<source src="<?php echo $received_message->gift_info->gift_thankyou_id[0]->message_content; ?>" type="video/mp4" controls>
                            								</video> 
																<?php	} else {
																	echo $received_message->gift_info->gift_thankyou_id[0]->message_content;
																} ?></td>
																<td align="center" width="20%"><!--02-09-2016 <br> 03:22 pm--><?php echo date('m-d-Y H:i a', strtotime($received_message->meta->created_on)); ?>
                                </td>

																
                                <td align="center" width="10%">

                                     <a href="<?php echo site_url('admin_wishlist/delete_message'); ?>/<?php echo $received_message->gift_info->gift_thankyou_id[0]->message_id;?>/<?php echo $userdata->id; ?>" data-toggle="modal" class="open-active2" data-id="<?php echo site_url('admin_wishlist/delete_message'); ?>/<?php echo $received_message->gift_info->gift_thankyou_id[0]->message_id;?>/<?php echo $userdata->id; ?>" data-target="#myModal"> <img src="<?php echo base_url(); ?>images/delete-icon.png"></a>

                                </td>
															</tr>
															<?php 
                                        
                                  } ?>
                              					<?php } ?>
                            					</tbody>
                        					</table>
				 								<?php } else {
				 									echo "<div class='alert alert-info'>";
				 									echo "User has not received any messages yet";
				 									echo "</div>";
				 								} ?>

				 						</div>
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

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-body">
        <input type="hidden" name="bookId" id="bookId" value=""/>
                <p>Are you sure you wish to delete the message?</p>
         
        </div>
        <div class="modal-footer">
          <div class="col-sm-6 col-xs-6">
         
                         <!--<a href="" id="button123" class="btn btn-info" role="button" style="width: 100%;
background-color: transparent; border: medium; color:#333;" data-id="" onclick="Fun_1(this);" >Yes</a>-->
<a href="#" id="button123" class="btn btn-info" role="button" style="width: 100%;
background-color: transparent; border: medium; color:#333;" data-id=""  >Yes</a>

             </div>
             <div class="col-sm-6 col-xs-6">
              <button type="button" class="btn btn-default btn-block" data-dismiss="modal" style="width: 100%;
background-color: transparent; border: medium; border-width: 0px 0px 0px 1px;">Cancel</button>
             </div>

        </div>
      </div>
    </div>
  </div>


<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">


$(document).ready(function() 
 {
   
    $(".open-active2").click(function () {
      // $('#button123').attr("href", $(this).data('id') );
        $('#bookId').val($(this).data('id'));
        $('#myModal').modal('show');
    });



    $('ul.art li').click(function(e) 
    { 
     
     $("#bigheader").text($(this).find("span.t").text());

    });

    $('ul.art2 li').click(function(e) 
    { 
     
     $("#bigheader").text($(this).find("span.t").text());

    });

    $('ul.art3 li').click(function(e) 
    { 
     
     $("#bigheader").text($(this).find("span.t").text());

    });

 });

//delete message ajax
//$('.open-active2').click(function(e){
   
$('#button123').click(function(e) {
     //var anchor = this;

   var href =  $('#bookId').val();
   
var res = href.split("/"); //alert(res[6]);return false;
    $.ajax({
      type: "POST",
        //url: $(anchor).attr('href'),
        url: href,
        //data: "id="+$(anchor).attr('href'),
        success: function(response){  
$('#success_message').html("<div class='alert alert-success'>message deleted successfully.</div>");
$('#myModal').modal('hide');
 $( "#success_message" ).fadeOut( 7000);
 $('#msg_'+res[5]).hide(); //6
        }
    });
     
           // log('delete: ' + $(anchor).attr('href'));
});

// Delegate click event
$(document).on('click', 'a.ajax', function(){ 
// alert Hie;
		var el = $(this);
		var id ='<?php echo $this->uri->segment(3); ?>';
	$.ajax({
	url: '<?php echo site_url('admin_wishlist/edit_user_form'); ?>',
	method: 'post',
	data : 'id='+id,
	async:true,
	success: function (response) {
			$('#myDiv').html(response);
	}
	// other ajax options here if you need them
});

});

function delete_message(message_id) {           
  $.ajax({
      type: 'DELETE',
      url: '<?php echo API_BASE; ?>' + '/message/' + message_id,
      headers: {
        'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
      },
      success: function(data) {
           
              alert('Message deleted successfully');
             //location.reload();
           
      }
  });

  $('#'.message_id).remove();
  //document.getElementById("myTable").deleteRow(del);
}
</script>

<script type="text/javascript">
     
$(window).load(function(){

    $('.menu-toggle123').click( function(){
        $(this).find('i').toggleClass('glyphicon-plus-sign').toggleClass('glyphicon-minus-sign');
    });
});

</script>

<script type="text/javascript">

function useredit()
{
  // alert Hie;
  $('#bigheader').text("User List / Edit User");
}

</script>

		
