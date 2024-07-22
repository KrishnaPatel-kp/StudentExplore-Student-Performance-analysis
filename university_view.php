<?php
session_start();

include("php/config.php");

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
}

$edit_query = mysqli_query($con, "SELECT*FROM university_data WHERE Enroll_id=$id ");

while ($result = mysqli_fetch_assoc($edit_query)) {
    $res_uni_name = $result['Uni_name'];
    $res_uni_dep = $result['Uni_department'];
    $res_uni_course = $result['Uni_course'];
    $res_s1 = $result['Sem1'];
    $res_s2 = $result['Sem2'];
    $res_s3 = $result['Sem3'];
    $res_s4 = $result['Sem4'];
    $res_s5 = $result['Sem5'];
    $res_s6 = $result['Sem6'];
    $res_uni_sgpa = $result['Uni_sgpa'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>university Graduation details </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/footer.css">


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
            <img src="imgs/university-f.png" alt="Personal data logo" style="width: 100%;">
        </div>
        <div>
            <p>If you already insert data then please <a href="university_edit.php"><span style="color: blue;">update</span></a> your details .</p>
        </div>
        <div class="container1">
            <div class="box form-box1">
                <header>Graduation Details</header>
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
                                Collage/University Name
                            <td>
                                <p id="viewdata">
                                    <?php echo $res_uni_name; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Department
                            </td>
                            <td>
                                <input type="radio" name="uni_dep" value="B.tech" <?php if ($res_uni_dep == 'B.tech') echo 'checked'; ?>> B.tech
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Course
                            </td>
                            <td>
                                <input type="radio" name="uni_course" value="Computer Engineering" <?php if ($res_uni_course == 'Computer Engineering') echo 'checked'; ?>>Computer Engineering
                                <br>
                                <input type="radio" name="uni_course" value="Information Technology" <?php if ($res_uni_course == 'Information Technology') echo 'checked'; ?>> Information Technology
                                <br>
                                <input type="radio" name="uni_course" value="Machine learning" <?php if ($res_uni_course == 'Machine learning') echo 'checked'; ?>>Machine learning
                                <br>
                                <input type="radio" name="uni_course" value="Artificial Intelligence" <?php if ($res_uni_course == 'Artificial intelleigence') echo 'checked'; ?>>Artificial intelligence
                                <br>
                                <input type="radio" name="uni_course" value="Computer Science" <?php if ($res_uni_course == 'Computer Science') echo 'checked'; ?>>Computer Science
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sem1
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_s1; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sem2
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_s2; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sem3
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_s3; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sem4
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_s4; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sem5
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_s5; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sem6
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_s6; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                All over SGPA rank
                            </td>
                            <td>
                                <p id="viewdata"><?php echo $res_uni_sgpa; ?></p>
                            </td>
                        </tr>
                    </table>
                    <div class="extralinks">
                        <a href="visualization_university.php">compare yourself with others</a>
                    </div>
                </div>
            </div>

        </div>
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