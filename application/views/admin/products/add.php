<div class="container minus-margin">
	<div class="row">
    <div class="col-sm-12">
		<div class="col-sm-3">
        	<?php $this->load->view('includes/left_menu'); ?>
        </div>
        
        <div class="col-sm-9">
        	<div class="main-content">
      
              <?php
             
              //form validation
              if(validation_errors())
              {
                echo '<div class="alert alert-danger">';
                echo validation_errors();
                 echo "</div>";
              }
              
              if(!empty($upload_error))
              {
                echo '<div class="alert alert-danger">';
                echo $upload_error['error'] ;
                 echo "</div>";
              }
             
             
              ?>
            <div class="col-sm-12">
            <?php
                         //form data
      $attributes = array('class' => 'form-horizontal', 'id' => 'add_product','enctype'=>"multipart/form-data",'method'=>'post');

                         echo form_open('admin/product/add', $attributes);
            ?>
            
            	<div class="top-form">
                	
                    
                    <div class="col-sm-12">
                    	<div class="product-form">
                    	
                        <div class="col-sm-12">
                        	 <div class="form-group">
                                	 <label>Product Name</label>
                            		 <input type="text" class="form-control" id="product_name" name="product_name"  placeholder="" title="Please enter product name" x-moz-errormessage="Please enter product name" required>   
                            </div>   
                            <div class="form-group">
                            	 <label>Product Category</label>
                            		 <select class="form-control chosen-select" data-placeholder="Choose a Category..." name="product_category" id="product_category" style="height: 40px;">
                                     <?php foreach ($categories as $key => $value) {
                                        ?>
                                         <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                   <?php   } ?>
                                       
    								              </select>
                            </div>

                            <div class="form-group">
                            	 <label class="control-label">Product Description</label>
                                 <div class="controls">
                                    <div class="hero-unit" style="">
                        		  <textarea id="product_desc" name="product_desc" class="textarea" placeholder="Enter text ..." rows="8" style="width:100%; padding: 10px; border:solid 1px #ccc;"></textarea>
                                  </div>
                                  </div>
                            </div>
                                                    
                        </div>
                    
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            </div>
   <!--     </div>
		  <div class="col-sm-9"> -->
        	<div class="main-content">
            <div class="col-sm-12">
            	<div class="top-form" style="margin-top: 10px;">

                  <div class="col-sm-4 main-image text-center">
                 
                    <div class="col-sm-12 ">Product Image</div>
                        <div class="oneInfo" style="width:200px; margin:auto; overflow: hidden">
                    
                         <!-- <input type="file" name="image" accept='image/*' value="Select Image" id="imgInpAddproduct"/> -->
                          <span class="spanForFileInput">
                          </span>
                          
                          <img src="<?php echo base_url()?>images/profile-image-border.png" id="imageID"  height="120" width="120" >
                          <br>
                          <label style="float: inherit;" for="file-upload" class="selectImage">Add Image.</label>
                          <input type="text" id="hid" name="img_req" style="visibility: hidden;" oninvalid="this.setCustomValidity('Please add product image.')" value="">            
                        </div>        
                        <input type="file" name="image" accept='image/*' value="Select Image" id="imgInpAddproduct"  onkeypress="badal()" required/>

                    </div>
                    <div class="col-sm-8">
                    	<div class="product-form">

                        <div class="col-sm-12">
                        
                        	  <div class="form-group">
                            	  <label style="width:100%">Product Pricing </label>
                        		    <div class="col-sm-8" style="padding-left:0px;padding-right: 0px;">
                                  <input type="text"  class="form-control" id="product_price" name="product_price" value="<?php echo set_value('product_price'); ?>"  required> 
                                </div> 

                                <div class="col-sm-4" style="padding-left:0px;padding-right: 0px;">
                                  
                                   <select  style = "min-width:80px; height: 40px;" class="form-control pull-right" name="currency" id="currency">
                                              <!--  <option value="1">CAD</option> -->
                                                <option value="2">$</option>
                                   </select>
                                       
                                </div>
                            </div>
                            <div class="form-group">
                            	 <label>Trend Rating</label>
                        		 <input type="hidden" id="trend_rating" name="trend_rating" value=""/>
                                <div class="trend-rating">
                                <?php
                
                $empty_star = 5;
                $index = 1;

                while( $empty_star > 0 )
                {
                    echo '<span class="glyphicon glyphicon-star-empty" style="color: #ffd203;" aria-hidden="true" id="' . $index . '"></span>';
                    $index++;
                    $empty_star--;
                }
                
                            
                            ?>
                            </div></div>
                            <div class="form-group">
                            	 <label>Product Url</label>
                        		 <input type="url" class="form-control"  placeholder=" " name="product_url" value="<?php echo set_value('product_url'); ?>" onblur="checkURL(this)" required>   
                            </div>
							<br><br>
							 <div class="form-group">
                            	<button name="submit" type="submit" class="btn btn-product " style="height: 40px;"> Save </button>  
                              <button type="button" class="btn btn-product " style="height: 40px;" onclick="javascript:cancel_button();"> Cancel </button>
                            </div>  
                                                   
                        </div>
                        <?php echo form_close(); ?>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            </div>
            
           
        </div>
		
		
        
        
        
    </div>
    </div>
