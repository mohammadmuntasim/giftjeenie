<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.png" type="image/png">

  <title>Change Password - Gift Jeenie</title>

  <link href="<?php echo base_url(); ?>assets/css/style.default.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/my-style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
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
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
           
            
            <div class="col-sm-12 text-center logo-login">
            	<img src="<?php echo base_url(); ?>images/logo-coloured.png">
             
            </div>
            
            <div class="col-sm-10 col-sm-offset-1">
            
            <div class="login-heading text-center">
            	<h3>Change Password</h3>
            </div>
            <div class="login-details">
             <?php  if(validation_errors()){
                  echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo validation_errors();
                  echo '</div>';             
              }
               ?>
                <?php  if(isset($invalid_password) && $invalid_password){
                  echo '<div class="alert alert-danger">';
                    echo '<a class="close" data-dismiss="alert">×</a>';
                    echo '<strong>Sorry!</strong>Invalid current password.';
                  echo '</div>';             
              }
               ?>
            	<form name="change_password" method="post" action="" class="form-horizontal">
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-4 control-label lblchangepasswordlabel1">Current Password:</label>
					    <div class="col-sm-8">
					      <input type="password" name="current_password" id="current_password" class="form-control"   required>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-4 control-label lblchangepasswordlabel">New Password:</label>
					    <div class="col-sm-8">
					      <input type="password" name="new_password" id="new_password" class="form-control"  placeholder="" required>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-4 control-label lblchangepasswordlabel">Confirm Password:</label>
					    <div class="col-sm-8">
					      <input type="password" name="confirm_password" id="confirm_password" class="form-control"  placeholder="" required>
					    </div>
					  </div>
					  
					  <!-- <div class="form-group"> -->
					    <div class="row text-center">
                <div class="col-sm-12 col-sm-offset-2">
					      <button type="submit" name="submit" class="btn btn-login">Submit</button><br>
					       <a href="#" onclick="javascript:window.history.back();" class="forgot-pass changepassword-cancel">Cancel</a>
                 </div>
					    </div>
					  <!-- </div> -->
				</form>
            </div>
            
            </div>
            
        </div><!-- row -->
        
        
        
    </div><!-- signin -->
  
</section>
<section style="padding:60px; background-color:#161616; margin-top:60px;">

</section>

<!-- <section style="padding:60px;  margin-top:60px;">

</section> -->


<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/retina.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

</body>
</html>