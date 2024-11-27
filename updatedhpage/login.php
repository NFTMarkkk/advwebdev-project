<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="logform.css">
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

<div class="form">
    <form action="login.php" method="post">
    <h2>Log In</h2>
    <form method="POST">
        <p>Username</p>
        <input type="text" name="username" required><br><br>
        <p>Password</p>
        <input type="password" name="password" required><br><br>
        <button type="submit">Log In</button>
    </form>
    </form>

            <?php session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validate inputs
            if (empty($username) || empty($password)) {
                echo "Username and password are required.";
            } else {
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'user_system');

                // Check connection and don't display actual error message
                if ($conn->connect_error) {
                    echo "An error occurred. Please try again later.";
                    exit(); // Terminate the script
                }

                // Prepare and execute query
                $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $hashed_password);
                    $stmt->fetch();

                    // Verify password
                    if (password_verify($password, $hashed_password)) {
                        // Successful login
                        $_SESSION['user_id'] = $id;
                        $_SESSION['username'] = $username;
                        header('Location: shop.php'); // Redirect to the shop page after login
                        exit();
                    } else {
                        // Incorrect password
                        echo "Incorrect username or password.";
                    }
                } else {
                    // User not found
                    echo "User not found.";
                }

                // Close the statement and connection
                $stmt->close();
                $conn->close();
            }
        }
        ?>

</div>
</html>