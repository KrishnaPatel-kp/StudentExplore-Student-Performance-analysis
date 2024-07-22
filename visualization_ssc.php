<?php
session_start();
include("/Applications/XAMPP/xamppfiles/htdocs/StudentExplore/php/config.php");
$ssc_data = mysqli_query($con, "SELECT * FROM ssc_edu_data ORDER BY Enroll_id ASC");

$num_rows = mysqli_num_rows($ssc_data);
$chart_data = array();

if ($num_rows > 0) {
    $counter = 1; // Start counter from 1
    while ($row = mysqli_fetch_assoc($ssc_data)) {
        $percentage = min(max($row['S_percentage'], 0), 100);
        $percentile = min(max($row['S_percentile'], 0), 100);
        $chart_data[] = array($counter++, $percentage, $percentile);
    }
}
?>
<?php
// Fetch data from the database
$board_data = mysqli_query($con, "SELECT S_board, COUNT(*) as count FROM ssc_edu_data GROUP BY S_board");

// Initialize an array to store modified chart data
$modified_chart_data_board = array();
$other_count = 0;

// Loop through the fetched data
while ($row = mysqli_fetch_assoc($board_data)) {
    // Check if the board is CBSE
    if ($row['S_board'] == 'CBSE') {
        // Add the count to the other category
        $other_count += $row['count'];
    } else {
        // Add the data to the modified chart data array
        $modified_chart_data_board[] = array($row['S_board'], intval($row['count']));
    }
}

// Add the combined count for CBSE and other categories
$modified_chart_data_board[] = array('Other', $other_count);
?>
<?php
// Fetch data from the database for grade category analysis
$grade_data = mysqli_query($con, "SELECT S_grade, COUNT(*) as count FROM ssc_edu_data GROUP BY S_grade");

// Initialize an array to store the chart data for grade category
$chart_data_grade = array();

// Loop through the fetched data
while ($row = mysqli_fetch_assoc($grade_data)) {
    // Add the grade and count to the chart data array
    $chart_data_grade[] = array($row['S_grade'], intval($row['count']));
}
?>
<?php
// Fetch SSC data from the database
$ssc_data = mysqli_query($con, "SELECT * FROM ssc_edu_data ORDER BY Enroll_id ASC");

$num_rows = mysqli_num_rows($ssc_data);
$percentage_data = array(); // Array to store percentage data
$percentile_data = array(); // Array to store percentile data

if ($num_rows > 0) {
    $counter = 1; // Start counter from 1
    while ($row = mysqli_fetch_assoc($ssc_data)) {
        // Ensure percentage and percentile values are between 0 and 100
        $percentage = min(max($row['S_percentage'], 0), 100);
        $percentile = min(max($row['S_percentile'], 0), 100);

        // Store data for percentage and percentile
        $percentage_data[] = array($counter, $percentage);
        $percentile_data[] = array($counter, $percentile);

        // Increment counter
        $counter++;
    }
}
?>
<?php

// Fetching combined percentage data
$combined_percentage_data = array();
$combined_percentage_query = mysqli_query($con, "SELECT S_percentage FROM ssc_edu_data ORDER BY Enroll_id ASC");
while ($row = mysqli_fetch_assoc($combined_percentage_query)) {
    $percentage = min(max($row['S_percentage'], 0), 100);
    $combined_percentage_data[] = $percentage;
}

