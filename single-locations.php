<?php
get_header();
$post_id = get_the_id();
?>
<h1></h1>
<body>
	<div class="custom-banner" style="background-image: url('<?php echo get_option( 'backgournd_image' ); ?>');">
		<div class="custom-banner-content inner-section">
			<div class="custom-left-content">
				<h2><?php echo get_post_meta($post_id,'_select_main_key',true); ?> <br /><span>in</span> <?php the_title(); ?></h2>
			</div>
			<div class="custom-contact-form">
					<?php 
                    $form_shortcode = get_option("form_shortcode");
					echo do_shortcode(''.$form_shortcode.''); ?>
				
			</div>
		</div>
	</div>
	<div class="custom-paragraph">
		<div class="inner-section">
			<?php 
				$post_id = get_the_id();
				$the_title = get_the_title($post_id);
				$main_variable = wpautop(get_option("main_block_of_text"));
				echo str_replace('location_name', $the_title,$main_variable);
			 ?>
			<ul class="selling-point">
				<li>
					<?php $first_icon_color = get_option('first_icon_color'); ?>
					<div class="icon-bg" style="background-color: <?php echo $first_icon_color ?> ;">
						<img src="<?php echo get_option( 'first_selling_icon' );  ?>">
					</div>	
					<?php echo wpautop(get_option( 'first_selling_content' ));  ?>				
				</li>
				<li>
					<?php $second_icon_color = get_option('second_icon_color'); ?>
					<div class="icon-bg" style="background-color: <?php echo $second_icon_color ?> ;">
						<img src="<?php echo get_option( 'second_selling_icon' );  ?>">
					</div>
					<?php echo wpautop(get_option( 'second_selling_content' ));  ?>					
				</li>
				<li>
					<?php $third_icon_color = get_option('third_icon_color'); ?>
					<div class="icon-bg" style="background-color: <?php echo $third_icon_color ?> ;">
						<img src="<?php echo get_option( 'third_selling_icon' );  ?>">
					</div>	
					<?php echo wpautop(get_option( 'third_selling_content' ));  ?>				
				</li>
			</ul>
		</div>
	</div>
	<?php $banner_background = get_option( 'banner_background_image' );  ?>
	<div class="custom-bg-banner" style="background-image: url(<?php echo $banner_background ?>);">
		<div class="inner-section">
			<?php echo wpautop(get_option("banner_text")); ?>
			<a href="<?php echo get_option("booking_link_url"); ?>" class="btn btn-custom"><?php echo get_option("button_text"); ?></a>
		</div>
	</div>
	<div class="custom-banner" style="background-color: #009bdf;">
		<div class="custom-banner-content inner-section">
			<div class="custom-left-content">
				<?php echo wpautop(get_option("contact_details")); ?>
			</div>
			<div class="custom-contact-form">
				<?php 
                     $form_shortcode = get_option("form_shortcode");
					echo do_shortcode(''.$form_shortcode.''); ?>
			</div>
		</div>
	</div>

</body>
<?php
get_footer(); 
?>