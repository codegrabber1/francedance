<?php
/**
 * 
 */

    get_header('category');
?>
    <div class="gallery-filter" >
        <ul>
            <li class="filter" data-rel=".photo" data-filter=".photo">
                <span>Photo</span>
            </li>
            <li class="filter active" data-filter="all"><span>All</span></li>
            <li class="filter" data-rel=".video" data-filter=".video">
                <span>Video</span>
            </li>
        </ul>
    </div>

<div id="aniimated-thumbnials">

    <div id="image-gallery" class="grid">

	    <?php
	    $vId = mcw_get_option( 'video_category');
	    $args = array(
		    'cat' => $vId,
		    'ignore_sticky_posts'=> 1,
		    'post__not_in' => get_option('sticky_posts'),
	    );
	    $media = new WP_Query( $args );

	    while( $media->have_posts() ) : $media->the_post();

		    ?>
            <div class='grid-item gallery-img mix video'>
			    <?php the_content()?>
            </div>
	    <?php endwhile; wp_reset_postdata();?>
		<?php
		$catId = mcw_get_option('photo_category');
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
                    <div class='grid-item gallery-img mix photo'>
                        <a href="<?php echo wp_get_attachment_image_url($v, 'full');?>">
                            <img src='<?php echo wp_get_attachment_image_url($v, 'full');?>'>
                        </a>
                    </div>
				<?php
				endforeach; endwhile; endif; wp_reset_postdata();
		?>

        <div class="grid-sizer"></div>
    </div>

</div>
<?php
  get_footer();