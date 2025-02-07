<?php
    session_start();
    include("connection.php");

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $idno = $_SESSION['id'];

    $query = "SELECT firstname, lastname, CONCAT(lastname, ' ', firstname) AS fullname FROM users WHERE userId = ?";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("i", $idno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<script>alert('No Users Found.')</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="w3.css">
    <title>Homepage</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        nav {
            display: flex;
            width: 100%;
            height: 5vh;
            align-items: center;
        }
        nav .logo {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: bold;
            font-size: 2em;
            margin-left: 10%;
        }
        nav .logo a {
            text-decoration: none;
        }
        nav .items {
            font-size: 1.2em;
            margin-right: 8%;
            font-weight: 500;
        }
        footer {
            margin-top: auto;
            width: 100%;
            height: 3vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        main {
            text-align: center;
            margin-top: 10%;            
        }
    </style>
</head>
<body>
    <nav class="w3-border-bottom">
        <div class="w3-container logo">
            <a href="">SysArch</a>
        </div>
        <div class="w3-container w3-bar items">
            <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
            <a href="aboutus.php" class="w3-bar-item w3-button w3-right">About us</a>
            <a href="" class="w3-bar-item w3-button w3-right">Home</a>
        </div>
    </nav>
    <main>
        <h1>Hello there <?php echo htmlspecialchars($user['firstname']) ?>!</h1>
        <h4>Welcome to your homepage.</h4>
    </main>
</body>
</html>