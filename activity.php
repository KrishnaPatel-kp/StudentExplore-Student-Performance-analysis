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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style/style2.css"> -->
    <!-- <link rel="stylesheet" href="style/activity.css"> -->
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/footer.css">
    <!-- <link rel="stylesheet" href="style/activity2.css"> -->
    <title>Activity page</title>


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

    <div class="container" style="background-color: rgba(212, 213, 226, 0.8); padding:70px;">
        <div class="boxforboth" style="display: flex; background-color:#fff; border-radius:100px; padding:20px; width:100%;">
            <div class="img-content" style="width:40%;">
                <img src="https://img.freepik.com/premium-vector/boys-girls-climb-stacks-books-achievement-level-education-development_327176-372.jpg?w=2000" alt="education image" height="400px" width="100%" style="padding-left: 20px;">
            </div>
            <div class="content" style="width: 60%;">
                <h1>Student Performance Analyse Section</h1>
                <p style="padding: 20px;">
                    To facilitate comprehensive analysis of student performance across various educational levels, our education section encompasses three distinct segments dedicated to collecting details on <br> <span style="color:green">SSC</span> (Secondary School Certificate),<br> <span style="color:green">HSC</span> (Higher Secondary Certificate), <br><span style="color:green">Graduation</span> education. <br><br>In order to effectively evaluate performance among peer students, we require pertinent data from users for analysis.This data will enable us to conduct thorough assessments and identify trends or patterns in academic achievement. <br><br> Therefore, we kindly <span style="color: green;">request</span> users to <b>provide</b> the necessary information to enhance our analytical capabilities and provide valuable insights into student performance.
                </p>
            </div>
        </div>
    </div>


    <div class="box-button" style="width: 100%; height:250px; padding-top:50px; padding-bottom:50px; padding-left:100px;padding-right:150px;">
        <div class="capsual" style="width: 100%; height: 200px; padding:30px;  border-radius:100px; background-color:rgba(212, 213, 226, 0.8); display:flex; justify-content:space-evenly;">
            <div class="ractangle" style="height: 100px; width:450px;">
                <p style="font-size: 30px; text-align:center; align-items:center; font-weight:700;padding-top:25px;color:rgba(47, 31, 78, 0.8);">SSC Performance Section : </p>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="educationaldetails_ssc_add.php">
                    <img src="https://as2.ftcdn.net/v2/jpg/03/36/01/59/1000_F_336015944_CMABXzy0gTKygHVRcJjkhbhS7lc3esch.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Add</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="educationaldetails_ssc_edit.php">
                    <img src="https://as2.ftcdn.net/v2/jpg/04/47/24/73/1000_F_447247307_ijZAptYcJONjuk65G5jVKMF0Sz68irTG.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Edit</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="educationaldetails_ssc_view.php">
                    <img src="https://img.freepik.com/free-psd/camera-outline-logo-design_23-2151263972.jpg?t=st=1710164686~exp=1710168286~hmac=4d38944ef5d9b6b8362dae06594af393a03b47289fdcefb759eefe9e3919171b&w=1480" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">View</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="visualization_ssc.php">
                    <img src="https://as1.ftcdn.net/v2/jpg/07/30/67/84/1000_F_730678411_EjJicAxYMw8YRNkgxLZypLa54sipVpbg.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Analyse</p>
                </a>
            </div>
        </div>
    </div>

    <div class="box-button" style="width: 100%; height:250px; padding-top:50px; padding-bottom:50px; padding-left:100px;padding-right:150px;">
        <div class="capsual" style="width: 100%; height: 200px; padding:30px;  border-radius:100px; background-color:rgba(212, 213, 226, 0.8); display:flex; justify-content:space-evenly;">
            <div class="ractangle" style="height: 100px; width:450px;">
                <p style="font-size: 30px; text-align:center; align-items:center; font-weight:700;padding-top:25px;color:rgba(47, 31, 78, 0.8);">HSC Performance Section : </p>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="educationaldetails_hsc_add.php">
                    <img src="https://as2.ftcdn.net/v2/jpg/03/36/01/59/1000_F_336015944_CMABXzy0gTKygHVRcJjkhbhS7lc3esch.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Add</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="educationaldetails_hsc_edit.php">
                    <img src="https://as2.ftcdn.net/v2/jpg/04/47/24/73/1000_F_447247307_ijZAptYcJONjuk65G5jVKMF0Sz68irTG.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Edit</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="educationaldetails_hsc_view.php">
                    <img src="https://img.freepik.com/free-psd/camera-outline-logo-design_23-2151263972.jpg?t=st=1710164686~exp=1710168286~hmac=4d38944ef5d9b6b8362dae06594af393a03b47289fdcefb759eefe9e3919171b&w=1480" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">View</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="visualization_hsc.php">
                    <img src="https://as1.ftcdn.net/v2/jpg/07/30/67/84/1000_F_730678411_EjJicAxYMw8YRNkgxLZypLa54sipVpbg.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Analyse</p>
                </a>
            </div>
        </div>
    </div>

    <div class="box-button" style="width: 100%; height:250px; padding-top:50px; padding-bottom:50px; padding-left:100px;padding-right:150px; margin-bottom:80px;">
        <div class="capsual" style="width: 100%; height: 200px; padding:30px;  border-radius:100px; background-color:rgba(212, 213, 226, 0.8); display:flex; justify-content:space-evenly;">
            <div class="ractangle" style="height: 100px; width:450px;">
                <p style="font-size: 30px; text-align:center; align-items:center; font-weight:700;padding-top:25px;color:rgba(47, 31, 78, 0.8);">Graduation Performance Section : </p>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="university_add.php">
                    <img src="https://as2.ftcdn.net/v2/jpg/03/36/01/59/1000_F_336015944_CMABXzy0gTKygHVRcJjkhbhS7lc3esch.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Add</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="university_edit.php">
                    <img src="https://as2.ftcdn.net/v2/jpg/04/47/24/73/1000_F_447247307_ijZAptYcJONjuk65G5jVKMF0Sz68irTG.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Edit</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="university_view.php">
                    <img src="https://img.freepik.com/free-psd/camera-outline-logo-design_23-2151263972.jpg?t=st=1710164686~exp=1710168286~hmac=4d38944ef5d9b6b8362dae06594af393a03b47289fdcefb759eefe9e3919171b&w=1480" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">View</p>
                </a>
            </div>
            <div style="align-items: center; text-align:center;">
                <a href="visualization_university.php">
                    <img src="https://as1.ftcdn.net/v2/jpg/07/30/67/84/1000_F_730678411_EjJicAxYMw8YRNkgxLZypLa54sipVpbg.jpg" alt="add" height="100px" style="border-radius: 50px;">
                    <p style="font-weight:600;">Analyse</p>
                </a>
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