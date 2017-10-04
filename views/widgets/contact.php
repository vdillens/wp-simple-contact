<?php if (!empty($notification)) : ?>
    <div class="wp_simple_contact_notifications <?= $notification_style; ?>"><?= $notification; ?></div>
<?php endif; ?>
<form method="post" action="">
    <label for="email"><?= __('Email', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
    <input type="email" placeholder="<?= __("Write your email here..."); ?>" id="email" name="email" value="<?= $emailValue; ?>" /><br />
    <label for="subject"><?= __('Subject', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
    <input type="text" placeholder="<?= __("For what reason you need to contact us..."); ?>" id="subject" name="subject" value="<?= $subjectValue; ?>" /><br />
    <label for="message"><?= __('Message', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?></label>
<!--    <input type="text" placeholder="--><?php //echo __("Your message..."); ?><!--" id="message" name="message" value="--><?php //echo $messageValue; ?><!--" /><br />-->

    <?php wp_editor( $messageValue, 'message', $settings = array("media_buttons"=> false, "teeny" => true) ); ?><br />
    <input type="submit" value="<?= __('Save', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN); ?>" />
</form>