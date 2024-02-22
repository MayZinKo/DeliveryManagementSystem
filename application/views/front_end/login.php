<?php 
  $bootstrap_css=$this->config->item('bootstrap_css');
  $template_css=$this->config->item('template_css');


  $main_jquery=$this->config->item('main_jquery');
  $bootstrap_js=$this->config->item('bootstrap_js');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DMS | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="<?php echo base_url($bootstrap_css); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url($template_css); ?>" rel="stylesheet" type="text/css" />
    
  </head>

  <style type="text/css">
  .error
  {
    color: red;
  }
  .alert
  {
    color: green;
  }
</style>

  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>DMS</b> <small>DeliveryManagementSystem</small></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Welcome User</p>
        <?php echo $this->session->flashdata('message'); ?>
        <?php 
          $action_go="Login/process"; 
          $attributes = array('method' => 'post'); 
        ?>
        <?php echo form_open($action_go,$attributes);?> 
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email" name="email" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
             <?= form_error('email', '<div class="error">', '</div>'); ?>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <?= form_error('password', '<div class="error">', '</div>'); ?>
          </div>
          <div class="row">
            <div class="col-xs-8">    
                             
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        <?= form_close();?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url($main_jquery); ?>"></script>
    <script src="<?php echo base_url($bootstrap_js); ?>" type="text/javascript"></script>
    
  </body>
</html>