<?php 
	$bootstrap_css=$this->config->item('bootstrap_css');
	$template_css=$this->config->item('template_css');
	$skin_css=$this->config->item('skin_css');
  $font_css=$this->config->item('font_css');
?>
<?php 
  $main_jquery=$this->config->item('main_jquery');
  $bootstrap_js=$this->config->item('bootstrap_js');
?>
<?php 

    $username=$_SESSION['user_info']['name'];
    $userimage=$_SESSION['user_info']['image'];
    $position=$_SESSION['user_info']['description'];
    $profile_image_extension=$this->config->item('profile_image_extension');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DMS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   
    <link href="<?php echo base_url($bootstrap_css); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url($template_css); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url($skin_css); ?>" rel="stylesheet" type="text/css" />
   <!--  <link href="<?php //echo base_url($font_css); ?>" rel="stylesheet" type="text/css" /> -->

   <script src="<?php echo base_url($main_jquery); ?>"></script>
   <script src="<?php echo base_url($bootstrap_js); ?>" type="text/javascript"></script>
   
  </head>

  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>D</b>MS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>DMS</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="glyphicon glyphicon-list"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url('images/users/'.$userimage)?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?=$username?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=base_url('images/users/'.$userimage)?>" class="img-circle" alt="User Image" />
                    <p>
                      <?=$username?>
                      <small><?=$position?></small>
                    </p>
                  </li>
               
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url('login/logout')?>" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
             
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url('images/users/'.$userimage)?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?=$username?></p>
              <a href="#"><i class="fa fa-circle text-success"></i><?=$position?></a>
            </div>
          </div>
        
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active"><a href="<?=base_url('customer/browse/unassign')?>"><i class="glyphicon glyphicon-fire"></i> <span>Today Route List</span></a></li>

            <li class="header">USER GUIDE</li>
            <li><a href="#" onClick="alert('Comming Soon')"><i class="glyphicon glyphicon-file"></i> <span>Information</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>