<?php
session_start();

include("php/config.php");

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view personal details </title>
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/footer.css">

    <style>
        #viewdata {
            margin-left: 20px;
            height: 25px;
            width: 350px;
            font-size: 16px;
            padding-left: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
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
            <a href="activity.php" class="activate">Activity</a>
            <a href="personaldetails.php">Personal Details</a>

            <?php
            echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>";
            ?>
            <a href="php/logout.php">Log Out </a>

        </div>
    </div>
    <center>
        <div class="personaldataimg">
            <img src="imgs/personaldata-f.png" alt="Personal data logo" style="width: 100%;">
        </div>
        <div>
            <p>If you want to edit some education information then please update your details .</p>
            <a href="educationaldetails_edit.php">update details</a>
        </div>
        <div class="container1">
            <div class="box form-box1">
                <header>Details</header>
                <form action="" method="post">
                    <div class="field input">
                        <table>
                            <tr>
                                <td>
                                    Enrollment Number
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo "UID", $id; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Username
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_Uname; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Age
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_Age; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_Email; ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                <header>Personal Details</header>
                <form action="" method="post">
                    <div class="field input">
                        <table>
                            <tr>
                                <td>
                                    First Name
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_fname; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Last Name
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_lname; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Gender
                                </td>
                                <td>
                                    <input type="radio" name="gender" value="male" <?php if ($res_gender == 'male') echo 'checked'; ?>> Male
                                    <input type="radio" name="gender" value="female" <?php if ($res_gender == 'female') echo 'checked'; ?>> Female
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Birth Date
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_bdate; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    State
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_state; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Country
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_country; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Contact Number
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_contact; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Education Qualification
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_edu_qualification; ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div class="extralinks">
                <a href="home.php" class="">Go Home</a>
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