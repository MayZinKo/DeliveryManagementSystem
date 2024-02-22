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
<?php $assign_view_css=$this->config->item('assign_view_css'); ?>
<link rel="stylesheet" type="text/css" href="<?=base_url($assign_view_css)?>">

<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDCrhhXV5hmkXJDdWkCuXjGBakTqyYceA&callback=initMap"></script>  

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
			$action_go="Customer/save"; 
			$attributes = array('method' => 'post','enctype'=>'multipart/form-data');	
?>
<?php echo form_open($action_go,$attributes);?>	

<input type="text" value="<?='s'?>" hidden="true" name="status">

<div class="content-wrapper">



<section class="content">
	 <div class="row">
            <!-- left column -->
            
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?=$page_label_2?> Create</h3>
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
    <td>  <span class="lead">Latitude : </span>   <input style=" cursor: no-drop;" type="text" name="latitude" id="latitude" readonly="readonly" required="true"> </td>
   
    <td>  <span class="lead">Longitude : </span>  <input style=" cursor: no-drop;" type="text" name="longitude" id="longitude" readonly="readonly" required="true"> </td>
    
  </tr>
  <tr>
    <td colspan="2"> <button type="submit" class="btn btn-primary">SAVE</button></td>
  </tr>
</table>

                   


             </div>		<!-- <div class="col-md-8"> -->

           </div>	 <!-- <div class="row"> -->

</section>   <!-- <section class="content"> -->
	
<?= form_close();?>
</div> <!-- <div class="content-wrapper"> -->
 <script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDCrhhXV5hmkXJDdWkCuXjGBakTqyYceA&callback=initMap"></script>  





