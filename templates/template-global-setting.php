<?php
?>
<h3>Location Pages Modules Setting</h3>
            <form action="" method="post">
                <table class="form-table">
                    <tr>
                        <th><label for="background_image"><?php  printf( __( 'Back Ground Image', 'location-module' ));?></label></th>
                        <td>
                            <input id="upload_image" type="text" name="upload_image" style="width: 80%" value="<?php echo get_option( 'backgournd_image' );  ?>" />
                            <input id="upload_image_button" type="button" value="Upload Image" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="main_key_phrase"><?php  printf( __( 'Main Key Phrase.', 'location-module' ));?></label></th>
                        <td><input type="text" name="main_key_phrase" id="main_key_phrase" class="regular-text" value="<?php echo get_option( 'main_key_phrase' ); ?>" style="width: 90%;"></td>
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
                            <input id="first_selling_icon" type="text"  name="first_selling_icon" style="width: 80%" value="<?php echo get_option( 'first_selling_icon' );  ?>" />
                            <input id="first_selling_button" type="button" value="Upload Image" />
                       </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="first_icon_color"><?php  printf( __( 'Put Icon color Like(#000)', 'location-module' ));?></label>
                        </th>
                        <td>
                            <input id="first_icon_color" type="text"  name="first_icon_color" style="width: 80%" value="<?php echo get_option('first_icon_color'); ?>">
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
                            <input id="second_selling_icon" type="text" name="second_selling_icon" style="width: 80%" value="<?php echo get_option( 'second_selling_icon' );  ?>" />
                            <input id="second_selling_button" type="button" value="Upload Image" />
                       </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="second_icon_color"><?php  printf( __( 'Put Icon color Like(#000)', 'location-module' ));?></label>
                        </th>
                        <td>
                            <input id="second_icon_color" type="text"  name="second_icon_color" style="width: 80%" value="<?php echo get_option('second_icon_color'); ?>">
                       </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="second_selling_point"><?php  printf( __( 'Second Selling Point Content', 'location-module' ));?></label>
                        </th>
                        <?php $first_selling_point = get_option("second_selling_content"); ?>
                        <td><?php wp_editor( wpautop($first_selling_point), 'second_selling_content'); ?></td>
                    </tr>
                    <tr>
                        <th>
                            <label for="third_selling_point"><?php  printf( __( 'Choose Third Selling Icon', 'location-module' ));?></label>
                        </th>
                        <td>
                            <input id="third_selling_icon" type="text" name="third_selling_icon" style="width: 80%" value="<?php echo get_option( 'third_selling_icon' );  ?>" />
                            <input id="third_selling_button" type="button" value="Upload Image" />
                       </td>
                    </tr>
                     <tr>
                        <th>
                            <label for="third_icon_color"><?php  printf( __( 'Put Icon color Like(#000)', 'location-module' ));?></label>
                        </th>
                        <td>
                            <input id="third_icon_color" type="text"  name="third_icon_color" style="width: 80%" value="<?php echo get_option('third_icon_color'); ?>">
                       </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="third_selling_point"><?php  printf( __( 'Third Selling Point Content', 'location-module' ));?></label>
                        </th>
                        <?php $first_selling_point = get_option("third_selling_content"); ?>
                        <td><?php wp_editor( wpautop($first_selling_point), 'third_selling_content'); ?></td>
                    </tr>
                    <tr>
                        <th><label for="banner_text"><?php  printf( __( 'Banner Text', 'location-module' ));?></label></th>
                        <td><?php $banner_text = get_option("banner_text");
                            wp_editor( wpautop($banner_text), 'banner_text', array() ); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="button_text"><?php  printf( __( 'Button Text', 'location-module' ));?></label></th>
                        <td><input type="text" name="button_text" id="button_text" class="regular-text" value="<?php echo get_option("button_text"); ?>" style="width: 90%;"></td>
                    </tr>
                    <tr>
                        <th><label for="booking_link_url"><?php  printf( __( 'Booking Link URL', 'location-module' ));?></label></th>
                        <td><input type="text" name="booking_link_url" id="booking_link_url" class="regular-text" value="<?php echo get_option("booking_link_url"); ?>" style="width: 90%;"></td>
                    </tr>
                    <tr>
                        <th><label for="contact_details"><?php  printf( __( 'Contact Details', 'location-module' ));?></label></th>
                       <?php $contact_details = get_option("contact_details");
                        ?>
                        <td><?php
                          $settings = array('wpautop' => true,
                                                );
                          wp_editor( get_option("contact_details"), 'contact_details',  $settings ); ?></td> 
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Save"></td>
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

            });
        </script>

        <?php 
        global $wp_db;
       if(isset($_POST['submit'])){
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
                   if (isset( $_POST['first_selling_icon'] ) ) {
                   $shortcode_data =  $_POST['first_selling_icon'];
                   update_option('first_selling_icon',$shortcode_data,'', 'yes' );
                    }
                    if (isset( $_POST['first_icon_color'] ) ) {
                   $shortcode_data =  $_POST['first_icon_color'];
                   update_option('first_icon_color',$shortcode_data,'', 'yes' );
                    }
                   if (isset( $_POST['first_selling_content'] ) ) {
                   $shortcode_data =  $_POST['first_selling_content'];
                   update_option('first_selling_content',$shortcode_data,'', 'yes' );
                    }
                    if (isset( $_POST['second_selling_icon'] ) ) {
                   $shortcode_data =  $_POST['second_selling_icon'];
                   update_option('second_selling_icon',$shortcode_data,'', 'yes' );
                    }
                    if (isset( $_POST['second_selling_content'] ) ) {
                   $shortcode_data =  $_POST['second_selling_content'];
                   update_option('second_selling_content',$shortcode_data,'', 'yes' );
                    }
                    if (isset( $_POST['second_icon_color'] ) ) {
                   $shortcode_data =  $_POST['second_icon_color'];
                   update_option('second_icon_color',$shortcode_data,'', 'yes' );
                    }
                   if (isset( $_POST['third_selling_content'] ) ) {
                   $shortcode_data =  $_POST['third_selling_content'];
                   update_option('third_selling_content',$shortcode_data,'', 'yes' );
                    }
                    if (isset( $_POST['third_selling_icon'] ) ) {
                   $shortcode_data =  $_POST['third_selling_icon'];
                   update_option('third_selling_icon',$shortcode_data,'', 'yes' );
                    }
                    if (isset( $_POST['third_icon_color'] ) ) {
                   $shortcode_data =  $_POST['third_icon_color'];
                   update_option('third_icon_color',$shortcode_data,'', 'yes' );
                    }
                   if (isset( $_POST['third_selling_content'] ) ) {
                   $shortcode_data =  $_POST['third_selling_content'];
                   update_option('third_selling_content',$shortcode_data,'', 'yes' );
                    }
                   $button_text = $_POST['button_text'];
                   update_option('button_text',$button_text,'', 'yes' );
                   $booking_link_url = $_POST['booking_link_url'];
                   update_option('booking_link_url',$booking_link_url,'', 'yes' );
                   $banner_text = $_POST['banner_text'];
                   update_option('banner_text',$banner_text,'', 'yes' );
                   $main_block_of_text = $_POST['main_block_of_text'];
                   update_option('main_block_of_text',$main_block_of_text,'', 'yes' );
                   $contact_details = $_POST['contact_details'];
                   update_option('contact_details',$contact_details,'', 'yes' );
                  
              }
    
?>