<?php
    session_start();
    include("connection.php");

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $idno = $_SESSION['id'];

    $query = "SELECT idno, firstname, midname, lastname, CONCAT(lastname, ' ', midname, ' ', firstname) AS fullname, yearlvl, course, email FROM users WHERE id = ?";
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
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Dashboard - CCS Sit-In</title>
    <style>
        .card-container {
            width: 100%;
            height: 80%;
            padding-top: 0;
            margin-top: 25px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 25px;
        }
        .card-container .card-1 {
            width: 25%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-container .card-1 header {
            border-radius: 15px 15px 0px 0px;
        }
        .card-container .card-1 #information-container {
            padding: 0;
        }
        .card-container .card-1 #information-container p {
            width: 100%;
            margin: 8px 0px 8px 50px;
            padding: 0;
            text-align: left;
        }
        .card-container .card-2 {
            width: 25%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-container .card-2 header {
            border-radius: 15px 15px 0px 0px;
        }
        .card-container .card-3 {
            width: 27%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-container .card-3 header {
            border-radius: 15px 15px 0px 0px;
        }
        .card-container .card-3 #rules-regulation {
            overflow-y: auto;
            max-height: 620px;
        }
        .card-container .card-3 #rules-regulation p {
            margin-bottom: 1rem;
            text-align: left;
        }
        .card-container .card-3 #rules-regulation ul {
            margin-left: 3em;
            margin-bottom: 1rem;
            text-align: left;
        }
        .card-container .card-3 #announcement {
            overflow-y: auto;
            max-height: 620px;
        }
        .card-container .card-3 #announcement {

        }
    </style>
