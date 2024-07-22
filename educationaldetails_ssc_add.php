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
if (isset($_POST['ssc_submit'])) {
    $ssc_schoolname = $_POST['ssc_schoolname'];
    $ssc_board = $_POST['ssc_board'];
    $ssc_month = $_POST['ssc_month'];
    $ssc_year = $_POST['ssc_year'];
    $ssc_pg = $_POST['ssc_pg'];
    $ssc_pr = $_POST['ssc_pr'];
    $ssc_grade = $_POST['ssc_grade'];

    $id = $_SESSION['id'];

    $insert_query = "INSERT INTO ssc_edu_data(Enroll_id, S_schoolname, S_board, S_month, S_year, S_percentage, S_percentile, S_grade) 
                    VALUES('$id', '$ssc_schoolname', '$ssc_board', '$ssc_month', '$ssc_year', '$ssc_pg', '$ssc_pr', '$ssc_grade')";

    if (mysqli_query($con, $insert_query)) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Record inserted successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // Redirect to personaldetails_view.php after the popup is closed
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = 'educationaldetails_ssc_view.php';
                            }
                        });
                    });
                  </script>";
    }
}
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
    <title>educational details add form-ssc</title>
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/style2.css">
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
        <div class="educationimg" style="margin-bottom: 50px;">
            <img src="imgs/education-f.png" alt="Education data logo" style="width: 20%;">
            <p>If you already insert data then please <a href="educationaldetails_edit.php"><span style="color: blue;">update</span></a> your details .</p>
        </div>
        <div class="container1">
            <div class="box form-box1">
                <header>Add Secondary State Examination [SSC] Details</header>

                <form action="" method="post">
                    <div class="field input">
                        <table>
                            <tr>
                                <td>
                                    <label for="ssc_schoolname">School Name</label>
                                <td>
                                    <input type="text" name="ssc_schoolname" id="ssc_schoolname" value="<?php echo $res_ssc_schoolname; ?>" autocomplete="off" required placeholder="Name of the school">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ssc_board">SSC Board </label>
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
                                    <label for="ssc_month">Month of exam</label>
                                </td>
                                <td>
                                    <input type="text" name="ssc_month" id="ssc_month" value="<?php echo $res_ssc_month ?>" autocomplete="off" required placeholder="Ex: January">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ssc_year">Passing Year of exam</label>
                                </td>
                                <td>
                                    <input type="text" name="ssc_year" id="ssc_year" value="<?php echo $res_ssc_year ?>" autocomplete="off" required placeholder="Ex: 2001">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ssc_pg">Percentage</label>
                                </td>
                                <td>
                                    <input type="text" name="ssc_pg" id="ssc_pg" value="<?php echo $res_ssc_pg ?>" autocomplete="off" required placeholder="00.00%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ssc_pr">Percentile Rank</label>
                                </td>
                                <td>
                                    <input type="text" name="ssc_pr" id="ssc_pr" value="<?php echo $res_ssc_pr ?>" autocomplete="off" required placeholder="00.00">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ssc_grade">Overall Grade</label>
                                </td>
                                <td>
                                    <input type="text" name="ssc_grade" id="ssc_grade" value="<?php echo $res_ssc_grade ?>" autocomplete="off" required placeholder="A1-A2-B1-B2-C1-C2">
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>
                                    <div class="field">
                                        <input type="submit" class="btn" name="ssc_submit" value="submit" required>
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