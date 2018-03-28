<?php echo $this->load->view('includes/frontend/header'); ?>
    <div class="container"  id="shared_container" >
        <div class="row" id="row">
            <div class="col-sm-12" > 
           		 <div class="row product-wishlist-heading text-center">
            		<h4 class= "lblproductwishlist">Product Wishlist </h4>	
            	</div>
				<div class="border_productwishlist">
				</div> 	  
				<div class=" row  product-wishlist-heading11" style="border-bottom:1px solid #424242 !important; padding:20px;">
					<div class="col-sm-8 col-xs-4  shared_content">
							<label class=" lblprname for-label"><?php echo $wishlist_info->name; ?></label>
					</div>
					<div class="col-sm-4 col-xs-8">
						<div class="col-sm-4 col-xs-5 text-right">
							<img src="<?php echo $wishlist_info->user->profile_picture; ?>" width="50" height="50" class="img-circle " style="border-radius:2px solid;"></img>
						</div>
						<div class="col-sm-8 col-xs-7 shared_content">
								<?php echo $wishlist_info->user->first_name; ?>&nbsp;<?php echo $wishlist_info->user->last_name; ?>
						</div>
					</div>
					
	  			</div>
				<!--<div id="border_bottom-productwishlsit">
					</div>-->
				
					<?php if(!empty($products)) {  ?>	
					<?php foreach($products as $key=>$value) { 
					if(!isset($value->product_id->message_code) || $value->product_id->message_code!=110)
					{	?>
				
				
					<div class="row product-wishlist-heading1" style="border-bottom:1px solid #424242 !important; padding:10px;">
						<div class=" col-sm-2 col-xs-5 text-center">
							<?php if($value->product_id->images->url!=""){ ?>
							<a href="<?php echo site_url('wishlist/product_details')?>/<?php echo $value->product_id->id . '?wid=' . $this->uri->segment(3); ?>">
                            <div class="img-outer-border">
                            <div class="prdImage" style="height:auto" id="img_<?php echo $value->product_id->id; ?>">
                            <img  class="img-rectangle"  style="border-radius:2px solid; " src="<?php echo $value->product_id->images->url; ?>" onload="loadImage(<?php echo $value->product_id->id?>)"></img>
                            </div>
                            </div>
                            </a>
							<?php }else{
							?>
							<a href="#">
                             <div class="img-outer-border">
                            <div class="prdImage" style="height:auto">
                            <img  class="img-rectangle " style="border-radius:2px solid; " src="#" width="80" height="80"></img>
                            </div>
                            </div>
                            </a>
							<?php } ?>
						</div>
						<div class="col-sm-5 col-xs-5 text-left">
							<div class="row">

							<h6  class="lblproductname"><?php echo $value->product_id->name; ?></h6>
							
							<h6  class="lblproductgranted">$<?php echo $value->product_id->price; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo ($value->grant_status == 13) ? 'Granted' : 'Not Granted'; ?></h6>
							</div>
						</div>
						<div class="col-sm-5 col-xs-2 text-right">
						<a  href="<?php echo site_url('wishlist/product_details')?>/<?php echo $value->product_id->id . '?wid=' . $this->uri->segment(3); ?>"><img  style="margin-top:25px;" src="<?php echo base_url()?>images/sprite_next.png"></img></a>	
	  					</div>

	  					<!--<div id="border_bottom-productwishlsit" style="height:1px;">&nbsp;
				</div>-->
					
					</div>
				
           		
				<?php }else{
				echo '<div class="alert alert-danger">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Oops!</strong> No product found.';
                echo '</div>';
				} ?>
				<?php } ?> 
				<?php } ?>

            </div>    

       </div><!-- row -->  
              <br/>       <br/>
    </div><!-- signin -->

	 <section  style="  background-color: rgb(22, 22, 22);
	width: 100%;
	padding: 1rem;
	bottom: 0;
	margin-bottom: 0px;
	position: fixed;">
	</section>

<?php echo $this->load->view('includes/frontend/footer'); ?>

<script>
function loadImage(id) {
   
     var img_height = $(".img-rectangle").height();
    //alert(img_height);
    /*if(img_height < 640)
       {
         $("#img_"+id).css('margin-top','15%');
        }*/
}
</script>
