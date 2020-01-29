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
		$name_error = "Будь ласка, введіть Ваше ім'я.";
		$has_error = true;
	} else {
		$sender_name = trim($_POST['sender_name']);
	}
	/*validate sender email*/
	if(trim($_POST['sender_email']) === '')  {
		$email_error = 'Будь ласка, введіть Ваш email.';
		$has_error = true;
	} else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", trim($_POST['sender_email']))){
		$email_error = 'Будь ласка, введіть Ваше коректний email.';
		$has_error = true;
	} else {
		$sender_email = trim($_POST['sender_email']);
	}

	/*validate message*/
	if(trim($_POST['message_text']) === '') {
		$message_error = 'Будь ласка, введіть повідомлення.';
		$has_error = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['message_text']));
		} else {
			$message = trim($_POST['message_text']);
		}
	}

	// include_once( trailingslashit( get_stylesheet_directory() ) . 'framework/lib/recaptcha/recaptchalib.php' );
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
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="wrrap" style='background-image: linear-gradient(rgba(0,0,0,.8), rgba(0,0,0,.8)),url("<?php echo get_the_post_thumbnail_url(); ?>")'>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="contact-info">
                                <h2>Contact</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <section class="contact-block">
                                <h2>Questions</h2>
                                <p>contact@battle-pro.com</p>
                                <p><button type="submit" name="mcw_submit" > <?php _e('Formulaire Presse', 'francedance'); ?> </button></p>
                                <h2>Restez connectés</h2>
                                <p>Retrouvez nous sur les réseaux sociaux</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                </ul>
                                
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="contact-block" >
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="mcw_contact_form">

                                    <div class="">
                                        <input type="text" class="name_field requiredField" id="sender_name" name ="sender_name" value="<?php if(isset($_POST['sender_name'])) echo $_POST['sender_name'];?>" placeholder="<?php _e('Your Name')?>">
				                        <?php if( $name_error != '' ) : ?>
                                            <span class="error"><?php echo $name_error;?></span>
				                        <?php endif;?>
                                    </div>
                                    <div class="">
                                        <input type="email" class="email requiredField" id="sender_email " name="sender_email" placeholder="<?php _e('Your Email')?> &#42;" value="<?php if(isset($_POST['sender_email'])) echo $_POST['sender_email'];?>">
				                        <?php if( $email_error != '' ) : ?>
                                            <span class="error"><?php echo $email_error;?></span>
				                        <?php endif;?>
                                    </div>
                                    <div class="">
                                        <textarea name="message_text" class="message_field requiredField" id="message_text" rows="8" cols="10" placeholder="<?php _e('Your Text')?>"><?php if(isset($_POST['message_text'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message_text']); } else { echo $_POST['message_text']; } } ?></textarea>
				                        <?php if( $message_error != '' ) : ?>
                                            <span class="error"><?php echo $message_error;?></span>
				                        <?php endif;?>
                                    </div>
                                    <div id="recaptcha_widget" class='captcha_field' style="display:none">
                                        <div class="field">
                                            <div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php _e('Error! Please, try again!', 'francedance'); ?></div>
                                            <input type="text" id="recaptcha_response_field" class="text requiredField captcha_field" name="recaptcha_response_field"placeholder="<?php _e('Confirmation code', 'francedance'); ?> &#42;" />
					                        <?php if($captcha_error != '') { ?>
                                                <span class="error"><?php echo $captcha_error; ?></span>
					                        <?php } ?>
                                        </div>

                                        <div class="field recaptcha-image">
                                            <div id="recaptcha_image"></div>
                                            <div class="recaptcha_refresh"><i class="fa fa-refresh"></i><a href="javascript:Recaptcha.reload()"><?php _e('reload', 'francedance'); ?></a></div>
                                            <div class="recaptcha_only_if_image"><i class="fa fa-volume-up"></i><a href="javascript:Recaptcha.switch_type('image')"><?php _e('image ', 'francedance'); ?></a></div>
                                            <div class="recaptcha_only_if_audio"><i class="fa fa-picture-o"></i><a href="javascript:Recaptcha.switch_type('audio')"><?php _e('audio', 'francedance'); ?></a></div>
                                            <div class="recaptcha_help"><i class="fa fa-info-circle"></i><a href="javascript:Recaptcha.showhelp()"><?php _e('help', 'francedance'); ?></a></div>
                                        </div>

                                        <script type="text/javascript"
                                                src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $mcw_recaptcha_public_key; ?>">
                                        </script>
                                        <noscript>
                                            <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $mcw_recaptcha_public_key; ?>"
                                                    height="300" width="500" frameborder="0"></iframe><br>
                                            <textarea name="recaptcha_challenge_field" rows="3" cols="40">
    </textarea>
                                            <input type="hidden" name="recaptcha_response_field"
                                                   value="manual_challenge">
                                        </noscript>
                                        <div class="g-recaptcha">6LedRCQUAAAAANzorD4GKu4NMBfWMXj69orELAjB</div>
                                        <span class="error"><?php echo $captcha_error;?></span>
                                    </div>
                                    <div class="">
                                        <input type="submit" name="mcw_submit" value="<?php _e('Envoyer', 'francedance'); ?>">
                                    </div>
                                    <script src='https://www.google.com/recaptcha/api.js'></script>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>

            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home');
