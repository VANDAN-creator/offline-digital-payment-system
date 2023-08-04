<!DOCTYPE html>
<html>
<head>
    <title>ADD USERS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        form {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative; /* Added position relative */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        h5 {
            margin-top: 20px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
        }

        .checkbox-container label {
            margin-left: 10px;
        }

        .logout-button {
            position: absolute;
            bottom: 15px;
            left: 30px;
            background-color: red;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        

        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <form action="user_signup_check.php" method="post">
        <h2>ADD USERS</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <label>Name</label>
        <?php if (isset($_GET['name'])) { ?>
            <input type="text" name="name" placeholder="First_Name Middle_Name Last_Name" value="<?php echo $_GET['name']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="name" placeholder="First_Name Middle_Name Last_Name"><br>
        <?php } ?>

        <label>Email</label>
        <?php if (isset($_GET['email'])) { ?>
            <input type="text" name="email" placeholder="user@gmail.com" value="<?php echo $_GET['email']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="email" placeholder="user@gmail.com"><br>
        <?php } ?>

        <label>PAN Card Number</label>
        <?php if (isset($_GET['pn'])) { ?>
            <input type="text" name="pn" placeholder="ABCEFXXXXG" value="<?php echo $_GET['pn']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="pn" placeholder="ABCEFXXXXG"><br>
        <?php } ?>

        <label>Aadhar Card Number</label>
        <?php if (isset($_GET['an'])) { ?>
            <input type="text" name="an" placeholder="XXXXXXXXXXXX" value="<?php echo $_GET['an']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="an" placeholder="XXXXXXXXXXXX"><br>
        <?php } ?>

        <label>Ration Card Number</label>
        <?php if (isset($_GET['rn'])) { ?>
            <input type="text" name="rn" placeholder="XXXXXXXXXXXXXXX" value="<?php echo $_GET['rn']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="rn" placeholder="XXXXXXXXXXXXXXX"><br>
        <?php } ?>

        <label>Mobile Number</label>
        <?php if (isset($_GET['mn'])) { ?>
            <input type="text" name="mn" placeholder="XXXXXXXXXX" value="<?php echo $_GET['mn']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="mn" placeholder="XXXXXXXXXX"><br>
        <?php } ?>

        <div class="checkbox-container">
            <input type="checkbox" id="correct-details" name="correct-details">
            <label for="correct-details">I have entered the correct details without any error.</label>
        </div>

        <button type="submit">Add User</button>

        <a href="government_logout.php" class="logout-button">Logout</a>
    </form>
</body>
</html>
