            <div class="left-menu">
                <ul id="list3">

                    <li id="user_li" <?php if($this->router->class=='user'|| $this->router->class=='admin'|| $this->router->class=='admin_wishlist') { echo "class='active-menu'"; } ?>> <a href="<?php echo base_url('admin/home'); ?>"> 
                    <?php if($this->router->class=='user'|| $this->router->class=='admin' || $this->router->class=='admin_wishlist')  { ?>
                    <img id="imageid" src="<?php echo base_url()?>images/active-user-icon.png">
                    <?php }else{ ?>
                    <img id="imageid" src="<?php echo base_url()?>images/inactive-user-icon.png">
                    <?php } ?>
                     <h4 id="userm">User <br> Management</h4> </a> </li>

                    <li id="tm_li" <?php if($this->router->class=='admin_trends') { echo "class='active-menu'"; } ?>> <a href="<?php echo base_url('admin/trends'); ?>"> 
                    <?php if($this->router->class=='admin_trends')  { ?>
                    <img id="imageid5" src="<?php echo base_url()?>images/wishlist_selected.png">
                    <?php }else{ ?>
                    <img id="imageid5" src="<?php echo base_url()?>images/wishlist.png">
                    <?php } ?>
                    <h4 id="tm">Trends <br> Management</h4> </a> </li>
                    
                    <li id="product_li" <?php if($this->router->class=='admin_product') { echo "class='active-menu'"; } ?>> <a href="<?php echo site_url('admin/product'); ?>"> 
                    <?php if($this->router->class=='admin_product')  { ?>
                    <img id="imageid2" src="<?php echo base_url()?>images/active-product-icon.png">
                    <?php }else{ ?>
                    <img id="imageid2" src="<?php echo base_url()?>images/inactive-product-icon.png">
                    <?php } ?>
                     <h4 id="productp">Product <br> Management</h4> </a> </li>

                    <li id="dd_li" <?php if($this->router->class=='admin_dailydeals') { echo "class='active-menu'"; } ?>> <a href="<?php echo site_url('admin/dailydeals'); ?>"> 
                    <?php if($this->router->class=='admin_dailydeals')  { ?>
                    <img id="imageid4" src="<?php echo base_url()?>images/dailyDeals_selected.png">
                    <?php }else{ ?>
                    <img id="imageid4" src="<?php echo base_url()?>images/dailyDeals.png">
                    <?php } ?>
                     <h4 id="dd">Daily Deals</h4> </a> </li>

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

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<script type="text/javascript">


function setcookie(str)
{
  document.cookie = "lastPage=; expires=Thu, 01 Jan 1970 00:00:00 UTC"; 
  document.cookie = str + "; expires=Thu, 31 Dec 2020 12:00:00 UTC; path=/"; 
}
$(document).ready(function () {
    var lastPage = "lastPage=User";

      if (document.cookie == "")
        setcookie("lastPage=User");
      else
      {
        //alert(document.cookie);
        if (document.cookie.indexOf("lastPage=User") >= 0)
          lastPage = "lastPage=User";
        else if(document.cookie.indexOf('lastPage=Product') >= 0)
          lastPage = "lastPage=Product";
        else
          lastPage = "lastPage=DailyDeals";
        
        setcookie(lastPage);
      }
        // var link = window.location.href;
        //             var lastpart = link.substr(link.lastIndexOf('/') + 1);


        $('#product_li').on('click', function () {
          lastPage = "lastPage=Product";
          setcookie(lastPage);
        });

         $('#user_li').on('click', function () {
          lastPage = "lastPage=User";
          setcookie(lastPage);
        });

        $('#dd_li').on('click', function() {
          lastPage = "lastPage=DailyDeals"
          setcookie(lastPage);
        })

 // $('#settings_li').on('click', function () {
                  
            // $('#settings_li').on('click', function () {
                  
            //       document.getElementById("imageid3").src="<?php echo base_url()?>images/active-setting-icon.png";
            //       document.getElementById("settings").style.color ='#4B156D';

            //       document.getElementById("imageid").src="<?php echo base_url()?>images/inactive-user-icon.png";
            //       document.getElementById("userm").style.color ='#9197A5';
                    

            //       document.getElementById("imageid2").src="<?php echo base_url()?>images/inactive-product-icon.png";
            //       document.getElementById("productp").style.color ='#9197A5';

            // });


            $("body").click(function (e) { 

              if ((e.target.id === "settings") || (e.target.id === "imageid3")) {
                
                        document.getElementById("imageid3").src="<?php echo base_url()?>images/active-setting-icon.png";
                        document.getElementById("settings").style.color ='#4B156D';

                        document.getElementById("imageid").src="<?php echo base_url()?>images/inactive-user-icon.png";
                        document.getElementById("userm").style.color ='#9197A5';
                      
                        document.getElementById("imageid2").src="<?php echo base_url()?>images/inactive-product-icon.png";
                        document.getElementById("productp").style.color ='#9197A5';
              }
              else{
                    if(lastPage==="lastPage=Product")
                    {

                        document.getElementById("imageid3").src="<?php echo base_url()?>images/inactive-setting-icon.png";
                        document.getElementById("settings").style.color ='#9197A5';

                        document.getElementById("imageid").src="<?php echo base_url()?>images/inactive-user-icon.png";
                        document.getElementById("userm").style.color ='#9197A5';
                          
                        document.getElementById("imageid2").src="<?php echo base_url()?>images/active-product-icon.png";
                        document.getElementById("productp").style.color ='#4B156D';

              
                    }
                    else if(lastPage==="lastPage=User")
                    {

                        document.getElementById("imageid3").src="<?php echo base_url()?>images/inactive-setting-icon.png";
                        document.getElementById("settings").style.color ='#9197A5';

                        document.getElementById("imageid").src="<?php echo base_url()?>images/active-user-icon.png";
                        document.getElementById("userm").style.color ='#4B156D';
                          
                        document.getElementById("imageid2").src="<?php echo base_url()?>images/inactive-product-icon.png";
                        document.getElementById("productp").style.color ='#9197A5';
                    }
                
                  }
              });
    
              
});

</script>

