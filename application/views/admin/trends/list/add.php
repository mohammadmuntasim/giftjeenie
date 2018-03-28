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
      $attributes = array('class' => 'form-horizontal', 'id' => 'add_list','enctype'=>"multipart/form-data",'method'=>'post', 'novalidate');

                         echo form_open('admin/trends/list/add', $attributes);
            ?>
            

            <!-- </div>
            
            </div> -->
   <!--     </div>
		  <div class="col-sm-9"> -->
        	<div class="main-content">
            <div class="col-sm-12">
            	<div class="top-form" style="margin-top: 10px;">

                  <div class="col-sm-4 main-image text-center">
                 
                    <div class="col-sm-12 ">List Image</div>
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
                            	    <label style="width:100%">List Name </label>
                                    <input type="text" class="form-control" id="list_name" name="list_name" value="<?php echo set_value('list_name'); ?>"  required> 
                            </div>
                            <div class="form-group">
                                    <label style="width:100%">Gradient Color</label>
                                    
                                    <?php foreach($gradients as $gradient ) {
                                        echo    '<input type="checkbox" class="gradient-check" id="gradient_' . $gradient->id . '" name="gradient[' . $gradient->id . ']">' .  
                                                '<div id="' . $gradient->id . '" class="preview_gradient"' .
                                                'style="display:inline-block; margin-right: 15px; border: 1px solid #000; height: 60px; width: 30px; border-radius: 10px;' .
                                                'background: linear-gradient(' . $gradient->first_color . ', ' . $gradient->second_color . ')"><div class="inner"></div></div>';
                                    } ?>
                            </div>
                        </div>
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
<style>
    .gradient-check {
        position: relative;
        left: 23px;
        top: -43px;
        appearance: none;
        -moz-appearance: none;
        -webkit-appearance: none;
    }
    .checkmark {
        display:block;
        width: 42px;
        height:42px;
        border-radius:50%;
        -ms-transform: rotate(45deg); /* IE 9 */
        -webkit-transform: rotate(45deg); /* Chrome, Safari, Opera */
        transform: rotate(45deg);
    }

    .checkmark:before{
        content:"";
        position: absolute;
        width:6px;
        height:18px;
        background-color:#fff;
        border: 1px solid #000;
        left:21px;
        top:24px;
    }

    .checkmark:after{
        content:"";
        position: absolute;
        width:8px;
        height:6px;
        background-color:#fff;
        border: 1px solid #000;
        border-right: none;
        left:15px;
        top:36px;
    }
</style>
<script type="text/javascript">

    function cancel_button()
    {  
        window.location.href = "<?php echo site_url('admin/trends/'); ?>";
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
      $('.preview_gradient').on('click', function(){
          var id = $(this).attr('id');

          $('.checkmark').removeClass('checkmark');
          $(this).find('input:checked').attr('checked', false);
          $('#gradient_' + id).attr('checked', true);
          $(this).find('.inner').addClass('checkmark');
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
