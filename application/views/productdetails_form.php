

<?php echo $this->load->view('includes/frontend/header'); ?>
    <div class="container" id="shared_container">
        
        <div class="row">
              
            <div class="col-sm-10 col-sm-offset-1" >
            
            <div class="product-details-heading text-center">
            	<h4 class="lblproductheading">Product Details </h4>
				
            </div>
				<div class="border_productdetails">
				</div>
				  
            <div class="product-details-heading1">
        
				<div class="form-group">
					<div class="col-sm-12 text-center btn-heading">
				<div class="col-sm-4" id="replaceDiv">
					<?php 

					parse_str($_SERVER['QUERY_STRING'], $_GET); 
					
		
					$product_id = $this->uri->segment(3);

					foreach( $wishlist_info->details as $product )
					{
						if( $product->product_id->id == $product_id )
						{
							$grant_status = $product->grant_status;
							$claim_status = $product->claim_status;
						}
					}


 					if($claim_status=='18')		
 					{
 						?>

 						<button type="button" id="claim" onclick="claim_product(this.id,'<?php echo $this->uri->segment(3);?>','<?php echo $_GET['wid']; ?>');"  class="btn btn-claim" >Claim</button>

 						<?php
 					}
 					else
 					{
 						?>

 						<button type="button" id="claim" onclick="unclaim_product(this.id,'<?php echo $this->uri->segment(3);?>','<?php echo $_GET['wid']; ?>');"  class="btn btn-claim" >UnClaim</button>

 						<?php
 					}

					?>
					

					<br>
						</div>
						<div class="col-sm-4">
						<a href="<?php echo $product_details->url; ?>" target="_blank"><button type="button"  class="btn btn-buy">Buy</button></a><br>
						</div>
						<div class="col-sm-4">

						<?php  if($grant_status=='18'){ ?>
						<button type="button" id="grant" onclick="mark_as_granted(this.id,'<?php echo $this->uri->segment(3);?>','<?php echo $_GET['wid']; ?>');" class="btn btn-info btn-lg btn-mark"  data-toggle="modal" data-target="#myModal">Mark as Granted</button><br>
							</div>

							<?php }

							else{

								?>

								<button type="button" id="one" onclick="" class="btn btn-info btn-lg btn-mark"  data-toggle="modal" data-target="">Granted</button><br>
							</div>

								<?php
								} ?>
					</div>
						
						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Gift Message</h4>
						      </div>
						      <div class="modal-body">
														<!-- FORM -->
						      <form class="form-horizontal" role="form"  method="post" name="form" id="form" enctype="multipart/form-data">    								
						        <div class="form-group">
								  <label for="comment">Message:</label>
								  <textarea class="form-control phone-group" rows="5" id="comment" name="comment"></textarea>
								</div>
								
								<div class="hero-unit" style="margin-left: -15px; */
    margin-right: -15px; ">
									<label for="delivery_date">Delivery Date:</label>
					                <input  type="date" placeholder=""  id="delivery_date" name="delivery_date">
					            </div>
								<div class="form-group">
								  <label for="order_id">Order Id:</label>
								  <input class="form-control" type="text" id="order_id" name="order_id">
								</div>
								
								<label for="comment">Upload Video Comment:</label>
								<label class="btn btn-default btn-file">
								    Browse <input class=" phone-group" type="file" accept="video/*" name="videofile" id="videofile" >

								    <input class=" phone-group" type="text" name="giftno" id="giftno" style="display: none;">
								</label>
						      </div>
						      <div class="modal-footer">
						        <button type="submit" onsubmit="validateForm()" class="btn btn-default">Submit</button>
						      </div>

								</form>
						    </div>

						  </div>
						</div>

					<div class="product-details-heading11">
					<div class="form-group">
						
					<div class="col-sm-12 text-center " >
						<!--<img src="<?php echo base_url()?>images/applewatch.jpg" class="watch_image"></img>-->
						<img src="<?php echo $product_details->images->url; ?>" class="watch_image img-responsive" style="margin:auto;">
						
					</div>
					</div>
						
				</div>
				<div class="border_bottom-productdetails ">
			</div>
					
					
				
				<div class=" col-sm-12 col-xs-12 product-description"
				<p><h6 class="lblproductdescription"><?php echo $product_details->name; ?></h6> </p>
				<p class="lblproductdescription1" >$<?php echo $product_details->price; ?></p>
				<p><h6 class="lblproductdescription">Product link</h6></p>
				<p  class="lblproductdescription2" ><a href="<?php echo $product_details->url; ?>" style="word-wrap: break-word"><?php echo $product_details->url; ?></a></p>
			<p><h6 class="lblproductdescription">Description</h6></p>
					<!--<p align="left">Apple Watch Sport</p>
					<p align="left">42mm Space Grey Aluminium Case with Black Sport Band</p>-->

			<p  class="lblproductdescription2"><?php echo $product_details->description; ?></p>
				</div>
				
								
						</div>
            </div>

				
				

            
            </div>
            
        </div><!-- row -->
        
        
        
    </div><!-- signin -->

    <section  style="  padding:10px; background-color:#161616; position: overflow; height:1px; bottom: 0; width: 100%;">

