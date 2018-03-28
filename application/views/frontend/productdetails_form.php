

<?php echo $this->load->view('includes/frontend/header'); ?>
    <div class="container" id="shared_container">
        
        <div class="row" style="background-color: rgb(243, 243, 243);">
              
            <div class="col-sm-12" >
            
	            <div class="product-details-heading text-center">
	            	<h4 class="lblproductheading">Product Details </h4>
					
	            </div>
					
				<div class="col-sm-12" style="left: 0px; right: 0px; border-bottom: 1px solid rgb(7, 20, 122); position: absolute; margin-bottom: 10px;"></div>
					  
	            <div class="row" style="margin-bottom: 10px;">
	        
					<div class="col-sm-12">
						<div class="col-sm-4 col-xs-6" id="replaceDiv">
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

						<div class="col-sm-4 col-xs-6">
							<a href="<?php echo $product_details->url; ?>" target="_blank"><button type="button"  class="btn btn-buy">Buy</button></a><br>
						</div>
						
						<div class="col-sm-4 col-xs-6">

							<?php  if($grant_status=='12'){ ?>
							<button type="button" id="grant" onclick="mark_as_granted(this.id,'<?php echo $this->uri->segment(3);?>','<?php echo $_GET['wid']; ?>');" class="btn btn-info btn-lg btn-mark" style="white-space: normal;"  data-toggle="modal" data-target="#myModal">Mark as Granted</button><br>
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
								
								<div class="hero-unit" style="margin-left: -15px; margin-right: -15px; ">
									<label for="delivery_date">Delivery Date:</label>
					                <input type="text"  id="delivery_date" name="delivery_date">
					            </div>
								<div class="form-group">
								  <label for="order_id">Order Id:</label>
								  <input class="form-control" type="text" id="order_id" name="order_id">
								</div>
								<div class="form-group">
								<label for="comment">Upload Video Comment:</label>
								
								    <input class="phone-group" type="file" accept="video/mp4,video/x-m4v,video/*" name="videofile" id="videofile" style="">

								    <input class="phone-group" type="text" name="giftno" id="giftno" style=" ; display: none;">
								</div>
						      </div>
						      <div class="modal-footer">
						        <button type="submit" onsubmit="validateForm()" class="btn btn-default">Submit</button>
						      </div>

								</form>
						    </div>

						  </div>
						</div>
					</div>
					<div class="col-sm-12">
						
							
						<div class="col-sm-12 text-center " style="background-color: rgb(255, 255, 255);">
							<!--<img src="<?php echo base_url()?>images/applewatch.jpg" class="watch_image"></img>-->
							<img src="<?php echo $product_details->images->url; ?>" class="watch_image img-responsive" style="margin:auto;">
							
						</div>
						
					</div>
						
				</div>
			
				<div class="col-sm-12" style="left: 0px; right: 0px; border-bottom: 1px solid rgb(7, 20, 122); margin-top: 20px; margin-bottom: 10px;"></div>
				
				
				<div class=" col-sm-12 col-xs-12">
					<div class="col-sm-12">
						<div class="col-sm-12" style="background-color: #ffffff; margin-top: 20px; padding-top: 10px;">
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
            </div>

            </div>
            
        </div><!-- row -->
        
        
        
    </div><!-- signin -->

    <section  style=" background-color: rgb(22, 22, 22);
		width: 100%;
		padding: 20px;
		bottom: 0px;
		margin-bottom: 0px;
		position: fixed;">

	</section>
  
<?php echo $this->load->view('includes/frontend/footer'); ?>

  <script>
  $( function() {
    $( "#delivery_date" ).datepicker();
  } );
  </script>

<script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>

<link href="<?php echo base_url()?>assets/css/datestyle.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	$(document).ready( function() {

		$('#comment').keyup(function()								//Only accept one of fields. either message or video.
		{
			if(document.getElementById('comment').value!="")
			{
				document.getElementById("videofile").disabled = true;
			}
			else
			{
				document.getElementById("videofile").disabled = false;
			}
		}
		);
		
		if(document.getElementById('videofile').value!="")
		{
			document.getElementById("comment").value = "";
		}

		

		var ua = navigator.userAgent.toLowerCase(); 					//Detecting browser for accepting video format. 
		if (ua.indexOf('safari') != -1) 
		{
			document.getElementById('videofile').accept="video/mp4,video/x-m4v,video/*";
		}
		else
			document.getElementById('videofile').accept="video/*";


	    $('.modal form').on('submit', function(event) {					//send data to API

	    	event.preventDefault();

	    	var giftId = document.getElementById('giftno').value;
	    	var messagees = document.getElementById('comment').value;
	    	var videofile = document.getElementById('videofile').value;
	    	var dateorder = document.getElementById('delivery_date').value;
	    	var orderid = document.getElementById('order_id').value;
	    	var code = 14;

	    	if((messagees=="")&&(videofile!=""))
	    	{
	    		messagees=videofile;
	    		code = 15;
	    	}
/*
	    	var data = new FormData();

			jQuery.each(jQuery('#file')[0].files, function(i, file) {
			    data.append('file-'+i, file);
			});
			
			jQuery.ajax({
			    url: 'php/upload.php',
			    data: data,
			    cache: false,
			    contentType: false,
			    processData: false,
			    type: 'POST',
			    success: function(data){
			        alert(data);
			    }
			});

*/
	    	$.ajax({

	 	 		type: 'POST',
			    url: '<?php echo API_BASE; ?>' + '/message',
			    data: {'gift_id': giftId,
			           'message_content': messagees,
			           'message_description': '16',
			       		'message_type': code},
			   	headers: {
			   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
			   	},
				
			   	success: function(data) {
			   		console.log(data);

						$.ajax({
	 	 				type: 'POST',
			    		url: '<?php echo API_BASE; ?>' + '/gift/1/deliverydate',
			    		data: {'gift_id': giftId,
			       	    'delivery_date': dateorder},
			   			headers: {
			   			'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
			   			},
				
					   	success: function(data) {
					   		
							$.ajax({
		 	 				type: 'POST',
				    		url: '<?php echo API_BASE; ?>' + '/gift/1/orderdetails',
				    		data: {'gift_id': giftId,
				       	    'order_details': orderid},
				   			headers: {
				   			'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
				   			},
					
						   	success: function(data) {
						   		alert("Message sent successfully");
			   					location.reload();
						   	}
			   			});

					   	}
		   			});
			   	}
		   	});

		   

	    });
    });
</script>

<script type="text/javascript">
	$('#one').prop('disabled', true);
</script>

<script type="text/javascript">
/*
	url: '<?php echo API_BASE; ?>' + '/gift/1/deliverydate',
			    data: {'gift_id': giftId,
			           'delivery_date': dateorder},
			   	headers: {
			   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
			   	},

			   	url: '<?php echo API_BASE; ?>' + '/gift/1/orderdetails',
			    data: {'gift_id': giftId,
			           'order_details': orderid},
			   	headers: {
			   		'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
			   	}, */


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
