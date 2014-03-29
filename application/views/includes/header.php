<!DOCTYPE html>
<?php
  //Reference: http://stackoverflow.com/questions/13099805/clear-cache-on-back-press-to-prevent-going-back-on-login-page-or-previous-page-a/13099962#comment17804359_13099962
  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
  $this->output->set_header("Pragma: no-cache");
?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?=$title?></title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width">
      <link rel='shortcut icon' type='image/png' href="<?=base_url('resources/img/icsonlib_icon.png')?>"/>
      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/bootstrap.min.css')?>">
      <style>
          body {
              padding-top: 50px;
              padding-bottom: 20px;
          }
      </style>

      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/bootstrap-theme.min.css')?>">
      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/bootstrap.css')?>">

      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/main.css')?>">
      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/main_login.css')?>">
      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/profile_view.css')?>">
      <link rel="stylesheet" type='text/css' href="<?=base_url('resources/css/template.css')?>">
      <script src="<?=base_url('resources/js/jquery-2.1.0.min.js')?>"></script>
      <script src = "<?= base_url('resources/js/bootstrap.min.js') ?>"></script>
      <script src = "<?= base_url('resources/js/bootbox.min.js') ?>"></script>
      <script src="<?=base_url('resources/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js')?>"></script>
      
      <script type='text/javascript' src='<?=base_url('resources/js/scripts.js')?>'></script>
    
    <script src="<?=base_url('resources/js/delete_script.js') ?>"></script>
    <script src="<?= base_url('resources/js/validate_script.js')?>"></script>
    
    <script src = "<?=base_url('resources/js/main.js') ?>"></script>
    <script src = "<?=base_url('resources/js/customdateforreport.js') ?>"></script>
 <script src = "<?=base_url('resources/js/createAccount.js') ?>"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experiensce.</p>
        <![endif]-->
     <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= base_url('index.php/home/') ?>"> <span id="logo">ICS </span><span id="logo1">OnLib</span></a>
        
        </div>
        <div class="navbar-collapse collapse">
          
         <ul class="nav navbar-nav navbar-right">
            <?php if($this->session->userdata('userType') == 'A'){?>
             <li class="active twitter"><a href="<?=base_url('index.php/home')?>">Home</a></li>
                <li class="active twitter"><a href="<?=base_url().'index.php/administrator/view_accounts/'?>">Admin Features</a></li>
          
                <li class="active twitter">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?=$this->session->userdata('username')?><b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><?=anchor('profile', 'View Profile')?></li>
                    <li><?=anchor('logout', 'Logout')?></li>
                  </ul>
                </li>
                  <?php }else if($this->session->userdata('userType') == 'L'){?>

               <li class="active twitter"><a href="<?= base_url('index.php/home/') ?>">Home</a></li>
               <li class="active twitter"><a href="<?= base_url('index.php/librarian/') ?>">Librarian Features</a></li>
              
                <li class="active twitter">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$this->session->userdata('username')?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li><a href="<?=base_url().'index.php/profile'?>">View Profile</a></li>
                    <li><a href="<?= base_url('index.php/logout') ?>">Logout</a></li>
                  </ul>
                </li>
                
            <?php  }else if($this->session->userdata('userType') == 'F' || $this->session->userdata('userType') == 'S'){ ?>
            <!--start -->
            <!-- Collect the nav links, forms, and other content for toggling -->
              
                  <li class="active twitter"><a href="<?=base_url().'index.php/home/'?>">Home</a></li>
                <li class="active twitter"><a href="<?=base_url().'index.php/search'?>">Search References</a></li>
             
                <li class="active twitter">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$this->session->userdata('username')?><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?=base_url().'index.php/profile'?>">View Profile</a></li>
                    <li><a href="<?=base_url().'index.php/cart/view_cart'?>">View Cart</a></li>
                    <li><a href="<?=base_url().'index.php/logout'?>">Logout</a></li>
                  </ul>
                </li>
                
            <!--//navbar-collapse  -->
          <?php } else{?>
              <li class="active twitter"><a href="<?=base_url('index.php/home')?>">Home</a></li>
              <li class="active twitter"><a href="<?=base_url().'index.php/cart/view_cart'?>">View Cart</a></li>
                <li class="active twitter">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Sign In<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li> <form  action="<?=base_url().'index.php/login'?>" role="form" method='post'>
          
                 <input type="text" name='username'  size="13"  class="form-control"placeholder="Username" required>
                 <p>  </p>
                 <input type="password" name='password' size="13" class="form-control" placeholder="Password" required>
              <br />
                <button class="btn btn-md btn-primary form-control" type="submit">Sign in</button>
                </form>
              </li>
                   
                  </ul>
                </li>
                <li class="active twitter"><a href="#createAccount" data-toggle="modal" data-target=".bs-modal-lg">Create Account</a></li>

          <?php }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>