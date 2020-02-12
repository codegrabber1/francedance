<?php
session_start();
/**
 * Template Name: Contact
 * Template post type: post, page
 * Description: A Page Template to display contact form with captcha and jQuery validation.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FranceDance
 * @file    page-contact.php
 * @author  francedance <[makecodework@gmail.com]>
 */
$name_error     = '';
$email_error    = '';
$message_error  = '';
$captcha_error  = '';

if( isset( $_POST['mcw_submit'] )) {
	/* validate sender name*/
	if(trim($_POST['sender_name']) === '') {
		$name_error = "Please, enter your name.";
		$has_error = true;
	} else {
		$sender_name = trim($_POST['sender_name']);
	}
	/*validate sender email*/
	if(trim($_POST['sender_email']) === '')  {
		$email_error = 'Please enter your email.';
		$has_error = true;
	} else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", trim($_POST['sender_email']))){
		$email_error = 'Please, enter your correct email.';
		$has_error = true;
	} else {
		$sender_email = trim($_POST['sender_email']);
	}

	/*validate message*/
	if(trim($_POST['message_text']) === '') {
		$message_error = 'Please, enter a message.';
		$has_error = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message_text']));
		} else {
			$message = trim($_POST['message_text']);
		}
	}


	if( !isset( $has_error ) ) {
		$email_to = mcw_get_option( 'mcw_contact_email' );
		$subject = mcw_get_option( 'mcw_contact_subject' );

		if( !isset( $email_to ) || ( $email_to == '' ) ) {
			$email_to = get_option( 'admin_email' );
		}

		if( !isset( $subject ) || ( $subject == '' ) ) {
			$subject = 'Contact Message From ' . $sender_name;
		}

		$from_user = "=?UTF-8?B?".base64_encode($sender_name)."?=";
		$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

		$headers = "From: $from_user <$sender_email>\r\n".
		           "Reply-To: $sender_email" . "\r\n" .
		           "MIME-Version: 1.0" . "\r\n" .
		           "Content-type: text/html; charset=UTF-8" . "\r\n";

		$body = "Name: $sender_name <br />Email: $sender_email <br />Comments: $message";

		mail($email_to, $subject, $body, $headers);
		$email_sent = true;
	}
	
}
get_header('page');
?>
    <script type="text/javascript">
        <!--//--><![CDATA[//><!--
        jQuery(document).ready(function() {
            jQuery('form#wt_contact_form').submit(function() {
                jQuery('form#wt_contact_form .error').remove();
                var hasError = false;
                jQuery('.requiredField').each(function() {
                    if(jQuery.trim(jQuery(this).val()) == '') {

                        if(jQuery(this).hasClass('name_field')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter your name.', 'wellthemes'); ?></span>');
                        }

                        if(jQuery(this).hasClass('title_field')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter message title.', 'wellthemes'); ?></span>');
                        }

                        if(jQuery(this).hasClass('email')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter your email.', 'wellthemes'); ?></span>');
                        }

                        if(jQuery(this).hasClass('message_field')) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter your message.', 'wellthemes'); ?></span>');
                        }

                        if(jQuery(this).hasClass("captcha_field")) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter the security code.', 'wellthemes'); ?></span>');
                        }

                        jQuery(this).addClass('inputError');
                        hasError = true;
                    } else if(jQuery(this).hasClass('email')) {
                        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                        if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
                            jQuery(this).parent().append('<span class="error"><?php _e('Please enter valid email', 'wellthemes'); ?> </span>');
                            jQuery(this).addClass('inputError');
                            hasError = true;
                        }
                    }
                });

                if(hasError) {
                    return false;
                } else{
                    return true;
                }
            });
        });
        //-->!]]>
    </script>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="wrrap" style='background-image: linear-gradient(rgba(0,0,0,.8), rgba(0,0,0,.8)),url("<?php echo get_the_post_thumbnail_url(); ?>")'>
                <div class="container">
                    <div id="contact-box">
                        <section class="contact-block">
                            <div class="row">
                                <div class="col-md-8 contact-form">
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="mcw_contact_form">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="name_field requiredField" id="sender_name" name ="sender_name" value="<?php if(isset($_POST['sender_name'])) echo $_POST['sender_name'];?>" placeholder="<?php _e('Your Name')?>">
                                        <?php if( $name_error != '' ) : ?>
                                            <span class="error"><?php echo $name_error;?></span>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="email requiredField" id="sender_email " name="sender_email" placeholder="<?php _e('Your Email')?> &#42;" value="<?php if(isset($_POST['sender_email'])) echo $_POST['sender_email'];?>">
                                        <?php if( $email_error != '' ) : ?>
                                            <span class="error"><?php echo $email_error;?></span>
                                        <?php endif;?>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message_text" class="message_field requiredField" id="message_text" rows="8" cols="10" placeholder="<?php _e('Your Text')?>"><?php if(isset($_POST['message_text'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message_text']); } else { echo $_POST['message_text']; } } ?></textarea>
                                        <?php if( $message_error != '' ) : ?>
                                            <span class="error"><?php echo $message_error;?></span>
                                        <?php endif;?>
                                    </div>

                                    <div class="col-12">
                                        <input type="submit" class="right" name="mcw_submit" value="<?php _e('Envoyer', 'francedance'); ?>">
                                    </div>
                                    </div>

                                </form>
                            </div>
                                <div class="col-md-4 contact-info">
                                    <h2>Questions</h2>
                                     <?php if( mcw_get_option( 'contact_email' ) ):?>
                                    <p><?php echo mcw_get_option( 'contact_email' )?></p>
                                    <?php endif;?>
<!--                                    <p><button type="submit" name="mcw_submit" > --><?php //_e('Formulaire Presse', 'francedance'); ?><!-- </button></p>-->
                                    <h2>Restez connectés</h2>
                                    <p>Retrouvez nous sur les réseaux sociaux</p>
                                    <ul>
			                            <?php if( mcw_get_option( 'mcw_twitter_url' ) ): ?>
                                            <li><a href="<?php echo mcw_get_option( 'mcw_twitter_url' )?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			                            <?php endif; ?>
			                            <?php if( mcw_get_option( 'mcw_fb_url' ) ): ?>
                                            <li><a href="<?php echo mcw_get_option( 'mcw_fb_url' ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			                            <?php endif; ?>
			                            <?php if( mcw_get_option( 'mcw_inst_url' ) ):?>
                                            <li><a href="<?php echo mcw_get_option( 'mcw_inst_url' )?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			                            <?php endif;?>
			                            <?php if( mcw_get_option( 'mcw_youtube_url' ) ): ?>
                                            <li><a href="<?php echo mcw_get_option( 'mcw_youtube_url' )?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
			                            <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
    get_footer();
