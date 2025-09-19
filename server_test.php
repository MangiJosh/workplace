<?php
// Simple server test
echo "<h1>Server Test Results</h1>";

echo "<h2>PHP Information:</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "<h2>Request Information:</h2>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "HTTP Host: " . $_SERVER['HTTP_HOST'] . "<br>";

echo "<h2>Form Data Test:</h2>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "POST data received:<br>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
} else {
    echo "No POST data. Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
}

echo "<h2>File Permissions:</h2>";
echo "Current file readable: " . (is_readable(__FILE__) ? 'Yes' : 'No') . "<br>";
echo "Current file writable: " . (is_writable(__FILE__) ? 'Yes' : 'No') . "<br>";

echo "<h2>Test Form:</h2>";
?>
<form method="POST" action="server_test.php">
    <input type="text" name="test_field" placeholder="Enter test data" required>
    <button type="submit">Test Submit</button>
</form>

<?php
echo "<h2>Mail Function Test:</h2>";
if (function_exists('mail')) {
    echo "Mail function is available.<br>";
    // Test mail (commented out to avoid sending actual emails)
    // $test = mail('test@example.com', 'Test', 'Test message');
    // echo "Mail test result: " . ($test ? 'Success' : 'Failed') . "<br>";
} else {
    echo "Mail function is NOT available.<br>";
}
?>
