<?php
    session_start();
    include("connection.php");

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $id = $_SESSION["id"];

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("i", $id);
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
    <link rel="stylesheet" href="navbar.css">
    <title>Edit Profile</title>
    <style>
        .register-container {
            margin: auto;
            width: 40%;
            margin-top: 20px;
        }
        .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-context {
            text-align: center;
        }
        form .persIn {
            margin-top: -20px;
            margin-bottom: 20px;
        }
        form .courseYrlvl {
            margin-top: -10px;
            margin-bottom: 20px;
        }
        form .accnt {
            margin-top: -10px;
            margin-bottom: 20px;
        }
        form .personal-information input {
            width: 90%;
            margin-bottom: 10px;
        }
        form .userpass input {
            width: 90%;
            margin-bottom: 16px;
        }
        form .personal-information .Idno {
            width: 45%;
        }
    </style>
</head>
<body>
    <nav class="w3-border-bottom">
        <div class="w3-container logo">
            <a href="homepage.php">Dashboard</a>
        </div>
        <div class="w3-container w3-bar items">
            <a href="logout.php" class="w3-bar-item w3-button w3-right w3-hover-blue">Logout</a>
            <a href="history.php" class="w3-bar0item w3-button w3-right w3-hover-blue">History</a>
            <a href="editprofile.php" class="w3-bar-item w3-button w3-right w3-hover-blue w3-yellow">Edit Profile</a>
            <a href="homepage.php" class="w3-bar-item w3-button w3-right w3-hover-blue">Home</a>
        </div>
    </nav>
    <div class="w3-card-4 register-container w3-round-large">
        <div class="w3-container w3-padding-16 w3-large w3-center w3-border-bottom">
            <img src="Images/CCS Logo.png" alt="CCS" style="width: 20%;"><br>
            Edit Profile
        </div>
        <form class="w3-container w3-padding-large" action="register.php" method="POST">
            <div class="w3-container personal-information w3-padding-16 w3-border-bottom">
                <p class="w3-large persIn">Personal Information</p>
                <input class="w3-input w3-border-blue Idno" type="text" id="idno" name="idno" disabled value="<?php echo htmlspecialchars($user['idno']) ?>">
                <div class="w3-half">
                    <input class="w3-input w3-border-blue" type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']) ?>">
                    <input class="w3-input w3-border-blue" type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($user['midname']) ?>">
                </div>
                <div class="w3-half">
                    <input class="w3-input w3-border-blue" type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']) ?>">
                    <input class="w3-input w3-border-blue" type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']) ?>">
                </div>
            </div>

            <div class="w3-container w3-border-bottom w3-padding-16 CourseYearLvl">
                <p class="w3-large courseYrlvl">Course & Year Level</p>
                <div class="w3-half">
                    <select class="w3-select w3-border-blue" id="course" name="course" style="width: 90%; font-size: 14px;" name="Course">
                        <option value="" disabled selected><?php echo htmlspecialchars($user['course']) ?></option>
                        <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                        <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                        <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                        <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
                        <option value="Bachelor of Science in Custom Administration">Bachelor of Science in Custom Administration</option>
                    </select>
                </div>
                <div class="w3-half">
                    <select class="w3-select w3-border-blue" id="year" name="year" style="width: 90%; font-size: 14px;" name="Course">
                        <option value="" disabled selected><?php echo htmlspecialchars($user['yearlvl']) ?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>

            <div class="w3-container w3-border-bottom w3-padding-16 userpass">
                <p class="w3-large accnt">Account Information</p>
                <div class="w3-half">
                    <input class="w3-input w3-border-blue" type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']) ?>">
                    <input class="w3-input w3-border-blue" style="margin-bottom: 11px;" type="password" id="confirmPass" name="confirmPass" value="<?php echo htmlspecialchars($user['password']) ?>">
                </div>
                <div class="w3-half">
                    <input class="w3-input w3-border-blue" type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']) ?>">
                </div>
            </div>
            <button type="submit" name="submit" class="w3-button w3-round w3-blue w3-block w3-margin-top w3-hover-yellow">SAVE INFORMATION</button>
        </form>
    </div>
</body>
</html>