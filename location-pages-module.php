<?php 
/**
* Plugin Name: Location Pages Module
* Plugin URI: https://wordpress.org/plugins/
* Description: With this plugin, location pages can be added to WordPress sites.
* Version: 1.0.0
* Author: Dijitul
* Author URI: 
* Text Domain: location-module
* License: 
*/

add_theme_support( 'post-thumbnails' ); 


// add locations post type
add_action( 'init', 'locations_register_post_type' );
// add css
wp_enqueue_style( 'locations',  plugin_dir_url( __FILE__ ) . '/assets/css/locations.css' ); 
wp_enqueue_style( 'admin-css',  plugin_dir_url( __FILE__ ) . '/assets/css/admin-dashboard.css' ); 

//create post type location
function locations_register_post_type() 
{
    $args=array(
    'label' => 'Locations',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'rewrite' => array
    (
        'slug' => 'locations',
        'with_front' => false
    ),
    'query_var' => true,
    'supports' => array
    (
        'title',
        'editor',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'revisions',
        'thumbnail',
        'author',
        'page-attributes'
    )
    ); 
    register_post_type( 'locations', $args );
}

// add shortcode for location index page
// add area covered pages
function add_areas_covered_page() 
{
    // Create post object
    global $wpdb;
    $current_user = wp_get_current_user();
    $my_post = array
    (
        'post_title'    => 'Areas Covered',
        'post_content'  => '[locations-listing]',
        'post_status'   => 'publish',
        'post_author'   => $current_user->ID,
        'post_type'     => 'page',
    );
    // Insert the post into the database
    wp_insert_post( $my_post );
}
add_shortcode('locations-listing' , 'areas_covered_pages');

//Template Area Cover include
function areas_covered_pages()
{
  ob_start();
  if ( file_exists( plugin_dir_path( __FILE__ ) . 'templates/template-areas-covered.php' ) ) 
  {
    include(plugin_dir_path( __FILE__ ) . 'templates/template-areas-covered.php');
  }
  return ob_get_clean();
} 

//upload image to media library
    function my_admin_scripts() {    
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
       //wp_register_script('my-upload', plugin_dir_path( __FILE__ ).'/assets/js/customscript.js', array('jquery','media-upload','thickbox'));
       //wp_enqueue_script('my-upload');
    }
 
    function my_admin_styles() {
        wp_enqueue_style('thickbox');
    }

// better use get_current_screen(); or the global $current_screen
    if (isset($_GET['page']) && $_GET['page'] == 'my_plugin_page') {
        add_action('admin_print_scripts', 'my_admin_scripts');
        add_action('admin_print_styles', 'my_admin_styles');
    }
    //end upload meida library functionn


// add single page
add_filter( 'single_template', 'single_page_added' );
function single_page_added( $page_template )
    {
        $queried_post_type = get_query_var('post_type');
        if (is_single() && 'locations' == $queried_post_type) {
            $page_template = dirname( __FILE__ ) . '/single-locations.php';
        }
        return $page_template;
    }

/** Add Admin menu */
function register_my_custom_menu_page()
{
    add_menu_page( 'Location Pages Module','Location Pages Module','manage_options','locationpagesetting','location_pages_modules','dashicons-location-alt',80 ); 
}
add_action( 'admin_menu', 'register_my_custom_menu_page' ); 

/**
 * Display a custom menu page
 */
