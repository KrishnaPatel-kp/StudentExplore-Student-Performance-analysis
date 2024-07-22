<?php
session_start();

include("php/config.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentExplore - Data Visualization for Students after</title>
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/footer.css">

    <!-- <link rel="stylesheet" href="style/shome.css"> -->
    <style>
        .slider {
            width: 70%;
            /* Adjust the width as needed */
            height: 60vh;
            /* Adjust the height as needed */
            overflow: hidden;
            position: relative;
            margin: 0 auto;
            /* Center the slider */
        }

        .slides {
            display: flex;
            width: 300%;
            /* Adjust the width according to the number of slides */
            height: 100%;
        }

        .slide {
            min-width: 33.33%;
            /* Adjust according to the number of slides */
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0 20px;
            /* Adjust the padding as needed */
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
            /* Transparent gradient background */
        }

        .slide-content {
            color: #fff;
            /* White color for text */
            text-align: left;
            /* Shift text to the right side */
            opacity: 0;
            transition: opacity 0.5s;
        }

        @keyframes slideContent {

            0%,
            100% {
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }
        }
    </style>

</head>

<body>
    <header style="margin:0px;">
        <nav style="margin:0px;">
            <div class="nav">
                <div class="logo">
                    StudentExplore ~ <span style="font-size: 15px;"><?php echo $res_Uname ?></span>
                </div>
                <div class="right-links">
                    <a href="shome.php" class="activate">Home</a>
                    <a href="activity.php">Activity</a>
                    <a href="personaldetails.php">Personal Details</a>

                    <?php
                    echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>";
                    ?>
                    <a href="php/logout.php">logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="background" style="height: 100vh; width: 100%;  position: relative;">
        <div class="slider" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
            <div class="slides" style="display: flex; width: 300%;">
                <div class="slide" style="min-width: 33.33%; height: 100%; background-image: url('image/s4.jpg');"></div>
                <div class="slide" style="min-width: 33.33%; height: 100%; background-image: url('image/s2.jpg');"></div>
                <div class="slide" style="min-width: 33.33%; height: 100%; background-image: url('image/s6.jpg');"></div>
                <!-- Add more slides as needed -->
            </div>
        </div>
        <div class="content">
            <div class="slide-content" style="animation: slideContent 9s infinite;">
                <h1 style="font-size: 80px;"> StudentExplore</h1>
                <p>A cutting-edge web application designed for student performance analysis. <br> Gain insightful graphical visualizations, compare your performance with peers, <br>and unlock the full potential of your academic experience.</p>
                <div style="margin-top: 20px;">
                    <a href="activity.php"><button style="height: 40px; width:150px; font-size:15px;">Start Activity</button></a>
                </div>
            </div>
        </div>
    </div>


    <div class="main" style="background-color:rgba(212, 213, 226, 0.8); width:100%; margin-top:150px; padding:50px;">
        <div class="heading" style="text-align: center;">
            <p style="font-size: 60px; font-weight:600;">Our Area Of Analysis!</p>
            <p>Explore your performance Here.</p>
        </div>
        <div style="height: 400px; width:100%; display:flex; justify-content:space-evenly; padding:50px; ">
            <a href="visualization_ssc.php" style="text-decoration: none; color:black;">
                <div style="width:33.33%;  margin:0 auto; text-align:center;padding:30px;">
                    <img src="https://img.freepik.com/premium-vector/online-data-hand-drawn-illustration-website-analytics_203633-5763.jpg?w=1480" alt="ssc" height="150px" width="150px" style="border-radius: 100px;">
                    <div style="text-align: center;">
                        <p style="font-size: 20px; font-weight:800;">SSC Performance</p>
                        <p>explore this section.</p>
                    </div>
            </a>
        </div>

        <a href="visualization_hsc.php" style="text-decoration: none; color:black;">
            <div style="width:33.33%;  margin:0 auto; text-align:center;padding:30px;">
                <img src="https://img.freepik.com/free-vector/digital-learning-abstract-concept-vector-illustration-digital-distance-education-elearning-flipped-smart-classroom-training-courses-online-teaching-video-call-home-office-abstract-metaphor_335657-5860.jpg?w=1480&t=st=1710317697~exp=1710318297~hmac=aac8f4be58d865622de884c293f55c6caca62c20e8940342f3f3d0033eec3f42" alt="ssc" height="150px" width="150px" style="border-radius: 100px;">
                <div style="text-align: center;">
                    <p style="font-size: 20px; font-weight:800;">HSC Performance</p>
                    <p>explore this section.</p>
                </div>
        </a>
    </div>

    <a href="visualization_university.php" style="text-decoration: none; color:black;">
        <div style="width:33.33%; margin:0 auto; text-align:center;padding:30px;">
            <img src="https://img.freepik.com/premium-vector/online-data-hand-drawn-illustration-website-analytics_203633-5765.jpg?w=1480" alt="ssc" height="150px" width="150px" style="border-radius: 100px;">
            <div style="text-align: center;">
                <p style="font-size: 20px; font-weight:800;">Graduation Performance</p>
                <p>explore this section.</p>
            </div>
    </a>
    </div>

    </div>
    </div>

    <div class="primary-edu" style="background-color: #fff; height:500px; width:100%; padding:100px; align-items:center;align-items:center;">
        <div class="primary-info" style="background-color: rgba(212, 213, 226, 0.8); height:400px;width:80%; border-radius:100px;  margin-left:150px;margin-right:100px;">
            <div class="prim" style="padding: 50px;">
                <p style="padding-bottom: 30px; font-size:30px; color:rgba(75, 57, 108, 0.8); font-weight:500;">SSC & HSC Education Details.</p>
                <p>
                    The form for SSC and HSC details entails gathering specific information including the <b>school name, passing year and month of the exam, board of examination, percentage achieved, percentile rank, and grade obtained</b>. <br><br>By collecting these details, we can perform a comprehensive analysis alongside peer students, allowing for meaningful comparisons and insights into academic performance trends. <br> <br>Therefore, users are encouraged to <span style="color: green;">provide</span> accurate data to facilitate a thorough examination and enhance our ability to discern patterns and achievements among peers.
                </p>
            </div>
        </div>
    </div>

    <div class="primary-edu" style="background-color: #fff; height:500px; width:100%; padding:100px; align-items:center;align-items:center; margin-bottom:50px;">
        <div class="primary-info" style="background-color: rgba(212, 213, 226, 0.8); height:400px;width:80%; border-radius:100px;  margin-left:150px;margin-right:100px;">
            <div class="prim" style="padding: 50px;">
                <p style="padding-bottom: 30px; font-size:30px; color:rgba(75, 57, 108, 0.8); font-weight:500;">Graduation Education Details.</p>
                <p>
                    In the section dedicated to analyzing graduation performance, <br> users are prompted to input essential details including the university name and degree pursued, such as B.Tech. Furthermore, users are required to specify the courses undertaken, which may include fields like computer engineering, computer science, artificial intelligence, information technology, and machine learning. Additionally, users are asked to provide semester-wise <span style="color: green;">CGPA (Cumulative Grade Point Average) </span>details, from which the system calculates the <span style="color: green;">SGPA (Semester Grade Point Average) </span>automatically. <br><br> By furnishing this information, users contribute to a comprehensive <b>analysis of academic performance </b>throughout their undergraduate studies, facilitating comparisons and insights into their <b>progress</b> and achievements.</p>
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



    <script>
        const slides = document.querySelectorAll('.slide');
        const slider = document.querySelector('.slides');

        let index = 0;

        function slide() {
            index++;

            if (index === slides.length) {
                index = 0;
            }

            const size = slides[index].clientWidth;

            slider.style.transform = `translateX(-${size * index}px)`;
        }

        setInterval(slide, 3000); // Change slide every 3 seconds (adjust as needed)
    </script>
</body>

</html>