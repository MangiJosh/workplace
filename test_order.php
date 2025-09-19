<?php
// Simple test file to debug the 405 error
echo "PHP is working!<br>";
echo "Request Method: " . $_SERVER["REQUEST_METHOD"] . "<br>";
echo "Script Name: " . $_SERVER["SCRIPT_NAME"] . "<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "POST data received:<br>";
    print_r($_POST);
} else {
    echo "No POST data received.<br>";
    echo "Available methods: " . $_SERVER["REQUEST_METHOD"] . "<br>";
}
?>
