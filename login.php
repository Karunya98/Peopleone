<!DOCTYPE html>
<html>
<head>
    <title>User Authentication System</title>
    <style>
        body{
            background-image: url('login.gif');
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
        }
        div{
            margin-top: 10px;
            margin-bottom: 30px;
        }
        </style>
</head>
<body>
    <h1>Login</h1>
    <a href="register.php">Home</a>
    <?php

     // Connect to database
            $conn = new mysqli("localhost", "root", "", "authentication");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    if (isset($_POST['submit'])) {
        // Validate login credentials
        $username_or_email = mysqli_real_escape_string($conn,$_POST['username_or_email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        // Check for empty fields
        if (empty($username_or_email) || empty($password)) {
            echo "Please fill in all fields.";
        } else {
            // Connect to database
            /*$conn = new mysqli("localhost", "root", "", "test");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }*/

            // Check if username or email exists
            $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username_or_email, $username_or_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    // Set session variables
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    // Redirect to protected area
                    header("Location: protected_area.php");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "User not found.";
            }

            $stmt->close();
            $conn->close();
        }
    }
    ?>
    <form method="post" action="">
        <div>
        <label for="username_or_email">Username or Email:</label>
        <input type="text" name="username_or_email" required><br>
        </div>
        <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        </div>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
