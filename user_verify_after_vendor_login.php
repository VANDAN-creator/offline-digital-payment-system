<!-- user_verify_after_vendor_login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>USER VERIFICATION</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    // Function to check if email exists in the database
    function isEmailExists($email) {
        // Replace with your database credentials
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'test_db';

        // Create connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT email FROM usernames WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // If at least one row is returned, the email exists in the database
        if ($stmt->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return true;
        }

        $stmt->close();
        $conn->close();
        return false;
    }

    // Function to add email to the transactions database
    function addEmailToTransactions($email) {
        // Replace with your database credentials
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'test_db';

        // Create connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the query to insert email into transactions table
        $stmt = $conn->prepare("INSERT INTO transactions (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];

            if (isEmailExists($email)) {
                // Email exists in the database
                addEmailToTransactions($email);
                header("Location: user_transaction_history.php?email=$email");
                exit();
            } else {
                // Email does not exist in the database
                $error = "Email not found";
            }
        }
    }
    ?>
    <form action="user_verify_after_vendor_login.php" method="post">
        <h2>USER VERIFICATION</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <label>Email</label>
        <input type="text" name="email" placeholder="Email" required><br>

        <button type="submit">Validate</button>
    </form>
</body>
</html>
