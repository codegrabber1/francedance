<?php
/**
 * 
 */

    get_header('category');
?>

<div class='grid'>
    <div class="grid-sizer"></div>
    <?php
        $catId = get_queried_object()->term_id;
        $args = array(
           'cat' => $catId,
           'ignore_sticky_posts'=> 1,
           'post__not_in' => get_option('sticky_posts'),
        );

        $mediaGall = new WP_Query( $args );
        if( $mediaGall ) :
            while( $mediaGall->have_posts() ) : $mediaGall->the_post();
            $getPost = get_post();
            $images = get_post_gallery( $getPost, false ); ;
            $img_sl = explode( ',', $images['ids']);
            foreach( $img_sl as $v ) :
         ?>
        <div class='grid-item '>
            <a href="#"> <img src='<?php echo wp_get_attachment_image_url($v, 'full');?>'> </a>
        </div>
        <?php
            endforeach; endwhile; endif; wp_reset_postdata();
    ?>
</div>
<?php
  get_footer();