function location_pages_modules()
{
 ?>
    <div class="para">
        <h3>Put Location Name Through CSV File</h3>
        <form method='post' action='<?= $_SERVER['REQUEST_URI']; ?>' enctype='multipart/form-data'>
            <div class="upload-box adding-box">
                <input type="file" name="import_file" >
                <input type="submit" name="butimport" value="Import">
            </div>
        </form>
    </div>
    <?php
    global $wpdb;
    // Table name
    $tablename = $wpdb->prefix."posts";
    if(isset($_POST['butimport'])){

  // File extension
  $extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);

  // If file extension is 'csv'
  if(!empty($_FILES['import_file']['name']) && $extension == 'csv'){

    $totalInserted = 0;

    // Open file in read mode
    $csvFile = fopen($_FILES['import_file']['tmp_name'], 'r');

    fgetcsv($csvFile); // Skipping header row

    // Read file
    while(($csvData = fgetcsv($csvFile)) !== FALSE){
      $csvData = array_map("utf8_encode", $csvData);

      // Row column length
      $dataLen = count($csvData);

      // Skip row if length != 4
      if( !($dataLen == 1) ) continue;

      // Assign value to variables
      $name = trim($csvData[0]);

      // Check record already exists or not
      //$query = $wpdb->prepare('SELECT * FROM ' . $wpdb->posts . ' WHERE post_title = %s', $name);
            $record = $wpdb->get_row( "SELECT * FROM $tablename WHERE post_title = '" . $name . "' && post_status = 'publish' && post_type = 'locations' ", 'ARRAY_N' );

      //$record = $wpdb->get_results($query, OBJECT);

      if(empty($record)){

        // Check if variable is empty or not
        if(!empty($name)) {
            $post_id = wp_insert_post( array(
                    'post_status' => 'publish',
                    'post_type' => 'locations',
                    'post_title' => $name
                ) );
           
            $totalInserted++;
        }

      }

    }
    echo "<h3 style='color: green;'>Total record Inserted : ".$totalInserted."</h3>";


  }else{
    echo "<h3 style='color: red;'>Invalid Extension</h3>";
  }

}
?>
        <h3>Location Pages Modules Setting</h3>
        <form action="" method="post">
            <table class="form-table">
                <tr>
                    <td class="save-btn" colspan="2"><input type="submit" name="submit" value="Save"></td>
                </tr>
                <tr>
                    <th><label for="background_image"><?php  printf( __( 'Back Ground Image', 'location-module' ));?></label></th>
                    <td class="upload-box-outer">
                        <div class="upload-box">
                            <input id="upload_image" type="text" name="upload_image" value="<?php echo get_option( 'backgournd_image' );  ?>" />
                            <input id="upload_image_button" type="button" value="Upload Image" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><label for="main_key_phrase"><?php  printf( __( 'Main Key Phrase.', 'location-module' ));?></label></th>
                    <td>
                        <!-- <textarea name="main_key_phrase" id="main_key_phrase" class="regular-text"  style="width: 100%; height: 100px"><?php echo get_option( 'main_key_phrase' ); ?></textarea> -->
                          <?php
                           
                                $get_key_phrse_array = get_option('main_key_phrase');
                                $result = explode(",", $get_key_phrse_array );
                                $i=0;
                               foreach ($result  as $key_phrase)
                                {
                                
                             ?> 
                         <div id="dynamic-field-<?php echo $i+1; ?>" class="form-group dynamic-field">

                          
                          <label for="field" class="font-weight-bold"><?php echo $i+1; ?></label>
                          <input type="text" id="main_key_phrase" name="main_key_phrase[]" value="<?php echo $key_phrase; ?>" />
                         
                        </div>
                         <?php $i++;  }   ?>
                        <div class="clearfix mt-4">
                          <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fas fa-plus fa-fw"></i> Add</button>
                          <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" ><i class="fas fa-minus fa-fw"></i> Remove</button>
                        </div>
                        
                    </td>
                </tr>
                <tr>
                    <th><label for="form_shortcode"><?php  printf( __( 'Form shortcode Embed.', 'location-module' ));?></label></th>
                    <td><?php $form_shortcode = get_option( 'form_shortcode' );  
                        wp_editor( $form_shortcode, 'form_shortcode', array() ); ?></td>
                </tr>
                <tr>
                    <th><label for="main_block_of_text"><?php  printf( __( 'Main block of Text', 'location-module' ));?></label></th>
                        <!-- <td><input type="text" name="main_block_of_text" id="main_block_of_text" class="regular-text" value=""></td> -->
                        <?php $main_block_of_text = get_option("main_block_of_text"); ?>
                    <td><?php wp_editor( wpautop($main_block_of_text), 'main_block_of_text'); ?></td>
                </tr>
                <tr>
                    <th>
                        <label for="first_selling_point"><?php  printf( __( 'Choose First Selling Icon', 'location-module' ));?></label>
                    </th>
                    <td>
                        <div class="upload-box">
                            <input id="first_selling_icon" type="text"  name="first_selling_icon" value="<?php echo get_option( 'first_selling_icon' );  ?>" />
                            <input id="first_selling_button" type="button" value="Upload Image" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="first_icon_color"><?php  printf( __( 'Put Icon color Like(#000)', 'location-module' ));?></label>
                    </th>
                    <td>
                        <input id="first_icon_color" type="text"  name="first_icon_color" value="<?php echo get_option('first_icon_color'); ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="first_selling_point"><?php  printf( __( 'First Selling Point Content', 'location-module' ));?></label>
                    </th>
                    <?php $first_selling_point = get_option("first_selling_content"); ?>
                    <td><?php wp_editor( wpautop($first_selling_point), 'first_selling_content'); ?></td>
                </tr>
                <tr>
                    <th>
                        <label for="first_selling_point"><?php  printf( __( 'Choose Second Selling Icon', 'location-module' ));?></label>
                    </th>
                    <td>
                        <div class="upload-box">
                            <input id="second_selling_icon" type="text" name="second_selling_icon" value="<?php echo get_option( 'second_selling_icon' );  ?>" />
                            <input id="second_selling_button" type="button" value="Upload Image" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="second_icon_color"><?php  printf( __( 'Put Icon color Like(#000)', 'location-module' ));?></label>
                        </th>
                    <td>
                        <input id="second_icon_color" type="text"  name="second_icon_color" value="<?php echo get_option('second_icon_color'); ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="second_selling_point"><?php  printf( __( 'Second Selling Point Content', 'location-module' ));?></label>
                    </th>
                    <?php $second_selling_point = get_option("second_selling_content"); ?>
                    <td><?php wp_editor( wpautop($second_selling_point), 'second_selling_content'); ?></td>
                </tr>
                <tr>
                    <th>
                        <label for="third_selling_point"><?php  printf( __( 'Choose Third Selling Icon', 'location-module' ));?></label>
                    </th>
                    <td>
                        <div class="upload-box">
                            <input id="third_selling_icon" type="text" name="third_selling_icon" value="<?php echo get_option( 'third_selling_icon' );  ?>" />
                            <input id="third_selling_button" type="button" value="Upload Image" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="third_icon_color"><?php  printf( __( 'Put Icon color Like(#000)', 'location-module' ));?></label>
                        </th>
                    <td>
                        <input id="third_icon_color" type="text"  name="third_icon_color" value="<?php echo get_option('third_icon_color'); ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="third_selling_point"><?php  printf( __( 'Third Selling Point Content', 'location-module' ));?></label>
                    </th>
                    <?php $third_selling_point = get_option("third_selling_content"); ?>
                    <td><?php wp_editor( wpautop($third_selling_point), 'third_selling_content'); ?></td>
                </tr>
                <tr>
                    <th><label for="banner_text"><?php  printf( __( 'Banner Text', 'location-module' ));?></label></th>
                    <td><?php $banner_text = get_option("banner_text");
                            wp_editor( wpautop($banner_text), 'banner_text') ?>
                    </td>
                </tr>
                <tr>
                    <th><label for="banner_background_image"><?php  printf( __( 'Banner Background Image', 'location-module' ));?></label></th>
                    <td>
                        <input id="banner_background_image" type="text"  name="banner_background_image" style="width: 80%" value="<?php echo get_option( 'banner_background_image' );  ?>" />
                        <input id="banner_background_button" type="button" value="Upload Image" />
                    </td>
                </tr>
                <tr>
                    <th><label for="button_text"><?php  printf( __( 'Button Text', 'location-module' ));?></label></th>
                    <td><input type="text" name="button_text" id="button_text" class="regular-text" value="<?php echo get_option("button_text"); ?>" ></td>
                </tr>
                <tr>
                    <th><label for="booking_link_url"><?php  printf( __( 'Booking Link URL', 'location-module' ));?></label></th>
                    <td><input type="text" name="booking_link_url" id="booking_link_url" class="regular-text" value="<?php echo get_option("booking_link_url"); ?>" ></td>
                </tr>
                <tr>
                    <th><label for="contact_details"><?php  printf( __( 'Contact Details', 'location-module' ));?></label></th>
                    <td><?php
                        $contact_details = get_option("contact_details");
                        wp_editor( wpautop($contact_details), 'contact_details'); ?></td> 
                </tr>
                <tr>
                    <td class="save-btn" colspan="2"><input type="submit" name="submit" value="Save"></td>
                </tr>
            </table>
        </form>
        <script type="text/javascript">
            jQuery(document).ready( function( $ ) {
                $('#upload_image_button').click(function() {
                    formfield = $('#upload_image').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    window.send_to_editor = function(html) {
                       imgurl = $(html).attr('src');
                       $('#upload_image').val(imgurl);
                       tb_remove();
                    }

                    return false;
                });
                $('#first_selling_button').click(function() {
                    formfield = $('#first_selling_icon').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    window.send_to_editor = function(html) {
                       imgurl = $(html).attr('src');
                       $('#first_selling_icon').val(imgurl);
                       tb_remove();
                    }

                    return false;
                });
                $('#second_selling_button').click(function() {
                    formfield = $('#second_selling_icon').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    window.send_to_editor = function(html) {
                       imgurl = $(html).attr('src');
                       $('#second_selling_icon').val(imgurl);
                       tb_remove();
                    }

                    return false;
                });
                $('#third_selling_button').click(function() {
                    formfield = $('#third_selling_icon').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    window.send_to_editor = function(html) {
                       imgurl = $(html).attr('src');
                       $('#third_selling_icon').val(imgurl);
                       tb_remove();
                    }

                    return false;
                });
                $('#banner_background_button').click(function() {
                    formfield = $('#banner_background_image').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    window.send_to_editor = function(html) {
                       imgurl = $(html).attr('src');
                       $('#banner_background_image').val(imgurl);
                       tb_remove();
                    }

                    return false;
                });

              var buttonAdd = $("#add-button");
              var buttonRemove = $("#remove-button");
              var className = ".dynamic-field";
              var count = 0;
              var field = "";
              var maxFields = 50;

              function totalFields() {
                return $(className).length;
              }

              function addNewField() {
                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("" + count);
                field.find("input").val("");
                $(className + ":last").after($(field));
              }

              function removeLastField() {
                if (totalFields() > 1) {
                  $(className + ":last").remove();
                }
              }

              function enableButtonRemove() {
                if (totalFields() === 2) {
                  buttonRemove.removeAttr("disabled");
                  buttonRemove.addClass("shadow-sm");
                }
              }

              function disableButtonRemove() {
                if (totalFields() === 1) {
                  buttonRemove.attr("disabled", "disabled");
                  buttonRemove.removeClass("shadow-sm");
                }
              }

              function disableButtonAdd() {
                if (totalFields() === maxFields) {
                  buttonAdd.attr("disabled", "disabled");
                  buttonAdd.removeClass("shadow-sm");
                }
              }

              function enableButtonAdd() {
                if (totalFields() === (maxFields - 1)) {
                  buttonAdd.removeAttr("disabled");
                  buttonAdd.addClass("shadow-sm");
                }
              }

              buttonAdd.click(function() {
                addNewField();
                enableButtonRemove();
                disableButtonAdd();
              });

              buttonRemove.click(function() {
                removeLastField();
                //disableButtonRemove();
                enableButtonAdd();
              });

            });
        </script>
   <?php
}
    global $wp_db;
       if(isset($_POST['submit']))
       {
                    if (isset( $_POST['form_shortcode'] ) ) {
                   $bockground_image = $_POST['upload_image'];
                   update_option('backgournd_image',$bockground_image,'', 'yes' );
                   }
                   $main_key_phrase = $_POST['main_key_phrase'];
                   update_option('main_key_phrase',$main_key_phrase,'', 'yes' );
                   if (isset( $_POST['form_shortcode'] ) ) {
                   $shortcode_data =  $_POST['form_shortcode'];
                   update_option('form_shortcode',$shortcode_data,'', 'yes' );
                   }
                   if(isset($_POST['main_block_of_text'])){
                   $main_block_of_text = $_POST['main_block_of_text'];
                   update_option('main_block_of_text',$main_block_of_text,'', 'yes' );
                    }
                   if (isset( $_POST['first_selling_icon'] ) ) {
                   $first_selling_icon =  $_POST['first_selling_icon'];
                   update_option('first_selling_icon',$first_selling_icon,'', 'yes' );
                    }
                    if (isset( $_POST['first_icon_color'] ) ) {
                   $first_icon_color =  $_POST['first_icon_color'];
                   update_option('first_icon_color',$first_icon_color,'', 'yes' );
                    }
                   if (isset( $_POST['first_selling_content'] ) ) {
                   $first_selling_content =  $_POST['first_selling_content'];
                   update_option('first_selling_content',$first_selling_content,'', 'yes' );
                    }
                    if (isset( $_POST['second_selling_icon'] ) ) {
                   $second_selling_icon =  $_POST['second_selling_icon'];
                   update_option('second_selling_icon',$second_selling_icon,'', 'yes' );
                    }
                    if (isset( $_POST['second_selling_content'] ) ) {
                   $second_selling_content =  $_POST['second_selling_content'];
                   update_option('second_selling_content',$second_selling_content,'', 'yes' );
                    }
                    if (isset( $_POST['second_icon_color'] ) ) {
                   $second_icon_color =  $_POST['second_icon_color'];
                   update_option('second_icon_color',$second_icon_color,'', 'yes' );
                    }
                   if (isset( $_POST['third_selling_content'] ) ) {
                   $third_selling_content =  $_POST['third_selling_content'];
                   update_option('third_selling_content',$third_selling_content,'', 'yes' );
                    }
                    if (isset( $_POST['third_selling_icon'] ) ) {
                   $third_selling_icon =  $_POST['third_selling_icon'];
                   update_option('third_selling_icon',$third_selling_icon,'', 'yes' );
                    }
                    if (isset( $_POST['third_icon_color'] ) ) {
                   $third_icon_color =  $_POST['third_icon_color'];
                   update_option('third_icon_color',$third_icon_color,'', 'yes' );
                    }
                   if (isset( $_POST['third_selling_content'] ) ) {
                   $third_selling_content =  $_POST['third_selling_content'];
                   update_option('third_selling_content',$third_selling_content,'', 'yes' );
                    }
                    if(isset($_POST['banner_text']) ){
                   $banner_text = $_POST['banner_text'];
                   update_option('banner_text',$banner_text,'', 'yes' );
                   }
                   if(isset($_POST['banner_background_image'])){
                    $banner_background_image = $_POST['banner_background_image'];
                    update_option('banner_background_image',$banner_background_image,'','yes');
                   }
                   if(isset($_POST['button_text'])){
                   $button_text = $_POST['button_text'];
                   update_option('button_text',$button_text,'', 'yes' );
                   }
                   if(isset($_POST['booking_link_url'])){
                   $booking_link_url = $_POST['booking_link_url'];
                   update_option('booking_link_url',$booking_link_url,'', 'yes' );
                   }
                   if(isset($_POST['contact_details'])){
                   $contact_details = $_POST['contact_details'];
                   update_option('contact_details',$contact_details,'', 'yes' );
                   }  
        }

