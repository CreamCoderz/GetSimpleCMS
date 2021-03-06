<?php 
/**
 * Load Plugin
 *
 * Displays the plugin file passed to it 
 *
 * @package GetSimple
 * @subpackage Plugins
 */


# Setup inclusions
$load['plugin'] = true;
include('inc/common.php');
login_cookie_check();

# verify a plugin was passed to this page
if (!isset($_GET['id'])) {
	redirect('plugins.php');
}

# include the plugin
$plugin_id = $_GET['id'];
global $plugin_info;

get_template('header', cl($SITENAME).' &raquo; '. $plugin_info[$plugin_id]['name']); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main">

		<?php 
			call_user_func_array($plugin_info[$plugin_id]['load_data'],array()); 
		?>

		</div>
	</div>
	
	<div id="sidebar" >
    <?php 
      $res = (@include('template/sidebar-'.$plugin_info[$plugin_id]['page_type'].'.php'));
      if (!$res) { 
    ?>
      <ul class="snav">
        <?php exec_action($plugin_info[$plugin_id]['page_type']."-sidebar"); ?>
      </ul>
    <?php
	}
	// call sidebar extra hook for plugin page_type
	exec_action($plugin_info[$plugin_id]['page_type']."-sidebar-extra");     
    ?>
  </div>

</div>
<?php get_template('footer'); ?>