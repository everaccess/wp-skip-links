<?php
function wpsl_panel_assets( $hook ) {
	if($hook == 'accessibility_page_submenu-page' || $hook == 'post.php' || $hook == 'post-new.php' ) {
		wp_enqueue_style( 'ea-skiplinks-admin-css', plugins_url('assets/css/admin.css', __FILE__) );
		wp_enqueue_script('ea-skiplinks-admin-js',  plugins_url('assets/js/everaccess-skiplinks-admin.js', __FILE__), array('jquery', 'jquery-ui-sortable') );
	}
}
add_action( 'admin_enqueue_scripts', 'wpsl_panel_assets' );