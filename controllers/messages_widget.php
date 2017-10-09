<?php
class WPSimpleContactMessagesWidget extends \WP_Widget
{
    protected $messages;

    public function __construct()
    {
        include_once __DIR__ . '/../entity/messages.php';
        $this->messages = new WPSimpleContactMessages();
        $description = __('A contact page', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN);
        parent::__construct(
            'wp_simple_contact_message_widget',
            'Simple Contact Form',
            array('description' => $description)
        );
    }
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];

        if (!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
            $emailValue = $_POST['email'];
            $subjectValue = $_POST['subject'];
            $messageValue = nl2br($_POST['message']);

            if (!filter_var($emailValue, FILTER_VALIDATE_EMAIL)) {
                $notification = __("Email invalid", WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN);
                $notification_style = "wp_simple_contact_notifications_error";
            } else {
                $this->messages->save($emailValue, $subjectValue, $messageValue);
                $headers = array('Content-Type: text/html; charset=UTF-8');
                $mailContent = $messageValue;
                ob_start();
                include(__DIR__.'/../views/mail/template.php');
                $message = ob_get_contents();
                ob_end_clean();
                wp_mail($emailValue, stripslashes_deep($subjectValue), stripslashes_deep($messageValue), $headers);

                $notification = __("Message send", WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN);
                $notification_style = "wp_simple_contact_notifications_success";
                unset($emailValue, $subjectValue, $messageValue);
            }
        }
        include __DIR__ . '/../views/widgets/contact.php';

        echo $args['after_widget'];
    }
    /**
     * Back-end widget form.
     *
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('contacts table', 'text_domain');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'text_domain'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }
}

// Add Widget
add_action('widgets_init', function () {
    register_widget("WPSimpleContact\\Controllers\\WPSimpleContactMessagesWidget");
});