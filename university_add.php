<?php
session_start();
include("php/config.php");

// Fetch user details
$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
}
$id = $_SESSION['id'];
// Fetch university data
$edit_query = mysqli_query($con, "SELECT * FROM university_data WHERE Enroll_id=$id ");
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

// Handle form submission
if (isset($_POST['uni_submit'])) {
    $uni_name = $_POST['uni_name'];
    $uni_dep = $_POST['uni_dep'];
    $uni_course = $_POST['uni_course'];
    $s1 = $_POST['sem1'];
    $s2 = $_POST['sem2'];
    $s3 = $_POST['sem3'];
    $s4 = $_POST['sem4'];
    $s5 = $_POST['sem5'];
    $s6 = $_POST['sem6'];
    $total_cgpa = $s1 + $s2 + $s3 + $s4 + $s5 + $s6;
    $average_cgpa = $total_cgpa / 6;
    $uni_sgpa = round($average_cgpa, 2);

    // Update university data
    $query = mysqli_query($con, "INSERT INTO university_data (Enroll_id, Uni_name, Uni_department, Uni_course, Sem1, Sem2, Sem3, Sem4, Sem5, Sem6, Uni_sgpa) VALUES ('$id', '$uni_name', '$uni_dep', '$uni_course', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6', '$uni_sgpa')") or die("error occurred");
    if ($query) {
        // JavaScript code to display success message and redirect user
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Record insert successfully!',
                showConfirmButton: false,
                timer: 2000
            }).then((result) => {
                // Redirect to personaldetails_view.php after the popup is closed
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = 'university_view.php';
                }
            });
        });
      </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>university Grade add form</title>
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
                <header>Add Graduation Details</header>
                <form action="" method="post">
                    <div class="field input">
                        <table>
                            <tr>
                                <td>
                                    <label for="uni_name"> Collage/University Name</label>
                                <td>
                                    <input type="text" name="uni_name" id="uni_name" value="<?php echo $res_uni_name; ?>" autocomplete="off" required placeholder="Name of the school">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="uni_dep">Department </label>
                                </td>
                                <td>
                                    <input type="radio" name="uni_dep" value="B.tech" <?php if ($res_uni_dep == 'B.tech') echo 'checked'; ?>> B.tech
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="uni_course">Course</label>
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
                                    <label for="sem1">Sem1</label>
                                </td>
                                <td>
                                    <input type="text" name="sem1" id="sem1" value="<?php echo $res_s1; ?>" autocomplete="off" required placeholder="CGPA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sem2">Sem2</label>
                                </td>
                                <td>
                                    <input type="text" name="sem2" id="sem2" value="<?php echo $res_s2; ?>" autocomplete="off" required placeholder="CGPA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sem3">Sem3</label>
                                </td>
                                <td>
                                    <input type="text" name="sem3" id="sem3" value="<?php echo $res_s3; ?>" autocomplete="off" required placeholder="CGPA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sem4">Sem4</label>
                                </td>
                                <td>
                                    <input type="text" name="sem4" id="sem4" value="<?php echo $res_s4; ?>" autocomplete="off" required placeholder="CGPA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sem5">Sem5</label>
                                </td>
                                <td>
                                    <input type="text" name="sem5" id="sem5" value="<?php echo $res_s5; ?>" autocomplete="off" required placeholder="CGPA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sem6">Sem6</label>
                                </td>
                                <td>
                                    <input type="text" name="sem6" id="sem6" value="<?php echo $res_s6; ?>" autocomplete="off" required placeholder="CGPA">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>
                                    <label for="uni_sgpa">All over SGPA rank</label>
                                </td>
                                <td>
                                    <input type="text" name="uni_sgpa" id="uni_sgpa" value="<?php echo $res_uni_sgpa; ?>" autocomplete="off" required placeholder="00.00">
                                </td>
                            </tr> -->
                            <tr>
                                <td></td>
                                <td>
                                    <div class="field">
                                        <input type="submit" class="btn" name="uni_submit" value="submit" required>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
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



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>