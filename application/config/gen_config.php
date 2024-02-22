<?php
/* ------------ MAIN ---------------- */
$config['header'] = 'includes/header.php';
$config['footer'] = 'includes/footer.php';

$config['header_courier'] = 'includes/header_courier.php';
/* ------------ MAIN ---------------- */

/* ------------ Header Active ---------------- */
$config['header_active']=
		array('start' => "start",
			  'start_unassign' => "start_unassign",
			  'start_pending' => "start_pending",
			  'end' => "end",
			  'end_unassign' => "end_unassign",
			  'end_pending' => "end_pending",
			  'unassign'=>"unassign",
			  'pending'=>"pending"
			  );
/* ------------ Header Active ---------------- */

/* ------------ Template CSS ---------------- */
$config['bootstrap_css'] = 'public/bootstrap/css/bootstrap.min.css';
$config['template_css'] = 'public/template/css/AdminLTE.css';
$config['skin_css'] = 'public/template/css/skins/_all-skins.min.css';
$config['font_css'] = 'public/template/css/font.css';
/* ------------ Template CSS ---------------- */

/* ------------ Template JS ---------------- */
$config['main_jquery'] = 'public/jQuery/jQuery-2.1.4.min.js';
$config['bootstrap_js'] = 'public/bootstrap/js/bootstrap.js';
$config['app_js'] = 'public/template/js/app.js';
$config['demo_js'] = 'public/template/js/demo.js';
$config['dashboard_js'] = 'public/template/js/pages/dashboard.js';
/* ------------ Template JS ---------------- */

/* ------------ Custom CSS ---------------- */
$config['assign_view_css'] = 'public/custom/assign_view_css.css';
$config['item_create'] = 'public/custom/item_create.css';
/* ------------ Custom CSS ---------------- */

/* ------------ Custom JS ---------------- */
$config['routemap_js'] = 'public/jQuery/routemap.js';
/* ------------ Custom JS ---------------- */

/* ------------ Image Extensions ---------------- */
$config['img_allow_type'] = 'gif|jpg|png|jpeg';
$config['profile_image'] ='profile.png';
$config['profile_image_extension'] ='images/users/';
$config['item_category_image_extension'] ='images/item_categories/';
/* ------------ Image Extensions ---------------- */

/* ------------ Customer Views ---------------- */
$config['create'] ='front_end/customer/create';

$config['unassign2'] ='front_end/customer/unassign2';
$config['pending2'] ='front_end/customer/pending2';

$config['end_customer_list'] ='front_end/customer/end_customer_list.php';

$config['start_unassign'] ='front_end/customer/start_unassign.php';
$config['start_pending'] ='front_end/customer/start_pending.php';

$config['complete_list'] ='front_end/customer/complete_list.php';

$config['end_unassign'] ='front_end/customer/end_unassign.php';
$config['end_pending'] ='front_end/customer/end_pending.php';
/* ------------ Customer Views ---------------- */

/* ------------ Assign Views ---------------- */
$config['assign'] ='front_end/assign/assign';
$config['assign_courier'] ='front_end/assign/assign_courier';
$config['assign_courier_all_route'] ='front_end/assign/show_all_route.php';
$config['assign_controller'] ='Assign/view';
/* ------------ Assign Views ---------------- */

/* ------------ Order Views ---------------- */
$config['euser_item_create'] ='front_end/order/user_item_create.php';
$config['order_controller'] ='Order/view';
/* ------------ Order Views ---------------- */

/* ------------ Courier Views ---------------- */
$config['today_list'] ='front_end/courier/today_list.php';
/* ------------ Courier Views ---------------- */

/* ------------ Datatable Plugin ---------------- */
$config['datatable_bootstrap_css'] ='public/plug_in/datatables/dataTables.bootstrap.css';
$config['datatable_jquery_css'] ='public/plug_in/datatables/jquery.dataTables.min.css';
$config['datatable_jquery_js'] ='public/plug_in/datatables/jquery.dataTables.min.js';
$config['datatable_bootstrap_js'] ='public/plug_in/datatables/dataTables.bootstrap.min.js';
/* ------------ Datatable Plugin ---------------- */


/* ------------ Image Upload Plugin ---------------- */
$config['add_image_icon'] ='public/plug_in/image_upload/img_upload.png';
$config['script'] ='public/plug_in/image_upload/script.js';
/* ------------ Image Upload Plugin ---------------- */


?>