</div>
<script type="text/javascript">

    function cancel_button()
    {  
        window.location.href = "<?php echo site_url('admin/product/'); ?>";
    }
</script>
<script type="text/javascript">
  function checkURL (abc) {
  var string = abc.value;
  if (!~string.indexOf("http")) {
    string = "http://" + string;
  }
  abc.value = string;
  return abc
}
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

//var myVar = setInterval(myTimer, 100);

function myTimer() {
    //var d = document.getElementById('imageID').src;
    //alert(document.getElementById('imageID').complete);
    
    var source=document.getElementById('imageID').src;
    var filename = source.substring(source.lastIndexOf('/')+1);
    //alert(filename);
    if(filename!="profile-image-border.png")
    {
      //alert("dadasd");
      $(hides).val("11");
      document.getElementById("hides").value = "12";
      // document.getElementById("hides").innerHTML = "1";
      // document.getElementById("hides").text = "1";
      //alert(document.getElementById("hides").value);
    }
  
}





  $(document).ready(function(){ 
      $("#imgInpAddproduct").change(function(){
          readURL(this);
      });
  });

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#imageID').attr('src', e.target.result);
          }
          $("#imgInpAddproduct").prop('required',false);
          reader.readAsDataURL(input.files[0]);
          //alert("fds");
      }
  }

  

</script>
<script type="text/javascript">
    $('.trend-rating span').on( 'click', function() {
        var new_rating = $(this).attr('id');
        $('#trend_rating').attr('value', new_rating);
        for( var i = 1; i <=5; i++ )
        {
            if( i <= new_rating )
                $('#' + i).removeClass().addClass('glyphicon glyphicon-star');
            else
                $('#' + i).removeClass().addClass('glyphicon glyphicon-star-empty');
        }
    });
    $('.trend-rating span').on({
        mouseenter: function () {
            var new_rating = $(this).attr('id');
            for( var i = 1; i <=5; i++ )
            {
                if( i <= new_rating )
                    $('#' + i).removeClass().addClass('glyphicon glyphicon-star');
                else
                    $('#' + i).removeClass().addClass('glyphicon glyphicon-star-empty');
            }
        },
        mouseleave: function() {
            var new_rating = $('#trend_rating').attr('value');
            for( var i = 1; i <=5; i++ )
            {
                if( i <= new_rating )
                    $('#' + i).removeClass().addClass('glyphicon glyphicon-star');
                else
                    $('#' + i).removeClass().addClass('glyphicon glyphicon-star-empty');
            }
        }
    });
    
</script>
<style>
    .trend-rating span {
    font-size: 20px;
    padding-right: 3px;
}

.arrow-btn button
{
  display:none;
}

</style>
