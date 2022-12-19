<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    // last request was more than 15 minutes ago
    $_SESSION = array();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
else{
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
?>