</head>
<body>
    <nav>
        <div class="w3-container logo">
            <a href="">Dashboard</a>
        </div>
        <div class="w3-container w3-bar items" >
            <a href="logout.php" class="w3-bar-item w3-button w3-right w3-hover-blue">Logout</a>
            <a href="history.php" class="w3-bar0item w3-button w3-right w3-hover-blue">History</a>
            <a href="editprofile.php" class="w3-bar-item w3-button w3-right w3-hover-blue">Edit Profile</a>
            <a href="" class="w3-bar-item w3-button w3-right w3-yellow w3-hover-blue">Home</a>
        </div>
    </nav>
    <div class="w3-container w3-padding-16 card-container">
        <div class="w3-container w3-card-4 card-2">
            <header class="w3-container w3-blue w3-center">
                <h4><i class="fa-solid fa-bullhorn"></i> Announcement</h4>
            </header>
            <div class="w3-container w3-padding-16" id="announcement">
                <p class="title" style="margin-top: 1rem; margin-bottom: 1rem;"><strong>CCS Admin | 2025-Feb-03</strong></p>
                <div class="w3-container w3-bottombar w3-padding-16">
                    <p>The College of Computer Studies will open the registration of students for the Sit-in privilege starting tomorrow. Thank you! Lab Supervisor</p>
                </div>
                <p class="title" style="margin-top: 1rem; margin-bottom: 1rem;"><strong>CCS Admin | 2024-May-08</strong></p>
                <div class="w3-container w3-bottombar w3-padding-16">
                    <p>Important Announcement We are excited to announce the launch of our new website! 🎉 Explore our latest products and services now!</p>
                </div>
            </div>
        </div>
        <div class="w3-container w3-card-4 card-1">
            <header class="w3-container w3-blue w3-center">
                <h4>Student Information</h4>
            </header>
            <div class="w3-container w3-padding-16 w3-center" id="information-container">  
                <img src="Images/sample-profile.png" alt="Avatar" style="max-height: 10rem; max-width: 10rem;" class="w3-center w3-circle w3-border w3-border-black">
                <hr>
                <p class="w3-left">
                    <i class="fa-solid fa-id-card" aria-hidden="true"></i>
                    <strong>IDNO:</strong>
                    <?php echo htmlspecialchars($user['idno']) ?>
                </p>
                <p class="w3-left">
                    <i class="fa-solid fa-user"></i>
                    <strong>Name:</strong>
                    <?php echo htmlspecialchars($user['fullname']) ?>
                </p>
                <p class="w3-left">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <strong>Course:</strong>
                    <?php echo htmlspecialchars($user['course']) ?>
                </p>
                <p class="w3-left">
                    <i class="fa-solid fa-arrow-up-9-1"></i>
                    <strong>Year:</strong>
                    <?php echo htmlspecialchars($user['yearlvl']) ?>
                </p>
                <p class="w3-left">
                    <i class="fa-solid fa-envelope"></i>
                    <strong>Email:</strong>
                    <?php echo htmlspecialchars($user['email']) ?>
                </p>
                <p class="w3-left">
                    <i class="fa-solid fa-stopwatch"></i>
                    <strong>Session:</strong>
                    
                </p>
            </div>
        </div>
        <div class="w3-container w3-card-4 card-3">
            <header class="w3-container w3-blue w3-center">
                <h4><i class="fa-solid fa-shield"></i> Rules and Regulation</h4>
            </header>
            <div class="w3-container w3-padding-16 w3-center" id="rules-regulation">
                <h5 class="w3-center" style="text-transform: uppercase;"><strong>University of Cebu</strong></h5>
                <p class="w3-center" style="text-transform: uppercase; font-size: .9em;"><strong>College of Information & Computer Studies</strong></p>
                <br>
                <p class="w3-left" style="text-transform: uppercase;"><strong>Laboratory Rules and Regulations</strong></p>
                <hr>
                <p>To avoid embarrassment and maintain camaraderie with your friends and superiors at our laboratories, please observe the following:</p>
                <p>1. Maintain silence, proper decorum, and discipline inside the laboratory. Mobile phones, walkmans and other personal pieces of equipment must be switched off.</p>
                <p>2. Games are not allowed inside the lab. This includes computer-related games, card games and other games that may disturb the operation of the lab.</p>
                <p>3. Surfing the Internet is allowed only with the permission of the instructor. Downloading and installing of software are strictly prohibited.</p>
                <p>4. Getting access to other websites not related to the course (especially pornographic and illicit sites) is strictly prohibited.</p>
                <p>5. Deleting computer files and changing the set-up of the computer is a major offense.</p>
                <p>6. Observe computer time usage carefully. A fifteen-minute allowance is given for each use. Otherwise, the unit will be given to those who wish to "sit-in".</p>
                <p>7. Observe proper decorum while inside the laboratory.</p>
                <ul>
                    <li>Do not get inside the lab unless the instructor is present.</li>
                    <li>All bags, knapsacks, and the likes must be deposited at the counter.</li>
                    <li>Follow the seating arrangement of your instructor.</li>
                    <li>At the end of class, all software programs must be closed.</li>
                    <li>Return all chairs to their proper places after using.</li>
                </ul>
                <p>8. Chewing gum, eating, drinking, smoking, and other forms of vandalism are prohibited inside the lab.</p>
                <p>9. Anyone causing a continual disturbance will be asked to leave the lab. Acts or gestures offensive to the members of the community, including public display of physical intimacy, are not tolerated.</p>
                <p>10. Persons exhibiting hostile or threatening behavior such as yelling, swearing, or disregarding requests made by lab personnel will be asked to leave the lab.</p>
                <p>11. For serious offense, the lab personnel may call the Civil Security Office (CSU) for assistance.</p>
                <p>12. Any technical problem or difficulty must be addressed to the laboratory supervisor, student assistant or instructor immediately.</p>
                <hr>
                <p style="text-transform: uppercase;"><strong>DISCIPLINARY ACTION</strong></p>
                <ul>
                    <li>First Offense - The Head or the Dean or OIC recommends to the Guidance Center for a suspension from classes for each offender.</li>
                    <li>Second and Subsequent Offenses - A recommendation for a heavier sanction will be endorsed to the Guidance Center.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>