// add meta box in location post type
function make_custom_meta_box() 
{
       add_meta_box(
           'custom_meta_box',       // $id
           'Select Main Key Phrase',                  // $title
           'show_custom_meta_box',  // $callback
           'locations',                 // $page
           'normal',                  // $context
           'high'                     // $priority
       );
}
add_action('add_meta_boxes', 'make_custom_meta_box');
    
function show_custom_meta_box() {
        global $post;
       
        // Use nonce for verification to secure data sending
        wp_nonce_field( basename( __FILE__ ), 'wpse_our_nonce' );

        ?>
        <!-- my custom value input -->

         <table class="form-table">
            <tr>
                
                <td>
                <select class="select_main_key" name="select_main_key">
                <option value="">Choose here</option>
                    <?php
                        $post_id = $post->ID;
                        $smk = get_post_meta($post_id,'_select_main_key',true); 
                        $main_key_values = get_option( 'main_key_phrase' );
                        $final_val = explode(",", $main_key_values);
                    foreach ($final_val as $val) {
                        ?>
                    <option value="<?php echo $val; ?>" <?php echo $smk == $val ? 'selected' : ''; ?>><?php echo $val; ?></option>
                    <?php
                    } 
                    ?>
                    
                </select></td>
            </tr>
        </table>

        <?php
    }

