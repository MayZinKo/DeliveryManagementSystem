<?php 
  $datatable_bootstrap_css=$this->config->item('datatable_bootstrap_css');
  $datatable_jquery_css=$this->config->item('datatable_jquery_css');
  $datatable_jquery_js=$this->config->item('datatable_jquery_js');
  $datatable_bootstrap_js=$this->config->item('datatable_bootstrap_js');
  $assign_controller=$this->config->item('assign_controller');
  $order_controller=$this->config->item('order_controller');
?>
<?php 
  // if($status=='start'){$success=base_url($order_controller);}
  
?>
<link href="<?php echo base_url($datatable_bootstrap_css); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url($datatable_jquery_css); ?>" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
<!-- ************** Breadcrumb ****************** -->
 <section class="content-header">
          <h1>
            <?=$page_label_1?>
            <small> <?=$page_label_2?></small>
          </h1>
     
 </section>
<!-- ************** Breadcrumb ****************** -->

<section class="content">
	 <div class="row">
      <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?=$page_label_2?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Phone</th>
                          <th>Name</th>
                          <th>Township</th>
                          <th>Assigned Date</th>
                          <th>Courier</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      <?php  foreach ($query as $val): ?>
                        <?php //var_dump($val) ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$val['phone']?></td>
                          <td><?=$val['customer_name']?></td>
                          <td><?=$val['township']?></td>
                          <td><?=$val['timestamp']?></td>
                          <td><?=$val['username']?></td>
                         
                      
                          <td>
                            
                                <a href="<?=base_url('customer/done_process/end_pending/'.$val['customer_id'])?>">Success <i class="glyphicon glyphicon-certificate"></i></a>|
                                <a href="#" onClick="alert('Comming Soon')"> <i class="glyphicon glyphicon-trash"></i> </a>
                         
                          </td>


                        </tr>
                      <?php $i++; ?>






                      <?php endforeach; ?>   
                      </tbody>
                  </table>
               </div>   <!-- <div class="box-body"> -->
              </div> <!-- <div class="box"> -->
      </div>  <!-- <div class="col-xs-12"> -->
   </div>	 <!-- <div class="row"> -->

</section>   <!-- <section class="content"> -->

</div> <!-- <div class="content-wrapper"> -->
<script src="<?php echo base_url($datatable_jquery_js); ?>" type="text/javascript"></script>
<script src="<?php echo base_url($datatable_bootstrap_js); ?>" type="text/javascript"></script>

   <script type="text/javascript">
      $(function () {
         $("#example1").dataTable();
      });
    </script>




 
