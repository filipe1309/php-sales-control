<?php
// 7 Creating an app
// 7.4 Program
// 7.4.5 Session handling


namespace Book\Session;

class Session {
    
    public function __construct() {
        if (!session_id()) {
            session_start();
        }
    }
    
    public static function setValue($var, $value) {
        $_SESSION[$var] = $value;
    }
    
    public static function getValue($var) {
        if (isset($_SESSION[$var])) {
            return $_SESSION[$var];
        }
    }
    
    
    public static function freeSession() {
        $_SESSION = [];
        session_destroy();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=CitiesFormList

