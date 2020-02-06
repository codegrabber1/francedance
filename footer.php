<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FranceDance
 */

?>
         </div> <!-- .wrapper-->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="site-info">
                        <ul>
		                    <?php if( mcw_get_option( 'mcw_twitter_url' ) ): ?>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		                    <?php endif; ?>
		                    <?php if( mcw_get_option( 'mcw_fb_url' ) ): ?>
                                <li><a href="<?php echo mcw_get_option( 'mcw_fb_url' ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		                    <?php endif; ?>
		                    <?php if( mcw_get_option( 'mcw_inst_url' ) ):?>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
		                    <?php endif;?>
		                    <?php if( mcw_get_option( 'mcw_youtube_url' ) ): ?>
                                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
		                    <?php endif;?>
                        </ul>
                    </div>
                </div>
               <div class="col-6">
                   <div class="site-info">
                    <?php
                       /* translators: 1: Theme name, 2: Theme author. */
                       printf( esc_html__( 'Theme: %1$s by %2$s.', 'francedance' ), 'francedance', '<a href="http://makecodework.com">makecodework.com</a>' );
                       ?>
                   </div><!-- .site-info -->
               </div>
            </div>
        </div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
    new WOW().init();
</script>
</body>
</html>
