 <?php

    require 'connect.php';

// SQL query to retrieve student data
$sql = "SELECT studentName, registration, Class, maths, english, kiswaili, science, social, tarehe FROM student_details ORDER BY (maths + english + kiswaili + science + social) DESC";

$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
     $count = 1;
    while ($row = $result->fetch_assoc()) {

        $total = $row['maths'] + $row['english'] + $row['kiswaili'] + $row['science'] + $row['social'];
        echo '<tr>';
        echo '<td>' . $count . '</td>';
        echo '<td>' . $row['studentName'] . '</td>';
        echo '<td>' . $row['registration'] . '</td>';
        echo '<td>' . $row['Class'] . '</td>';
        echo '<td>' . $row['maths'] . '</td>';
        echo '<td>' . $row['english'] . '</td>';
        echo '<td>' . $row['kiswaili'] . '</td>';
        echo '<td>' . $row['science'] . '</td>';
        echo '<td>' . $row['social'] . '</td>';
        echo '<td>' . $total . '</td>';
        echo '<td>' . $row['tarehe'] . '</td>';
        echo '</tr>';
        $count++;
    }
} else {
    echo "No records found.";
}

// Close the database connection
$conn->close();
?>