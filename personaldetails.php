<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>
<?php

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
    $res_id = $result['Id'];
}
$edit_query = mysqli_query($con, "SELECT*FROM personal_details WHERE Enroll_id=$id ");

while ($result = mysqli_fetch_assoc($edit_query)) {
    $res_fname = $result['Firstname'];
    $res_lname = $result['Lastname'];
    $res_gender = $result['Gender'];
    $res_bdate = $result['Birthdate'];
    $res_state = $result['State'];
    $res_country = $result['Country'];
    $res_contact = $result['Contact_number'];
    $res_edu_qualification = $result['Education_qualification'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/activity.css">
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/activity2.css">
    <link rel="stylesheet" href="style/footer.css">

    <title>Activity page</title>

    <style>
        .graph-container {
            width: 60%;
            /* Adjusted width for better responsiveness */
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            align-items: center;
        }

        .container1 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            /* Changed background color */
        }

        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* Slightly reduced border-radius */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* Increased box shadow */
            width: 90%;
            /* Adjusted width */
            max-width: 800px;
            /* Added max-width */
        }

        .box header {
            font-size: 32px;
            /* Slightly reduced font size */
            margin-bottom: 20px;
            /* Added margin bottom */
        }

        .field {
            margin-bottom: 15px;
            /* Reduced margin bottom */
        }

        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"],
        .field input[type="number"],
        .field textarea,
        .field select {
            width: calc(100% - 22px);
            /* Adjusted input width */
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            /* Increased font size */
        }

        .field label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            /* Reduced margin bottom */
            font-size: 16px;

            /* Increased font size */
        }

        .field p {
            margin: 0;
            font-size: 16px;
            /* Increased font size */
        }

        .field table {
            width: 100%;
            border-collapse: collapse;
        }

        .field table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-weight: 500;
            /* Lighter border color */
        }

        .field table tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="logo">
            StudentExplore ~ <span style="font-size: 15px;"><?php echo $res_Uname ?></span>
        </div>
        <div class="right-links">
            <a href="shome.php">Home</a>
            <a href="activity.php">Activity</a>
            <a href="personaldetails.php" class="activate">Personal Details</a>

            <?php
            echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>";
            ?>
            <a href="php/logout.php">Log Out </a>

        </div>
    </div>


    <div style="width: 100%; height: 600px; border:1px solid white;background-color:rgba(212, 213, 226, 0.8);">
        <div style="width: 85%; height:400px; margin:100px; border-radius:50px; background-color:#fff; align-items:center; display:flex;">
            <div style="height: 300px; width:40%; align-items:center; padding:50px;">
                <img src="image/p3.jpg" alt="personal deatil img" height="200px" width="400px">
            </div>
            <div style="height:300px; width:60%;">
                <h1 style="font-weight:600; font-size:25px; color:#4a5568; margin-bottom:30px;">Personal Details</h1>

                <div style="display: flex; margin-bottom:10px;">
                    <div style="height: 50px; width: 50px; background-color:#a7a8c7; color:#fff; border-radius:20px;">
                        <p style="font-size: 30px; align-items:center; text-align:center;">01</p>
                    </div>
                    <div style="padding-left: 30px;">
                        <p style="font-weight:500; font-size:18px; color:#5255a8">Add your personal details here.</p>
                        <a href="personaldetails_add.php" style="font-size: 14px;"> <span style="text-decoration: none; color:#4a5568;font-weight: 600; ">click</span></a> here to add details.
                    </div>
                </div>
                <div style="display: flex; margin-bottom:10px;">
                    <div style="height: 50px; width: 50px; background-color:#a7a8c7; color:#fff; border-radius:20px;">
                        <p style="font-size: 30px; align-items:center; text-align:center;">02</p>
                    </div>
                    <div style="padding-left: 30px;">
                        <p style="font-weight:500; font-size:18px; color:#5255a8">Edit your personal details here.</p>
                        <a href="personaldetails_edit.php" style="font-size: 14px;"> <span style="text-decoration: none; color:#4a5568;font-weight: 600; ">click</span></a> here to add details.
                    </div>
                </div>
                <div style="display: flex; margin-bottom:10px;">
                    <div style="height: 50px; width: 50px; background-color:#a7a8c7; color:#fff; border-radius:20px;">
                        <p style="font-size: 30px; align-items:center; text-align:center;">03</p>
                    </div>
                    <div style="padding-left: 30px;">
                        <p style="font-weight:500; font-size:18px; color:#5255a8">View your personal details here.</p>
                        <a href="personaldetails_view.php" style="font-size: 14px;"> <span style="text-decoration: none; color:#4a5568;font-weight: 600; ">click</span></a> here to add details.
                    </div>
                </div>

            </div>
        </div>
    </div>

    <center>
        <div class="container1">
            <div class="box form-box1">
                <header style="font-size: 40px;">Details</header>
                <div class="field input">
                    <table>
                        <tr>
                            <td>Enrollment Number</td>
                            <td>
                                <p id="viewdata"><?php echo "UID", $id; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>
                                <p id="viewdata"><?php echo $res_Uname; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>
                                <p id="viewdata"><?php echo $res_Age; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <p id="viewdata"><?php echo $res_Email; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td>
                                <p id="viewdata"><?php echo $res_fname; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>
                                <p id="viewdata"><?php echo $res_lname; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <p id="viewdata"><?php echo $res_gender; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Birth Date</td>
                            <td>
                                <p id="viewdata"><?php echo $res_bdate; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>
                                <p id="viewdata"><?php echo $res_state; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <p id="viewdata"><?php echo $res_country; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td>
                                <p id="viewdata"><?php echo $res_contact; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Education Qualification</td>
                            <td>
                                <p id="viewdata"><?php echo $res_edu_qualification; ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </center>
    <footer style="margin-top:50px; margin-bottom:50px; padding-top:30px;border-top: 0.5px solid black;">
        <div class="footer-container" style=" height:250px; align-items:first baseline;  ">
            <div class="footer-info">
                <h3>About Me</h3>
                <p>Krishna Patel</p>
                <p>21SE02CE032</p>
                <p>B.Tech Computer Engineering</p>
                <p>Semester-6 (2024)</p>
                <p><a href="mailto:21se02ce032@ppau.ac.in">21se02ce032@ppsu.ac.in</a></p>
                <p><a href="mailto:krishnapatel2483@gmail.com">krishnapatel2483@gmail.com</a></p>
                <p>Minor Project </p>
                <p>Education Insight : Revolutionizing Student Performance Analysis </p>
            </div>
            <div class="footer-info">
                <h3>Mentorship Of</h3>
                <p>Mr. Mitulkumar Patel</p>
                <p>Assistant Professor</p>
                <p>School of Engineering</p>
                <p><a href="mailto:mitul.patel@ppsu.ac.in">mitul.patel@ppsu.ac.in</a></p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="shome.php">Home</a></li>
                    <li><a href="activity.php">Activity</a></li>
                    <li><a href="visualization_ssc.php">SSC Analyse</a></li>
                    <li><a href="visualization_hsc.php">HSC Analyse</a></li>
                    <li><a href="visualizatoin_graduation.php">Graduation Analyse</a></li>
                    <li><a href="personaldetails.php">Quick Start</a></li>

                </ul>
            </div>
            <div class="footer-links">
                <h3>APRIL 2024</h3>
                <p>P P SAVANI SCHOOL OF ENGINEERING</p>
                <p>P P SAVANI UNIVERSITY</p>
                <img src="image/logoSOE.png" alt="soe" height="60px" width="300px">
                <div style="display: flex; justify-content:space-between; padding-right:30px; margin-top:50px;">
                    <p><a href="https://www.linkedin.com/in/krishna-patel-7a8448248/" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/linkedin.svg" alt="LinkedIn" style="width: 30px; height: 30px;"></a></p>
                    <p><a href="https://github.com/krishnapatel2408?tab=repositories" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/github.svg" alt="GitHub" style="width: 30px; height: 30px;"></a></p>
                    <p><a href="https://www.instagram.com/" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/instagram.svg" alt="Instagram" style="width: 30px; height: 30px;"></a></p>
                    <p><a href="https://twitter.com/" target="_blank"><img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/twitter.svg" alt="Twitter" style="width: 30px; height: 30px;"></a></p>
                     <p><a href="mailto:21se02ce032@ppsu.ac.in"><img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/gmail.svg" alt="Email" style="width: 30px; height: 30px;"></a></p>

                </div>
            </div>

        </div>

    </footer>


</body>

</html>