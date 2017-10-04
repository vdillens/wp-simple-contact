<?php

/**
 * Class WPSimpleContactSystem
 * Use for install/uninstall database
 */
class WPSimpleContactSystem {
    /**
     * Install the database
     */
    public static function install() {
        global $wpdb;
        $query = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}simple_contact_messages (
                    id INT AUTO_INCREMENT PRIMARY KEY, 
                    date DATETIME NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    subject VARCHAR(150) NOT NULL,
                    message TEXT NOT NULL 
                    );";

        $wpdb->query($query);
    }
    /**
     * Remove the database
     */
    public static function uninstall() {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}simple_contact_messages;");
    }
}