<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="signform.css">
    <link rel="icon" href="/Final Project/MTop_Photo/fashweblogo.jpg">
    <title>CloverWear</title>
</head>
<body>
      <!--Homepage Header -->
<header>
    <div class="hpage">
        <nav>
            <div class="container1">
                        <img src="MTop_Photo/fashweblogo.jpg" alt="">
                        <p>CloverWear</p>
            </div>
            <div class="pages">
                <ul>
                    <a href="homepage.php">Home</a>
                    <a href="">Shop</a>
                    <a href="">About</a>
                    <a href="">Contact</a>
                </ul>
            </div>
            <div class="container2">
                     <a href=""><img id="img-1" src="acclog.jpg"></a>
                    <div class="shopcart">
                    <a href=""><img src="/Final Project/MTop_Photo/shopcarto.jpg" alt=""></a>
                    </div>
        </nav>
    </div>
        </header>
        <!-- contents and Sign up form -->
        <div class="conts">
            <div class="left">
                    <div class="desc">
                        <p>Why settle <br>for ordinary? <br>Find your signature <br>look today at Clover Wear!</p>
                    </div> <br>
                        <a href="signform.php"><button>Sign Up</button></a>
            </div>
            <!-- Featured Items -->
            <div class="right">
                    <p>Featured Items</p>
                    <div class="fItems">
                        <div class="Item1">

                        </div>
                        <div class="Item2">

                        </div>
                    </div>
                    
            </div>
        </div>
</body>

<!-- Sign up form -->
<div class="form">
    <form action="signform.php" method="post">
        <h2>Sign Up</h2><br>
        <p>Username</p><input type="text" name="username"  required><br><br>
        <p>Password</p>
        <input type="password" name="password" required><br><br>
        <button type="submit">Sign Up</button>
    </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Validate inputs
                if (empty($username) || empty($password)) {
                    echo "Username and password are required.";
                } else {
                    // Connect to the database
                    $conn = new mysqli('localhost', 'root', '', 'user_system');

                    // Check for connection error, but do not show it
                    if ($conn->connect_error) {
                        echo "An error occurred. Please try again later.";
                        exit(); // Stop further processing if the connection failed
                    }

                    // Check if the username already exists
                    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        // Username already exists
                        echo "Username has already been used.";
                    } else {
                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Insert the new user into the database
                        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                        $stmt->bind_param("ss", $username, $hashed_password);

                        if ($stmt->execute()) {
                            header('Location: login.php'); // Redirect to login page after successful sign up
                            exit();
                        } else {
                            // Catch any errors during insertion and show a generic error
                            echo "An error occurred while creating your account. Please try again.";
                        }
                    }

                    $stmt->close();
                    $conn->close();
            }
        }
        ?>
</div>
</html>