<?php $item_create=$this->config->item('item_create');	?>
<?php $assign_view_css=$this->config->item('assign_view_css'); ?>
<?php $add_image=$this->config->item('add_image_icon'); ?>
<?php $script=$this->config->item('script'); ?>

<link rel="stylesheet" type="text/css" href="<?=base_url($item_create)?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($assign_view_css)?>">

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>


var marker = null;
  var latitute_data="16.7849833";
  var longitute_data="96.1192453";
function township_change() {

    var township = document.getElementById("township_id").value;
  
    var array = township.split(',');
    
    document.getElementById("latitude").innerHTML=array[1];
    document.getElementById("longitude").innerHTML=array[2];

    latitute_data = array[1];
    longitute_data = array[2];
    initialize(); 
}

function initialize() {

  var mapProp = {
    center:new google.maps.LatLng(latitute_data,longitute_data),
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);


  google.maps.event.addListener(map, "click", function (e)
   {
    clearmarker();
    var latLng = e.latLng;
      
    document.getElementById("latitude").value=latLng.lat();
    document.getElementById("longitude").value=latLng.lng();
    marker = new google.maps.Marker({
             position: new google.maps.LatLng(latLng.lat(),latLng.lng()),
             map: map,
             draggable: true
          });
  });

}
google.maps.event.addDomListener(window, 'load', initialize);

  function clearmarker()
  {
      if (marker) {
                    marker.setMap(null);
                    marker = null;
                 }
  }


</script>
<?php 
			$action_go="Order/save/".$status; 
			$attributes = array('method' => 'post','enctype'=>'multipart/form-data');	
?>
<?php echo form_open($action_go,$attributes);?>	

<input type="text" value="<?=$customer_data['customer_id']?>" hidden="trued" name="customer_id">
<input type="text" value="<?='s'?>" hidden="true" name="status">

<div class="content-wrapper">
 <section class="content-header">
          <h1>
            <?=$customer_data['name']?> :
            <span> <a href="<?=base_url('customer/end_list/start_pending/'.$customer_data['customer_id'])?>"> Total End Customer - <?=$page_label_2?> </a></span>
          </h1>
          <ol class="breadcrumb"> <li><?php echo $this->breadcrumbs->show();  ?></li></ol>
          <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol> -->
 </section>
<?php echo $this->session->flashdata('message'); ?>

