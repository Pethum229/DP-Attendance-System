<?php
    $db = new PDO('mysql:host=localhost;dbname=dp_attendence_system', 'root', '');
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>