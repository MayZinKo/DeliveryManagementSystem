<?php 
  $datatable_bootstrap_css=$this->config->item('datatable_bootstrap_css');
  $datatable_jquery_css=$this->config->item('datatable_jquery_css');
  $datatable_jquery_js=$this->config->item('datatable_jquery_js');
  $datatable_bootstrap_js=$this->config->item('datatable_bootstrap_js');
?>
<link href="<?php echo base_url($datatable_bootstrap_css); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url($datatable_jquery_css); ?>" rel="stylesheet" type="text/css" />
<div class="content-wrapper">

<section class="content">

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Start Customer</a></li>
                  <li><a href="#tab_2" data-toggle="tab">End Customer</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                      <table id="" class="display">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Phone</th>
                          <th>Name</th>
                          <th>Township</th>
                          <th>Request Date</th>
                          <th>Courier</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      <?php  foreach ($start_pending as $val): ?>
                       <?php //var_dump($val);?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$val['phone']?></td>
                          <td><?=$val['customer_name']?></td>
                          <td><?=$val['township']?></td>
                          <td><?=$val['timestamp']?></td>
                          <td><?=$val['username']?></td>

                          <td>
                             <?php if($val['order_status']==1):?>
                            <a href="<?=base_url('order/view/pending/'.$val['customer_id'])?>"> Add Again </a>|
                            <a href="<?=base_url('customer/done_process/pending/'.$val['customer_id'])?>">Done <i class="glyphicon glyphicon-ok"></i> </a>|
                            <a href="<?=base_url('customer/end_list/pending/'.$val['customer_id'])?>">
                            <i class="glyphicon glyphicon-eye-open"></i> </a>
                              <?php else:?>
                                <a href="<?=base_url('order/view/pending/'.$val['customer_id'])?>">Success 
                                <i class="glyphicon glyphicon-certificate"></i> </a>|
                              
                                <a href="#" onClick="alert('Comming Soon')"> <i class="glyphicon glyphicon-trash"></i> </a>
                             <?php endif;?> 
                          </td>

                         
                        </tr>
                      <?php $i++; ?>

 






                      <?php endforeach; ?>   
                      </tbody>
                  </table>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                   

                         <table id="" class="display">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Phone</th>
                          <th>Name</th>
                          <th>Township</th>
                          <th>Request Date</th>
                          <th>Courier</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      <?php  foreach ($end_pending as $val): ?>
                        <?php //var_dump($val) ?>
                        <tr>
                         <td><?=$i?></td>
                           <td><?=$val['phone']?></td>
                          <td><?=$val['customer_name']?></td>
                          <td><?=$val['township']?></td>
                          <td><?=$val['timestamp']?></td>
                          <td><?=$val['username']?></td>

                         <td>
                           <a href="<?=base_url('customer/done_process/pending/'.$val['customer_id'])?>">Success<i class="glyphicon glyphicon-certificate"></i></a>|
                                <a href="#" onClick="alert('Comming Soon')"> <i class="glyphicon glyphicon-trash"></i> </a>
                         
                          </td>
                        </tr>
                      <?php $i++; ?>






   

                      <?php endforeach; ?>   
                      </tbody>
                  </table>



                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->








  
</section>   <!-- <section class="content"> -->

</div> <!-- <div class="content-wrapper"> -->
<script src="<?php echo base_url($datatable_jquery_js); ?>" type="text/javascript"></script>
<script src="<?php echo base_url($datatable_bootstrap_js); ?>" type="text/javascript"></script>

   <script type="text/javascript">
    $(document).ready(function() {
    $('table.display').dataTable();
} );
    </script>
