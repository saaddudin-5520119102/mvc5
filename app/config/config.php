<?php
define("DBHOST", "localhost");
define("DBTABLE", "phpdasar2");
define("DBUSERNAME", "root");
define("DBPASS", "");

define("BASEURL", "http://localhost/belajar_php/mvc5/public");

function getUserIP(): string {
    $keys = [
        'HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR'
    ];
    foreach ($keys as $k) {
        if (!empty($_SERVER[$k])) {
            $ips = preg_split('/,\s*/', $_SERVER[$k]);
            foreach ($ips as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function redirectToLogin(){
    $_SESSION = [];
            session_unset();
            session_destroy();
            // setcookie('user_id', '', time() - 3600, '/');
            
            setcookie('user_id', "logout", [
                    'expires' => time() - 259200, //3days active time
                    'path' => '/',
                    // 'domain' => COOKIE_DOMAIN ?: null,
                    'domain' => 'localhost',
                    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]);
        header("Location: ".BASEURL."/auth/login");
        exit(); 
}

?>