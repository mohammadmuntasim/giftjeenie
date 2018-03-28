<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.png" type="image/png">

  <title><?php if(isset($title)) { echo $title;}else{ echo 'Gift Jeenie'; } ?> - Gift Jeenie</title>

  <link href="<?php echo base_url()?>assets/css/style.default.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/css/my-style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>

    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" />

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

<body class="signin" style="overflow: visible">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section class="header-backend">
  
    <div class="container">
    	<div class="row">
        	<div class="col-sm-6">
            	<div class="col-sm-12">
                	<div class="col-sm-6">
               			 <img class="img-responsive" src="<?php echo base_url()?>images/logo-white.png">
                    </div>
                    <div class="col-sm-6 heading-title">
               			<h4 id="bigheader"><?php if(isset($title)) { echo $title;}else{ echo 'Gift Jeenie'; } ?> </h4>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
            <div class="arrow-btn col-sm-offset-6 " style="margin-left: 0;">
            	<?php 
              /* if($this->router->class=='user'|| $this->router->class=='admin') 
              { ?>
                <a href="<?php echo site_url('admin/add'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-left:10px;padding:8px 25px;">Add User  </button></a>
                <?php } */ ?>

        <?php 
          if($this->router->class=='admin_product')
          {
            ?>
            <a href="<?php echo site_url('admin/product/add'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-left:10px;padding:8px 25px;">Add Product  </button></a>
            <?php 
          }
        ?>
        <?php 
          if($this->router->class=='admin_dailydeals')
          {
            ?>
            <a href="<?php echo site_url('admin/dailydeals/brand/add'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-left:10px;padding:8px 25px;">Add Brand  </button></a>
            <?php 
          }
        ?>

        <?php 
          if ($this->router->class=='admin_trends') {
              ?>
            <a href="<?php echo site_url('admin/trends/list/add'); ?>"><button type="button" class="btn btn-default pull-right" style="margin-left:10px;padding:8px 25px;">Create Wishlist  </button></a>
            <?php
          }
        ?>

                <div class="btn-group pull-right" role="group" aria-label="..." id="pageNavPosition">
 					<!--<button type="button" class="btn btn-default"><i class="fa fa-caret-left"></i></button>
  					<button type="button" class="btn btn-default"><i class="fa fa-caret-right"></i></button>-->
                       <?php //if(isset($pagination_links)) { echo $pagination_links; } ?>
 
				      </div>
                
                
            </div>
            
                      
			</div>            
        </div>
    </div>
  
</section>