<section class="content">
	 <div class="row">
            <!-- left column -->
            
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?=$page_label_1?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">

                    <div class="form-group">
                      <label>Customer Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Customer Name">
					  <?= form_error('name', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="number" class="form-control" name="phone" placeholder="Phone Number" min=0>
				      <?= form_error('phone', '<div class="error">', '</div>'); ?>
                    </div>




               

              <div class="form-group">
               <label>Township</label>
                    <select name="township_id" class="form-control" onchange="township_change()" id="township_id">
                  <?php  foreach ($township as $val): ?>
                  
              
                    <option value="<?=$val->id.','.$val->latitude.','.$val->longitude?>">
                      <?=$val->township?>
                    </option>
                  <?php endforeach; ?> 
                </select> 
                <?= form_error('township_id', '<div class="error">', '</div>'); ?>
              </div>   <!-- <div class="form-group"> -->


                    <div class="form-group">
                      <label>Home Number</label>
                      <input type="text" class="form-control" name="home_no" placeholder="Home Number">
				      <?= form_error('home_no', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Street</label>
                      <input type="text" class="form-control" name="street" placeholder="Street">
				      <?= form_error('street', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Road</label>
                      <input type="text" class="form-control" name="road" placeholder="Road">
				      <?= form_error('road', '<div class="error">', '</div>'); ?>
                    </div>

                    <div class="form-group">
                      <label>Quarter</label>
                      <input type="text" class="form-control" name="quarter" placeholder="Quarter">
				      <?= form_error('quarter', '<div class="error">', '</div>'); ?>
                    </div>
                  </div><!-- /.box-body -->

            
                </form>
              </div><!-- box box-primary -->
            </div><!-- col-md-4 -->

            <div class="col-md-8">
              
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Map View</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="pad">
                          <!-- Map will be created here -->
                          <div id="googleMap" style="width:100%;height:420px;"></div>
                         <!--  <div id="world-map-markers"></div> -->
                        </div>
                      </div><!-- /.col -->
                    </div><!-- /.row -->

                  </div><!-- /.box-body -->
                </div>  <!-- <div class="box box-success"> -->

				<table class="table">
				  <tr>
				    <td>   
                <span class="lead">Latitude : </span>  
                <input style=" cursor: no-drop;" type="text" name="latitude" id="latitude" readonly="readonly" required="true">
                 <?= form_error('latitude', '<div class="error">', '</div>'); ?>
             </td>
				   
				    <td>  
                <span class="lead">Longitude : </span>  
                <input style=" cursor: no-drop;" type="text" name="longitude" id="longitude" readonly="readonly" required="true"> 
                <?= form_error('longitude', '<div class="error">', '</div>'); ?>
            </td>
				    
				  </tr>
				  <tr>
				    <td colspan="2"> <button type="submit" class="btn btn-primary">SAVE</button></td>
				  </tr>
				</table>

    		</div>		<!-- <div class="col-md-8"> -->
		</div>	 <!-- <div class="row"> -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				
				<div class="box-header">
                  <h3 class="box-title">Add Items</h3>
                </div><!-- /.box-header -->

	      		<div class="box-body">  

				    <div class="row custombr" id="item_choice"> 
					    <div class="col-xs-6">
					    	 <div id="image_preview" style="text-align:center;">
                              
                                <a href="#" id="upload_image_icon"> 
                                 <img id="previewing" src="<?php echo base_url().$add_image?>" class="img-thumbnail" style="width:200px"/>
                                </a>
                            	<input type="file" id="file"  name="item_img_org" style="display:none" />

                              </div><!-- image_preview -->
					    </div><!-- <div class="col-xs-6"> -->
					    <br><br><br><br>
	                    <div class="col-xs-4">
	                    
	                        <select name="item_category_org" class="form-control" required>
	                           
	                              <?php  foreach ($item_category as $category_data): ?>

	                                <option value="<?= $category_data->id ?>"> <?= $category_data->type ?></option>
	                              <?php endforeach; ?>  
	                        </select>

	                 
	                    </div> <!-- <div class="col-xs-4"> -->
	                    
	                    <div class="col-xs-2">
	                        <span onclick="plus_click()">
	                            <i class="glyphicon glyphicon-plus-sign custom"></i>
	                        </span>  
	                    </div> <!-- <div class="col-xs-2"> -->

	                </div>  <!-- <div class="row"> -->  

	                

	        	</div> <!-- <div class="box-body">  -->
	   		</div>   <!-- <div class="box box-primary"> -->
	   	</div>  <!-- <div class="col-xs-12"> -->	
	</div> <!-- <div class="row"> -->

</section>   <!-- <section class="content"> -->
	

</div> <!-- <div class="content-wrapper"> -->
 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=#YOUR-GOOGLE-API-KEY#&sensor=false"></script>  
 <script type="text/javascript"> 
   function plus_click()
  {
    var out = '<div class="row custombr">';

    out += '<div class="col-xs-6">';
    out += '<div id="image_preview" style="text-align:center;">';
    out += '<a class="upload_image_icon_test">';
    out += '<img id="previewing" src="<?php echo base_url().$add_image?>" class="img-thumbnail" style="width:200px"/>';
    out += '</a>';
    out += '<input type="file" id="file1"  name="userfile[]" style="display:none" />';
    out += '</div>';
    out += '</div>';

	out += ' <br><br><br><br>';				    	 
                              
    out += '<div class="col-xs-4">';
    out += '<select name="item_category[]" class="form-control" >';
    //out += '<option value="">Please Choose Item</option>';
    out += ' <?php  foreach ($item_category as $category_data): ?>';
    out += '<option value="<?= $category_data->id ?>"> <?= $category_data->type ?></option>';
    out += ' <?php endforeach; ?> ';
    out += '</select>';
    out += '</div>';                
                        
    out += '<div class="col-xs-2">';
    out += '<span  ><i class="glyphicon glyphicon-minus-sign custom_minus"></i></span>';
    out += '</div>';
    out += '</div>';   
                           
                              
    $(out).insertAfter("#item_choice");

    $( ".custom_minus" ).on( "click", function(event) {
        // console.log(this);
        $(this).parents(".custombr").remove();
    });

      $(".upload_image_icon_test").click(function(e) 
     {
        $("#file1").trigger('click');
         e.preventDefault();
    });

  }
</script>
<script type="text/javascript">


     $("#upload_image_icon").click(function(e) 
     {
        $("#file").trigger('click');
         e.preventDefault();
    });

   

    $('a.icon_fa').click(function(e)
    {
        e.preventDefault();
    });
    
    
</script>
<script src="<?=base_url($script)?>"></script>
<?= form_close();?>


