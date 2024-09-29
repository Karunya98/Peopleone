<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body{
            background: linear-gradient(109.6deg, rgb(255, 219, 47) 11.2%, rgb(244, 253, 0) 100.2%);
        }
        h1{
            text-align: center;
        }
        form{
            text-align: center;
        }
        div{
  margin-top: 10px;
  margin-bottom: 30px;
        }
        </style>
</head>
<body>
    <h1>Registration</h1>
    <a href="login.php">Login</a>
    <a href="logout.php">logout</a>
    <?php
    if (isset($_POST['submit'])) {
        // Validate input data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check for empty fields
        if (empty($username) || empty($email) || empty($password)) {
            echo "Please fill in all fields.";
        } else {
            // Check for valid email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format.";
            } else {
                // Check for unique username
                $conn = new mysqli("localhost", "root", "", "authentication");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM users WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "Username already exists.";
                } else {
                    // Store user information securely
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $username, $email, $hashed_password);

                    if ($stmt->execute()) {
                        echo "Registration successful!";
                        header("Location: index.php");
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                }

                $stmt->close();
                $conn->close();
            }
        }
    }
    ?>
    <form method="post" action="">
        <div>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        </div>
        <div>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        </div>
        <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        </div>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>