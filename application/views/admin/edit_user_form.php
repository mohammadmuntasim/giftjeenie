            	<form name="add_user_form" id="addUserForm" runat="server" action="<?php echo site_url('user/update'); ?>/<?php echo $userdata->id;?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="created_on" value="<?php echo $userdata->created_on; ?>">
                <div class="top-form">
                    <div class="row">
                   <!--  <div class="col-sm-12"><h4>Edit User</h4></div> -->
                </div>
                	<div class="col-sm-4 main-image text-center">
                            
                            <input type="file" name="profile_picture" accept='image/*' value="Select Image" id="imgInp"/>
            <span class="spanForFileInput">

                <!--<input type="button" class="selectImage" value="Select Image"/>-->
                   
            </span>
                     <?php if($userdata->profile_picture=='')
                            {
                                ?>
                                 <label for="file-upload" class="selectImage" style="width:100%;">
                               Add Image
                            </label>
                        <img alt="your image"  src="<?php echo base_url()?>images/profile-image-border.png" id="imageID" height="120" width="120">
                            <?php }else{ ?>

                        <img src="<?php echo $userdata->profile_picture;?>" height="120" width="120" id="imageID" class="img-circle" alt="Add Profile Image">
                            <?php } ?>
                        <br>
                        <!--<h4><a href="" id="upload_link">Update Profile Image</a></h4>
                        <input type="file" id="upload" name="profile_picture" accept='image/*' value="<?php echo set_value('profile_picture'); ?>">
                       -->
                        <!-- <label for="file-upload" class="custom-file-upload">
                               Add Profile Image
                            </label>
                            <input id="file-upload" name="profile_picture" accept='image/*' type="file"/>-->
                             <input type="hidden" name="hid_image" value="<?php echo $userdata->profile_picture; ?>">
                    </div>	
                    
                    <div class="col-sm-8" style="background-color:#ffffff;"> 
                    	
                        <div class="row">
                        	       <div class="form-group col-sm-6">
                            	        <label>First Name</label>
                        		           <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $userdata->first_name; ?>"  placeholder="" required>   
                                    </div> 
                                 <div class="form-group  col-sm-6">
                                 <label>Email</label>
                                 <input type="email" name="email" readonly id="email" class="form-control" value="<?php echo $userdata->email; ?>"  placeholder="" required>   
                                 </div>  
                                 </div> 
                          <div class="row">
                            
                                     <div class="form-group col-sm-6">
                                     <label>Last Name</label>
                                     <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $userdata->last_name; ?>"  placeholder="" required>   
                                     </div>

                                    <div class="form-group col-sm-6">
                                     <label>Status</label>
                                         <select name="status" id="user_status" class="form-control">
                                             <option <?php if($userdata->status==2) { echo "selected='selected'";} ?> value="2">Active</option>
                                             <option <?php if($userdata->status==1) { echo "selected='selected'";} ?> value="1">Inactive</option>
                                         </select>   
                                    </div>
                            </div>
                             <div class="row">

                                 <div class="form-group col-sm-6">
                                 <label>Registration Date</label>
                                 <input type="text"  class="form-control" value="<?php  echo date('m-d-Y', strtotime($userdata->created_on));?>"  placeholder="" readonly>   
                                 </div>  
                            
                                     <div class="form-group col-sm-6">
                                      <button type="submit" onclick=" $('#bigheader').text('Product Wishlist');" name="submit" id="submit_form" class="btn btn-product"> Save </button>  
                                      <button type="reset" class="btn btn-product" onclick="$('#bigheader').text('Product Wishlist'); window.location.reload();"> Cancel </button> 
                                     </div>   
                            </div>
                                <!-- <div class="form-group col-sm-6">
                                 <label>Location</label>
                                 <input type="text" name="location" id="location" class="form-control" value="<?php echo $userdata->location;//echo $userdata[0]['location']; ?>"  placeholder="">   
                                  </div> -->

                        
                      <!--   <div class="row">

                                               
                        </div> -->

                            <!--<div class="form-group">
                            	 <label>Password</label>
                        		 <input type="password" name="password" id="password" class="form-control"  placeholder="">   
                            </div>-->
                            
                        </div>
                       <!--  <div class="row">
                                                 
                        </div> -->
                        
                        
                                    <?php
          if(validation_errors()!="") 
          {
            echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo validation_errors();
            echo '</div>';             
          }
     
      ?>
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div></form>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>      
        <script type="text/javascript">
            
              function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#imageID').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#imgInp").change(function(){
                readURL(this);
            });
        </script>
 
     <script>
$(document).ready(function(){ 
    $("#imgInp").change(function(){  
        readURL(this);
    });
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