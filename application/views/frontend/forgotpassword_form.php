<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png">

   <title>Forgot Password - Gift Jeenie</title>

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
	
	<div class="header text-left" class="header">
            	<img src="<?php echo base_url(); ?>images/logo-coloured.png">
             
            </div>


	
    <div class="container" id="container">
        
        <div class="row">
            
                    
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3" >
            
            <div class="forgot-heading text-center" id="border_forgot_passwordhead">
            	<h5 class="lblforgotpassword">Forgot Password</h5>
				<!--<div class="devider">.</div>-->
				
            </div>
				
				<div id="border_forgotpassword">
				</div>
				
				   <!-- <hr class="devider" style="background:#000000">-->
            <div class="forgot-details">
        
            <h6  class="text-center">Enter your Email below  to receive your password reset instructions. </h6>
            
            	<form class="form-horizontal" name= "forgot_password" method="post" action="<?php echo site_url('wishlist/forgot_password');?>">
  <div class="form-group">
    
    <div class="col-sm-12">
      <input type="email" name ="email" class="form-control" id="email" placeholder="Email" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-12">
      <button type="submit" id="submit" class="btn btn-forgotpassword" style="display: block; width: 100%;">Send</button><br>
       <a href="<?php echo site_url('wishlist/login'); ?>" class="backto_sign_in">Back to Sign in</a>
    </div>
  </div>
</form>
            </div>
            
            </div>
            
        </div><!-- row -->  
    </div><!-- signin -->

<!-- <section style="padding:20px; background-color:#161616; margin-top:300px;">

</section> -->

<section  style="  padding:20px; background-color:#161616; position: fixed; height:40px; bottom: 0; width: 100%;margin-top:23%;">

</section>

	</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/retina.min.js"></script>

<script src="<?php echo base_url(); ?>js/custom.js"></script>

</body>
</html>

<script language="javascript">
	var ht = $( window ).height();
	$("#main").css("height",ht.toString() + "%");
</script>
