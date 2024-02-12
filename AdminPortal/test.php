<?php
// Start the session
session_start();

// Check if the button was clicked today
$buttonClickedToday = isset($_SESSION['button_clicked_date']) && $_SESSION['button_clicked_date'] === date('Y-m-d');

// Check if the button was disabled
$buttonDisabled = isset($_SESSION['button_disabled']) && $_SESSION['button_disabled'];

// Check if the button should be clickable
$buttonClickable = !$buttonClickedToday || ($buttonClickedToday && !$buttonDisabled);

// Reset button state if a new day has started
if (!$buttonClickedToday) {
    $_SESSION['button_disabled'] = false;
}

// Handle button click
if (isset($_POST['click_button'])) {
    // Perform actions when the button is clicked
    // For example, update database, perform some operation, etc.
    
    // Set button clicked date
    $_SESSION['button_clicked_date'] = date('Y-m-d');
    // Disable the button until the next day
    $_SESSION['button_disabled'] = true;
    // Redirect to prevent multiple form submissions
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Example</title>
</head>
<body>
    <form method="post">
        <button id="clickableButton" <?php if (!$buttonClickable) echo 'disabled'; ?>>Click Me</button>
        <input type="hidden" name="click_button" value="1">
    </form>
</body>
</html>