// Fetching combined percentile data
$combined_percentile_data = array();
$combined_percentile_query = mysqli_query($con, "SELECT S_percentile FROM ssc_edu_data ORDER BY Enroll_id ASC");
while ($row = mysqli_fetch_assoc($combined_percentile_query)) {
    $percentile = min(max($row['S_percentile'], 0), 100);
    $combined_percentile_data[] = $percentile;
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
    <title>Performance Comparison ssc</title>
    <link rel="stylesheet" href="style/fhome.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/graph.css">
    <link rel="stylesheet" href="style/footer.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawLineChart();
            drawScatterChartPercentage();
            drawScatterChartPercentile();
            drawPieChart();
            drawPieChartGrade();
            drawAreaChartPercentage();
            drawAreaChartPercentile();
            drawCombinedAreaChart();
        }

        function drawLineChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentage');
            data.addColumn('number', 'Percentile');

            <?php
            foreach ($chart_data as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Performance Comparison',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Enrollment ID',
                    minValue: 1,
                    maxValue: <?php echo $num_rows; ?>
                }, // Start from 1
                vAxis: {
                    title: 'Percentage / Percentile',
                    minValue: 0,
                    maxValue: 100
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        bold: true,
                        italic: false,
                        color: '#000000',
                        auraColor: 'none'
                    }
                }
            };

            var chart1 = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart1.draw(data, options);

            var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
            chart2.draw(data, options);
        }

        function drawScatterChartPercentage() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentage');

            <?php
            foreach ($chart_data as $row) {
                echo "data.addRow([" . $row[0] . "," . $row[1] . "]);";
            }
            ?>

            var options = {
                title: 'Percentage Scatter Plot',
                hAxis: {
                    title: 'Enrollment ID'
                },
                vAxis: {
                    title: 'Percentage'
                }
            };

            var chart = new google.visualization.ScatterChart(document.getElementById('scatter_percentage'));
            chart.draw(data, options);
        }

        function drawScatterChartPercentile() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentile');

            <?php
            foreach ($chart_data as $row) {
                echo "data.addRow([" . $row[0] . "," . $row[2] . "]);";
            }
            ?>

            var options = {
                title: 'Percentile Scatter Plot',
                hAxis: {
                    title: 'Enrollment ID'
                },
                vAxis: {
                    title: 'Percentile'
                }
            };

            var chart = new google.visualization.ScatterChart(document.getElementById('scatter_percentile'));
            chart.draw(data, options);
        }

        function drawPieChart() {
            // Create DataTable for pie chart
            var data_board = new google.visualization.DataTable();
            data_board.addColumn('string', 'Board');
            data_board.addColumn('number', 'Count');
            data_board.addRows(<?php echo json_encode($modified_chart_data_board); ?>);

            // Customize options for pie chart
            var options_board = {
                title: 'Board Category Analysis',
                pieHole: 0.4
            };

            // Draw the pie chart
            var chart_board = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart_board.draw(data_board, options_board);

        }

        function drawPieChartGrade() {
            // Create DataTable for pie chart
            var data_grade = new google.visualization.DataTable();
            data_grade.addColumn('string', 'Grade');
            data_grade.addColumn('number', 'Count');
            data_grade.addRows(<?php echo json_encode($chart_data_grade); ?>);

            // Customize options for pie chart
            var options_grade = {
                title: 'Grade Category Analysis',
                pieHole: 0.4
            };

            // Draw the pie chart
            var chart_grade = new google.visualization.PieChart(document.getElementById('chart_div_grade'));
            chart_grade.draw(data_grade, options_grade);
        }

        function drawAreaChartPercentage() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentage');

            <?php
            foreach ($percentage_data as $row) {
                echo "data.addRow([" . $row[0] . ", " . $row[1] . "]);";
            }
            ?>

            var options = {
                title: 'Percentage Area Chart',
                hAxis: {
                    title: 'Enrollment ID'
                },
                vAxis: {
                    title: 'Percentage'
                },
                isStacked: true,
                legend: {
                    position: 'top'
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div_percentage'));
            chart.draw(data, options);
        }

        function drawAreaChartPercentile() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentile');

            <?php
            foreach ($percentile_data as $row) {
                echo "data.addRow([" . $row[0] . ", " . $row[1] . "]);";
            }
            ?>

            var options = {
                title: 'Percentile Area Chart',
                hAxis: {
                    title: 'Enrollment ID'
                },
                vAxis: {
                    title: 'Percentile'
                },
                isStacked: true,
                legend: {
                    position: 'top'
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div_percentile'));
            chart.draw(data, options);
        }

        function drawCombinedAreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentage');
            data.addColumn('number', 'Percentile');

            <?php
            // Merge percentage and percentile data
            $combined_data = array();
            foreach ($percentage_data as $index => $row) {
                $combined_data[] = array_merge($row, array($percentile_data[$index][1]));
            }

            // Add combined data to JavaScript DataTable
            foreach ($combined_data as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Combined Percentage and Percentile Area Chart',
                hAxis: {
                    title: 'Enrollment ID'
                },
                vAxis: {
                    title: 'Percentage / Percentile'
                },
                isStacked: true,
                series: {
                    0: {
                        color: 'blue'
                    }, // Percentage
                    1: {
                        color: 'red'
                    } // Percentile
                },
                legend: {
                    position: 'top'
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div_combined'));
            chart.draw(data, options);
        }

        function drawCombinedAreaChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Enrollment ID');
            data.addColumn('number', 'Percentage');
            data.addColumn('number', 'Percentile');

            <?php
            // Merge combined percentage and percentile data
            $combined_data = array();
            foreach ($combined_percentage_data as $index => $percentage) {
                $combined_data[] = array($index + 1, $percentage, $combined_percentile_data[$index]);
            }

            // Add combined data to JavaScript DataTable
            foreach ($combined_data as $row) {
                echo "data.addRow([" . implode(",", $row) . "]);";
            }
            ?>

            var options = {
                title: 'Combined Percentage and Percentile Area Chart',
                hAxis: {
                    title: 'Enrollment ID'
                },
                vAxis: {
                    title: 'Percentage / Percentile'
                },
                isStacked: true,
                series: {
                    0: {
                        color: 'blue'
                    }, // Percentage
                    1: {
                        color: 'red'
                    } // Percentile
                },
                legend: {
                    position: 'top'
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div_combined'));
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

            <?php
            echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>";
            ?>
            <a href="php/logout.php">Log Out </a>

        </div>
    </div>
    <center>
        <div class="personaldataimg">
            <img src="imgs/performance-f1.png" alt="Personal data logo" style="width: 100%;">
        </div>
        <div>
            <p>If you want to change/update data then please <a href="educationaldetails_ssc_edit.php"><span style="color: blue;">update</span></a> your details .</p>
        </div>
    </center>
    <div class="div-header">
        <h1>
            SSC Student Performance Analysis
        </h1>
        <p style="font-size: 20px;">Enrollment Number : <?php echo $id; ?></p>

    </div>

    <div class="dashboard-container">
        <div class="dashboard-content">

            <div id="section">
                <div id="scatter_percentage" class="chart" style="width: 50%; height: 500px;"></div>
                <div id="scatter_percentile" class="chart" style="width: 50%; height: 500px;"></div>
            </div>


            <div id="chart_div_percentage" class="chart"></div>
            <div id="chart_div_percentile" class="chart"></div>
            <div id="chart_div_combined" class="chart"></div>


            <div id="section">
                <div id="chart_div2" class="chart" style="width: 100%; height: 500px;"></div>
                <div id="chart_div_grade" class="chart" style="width: 100%; height: 500px;"></div>
            </div>

            <div id="chart_div" class="chart" style="width: 100%; height: 400px;"></div>

            <div id="chart_div1" class="chart" style="width: 100%; height: 400px;"></div>
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