function save_custom_meta_box()
{
    global $post;
    $post_id = $post->ID;

    if(isset($_POST['publish']) || isset($_POST['save']))
    {
            /*echo '<pre>';
            print_r($_POST); die();*/
        $get_main_value = $_POST['select_main_key'];
        update_post_meta($post_id,'_select_main_key',$get_main_value);

    }
    else
    {
       
    }
}
add_action( 'save_post', 'save_custom_meta_box');

add_filter('pre_get_document_title', 'change_single_page_title', 50);
    function change_single_page_title($title) 
    {
        if (is_single() && 'locations' == get_post_type()) 
        {
            global $post;
            $post_id = get_the_id();
            $get_mainkey_value = get_post_meta($post_id,'_select_main_key',true);
                return $get_mainkey_value .' in '. get_the_title($post_id) .' - '. get_bloginfo('name');
        }
        return $title;
    }
          
function my_plugin_activeted() 
{
    locations_register_post_type();
    add_areas_covered_page();
}

register_activation_hook( __FILE__, 'my_plugin_activeted' );

//register_uninstall_hook( __FILE__, 'my_plugin_uninstall' );
        function my_plugin_deactivate() 
        {
            $mypost = get_page_by_path('areas-covered');            

             if ( $mypost) {
                  // wp_trash_post( $mypost->ID, true );

                wp_delete_post($mypost->ID);
             
                }
             
        }
            
register_deactivation_hook( __FILE__, 'my_plugin_deactivate' );  
               
   
?>