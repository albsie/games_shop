<?php
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // last request was more than 30 minutes ago
    $_SESSION = [];      // unset $_SESSION variable for the run-time
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
