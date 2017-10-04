<?php

class WPSimpleContactMessages {

    private $tableName;

    public function __construct()
    {
        global $wpdb;
        $this->tableName = "{$wpdb->prefix}simple_contact_messages";
    }

    public function save($email, $subject, $message){
        global $wpdb;
        $wpdb->insert($this->tableName, array(
            'email' => $email,
            'date' => date('Y-m-d H:i:s'),
            'subject' => $subject,
            'message' => $message
        ));
    }

    public function getList($beginDate, $endDate, $email, $message) {
        global $wpdb;

        $query = "SELECT * FROM {$this->tableName} WHERE 1 ";
        if (!empty($beginDate)) {
            $query .= " AND date >= '$beginDate 00:00:00'";
        }
        if (!empty($endDate)) {
            $query .= " AND date <= '$endDate 23:59:59'";
        }
        if (!empty($email)) {
            $query .= " AND email = '$email'";
        }
        if (!empty($message)) {
            $query .= " AND message LIKE '%$message%'";
        }

        return $wpdb->get_results($query, ARRAY_A );

    }

}