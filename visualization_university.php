<?php
session_start();
include("/Applications/XAMPP/xamppfiles/htdocs/StudentExplore/php/config.php");

// Fetch university data from the database
$university_data = mysqli_query($con, "SELECT * FROM university_data ORDER BY Enroll_id ASC");

$num_rows = mysqli_num_rows($university_data);
$chart_data_sem1 = array();
$chart_data_sem2 = array();
$chart_data_sem3 = array();
$chart_data_sem4 = array();
$chart_data_sem5 = array();
$chart_data_sem6 = array();


if ($num_rows > 0) {
    $counter = 1; // Start counter from 1
    while ($row = mysqli_fetch_assoc($university_data)) {
        // Ensure semester values are between 0 and 10
        $sem1 = min(max($row['Sem1'], 0), 10);
        $sem2 = min(max($row['Sem2'], 0), 10);
        $sem3 = min(max($row['Sem3'], 0), 10);
        $sem4 = min(max($row['Sem4'], 0), 10);
        $sem5 = min(max($row['Sem5'], 0), 10);
        $sem6 = min(max($row['Sem6'], 0), 10);

        $chart_data_sem1[] = array($counter, $sem1); // Include only Sem1 in chart data
        $chart_data_sem2[] = array($counter, $sem2); // Include only Sem2 in chart data
        $chart_data_sem3[] = array($counter, $sem3); // Include only Sem3 in chart data
        $chart_data_sem4[] = array($counter, $sem4); // Include only Sem4 in chart data
        $chart_data_sem5[] = array($counter, $sem5); // Include only Sem5 in chart data
        $chart_data_sem6[] = array($counter, $sem6); // Include only Sem6 in chart data
        $counter++;
    }
}
?>
<?php
// Assuming you have fetched the data from your database and stored it in $student_data variable

// Sort the student data by branch
$branch_wise_data = array();

foreach ($student_data as $student) {
    $branch = $student['Uni_course'];
    if (!isset($branch_wise_data[$branch])) {
        $branch_wise_data[$branch] = array();
    }
    $branch_wise_data[$branch][] = $student;
}

// Now, $branch_wise_data contains arrays of students grouped by branch

