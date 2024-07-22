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

// Handle form submission for updating personal details
if (isset($_POST['personaldetail_submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $bdate = $_POST['birthdate'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $contact = $_POST['contact_number'];
    $edu_qualification = $_POST['education_qualification'];

    $id = $_SESSION['id'];  // Assuming this is the enrollment number

    $edit_query = mysqli_query($con, "UPDATE personal_details SET Firstname='$fname', Lastname='$lname', Gender='$gender', Birthdate='$bdate', State='$state', Country='$country', Contact_number='$contact', Education_qualification='$edu_qualification' WHERE Enroll_id=$id ") or die("error occurred");

    if ($edit_query) {
        echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Record update successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // Redirect to personaldetails_view.php after the popup is closed
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = 'personaldetails_view.php';
                            }
                        });
                    });
                  </script>";
    }
}

// Fetch personal details for pre-filling the form
$id = $_SESSION['id'];
$edit_query1 = mysqli_query($con, "SELECT * FROM personal_details WHERE Enroll_id=$id ");

while ($result = mysqli_fetch_assoc($edit_query1)) {
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
    <title>personal details edit form</title>

    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/footer.css">


    <style>
        .message-p {
            text-align: center;
            padding: 15px 0px;
            border: 1px solid #5640e3;
            border-radius: 5px;
            margin-bottom: 10px;
            color: rgb(4, 110, 34);
        }

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

        .extralinks {
            margin: 25px;
            /* font-size: 15px; */
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
                <header>Edit Personal Details</header>
                <form action="" method="post">
                    <div class="field input">
                        <table>
                            <tr>
                                <td>
                                    <label for="firstname">First Name</label>
                                </td>
                                <td>
                                    <input type="text" name="firstname" id="firstname" value="<?php echo $res_fname; ?>" autocomplete="off" required placeholder="Enter First Name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lastname">Last Name</label>
                                </td>
                                <td>
                                    <input type="text" name="lastname" id="lastname" value="<?php echo $res_lname; ?>" autocomplete="off" required placeholder="Enter Last Name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="gender">Gender </label>
                                </td>
                                <td>
                                    <input type="radio" name="gender" value="male" <?php if ($res_gender == 'male') echo 'checked'; ?>> Male
                                    <input type="radio" name="gender" value="female" <?php if ($res_gender == 'female') echo 'checked'; ?>> Female
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="birthdate">Birth Date</label>
                                </td>
                                <td>
                                    <input type="date" name="birthdate" id="birthdate" value="<?php echo $res_bdate; ?>" required placeholder="dd/mm/yyyy">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="state">State</label>
                                </td>
                                <td>
                                    <input type="text" name="state" id="state" value="<?php echo $res_state; ?>" autocomplete="off" required placeholder="Enter your current state">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="country">Country</label>
                                </td>
                                <td>
                                    <input type="text" name="country" id="country" value="<?php echo $res_country; ?>" autocomplete="off" required placeholder="Enter your current country">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="contact_number">Contact Number</label>
                                </td>
                                <td>
                                    <input type="tel" id="contact_number" name="contact_number" value="<?php echo $res_contact; ?>" placeholder="+91 12345 67890" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="education">Education Qualification</label>
                                </td>
                                <td>
                                    <input type="text" name="education_qualification" id="education_qualification" value="<?php echo $res_edu_qualification; ?>" autocomplete="off" required placeholder="Enter your education qualification">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="field">
                                        <input type="submit" class="btn" name="personaldetail_submit" value="update" required>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>

            <div class="extralinks">
                <a href="shome.php" class="">Go Home</a>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>