<?php
/**
 * Template part for displaying contact form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FranceDance
 */

?>
<section class="">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="mcw_contact_form">
        <input type="text" class="name_field requiredField" id="sender_name" name ="sender_name" value="<?php if(isset($_POST['sender_name'])) echo $_POST['sender_name'];?>" placeholder="Ваше ім'я">
	    <?php if( $name_error != '' ) : ?>
            <span class="error"><?php echo $name_error;?></span>
	    <?php endif;?>
    </form>
</section>
