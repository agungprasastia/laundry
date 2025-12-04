<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$timeout_duration = 180; 

if (isset($_SESSION['LAST_ACTIVITY'])) {
    if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
        session_unset();
        session_destroy();
        
        header("Location: ../../login.php?error=session_expired");
        exit;
    }
}

$_SESSION['LAST_ACTIVITY'] = time();
?>