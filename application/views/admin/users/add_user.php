
<section>
<div class="container">
	<div class="row">
    <div class="col-sm-12">
		<div class="col-sm-3">
            <?php $this->load->view('includes/left_menu'); ?>
        </div>
        
        <div class="col-sm-9">
        	<div class="main-content">
                    <?php if($this->session->flashdata('success_msg')) 
                        {
                            echo "<div class='alert alert-success'>";
                            echo '<a class="close" data-dismiss="alert">x</a>';
                            echo $this->session->flashdata('success_msg');
                            echo " </div>";
                        } 
                        if($this->session->flashdata('error_msg')) 
                        {
                            echo "<div class='alert alert-warning'>";
                            echo '<a class="close" data-dismiss="alert">x</a>';
                            echo $this->session->flashdata('error_msg');
                            echo " </div>";
                        }
                    ?>
            <div class="col-sm-12">
                <form name="add_user_form" id="addUserForm" enctype="multipart/form-data" method="post">
            	<div class="top-form">
                	<div class="col-sm-4 main-image text-center">
                    	<img src="<?php echo base_url()?>images/profile-image-border.png">
                        <br>

                    <input type="file" id="fileElem" multiple onchange="handleFiles(this.files)">
  <button id="fileSelect">Add Profile Image</button>
                       
                        </div>	
                    
                    <div class="col-sm-8">
                    	<div class="product-form">
                    	
                        <div class="col-sm-6">
                        	<div class="form-group">
                            	 <label>First Name</label>
                        		 <input type="text" name="first_name" id="first_name" class="form-control"  placeholder="" required>   
                            </div>   
                            <div class="form-group">
                            	 <label>Last Name</label>
                        		 <input type="text" name="last_name" id="last_name" class="form-control"  placeholder="" required>   
                            </div>
                            <div class="form-group">
                            	 <label>Location</label>
                        		 <input type="text" name="location" id="location" class="form-control"  placeholder="">   
                            </div>
                            <div class="form-group">
                            	 <label>Registration Number</label>
                        		 <input type="text" name="registration_num" id="registration_num" class="form-control"  placeholder="">   
                            </div>                         
                        </div>
                        
                        <div class="col-sm-6">
                        	<div class="form-group">
                            	 <label>Email</label>
                        		 <input type="email" name="email" id="email" class="form-control"  placeholder="" required>   
                            </div>   
                            <div class="form-group">
                            	 <label>Password</label>
                        		 <input type="password" name="password" id="password" class="form-control"  placeholder="">   
                            </div>
                            <div class="form-group">
                            	 <label>Status</label>
                                         <select name="status" id="user_status" class="form-control">
                                             <option value="0">Active</option>
                                             <option value="1">Inactive</option>
                                         </select>
                            </div>
                            <div class="form-group">
                            	<button type="submit" name="submit" id="submit_form" onclick="javascript:makeAjaxCall();" class="btn btn-product pull-left"> Save </button>  
                                <button type="reset" class="btn btn-product pull-right"> Cancel </button> 
                            </div>                         
                        </div>
                        
                        
                                    <?php
          if(validation_errors()!="") 
          {
            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo validation_errors();
            echo '</div>';             
          }
     
      ?>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div></form>
            </div>
            
            </div>
            
            <div class="col-sm-12">
            	<div class="data-table table-responsive">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Registration Date</th>
                                <th>Action</th>
                            </tr>
                         </thead>
                        	
                            <tbody id="userdata">
                                <?php 
                                foreach ($userdata as $key => $value) {
                                ?>
                                 <tr>
                                   <td><?php echo $value['first_name']; ?></td>
                                   <td><?php echo $value['last_name']; ?></td>
                                   <td><?php echo $value['email']; ?></td>
                                   <td><?php if( $value['status']=="0") { ?><a>Active</a><?php } else{ ?><a>Inactive</a><?php } ?></td>
                                   <td><?php echo $value['created_on']; ?></td>
                                   <td><a href="<?php echo site_url('user/update'); ?>/<?php echo $value['id']; ?>">Edit</a></td>
                                 </tr> 
                                 <?php } ?>
                                
                            </tbody>
                        
                    </table> 
                </div>
            </div>
            <div class="pull-right"><?php //echo $this->pagination->create_links(); ?></div>
        </div>
        
        
        
    </div>
    </div>
</div>
</section>


<section style="padding:60px;">

</section>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<!--<script>
$(document).ready(function()
{
  $("#submit_form").click(function(){ 
    $.ajax({
    type:"POST",
    url: "<?php echo site_url('user/add_userdata');?>",
    data:$("#addUserForm").serialize(),
    success: function (dataCheck) {
    //alert(dataCheck);
$('#userdata').append(dataCheck);

//$("#addUserForm")[0].reset();

}
      });
  });
});

</script>-->
<script type="text/javascript">
    function makeAjaxCall(){
    $.ajax({
        type: "post",
        url: "<?php echo site_url('user/add'); ?>",
        cache: false,               
        data: $('#addUserForm').serialize(),
        success: function(json){                        
        try{        
            var obj = jQuery.parseJSON(json);
            //alert( obj['STATUS']);
                    
            
        }catch(e) {     
            alert('Exception while request..');
        }       
        },
        error: function(){                      
            alert('Error while request..');
        }
 });
}
</script>

<script>
function click(el) {
  // Simulate click on the element.
  var evt = document.createEvent('Event');
  evt.initEvent('click', true, true);
  el.dispatchEvent(evt);
}

document.querySelector('#fileSelect').addEventListener('click', function(e) {
  var fileInput = document.querySelector('#fileElem');
  //click(fileInput); // Simulate the click with a custom event.
  fileInput.click(); // Or, use the native click() of the file input.
}, false);

function handleFiles(files) {
  alert('Well done!');
}
</script>
