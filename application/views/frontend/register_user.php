<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.png" type="image/png">

   <title>Register - Gift Jeenie</title>

  <link href="<?php echo base_url()?>assets/css/frontend-style.default.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/css/frontend-my-style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

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

<body class="signin" >
	<div id="main">
	
	<div class="header text-left" class="header">
   <div class="row" style="max-width: 398px; margin: auto; ">
            	<img src="<?php echo base_url()?>images/logo-coloured.png">
      </div>       
            </div>

	
    <div class="container" id="container">
        
        <div class="row">
            
                    
           
			
            
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3" >
            
            <div class="register-heading text-center" id="border_registerhead">
            	<h5 class="lblregister" >Register </h5>
              <?php  
                if(isset($message_error) && $message_error==1)
                {
                  echo '<div class="alert alert-danger">';
                  echo '<a class="close" data-dismiss="alert">×</a>';
                  echo '<strong>Oops!</strong> User with same email exists.';
                  echo '</div>';             
                }
              ?>
				
            </div>
				<div id="border_register">
				</div>
				   
            <div class="register-details">
            	<form class="form-horizontal" name="form" onsubmit="return validation(this)" method="post" action="<?php echo site_url('/wishlist/register'); ?> " autocomplete="off">
  <div class="form-group">
    
    <div class="col-sm-12">
      <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required>
    </div>
  </div>
					  <div class="form-group">
					<div class="col-sm-12">
      <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required>
    </div> 
					</div>
					
					<div class="form-group">
					<div class="col-sm-12">
      <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off" required>
    </div> 
					</div>
					<div class="form-group">
					
						<div class="col-sm-12" id="password1">
							<!--<span class="glyphicon glyphicon-eye-open pull-right" ></span>
						<input type="password" name="password" class="form-control" id="password" placeholder="password" required>-->	
						  <input placeholder="Password" name="password" id="password"  class="form-control pwd input-field" autocomplete="off" type="password" > 
    <span class="glyphicon glyphicon-eye-open reveal"></span>



                    <!-- <span class="input-group-btn">
                    <input type="password" name="password" class="form-control pwd" placeholder="Password">
                     <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open reveal"></i></button>
                    </span>  -->
							
							
							<!-- /input-group -->
  </div><!-- /.col-lg-6 -->
						
						
	</div>

  <div class="form-group">
    <div class="col-sm-12">
      <button type="submit" id="submit" name ="submit"  class="btn btn-singup"   style="display: block; width: 100%;">Sign Up</button><br>
       <a href="<?php echo site_url('login'); ?>" class="backto_sign_in">Back to Sign in</a>
    </div>
  </div>
</form>
            </div>
            
            </div>
            
        </div><!-- row -->
        
    </div><!-- signin -->
  
<!-- <section style="padding:20px; background-color:#161616; margin-top:200px;">

      </section> -->
      
    <section  style="  padding:15px; background-color:#161616; position: fixed; height:50px; bottom: 0; width: 100%; margin-top:12%;">

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
<script type="text/javascript">
   $(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>
<script language="javascript">
	var ht = $( window ).height();
	$("#main").css("height",ht.toString() + "%");
</script>

<!-- for password validation -->
<!-- <script language="javascript">
         function CheckPassword(inputtxt)   
    {   
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;  
    //var passw=  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/; 
    if(inputtxt.value.match(passw))   
    {   
    
    return true;  
    }  
    else  
    {   
    alert('Input Password and Submit [6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter]');
    return false;  
    }  
    }  
    </script> -->

<script type="text/javascript">
// function checkPassword(str)
//   {
//     var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
//     return re.test(str);
//   }
function validation(form)
{ 
    var password = form.password.value;
    if(password=="")
    {
        alert("Please Enter Your Password");
        document.form.password.focus();
        return false;
    }
      if ((password.length < 7) || (password.length > 15))
    {
        alert("Your Password must be 7 to 15 Characters");
        document.form.password.select();
        return false;
    }
      var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/; 
      if(!re.test(form.password.value)) {
      alert("Password must contain at least one numeric digit, one uppercase and one lowercase letter!");
      form.password.focus();
      return false;
    } 
    
}
</script>
