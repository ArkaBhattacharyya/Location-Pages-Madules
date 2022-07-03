<?php
?>
   <ul class="location-area">
    <?php          
        $arr = array
        (
            'post_type' => 'locations', 
            'orderby' =>'title',
            'order' => 'ASC',
            'posts_per_page' => -1
        );
        $areas_locations = new WP_Query($arr);
        while ($areas_locations->have_posts()) : $areas_locations->the_post();
        $image_url = get_the_post_thumbnail_url();
        $post_id = get_the_id();
        ?>
    <li>
        <a href="<?php the_permalink() ?>" alt="Wheelie bin cleaning in"><?php the_title() ?></a>
    </li>
   <?php   
        endwhile; 
        wp_reset_postdata();   
    ?>                     
 </ul>
