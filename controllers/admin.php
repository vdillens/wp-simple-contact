<?php
/**
 * Class WPSimpleContactAdmin
 * Admin Controller to manage the
 */
class WPSimpleContactAdmin {

    protected $messages;
    protected $subjects;
    public function __construct()
    {
        include_once __DIR__ . '/../entity/messages.php';
        $this->messages = new WPSimpleContactMessages();
        add_action( 'admin_menu', array($this,'admin_menu') );
    }
    public function admin_menu() {
        add_menu_page(
            __('WP SimpleContact', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN),
            __('WP SimpleContact', WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN),
            'manage_options',
            'wp-simple-contact/admin_home.php',
            array( $this, 'home_page'), 'dashicons-phone', 6  );
    }

    public function home_page() {
        $beginDateValue = (!empty($_POST['begin_date'])) ? $_POST['begin_date'] : null;
        $endDateValue = (!empty($_POST['end_date'])) ? $_POST['end_date'] : null;
        $emailValue = (!empty($_POST['email'])) ? $_POST['email'] : null;
        $messageValue = (!empty($_POST['message'])) ? $_POST['message'] : null;

        if ($beginDateValue || $endDateValue || $emailValue || $messageValue) {
            $messages = $this->messages->getList($beginDateValue,$endDateValue,$emailValue,$messageValue);
        }

        include __DIR__ . '/../views/admin/home.php';
    }


}
