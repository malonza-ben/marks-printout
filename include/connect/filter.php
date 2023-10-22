<?php
    require 'connect.php'; // Ensure you have a valid database connection in 'connect.php'

    // Check if the "Confirm Details" button was clicked
    if (isset($_POST['printButton'])) {
        $studentId = $_POST['studentId'];

        // SQL query to retrieve a specific student's details based on registration number
        $sql = "SELECT studentName, registration, Class, maths, english, kiswaili, science, social, total, date FROM student_details WHERE registration = '$studentId'";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo '<table>'; // Start a table to display the results
                echo '<tr><th>Name</th><th>Registration</th><th>Class</th><th>Maths</th><th>English</th><th>Kiswaili</th><th>Science</th><th>Social</th><th>Total</th><th>Date</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    $total = $row['maths'] + $row['english'] + $row['kiswaili'] + $row['science'] + $row['social'];
                    echo '<tr>';
                    echo '<td>' . $row['studentName'] . '</td>';
                    echo '<td>' . $row['registration'] . '</td>';
                    echo '<td>' . $row['Class'] . '</td>';
                    echo '<td>' . $row['maths'] . '</td>';
                    echo '<td>' . $row['english'] . '</td>';
                    echo '<td>' . $row['kiswaili'] . '</td>';
                    echo '<td>' . $row['science'] . '</td>';
                    echo '<td>' . $row['social'] . '</td>';
                    echo '<td>' . $total . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>'; // End the table
            } else {
                echo "No records found for the provided registration number.";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>