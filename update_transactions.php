<?php
// Assuming you have a database connection already established
// Replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your database credentials
$connection = mysqli_connect('localhost', 'root', '', 'test_db');
if (!$connection) {
    die('Database connection failed: ' . mysqli_error());
}

// Set the timezone to IST (Indian Standard Time)
date_default_timezone_set('Asia/Kolkata');

// Retrieve the data sent from the client
$data = json_decode(file_get_contents('php://input'), true);

// Prepare and execute the database query for each data entry
foreach ($data as $entry) {
    $availingFor = mysqli_real_escape_string($connection, $entry['availingFor']);
    $grantedAmount = (int)$entry['grantedAmount'];
    $availedAmount = (int)$entry['availedAmount'];
    $availAmount = (int)$entry['availAmount'];
    $stringValue = mysqli_real_escape_string($connection, $entry['string_value']); // Updated variable name

    // Get the current date and time in IST
    $dateTime = date('Y-m-d H:i:s');

    // Assuming the email is retrieved from the session or elsewhere in your code
    $email = ''; // Replace with the actual email value

    $query = "INSERT INTO transactions (email, granted_amount, availed_amount, avail_amount, availing_for, date_time, string_value) VALUES ('$email', $grantedAmount, $availedAmount, $availAmount, '$availingFor', '$dateTime', '$stringValue')"; // Modified query

    if (!mysqli_query($connection, $query)) {
        die('Error inserting transaction: ' . mysqli_error($connection));
    }
}

// Close the database connection
mysqli_close($connection);

// Send a response back to the client
http_response_code(200);
?>
