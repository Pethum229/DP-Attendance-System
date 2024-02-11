<?php

session_start();

// Unset the desired session variables
unset($_SESSION['error']);
unset($_SESSION['timeIn']);
unset($_SESSION['timeOut']);
unset($_SESSION['warning']);
unset($_SESSION['qrNotSet']);
?>
