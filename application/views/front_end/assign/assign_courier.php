<?php 
  $profile_image=$this->config->item('profile_image');
  $profile_image_extension=$this->config->item('profile_image_extension');


  $assign_view_css=$this->config->item('assign_view_css');


?>
  <link rel="stylesheet" type="text/css" href="<?=base_url($assign_view_css)?>">

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">


    var markers =<?php echo $routedata ; ?>;
    
    window.onload = function () {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].latitude, markers[0].longitude),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var image = {
          url: '<?=base_url()."images/flag_icons/".$courier_res["marker_img"]?>',      
          size: new google.maps.Size(20, 32),   
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 32)
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        var lat_lng = new Array();
        var latlngbounds = new google.maps.LatLngBounds();
        for (i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.latitude, data.longitude);
            lat_lng.push(myLatlng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: image
            });
            latlngbounds.extend(marker.position);
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
 
        //***********ROUTING****************//
 
        //Initialize the Path Array
        var path = new google.maps.MVCArray();
 
        //Initialize the Direction Service
        var service = new google.maps.DirectionsService();
 
        //Set the Path Stroke Color
        var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });
 
        //Loop and Draw Path Route between the Points on MAP
        for (var i = 0; i < lat_lng.length; i++) {
            if ((i + 1) < lat_lng.length) {
                var src = lat_lng[i];
                var des = lat_lng[i + 1];
                path.push(src);
                poly.setPath(path);
                service.route({
                    origin: src,
                    destination: des,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                }, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                            path.push(result.routes[0].overview_path[i]);
                        }
                    }
                });
            }
        }
    }
</script>




<div class="content-wrapper">
<!-- ************** Breadcrumb ****************** -->
 <section class="content-header">
          <h1>
            <?="Assign"?>
            <small> <?="Assign"?></small>
          </h1>
      <ol class="breadcrumb"> <li><?php echo $this->breadcrumbs->show();  ?></li></ol>
 </section> <!-- <section class="content-header"> -->
<!-- ************** Breadcrumb ****************** -->

<section class="content">
     <div class="row">
      <div class="col-xs-3">
           <!-- ************** Courier List View ****************** -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Courier List</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                 
                  <?php $i=0;?>
                  <?php foreach ($courier_data as $data):?>  
                     <?php 
                          $customer_id=$customer_data['customer_id'];
                          $courier_id=$data['courier_id']; 
                          $user_img=$data['image']; 
                          if($user_img==null || $user_img=="")
                          $user_img=$profile_image_extension.$profile_image;
                          else
                          $cou_img=$profile_image_extension.$user_img;  
                     ?>
                    <li class="item">
                      <div class="product-img">
                        <img src="<?=base_url($cou_img)?>" alt="Product Image"/>
                      </div>
                      <div class="product-info">
                        <a href="<?=base_url('assign/view/'.$status.'/'.$customer_id.'/'.$courier_id)?>" class="product-title"><?=$data['name']?>
                          <span class="label pull-right" id="<?=$data['id']?>courier_assign_count"
                                style="background-color:<?=$data['theme_color']?>">
                            <?=$data['count_assign']?>
                          </span>
                        </a>
                      </div>
                    </li><!-- /.item -->
                    <?php $i++;?>
                   <?php endforeach; ?>   
                   
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
  <!-- ************** Courier List View ****************** -->



  <!-- **************************************************************************************************** -->
 
  


  <!-- ************** All Route Button ****************** -->

  <a href="<?=base_url('assign/view/'.$status.'/'.$customer_id.'/'.'0')?>" class="btn btn-block btn-primary">Show All Route</a>

  <!-- ************** All Route Button ****************** -->
 
 


  <!-- **************************************************************************************************** -->


  <!-- ************** Customer Information ****************** -->
         <div class="box box-primary">
               
                <div class="box-body">
                  <table class="table">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th> Information</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>
                      <td>Name : </td>
                      <td><a href="<?=base_url('assign/view/'.$status.'/'.$customer_id)?>"><?=$customer_data['name']?></a></td>
                    </tr>
                    <tr>
                      <td>Phone : </td>
                      <td><?=$customer_data['phone']?></td>
                    </tr>

                     <tr>
                      <td>Home No : </td>
                      <td><?=$customer_data['home_no']?></td>
                    </tr>
                    <tr>
                      <td>Street : </td>
                      <td><?=$customer_data['street']?></td>
                    </tr>
                    <tr>
                      <td>Road : </td>
                      <td><?=$customer_data['road']?></td>
                    </tr>
                    <tr>
                      <td>Quarter : </td>
                       <td><?=$customer_data['quarter']?></td>
                    </tr>
                    
                     <tr>
                      <td colspan="2">
                <?php  if(isset($check_assign)): ?>
                 
                        <select class="form-control" onchange="courier_assign()" id="courier_assign_id">
                           <?php foreach ($courier_data as $data):?>    

                            <option value="<?=$data['courier_id']?>" 
                            <?php if($data['courier_id']==$check_assign['courier_id']){echo "selected";} ?>
                            ><?=$data['name']?></option>

                           <?php endforeach; ?>
                        </select>

                <?php else:  ?>
                        <select class="form-control" onchange="courier_assign()" id="courier_assign_id">
                           <option value=null>Choose Courier</option> 
                        <?php foreach ($courier_data as $data):?>    
                            <option value="<?=$data['courier_id']?>"><?=$data['name']?></option>
                        <?php endforeach; ?>
                        </select>
                <?php endif;?> 
                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
  <!-- ************** Customer Information ****************** -->
      </div> <!-- <div class="col-xs-3"> -->


<!-- **************************************************************************************************** -->

 <!-- ************** Map Data ****************** -->
      <div class="col-xs-9">
        
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

                        <div id="dvMap" style="width:100%;height:420px;"></div>

                       <!--  <div id="world-map-markers"></div> -->
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div>  <!-- <div class="box box-success"> -->

              <div class="township_save_btn row">
                <div class="col-md-6 text-left">
                  <h3><?=$customer_data['township']?></h3>
                </div> <!-- <div class="col-md-6"> -->
                <div class="col-md-6 text-right">
                  
                </div> <!-- <div class="col-md-6"> -->
              </div>  <!-- <div class="township_save_btn row"> -->

      </div> <!-- <div class="col-xs-9"> -->
   <!-- ************** Map Data ****************** -->
     </div> <!-- <div class="row"> -->
</section> <!-- <section class="content"> -->
</div>  <!-- <div class="content-wrapper"> -->


<script type="text/javascript">

 function courier_assign() 
 {
    var courier_assign_id = $('#courier_assign_id').val();
    var target = {courier_id:courier_assign_id, 
                  customer_type:"<?=$customer_data['customer_type']?>",
                  customer_id:"<?=$customer_data['customer_id']?>",
                  township_id:"<?=$customer_data['township_id']?>"
      }; 

    if(courier_assign_id!="null")
      {
              $.ajax({
                  url: "<?= base_url() ?>Assign/assign_ajax",
                  type: "POST",
                  data: target,
                  success:function(data){
                      json_parse = $.parseJSON(data);
                  
        console.log(json_parse);
        json_parse_courier = $.parseJSON(json_parse.courier_data);
        console.log(json_parse_courier);
         for (i = 0; i < json_parse_courier.length; i++) 
         {
            var count_assign=json_parse_courier[i].count_assign;
            var id_pass='#'+json_parse_courier[i].courier_id+'courier_assign_count';
            $(id_pass).html(count_assign);
         }
window.location.reload();

                  },
                  error:function (){
                      alert("Error!!! Please refresh the page and try again!");
                  }    
          });
      }
 }
</script>
