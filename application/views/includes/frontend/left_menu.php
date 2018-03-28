            <div class="left-menu">
                <ul id="list3">
                    <li <?php if($this->router->class=='user'|| $this->router->class=='admin'|| $this->router->class=='admin_wishlist') { echo "class='active-menu'"; } ?>> <a href="<?php echo base_url('admin/home'); ?>"> 
<?php if($this->router->class=='user'|| $this->router->class=='admin' || $this->router->class=='admin_wishlist')  { ?>
                    <img id="imageid" src="<?php echo base_url()?>images/active-user-icon.png">
<?php }else{ ?>
 <img id="imageid" src="<?php echo base_url()?>images/inactive-user-icon.png">

   <?php } ?>
                     <h4 id="userm">User <br> Management</h4> </a> </li>
                    <li <?php if($this->router->class=='admin_product') { echo "class='active-menu'"; } ?>> <a href="<?php echo site_url('admin/product'); ?>"> 
<?php if($this->router->class=='admin_product')  { ?>
                    <img id="imageid2" src="<?php echo base_url()?>images/active-product-icon.png">
<?php }else{ ?>
  <img id="imageid2" src="<?php echo base_url()?>images/inactive-product-icon.png">
  <?php } ?>
                     <h4 id="productp">Product <br> 
                  Management</h4> </a> </li>


                    <li class="dropdown" id="settings_li">
                     <a href="#" id="setting" class="dropdown-toggle" data-toggle="dropdown"> 
                      <img id="imageid3" src="<?php echo base_url()?>images/inactive-setting-icon.png">
                        
                         <h4 id="settings">Settings</h4> 
                                </a>
                              <ul class="dropdown-menu" >
                         
                            <li><a href="<?php echo site_url('user/change_password'); ?>">Change Password</a></li>
                           <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
                            </ul>
                   </li>
               
                </ul>
            </div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function () {

    $("body").click(function (e) { 

        if (e.target.id == "settings_li" || $(e.target).parents("settings_li").size()) {

            document.getElementById("imageid3").src="<?php echo base_url()?>images/active-setting-icon.png";


            document.getElementById("imageid").src="<?php echo base_url()?>images/inactive-user-icon.png";
              /* $("#userm").remove('left-menu ul li.active-menu a h4');*/
            document.getElementById("userm").style.color ='#9197A5';
              

            document.getElementById("imageid2").src="<?php echo base_url()?>images/inactive-product-icon.png";
                /* $("#productp").css('color','darkgray');*/
               /* $("#productp").remove('left-menu ul li.active-menu a h4');*/
            document.getElementById("productp").style.color ='#9197A5';
        
          }
          else
          {
              location.reload();
          } 

   });
});

</script>