</section>
  
<?php echo $this->load->view('includes/frontend/footer'); ?>

<script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
	    $('.modal form').on('submit', function(event) {
	    	event.preventDefault();
	    	var giftId=document.getElementById('giftno').value;
	    	var messagees=document.getElementById('comment').value;
	    	$.ajax({

	 	 		type: 'POST',
			    url: '<?php echo API_BASE; ?>' + '/message',
			    data: {'gift_id': giftId,
			           'message_content': messagees,
			           'message_description': '16'},
			   	headers: {
			   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
			   	},
			   	success: function(data) {
			   		console.log(data);
			   		alert("Message sent successfully");
			   		location.reload();
			   	}
		   	});
	    });
    });
</script>

<script type="text/javascript">
	$('#one').prop('disabled', true);
</script>

<script type="text/javascript">
	/*function validateForm() {
    var x = document.forms["myForm"]["comment"].value;
    var y = document.forms["myForm"]["videofile"].value;

    if (x !== "" && y !== "") {
        alert("Fill either Message or Video file.");
        return false;
    }

}*/

/*
if($('input[text]').length > 1) {
                alert('Fill either Message or Video file.');
               return false;
            }
*/

/*
function validateForm() {
	 var a = $('#comment');
	 var b = $('#videofile');
	    // Check if there is an entered value
	    if(a.val() !== "" && b.val() !== "") {
	    	 alert("Fill either Message or Video file.");
        	return false;
	    }
	}*/
	function validateForm() {
		$( "#form" ).validate({
		  rules: {
		    comment: {
		      require_from_group: [1, ".phone-group"]
		    },
		    videofile: {
		      require_from_group: [1, ".phone-group"]
		    }
		  }
		});



	}	
</script>

<script type="text/javascript">
  function claim_product(id,product_id,wishlist_id) {       		
	$.ajax({
	    type: 'PUT',
	    url: '<?php echo API_BASE; ?>' + '/wishlist/' + wishlist_id + '/product/' + product_id + '/claim',
	   	headers: {
	   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
	   	},
	    success: function(data) {
	         if(id=='unclaim')
	         {
	         		alert('Product unclaimed successfully.');
	         }
	         else
	         {
	     	 		alert('Product claimed successfully.');
	     	 }
	     	 location.reload();
	    }
	});
}

function unclaim_product(id,product_id,wishlist_id) {       		
	$.ajax({
	    type: 'DELETE',
	    url: '<?php echo API_BASE; ?>' + '/wishlist/' + wishlist_id + '/product/' + product_id + '/claim',
	   	headers: {
	   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
	   	},
	    success: function(data) {
	         if(id=='unclaim')
	         {
	         		alert('Product claimed successfully.');
	         }
	         else
	         {
	     	 		alert('Product unclaimed successfully.');
	     	 }
	     	 location.reload();
	    }
	});
}

  function mark_as_granted(id,product_id,wishlist_id) {
	$.ajax({
	    type: 'PUT',
	    url: '<?php echo API_BASE; ?>' + '/wishlist/' + wishlist_id + '/product/' + product_id + '/grant',
	   	headers: {
	   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
	   	},
	    success: function(data) {
	         if(id=='ungrant')
	         {
	         		alert('Product Ungranted successfully.');
	         		
				    console.log(data);
	         }
	         else
	         {
	     	 		alert('Product Granted successfully.');
	     	 		console.log(data);
	     	 		
	     	 		var giftId=data["gift_id"];

	     	 		document.getElementById("giftno").value = giftId;

	     	 }
	    }
	});

 
}
</script>

 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#delivery_date').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>