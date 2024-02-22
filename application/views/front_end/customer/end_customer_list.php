<?php 
  $datatable_bootstrap_css=$this->config->item('datatable_bootstrap_css');
  $datatable_jquery_css=$this->config->item('datatable_jquery_css');
  $datatable_jquery_js=$this->config->item('datatable_jquery_js');
  $datatable_bootstrap_js=$this->config->item('datatable_bootstrap_js');
  $assign_controller=$this->config->item('assign_controller');
?>
<link href="<?php echo base_url($datatable_bootstrap_css); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url($datatable_jquery_css); ?>" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
<!-- ************** Breadcrumb ****************** -->
 <section class="content-header">
          <h1>
            <small>Customer List of </small>  <?=$start_customer_data['name']?>
           
          </h1>
          <ol class="breadcrumb">
          <li><?php echo $this->breadcrumbs->show();  ?></li>
            <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li> -->
          </ol>
 </section>
<!-- ************** Breadcrumb ****************** -->

<section class="content">
	 <div class="row">
      <div class="col-xs-12">
              <div class="box">
            
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Township</th>
                          <th>Order Date</th>
                          <th>Assign</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      <?php  foreach ($end_customer_data as $val): ?>
                        <?php //var_dump($val) ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$val['name']?></td>
                          <td><?=$val['phone']?></td>
                          <td>
                            <?php 
                              echo $val['home_no'].", ".$val['street'].", ".$val['road'].", ".$val['quarter'];
                            ?>
                          </td>
                          <td><?=$val['township']?></td>
                          <td><?=$val['timestamp']?></td>
                           <?php $toAssignController=$assign_controller."/end_unassign/".$val['customer_id'];?>
                          <td>
                          <?php 
                          
                          if($val['check_assign']=='1') 
                          {?>
                              <a>
                                Already Done 
                              </a>
                  <?php   }
                      else{?>
                               <a href="<?=base_url($toAssignController)?>">
                                Assign?   <i class="glyphicon glyphicon-map-marker"></i> 
                  <?php   }?>
                          </td>
                          <td>
                             <?php if($val['check_assign']==1) 
                          {?>
                              <a href="#" onClick="alert('Comming Soon')">
                                Detail  
                              </a>
                  <?php   }
                      else{?>
                              <a href="#" data-toggle="modal" data-target="#myModal<?=$val['customer_id']?>"> 
                              <i class="glyphicon glyphicon-wrench"></i> 
                            </a>
                            <a href="#" onClick="alert('Comming Soon')"> <i class="glyphicon glyphicon-trash"></i> </a>

                        <?php   }?>
                            
                          </td>
                        </tr>
                      <?php $i++; ?>




                          <!-- Modal -->
  <div class="modal fade" id="myModal<?=$val['customer_id']?>" role="dialog">
    <div class="modal-dialog">
      <?php 
        $action_go="Customer/update"; 
        $attributes = array('method' => 'post','enctype'=>'multipart/form-data'); 
      ?>
      <?php echo form_open($action_go,$attributes);?> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Customer Data Update</h4>
        </div>  <!-- <div class="modal-header"> -->
        <div class="modal-body">
   <div class="row">
            <!-- left column -->
       <input type="text" name="start_customer_id" value="<?=$start_customer_data['customer_id']?>" hidden="trued">
       <input type="text" name="view_status" value="end_customer_list" hidden="trued">
       <input type="text" name="customer_id" value="<?=$val['customer_id']?>" hidden="trued">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <!-- form start -->
                <div role="form">
                  <div class="box-body">

                    <div class="form-group">
                      <label>Customer Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Customer Name" value="<?=$val['name']?>">
            <?= form_error('name', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="number" class="form-control" name="phone" placeholder="Phone Number" min=0 value="<?=$val['phone']?>">
              <?= form_error('phone', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Township</label>
                      <select name="township_id" class="form-control">
              
              <?php  foreach ($township as $val1): ?>

                <option value="<?=$val1->id?>" 
                <?php if($val1->id==$val['township_id']){echo "selected";} ?>
                            >
                            <?=$val1->township?>
                 
                </option>

              <?php endforeach; ?> 
            </select> 
            <?= form_error('township_id', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Home Number</label>
                      <input type="text" class="form-control" name="home_no" placeholder="Home Number" value="<?=$val['home_no']?>">
              <?= form_error('home_no', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Street</label>
                      <input type="text" class="form-control" name="street" placeholder="Street" value="<?=$val['street']?>">
              <?= form_error('street', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Road</label>
                      <input type="text" class="form-control" name="road" placeholder="Road" value="<?=$val['road']?>">
              <?= form_error('road', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Quarter</label>
                      <input type="text" class="form-control" name="quarter" placeholder="Quarter" value="<?=$val['quarter']?>">
              <?= form_error('quarter', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Description</label>  
                      <textarea class="form-control" rows="3" placeholder="Description" wrap="off" name="description"><?=$val['description']?></textarea>
              <?= form_error('description', '<div class="error">', '</div>'); ?>
                    </div>

                  </div><!-- /.box-body -->

                </div>
              </div><!-- box box-primary -->
            </div><!-- col-md-12 -->
            
           </div>  <!-- <div class="row"> -->

        </div>  <!-- <div class="modal-body"> -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">SAVE</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> <!-- <div class="modal-footer"> -->
      </div> <!-- <div class="modal-content"> -->
      <!-- Modal content-->
<?= form_close();?>
    </div> <!-- <div class="modal-dialog"> -->
  </div>  <!-- <div class="modal fade" id="myModal" role="dialog"> -->
     <!-- Modal -->



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




 
