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
      $attributes = array('class' => 'form-horizontal', 'id' => 'add_brand','enctype'=>"multipart/form-data",'method'=>'post');

                         echo form_open('admin/dailydeals/brand/' . $branddata->brand_id . '/edit', $attributes);
            ?>
            
            	<!-- <div class="top-form">
                    <div class="col-sm-12">
                    	<div class="brand-form">
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
                </div> -->
            </div>
            
            </div>
   <!--     </div>
		  <div class="col-sm-9"> -->
        	<div class="main-content">
            <div class="col-sm-12">
            	<div class="top-form" style="margin-top: 10px;">

                  <div class="col-sm-4 main-image text-center">
                 
                    <div class="col-sm-12 ">Brand Image</div>
                        <div class="oneInfo" style="width:200px; margin:auto; overflow: hidden">
                    
                         <!-- <input type="file" name="image" accept='image/*' value="Select Image" id="imgInpAddproduct"/> -->
                          <span class="spanForFileInput">
                          </span>
                          
                          <img src="<?php echo json_decode($branddata->brand_image)->url ?>" id="imageID"  height="120" width="120" >
                          <br>
                          <label style="float: inherit;" for="file-upload" class="selectImage">Add Image.</label>
                          <input type="text" id="hid" name="img_req" style="visibility: hidden;" oninvalid="this.setCustomValidity('Please add product image.')" value="<?php echo json_decode($branddata->brand_image)->url?>">            
                        </div>        
                        <input type="file" name="image" accept='image/*' value="" id="imgInpAddproduct"  onkeypress="badal()"/>

                    </div>
                    <div class="col-sm-8">
                    	<div class="product-form">

                        <div class="col-sm-12">
                        
                        	  <div class="form-group">
                            	  <label style="width:100%">Brand Name </label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?php echo $branddata->brand_name; ?>
"  required> 
                            </div>
                        </div>
							           <div class="form-group">
                            	<button name="submit" type="submit" class="btn btn-product " style="height: 40px;"> Save </button>  
                              <button type="button" class="btn btn-product " style="height: 40px;" onclick="javascript:cancel_button();"> Cancel </button>
                            </div>  
                                                   
                        </div>
                        <?php 
// var_dump($branddata);
                        echo form_close(); ?>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="main-content">
                    <div class="col-sm-12">
                        <div class="top-form" style="margin-top: 10px;">
                            <div class="col-sm-4 col-sm-offset-8">
                                <a href="add_item"class="btn btn-product" style="width: 100%;background-color: #9197a3; color: #fff"> Add Item </a>  
                            </div>
                        </div>
                        <table class="dataTable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Status</th>
                                    <th>Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-body">
      
              <p>Product deleted successfully.</p>
       
      </div>
      <div class="modal-footer">
       
        <div class="row">
        
          <button type="button" class="btn btn-default btn-block" data-dismiss="modal"  onclick="rload()" style="width: 100%;
background-color: transparent; border: medium; border-width: 0px 0px 0px 1px;">Ok</button>

        </div>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    function cancel_button()
    {  
        window.location.href = "<?php echo site_url('admin/dailydeals/'); ?>";
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
      var table = $('.dataTable').DataTable({

            "ajax": {
                url: "<?php echo base_url() ?>api/deals/brands/" + <?php echo $branddata->brand_id ?>,
                beforeSend: function(xhr){
                    xhr.setRequestHeader("Authorization", "Basic <?php echo $this->session->userdata('auth'); ?>");
                },
                dataSrc: function(data) {
                    data.recordsTotal = data.data.products.length;
                    data.recordsFiltered = data.data.products.length;
                    return data.data.products;   
                }
                
            },
            "searching": false,
            "lengthChange": false,
            "processing": true,
            "serverSide": true,
            "columns": [
                {
                    "data": "product_name",
                    "render": function(product_name, type, row) {
                        return '<div class="col-sm-3"><img class="img-responsive"' + 
                        'style="margin:auto;object-fit:contain;border: 2px solid #ff2525;border-radius: 99px;max-height: 100px;padding: 2px;width: 100px;"' + 
                        'src="' + JSON.parse(row.product_image).url + '"></div><div class="col-sm-9">' +  product_name + '</div>';
                    }
                },
                {
                    "data": "product_id",
                    "render": function(product_id) {
                        return 'Available';
                    }
                },
                {
                    "data": "product_price",
                    "render": function(product_price, type, row) {
                        return row.product_currency + product_price;
                    }
                },
                {
                    "data": "product_id",
                    "render": function(product_id, type, row) {
                        return '<a href="#" id="delete_item" data-id="' + product_id + '" class="btn btn-danger btn-sm">Remove</a>';
                    }
                },
            ]
        });
        $('body').delegate('#delete_item', 'click', function() {
            var product_id = $(this).data('id');
            if (confirm("Are You Sure?")){
            $.ajax({
                type: 'DELETE',
                url: '<?php echo API_BASE; ?>' + '/deals/brands/' + '<?php echo $branddata->brand_id ?>' + '/item/' + product_id,

                headers: {
                    'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
                },
                success: function(data) {
                    $("#myModal").modal();
                }

            });
          }else {
             return false;
          }
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

function rload()
{
location.reload();

}
  

</script>