// Function to generate table HTML for a given branch
function generateBranchTable($branch, $students)
{
    echo "<h2>Branch: $branch</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Enrollment ID</th><th>Uni_course</th><th>Uni_sgpa</th></tr>";
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . $student['Enroll_id'] . "</td>";
        echo "<td>" . $student['Uni_course'] . "</td>";
        echo "<td>" . $student['Uni_sgpa'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Generate tables for each branch
foreach ($branch_wise_data as $branch => $students) {
    generateBranchTable($branch, $students);
}

$student_data = mysqli_query($con, "SELECT * FROM university_data ORDER BY Uni_course ASC");

// Sort the student data by branch
$branch_wise_data = array();

while ($row = mysqli_fetch_assoc($student_data)) {
    $branch = $row['Uni_course'];
    if (!isset($branch_wise_data[$branch])) {
        $branch_wise_data[$branch] = array();
    }
    $branch_wise_data[$branch][] = $row;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Comparison Graduation</title>
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/graph.css">
    <link rel="stylesheet" href="style/footer.css">

    <style>
        .tables-container {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            height: 400px;
            margin-bottom: 100px;
            /* Enable horizontal scrolling on smaller screens */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            /* Add margin between tables */
            height: 150px;
            /* Fix the height of the table */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            height: 30px;
            /* Fix the height of table rows (tr) and cells (td) */
        }

        th {
            background-color: #f2f2f2;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: none;
            border-top: 1px solid #ccc;
        }

        .table-title {
            background-color: #ddd;
            font-weight: bold;
            padding: 8px;
            border-radius: 5px 5px 0 0;
            text-align: center;
            /* Center align the course name */
            font-size: 18px;
            /* Adjust font size for main heading */
        }

        /* Responsive table */
        @media screen and (max-width: 600px) {

            th,
            td {
                font-size: 12px;
            }
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawSemester1BarChart();
            drawSemester2BarChart();
            drawSemester3BarChart();
            drawSemester4BarChart();
            drawSemester5BarChart();
            drawSemester6BarChart();


            drawSemester1AreaChart();
            drawSemester2AreaChart();
            drawSemester3AreaChart();
            drawSemester4AreaChart();
            drawSemester5AreaChart();
            drawSemester6AreaChart();
        }

        function drawSemester1BarChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 1');

            <?php
            foreach ($chart_data_sem1 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 1 Performance Analysis (Bar Chart)',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sem1_bar_chart'));
            chart.draw(data, options);
        }

        function drawSemester2BarChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 2');

            <?php
            foreach ($chart_data_sem2 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 2 Performance Analysis (Bar Chart)',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                colors: ['green'] // Set color to green for Semester 2
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sem2_bar_chart'));
            chart.draw(data, options);
        }
        // Functions for drawing bar charts for Semester 3, Semester 4, Semester 5, Semester 6 go here...
        function drawSemester3BarChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 3');

            <?php
            foreach ($chart_data_sem3 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 3 Performance Analysis (Bar Chart)',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                colors: ['orange'] // Set color to yellow for Semester 3
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sem3_bar_chart'));
            chart.draw(data, options);
        }

        function drawSemester4BarChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 4');

            <?php
            foreach ($chart_data_sem4 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 4 Performance Analysis (Bar Chart)',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                colors: ['hotpink'] // Set color to pink for Semester 4
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sem4_bar_chart'));
            chart.draw(data, options);
        }

        function drawSemester5BarChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 5');

            <?php
            foreach ($chart_data_sem5 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 5 Performance Analysis (Bar Chart)',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                colors: ['purple'] // Set color to purple for Semester 5
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sem5_bar_chart'));
            chart.draw(data, options);
        }

        function drawSemester6BarChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 6');

            <?php
            foreach ($chart_data_sem6 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 6 Performance Analysis (Bar Chart)',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                colors: ['red'] // Set color to red for Semester 6
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sem6_bar_chart'));
            chart.draw(data, options);
        }
        // Area chart drawing functions for Semester 1, Semester 2, etc. go here...
        function drawSemester1AreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 1');

            <?php
            foreach ($chart_data_sem1 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 1 Performance Analysis (Area Chart)',
                isStacked: true, // This stacks the area series
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                series: {
                    0: { // Define properties for the first series (Semester 1)
                        areaOpacity: 0.3 // Set opacity for the area chart
                    }
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('sem1_area_chart'));
            chart.draw(data, options);
        }

        function drawSemester2AreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 2');

            <?php
            foreach ($chart_data_sem2 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 2 Performance Analysis (Area Chart)',
                isStacked: true, // This stacks the area series
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                series: {
                    0: { // Define properties for the first series (Semester 2)
                        areaOpacity: 0.3 // Set opacity for the area chart
                    }
                },
                colors: ['green'] // Set color to green for Semester 2
            };

            var chart = new google.visualization.AreaChart(document.getElementById('sem2_area_chart'));
            chart.draw(data, options);
        }
        // Area chart drawing functions for Semester 3, Semester 4, Semester 5, Semester 6 go here...
        function drawSemester3AreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 3');

            <?php
            foreach ($chart_data_sem3 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 3 Performance Analysis (Area Chart)',
                isStacked: true, // This stacks the area series
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                series: {
                    0: { // Define properties for the first series (Semester 3)
                        areaOpacity: 0.3 // Set opacity for the area chart
                    }
                },
                colors: ['orange'] // Set color to yellow for Semester 3
            };

            var chart = new google.visualization.AreaChart(document.getElementById('sem3_area_chart'));
            chart.draw(data, options);
        }

        function drawSemester4AreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 4');

            <?php
            foreach ($chart_data_sem4 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 4 Performance Analysis (Area Chart)',
                isStacked: true, // This stacks the area series
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                series: {
                    0: { // Define properties for the first series (Semester 4)
                        areaOpacity: 0.3 // Set opacity for the area chart
                    }
                },
                colors: ['hotpink'] // Set color to pink for Semester 4
            };

            var chart = new google.visualization.AreaChart(document.getElementById('sem4_area_chart'));
            chart.draw(data, options);
        }

        function drawSemester5AreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 5');

            <?php
            foreach ($chart_data_sem5 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 5 Performance Analysis (Area Chart)',
                isStacked: true, // This stacks the area series
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                series: {
                    0: { // Define properties for the first series (Semester 5)
                        areaOpacity: 0.3 // Set opacity for the area chart
                    }
                },
                colors: ['purple'] // Set color to purple for Semester 5
            };

            var chart = new google.visualization.AreaChart(document.getElementById('sem5_area_chart'));
            chart.draw(data, options);
        }

        function drawSemester6AreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Semester 6');

            <?php
            foreach ($chart_data_sem6 as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Semester 6 Performance Analysis (Area Chart)',
                isStacked: true, // This stacks the area series
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                },
                vAxis: {
                    title: 'CGPA',
                    minValue: 0,
                    maxValue: 10
                },
                series: {
                    0: { // Define properties for the first series (Semester 6)
                        areaOpacity: 0.3 // Set opacity for the area chart
                    }
                },
                colors: ['red'] // Set color to red for Semester 6
            };

            var chart = new google.visualization.AreaChart(document.getElementById('sem6_area_chart'));
            chart.draw(data, options);
        }
    </script>
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

            <?php echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>"; ?>
            <a href="php/logout.php">Log Out </a>
        </div>
    </div>
    <center>
        <div class="personaldataimg">
            <img src="imgs/performance-f1.png" alt="Personal data logo" style="width: 100%;">
        </div>
        <div>
            <p>If you want to change/update data then please <a href="university_edit.php"><span style="color: blue;">update</span></a> your details .</p>
        </div>
    </center>
    <div class="div-header">
        <h1>Graduation Performance Analysis</h1>
        <p style="font-size: 20px;">Enrollment Number : <?php echo $id; ?></p>

    </div>

    <div style="display: flex; flex-direction:row;">
        <div id="sem1_bar_chart" style="height: 200px; width: 50%;"></div>
        <div id="sem1_area_chart" style="height: 200px; width: 50%;"></div>
    </div>
    <div style="display: flex; flex-direction:row;">
        <div id="sem2_bar_chart" style="height: 200px; width: 50%;"></div>
        <div id="sem2_area_chart" style="height: 200px; width: 50%;"></div>
    </div>


    <div style="display: flex; flex-direction:row;">
        <div id="sem3_bar_chart" style="height: 200px; width: 50%;"></div>
        <div id="sem3_area_chart" style="height: 200px; width: 50%;"></div>
    </div>
    <div style="display: flex; flex-direction:row;">
        <div id="sem4_bar_chart" style="height: 200px; width: 50%;"></div>
        <div id="sem4_area_chart" style="height: 200px; width: 50%;"></div>
    </div>


    <div style="display: flex; flex-direction:row;">
        <div id="sem5_bar_chart" style="height: 200px; width: 50%;"></div>
        <div id="sem5_area_chart" style="height: 200px; width: 50%;"></div>
    </div>
    <div style="display: flex; flex-direction:row;">
        <div id="sem6_bar_chart" style="height: 200px; width: 50%;"></div>
        <div id="sem6_area_chart" style="height: 200px; width: 50%;"></div>
    </div>


    <div class="div-header" style="text-align: center; margin-top:20px; font-weight:200;">
        <h1>Branch-wise Student Sorting</h1>
    </div>
    <!-- Generate tables for each branch -->
    <div class="tables-container" style="display: flex;">
        <?php
        foreach ($branch_wise_data as $branch => $students) {
            echo "<table>";
            echo "<tr><th colspan='2' class='table-title'>$branch</th></tr>"; // Course name as the main heading
            echo "<tr><th>Enrollment ID</th><th>SGPA</th></tr>"; // Adjusted column headers
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>" . $student['Enroll_id'] . "</td>";
                echo "<td>" . $student['Uni_sgpa'] . "</td>"; // Adjusted column data
                echo "</tr>";
            }
            echo "</table>";
            echo "<hr>"; // Add horizontal line as separator
        }
        ?>
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