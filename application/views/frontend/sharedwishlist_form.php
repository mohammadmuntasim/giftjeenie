<?php echo $this->load->view('includes/frontend/header'); ?>

    <div class="container"  id="shared_container" >
        
        <div class="row">
       <!--  <form name= "shared_wishlist" method="post" action="<?php echo site_url('wishlist/shared_wishlist');?>">
             -->
                    
            <div class="row">
            
	            <div class="row text-center" style="background-color: #ffffff; color: #000000; padding: 15px;">
					<span>
	            		<h4 class= "lblsharedwishlist">Shared Wishlists </h4>
					</span>
	            </div>

				<div class="border_sharedwishlsit">
				</div> 
				
				  
      					<?php 
                        if (!empty($shared_wishlist) && ( isset($shared_wishlist->message_code)  && ($shared_wishlist->message_code) ) != 115) { ?>
						<?php foreach($shared_wishlist as $key=>$value) { ?>
				<a  href="<?php echo site_url('wishlist/product_wishlist').'/'.$value->id;?>">
					<div class="row" style="background-color: #ffffff; color: #000000; border-bottom: 1px solid #614969; padding: 12px;">
						

							<div class="col-sm-3 col-xs-3  shared_content " style="word-wrap: break-word"; >
						
								<?php echo $value->name; ?>

							</div>
							
							<div class="col-sm-6 col-xs-5 text-right">
								
								<img  class="img-circle circle"  src="<?php if ( $value->user->profile_picture != "") { echo $value->user->profile_picture; } else { echo base_url() .  '/images/photo.jpg'; } ?>" width="50" height="50"></img>

							</div>

							<div class="col-sm-3 col-xs-4 text-left shared_content" >
								<p><?php echo $value->user->first_name; ?>&nbsp;<?php echo $value->user->last_name; ?></p>
							</div>
			  				
										
							
			
					</div>
				</a>
			<!--<div id="border_bottom-sharedwishlsit">
			</div>-->
		<?php } ?>	
			<?php }else{ ?>
			<div class="alert alert-danger">No wishlist is shared till now.</div>
	
			<?php } ?>
            </div>
			
	
			
            </div>

            <!-- </form> -->
        </div><!-- row --> 


    </div><!-- signin -->
    <section  style="  padding:10px; background-color:#161616; position: fixed; height:1px; bottom: 0; width: 100%;">

</section>
 
<?php echo $this->load->view('includes/frontend/footer'); ?>
