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
      $attributes = array('class' => 'form-horizontal', 'id' => '','enctype'=>"multipart/form-data",'method'=>'post');

                         echo form_open('admin/product/update/'.$this->uri->segment(4), $attributes);
            ?>
              <div class="top-form">
                  
                    
                    <div class="col-sm-12">
                      <div class="product-form">
                      
                        <div class="col-sm-12">
                          <div class="form-group">
                
      
                               <label>product name</label>
                             <input type="text"  style="font-size:14px;" class="form-control" id="product_name" name="product_name" value="<?php echo $productdata->name; ?>"  placeholder="">   
                            </div>   

                            <div class="form-group">
                               <label>product category</label>
                             <select style="font-size:14px;height:40px;" class="form-control chosen-select" data-placeholder="Choose a Country..." name="product_category" id="product_category" >
                                 
                             <?php if(!empty($categories)) 
                             {
                                   foreach ($categories as $key => $value) 
                                   {
                              ?>
                              <option value="<?php echo $value['id']; ?>" <?php echo ($productdata->category->id == $value['id']) ? 'selected="selected"' : ''; ?>><?php echo $value['name']; ?></option>
                               <?php  
                                  } 
                               } 
                               ?>
                                   
                </select>
                            </div>

                             

                            <div class="form-group">
                               <label class="control-label">product description</label>
                                 <div class="controls">
                                    <div class="hero-unit" style="">
                              <textarea id="product_desc" name="product_desc" class="textarea" placeholder="Enter text ..." rows="8" style="width:100%;  font-size:14px; padding: 10px; border:solid 1px #ccc;"><?php echo $productdata->description; ?></textarea>
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
                  <div class="col-sm-4 main-image text-center" >
                  <div class="col-sm-12 ">Product Image</div>
                  
                   <div class="oneInfo img-responsive" style="width:200px; margin:auto; overflow: hidden">


                   <input type="file" name="image" accept='image/*' value="Select Image" id="imgInpAddproduct" />
                    <span class="spanForFileInput">

                        <!--<input type="button" class="selectImage" value="Select Image"/>-->
                           
                    </span>
                     <?php if($productdata->images->url=='')
                            {
                                ?>
                                <div class="col-sm-12">
                                    <label for="file-upload" class="selectImage" style="width:100%;">Add Image</label>
                                   <img alt="Add Profile Image" src="<?php echo base_url()?>images/profile-image-border.png" id="imageID" height="120" width="120">
                                </div>
                                
                                      <?php }else{ ?>

                                <img src="<?php echo $productdata->images->url;?>" id="imageID" height="120" width="120" alt="Add Profile Image" class="img-circle">

                                <br>
                                <input type="hidden" name="image" value="<?php echo $productdata->images->url; ?>" >
                                    <?php } ?>
                                 
                                      
                                  <br>
                                           
                                     <u style="color:blue; "> Replace Image</u>              
                                  </div> 
                             
                      <!--<label> product image</label>-->
                      <br>
                      <!--<input type="file" id="upload" name="prodcut_image" accept='image/*' value="<?php echo set_value('prodcut_image'); ?>">
                       <input type="hidden" name="hid_image" value="<?php echo $productdata->images->url; ?>">
              <a href="" id="upload_link">Add Image</a>-->
                    </div>  
                    
                    <div class="col-sm-8" style="padding-left:20px;">
                      <div class="product-form">

                        <div class="row">

                          <div class="form-group">
                           <div class="col-sm-12">
                                <div class="row">
                                 <label>Product Pricing </label>
                            </div>
                            </div>
                            <div class="row" style="padding-left:10px;">
                                <div class="col-sm-8" style = " padding-left:0px; padding-right:0px;">
                                  <div class="clearfix"></div>                                            
                                    <input type="text"   class="form-control pull-left" id="product_price" name="product_price" value="<?php echo $productdata->price; ?>">
                                </div>

                                 <div class="col-sm-4" style="">
                                   <span>
                                     <select  style=" height: 40px;" class="form-control " name="currency" id="currency">
                                   <!--               <option <?php echo ($productdata->currency == 'CAD') ? 'selected="selected"' : ''; ?> value="1">CAD</option> -->
                                                  <option <?php echo ($productdata->currency == '$') ? 'selected="selected"' : ''; ?> value="2">$</option>
                                                   </select>
                                                 
                                  </span>
                                </div>
                            </div>
                          </div>   



                            <div class=" form-group">
                                
                                
                            <label>Trend Rating</label>
                                <input type="hidden" id="trend_rating" name="trend_rating" value="<?php echo $productdata->trend_rating; ?>"/>
                                <div class="trend-rating">
                                <?php
                
                                $dark_star = $productdata->trend_rating;
                                $empty_star = 5 - $productdata->trend_rating;
                                if( $empty_star > 5 ) $empty_star = 5;
                                $index = 1;
                
                           while( $dark_star > 0 )
                           {
                           echo '<span class="glyphicon glyphicon-star" aria-hidden="true" style="color: #ffd203;" id="' . $index . '"></span>';
                            $index++;
                           $dark_star--;
                           }
                           while( $empty_star > 0 )
                            {
                            echo '<span class="glyphicon glyphicon-star-empty" aria-hidden="true" style="color: #ffd203;" id="' . $index . '"></span>';
                            $index++;
                             $empty_star--;
                              }
                            ?>
                            
                            </div>

                            </div>

                            <div class="form-group">
                               <label>Product Url</label>
                             <input type="url" class="form-control"  placeholder=" " name="product_url" value="<?php echo $productdata->url; ?>">   
                            </div>
                             <br><br>
                           <div class="form-group">
                              <button name="submit" type="submit" class="btn btn-product" style=" height: 40px;"> Save </button>  
                                <button type="button" class="btn btn-product" style=" height: 40px;" onclick="javascript:cancel_button();"> Cancel </button> 
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <script>
$(document).ready(function(){ 
    $("#imgInpAddproduct").change(function(){
        readURL(this);
    });

    $("#bigheader").text("Edit Product");

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageID').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
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
</style>
