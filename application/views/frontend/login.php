<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.png" type="image/png">

  <title>Login - Gift Jeenie</title>

  <link href="<?php echo base_url()?>assets/css/frontend-style.default.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/css/frontend-my-style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">

		    <!--favicon-->
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url()?>/images/favicons/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>/images/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>/images/favicons/android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>/images/favicons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>/images/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?php echo base_url()?>/images/favicons/manifest.json">
  <link rel="mask-icon" href="<?php echo base_url()?>/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-TileImage" content="/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">
	<style type="text/css">
   html
  {
    height: 100%;
  } 
  </style>	
</head>

<body class="signin">
	<div id="main">
     <div class="header text-left">
        
        <div class="row" style="max-width: 472px; margin: auto; ">

            <img src="<?php echo base_url(); ?>images/logo-coloured.png">
           
        </div>

     </div>
     

           <div class="container" id="container">
        
                <div class="row">
           
                   <div class="row" style="max-width: 472px; margin: auto;" >
            
                       <div class="login-heading text-center" id="border_loginhead">
            	           <h5 class="lbllogin">Login</h5>
				                   <?php  if(isset($message_error) && $message_error==1){
                            echo '<div class="alert alert-danger">';
                            echo '<a class="close" data-dismiss="alert">×</a>';
                           echo '<strong>Oops!</strong> username or password is incorrect.';
                            echo '</div>';             
                            }
                            if(isset($message_error) && $message_error==2){
                            echo '<div class="alert alert-danger">';
                            echo '<a class="close" data-dismiss="alert">×</a>';
                           echo '<strong>Oops!</strong> Your account has been de-activated by admin.';
                            echo '</div>';             
                            }
                            
                            
                           ?>
                          <?php if($this->session->flashdata('success_msg')) 
                             {
                               echo "<div class='alert alert-success'>";
                               echo $this->session->flashdata('success_msg');
                               echo " </div>";
                             } 
                          ?>
				
                       </div>
				 
			                  <div id="border_login">
				                </div>
                       <div class="login-details">
        
                       <h5 class="lblsign text-center">Sign in with </h5>
				
				                <div class=" col-sm-12 col-xs-12 ">
					
					                <div class="col-sm-6 col-xs-6 text-right ">
				
					                    <a href="/auth_oa2/session/facebook" class="btn btn-facebook"><span class="fa fa-facebook fa-fw"></span>facebook</a><br>
					               </div>
					
					              
		                      <div class="col-sm-6  col-xs-6 text-left">
		
                           <a href="/auth_oa2/session/google" class="btn btn-google">	<!--<span class="fa fa-google-plus fa-fw"></span>--><i class="fa fa-google-plus" aria-hidden="true"></i>
                              google</a>
	                       </div>
	                      	
	                   </div>
				                <h5 class=" lblor text-center">or </h5>
          
			                 	 <form name="login_form" id="loginform" method="post" action="<?php echo site_url('wishlist/validate_credentials'); ?>" class="form-horizontal" autocomplete="off">
                          <div class="form-group">
    
                            <div class="col-sm-12 text-center">
                            <input type="email" name="email" class="form-control" id="email" autocomplete="off" placeholder="Email" required>
	                      </div>
		                    </div>
					
	                       <div class="form-group">
	                      <div class="col-sm-12">
		                    <input type="password" name="password" class="form-control" id="password" autocomplete="off" placeholder="Password" required>
                       </div>
                        </div>

                      <div class="form-group">
                        <div class="col-sm-12">
                         <button type="submit" name="submit" class="btn btn-login" style="display: block; width: 100%;">Login</button>
  	                     </div>
                      </div>
					
	                   <div class="form-group">	
                      <div class="col-sm-12">
		                     
                          <a href="<?php echo site_url('wishlist/register'); ?>"><button type="button" class="btn btn-register" style="display: block; width: 100%;">Register</button></a><br>
                         
                          <a href="<?php echo site_url('wishlist/forgot_password'); ?>" class="forgot-passwordlabel">Forgot Password?</a>

                     </div>
                    </div>
                    
                </form>
               </div>

                  <div class="row">
                     <!-- <div class="col-sm-6 col-xs-6 col-sm-offset-3"> -->
                         <a href="<?php echo base_url(); ?>login"><img class="img-responsive" style=" margin: 0 auto; height:80px; max-width:100%;" src="<?php echo base_url()?>images/appstore2.png" ></a>
                          <br/>
                    <!-- </div> -->
                </div>
            </div>
        </div><!-- row -->
         
    </div><!-- signin -->

<!-- style="padding:20px; background-color:#161616; margin-top:95px;" -->
		<section  style="  background-color: rgb(22, 22, 22);
width: 100%;
padding: 20px;
bottom: 0px;
margin-bottom: 0px;
position: fixed;">

</section>

		</div>
<script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url()?>assets/js/retina.min.js"></script>

<script src="<?php echo base_url()?>assets/js/custom.js"></script>

</body>
</html>

<!--<script language="javascript">
	//var ht = $( window ).height();
    //var ht = $(".container").height() +100;
    //alert(ht);
	//$("#main").css("height",ht.toString() + "px");
</script>-->




<script>
// Safari CSS and Webkit Google Chrome
if ($.browser.webkit) {
 var ht = $(".container").height() +100;
  $("#main").css("height",ht.toString() + "px");
    $("#main").addClass("clsmain");
} else if ( $.browser.safari ) {
   var ht = $(".container").height() +100;
   $("#main").css("height",ht.toString() + "px");
    $("#main").addClass("clsmain");
// Opera CSS
} else if ( $.browser.opera ) {
  var ht = $( window ).height();
// Internet Explorer CSS
} else if ( $.browser.msie ) {
   var ht = $( window ).height();
// Mozilla FireFox CSS
} else if ( $.browser.mozilla ) {
   var ht = $( window ).height();
   $("#main").css("height",ht.toString() + "px");
// Normal Revert, careful and note your the use of !important
} else {
   var ht = $( window ).height();
  
   
}
</script>