<?php
session_start();

include("php/config.php");

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
}


?>
<?php
$id = $_SESSION['id'];
$edit_query = mysqli_query($con, "SELECT*FROM ssc_edu_data WHERE Enroll_id=$id ");

while ($result = mysqli_fetch_assoc($edit_query)) {
    $res_ssc_schoolname = $result['S_schoolname'];
    $res_ssc_board = $result['S_board'];
    $res_ssc_month = $result['S_month'];
    $res_ssc_year = $result['S_year'];
    $res_ssc_pg = $result['S_percentage'];
    $res_ssc_pr = $result['S_percentile'];
    $res_ssc_grade = $result['S_grade'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View educational details - ssc </title>
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/footer.css">


    <style>
        .link-btn {
            text-decoration: none;
            background-color: rgba(76, 68, 182, 0.808);
            color: aliceblue;
            padding: 10px;
            border-radius: 5px;
        }

        .extralinks {
            margin: 25px;
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
        <div class="educationimg">
            <img src="imgs/education-f.png" alt="Education data logo" style="width: 20%;">
        </div>
        <div>
            <p>If you want to edit some education information then please update your details .</p>
            <a href="educationaldetails_ssc_edit.php">update details</a>
        </div>
        <div class="container1">
            <div class="box form-box1">
                <header>Secondary State Examination [SSC] Details</header>
                <form action="" method="post">
                    <div class="field input">
                        <table>
                            <tr>
                                <td>
                                    School Name
                                <td>
                                    <p id="viewdata"><?php echo $res_ssc_schoolname; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    SSC Board
                                </td>
                                <td>
                                    <input type="radio" name="ssc_board" value="State Board" <?php if ($res_ssc_board == 'State Board') echo 'checked'; ?>> State Board
                                    <input type="radio" name="ssc_board" value="CBSC" <?php if ($res_ssc_board == 'CBSC') echo 'checked'; ?>> CBSC
                                    <input type="radio" name="ssc_board" value="NIOS" <?php if ($res_ssc_board == 'NIOS') echo 'checked'; ?>> NIOS
                                    <input type="radio" name="ssc_board" value="ICSE" <?php if ($res_ssc_board == 'ICSC') echo 'checked'; ?>> ICSE
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Month of exam
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_ssc_month; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Passing Year of exam
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_ssc_year; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Percentage
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_ssc_pg; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Percentile Rank
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_ssc_pr; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Overall Grade
                                </td>
                                <td>
                                    <p id="viewdata"><?php echo $res_ssc_grade; ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                <div class="extralinks">
                    <a href="visualization_ssc.php">compare yourself with others</a>
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